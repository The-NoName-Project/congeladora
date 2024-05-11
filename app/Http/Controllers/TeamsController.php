<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\TableMatch;
use App\Models\Teams;
use App\Models\TeamUserCodes;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;
use Barryvdh\DomPDF\Facade\Pdf;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->rol_id === 3) {
            $teams = Teams::with('capitan', 'players')
                ->where('user_id', $user->id)->get();

            return view('teams.index', compact('teams'));
        }

        $teams = Teams::with('capitan', 'players')->get();

        return view('teams.index', compact('teams'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('teams.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate(['name' => ['required', 'string', 'min:3', 'unique:' . Teams::class,], 'logo' => ['required', 'file'], 'slug' => ['required', 'string', 'min:3', 'unique:' . Teams::class], 'name_user' => ['required', 'string', 'max:255'], 'number' => ['required', 'integer'], 'phone' => ['required', 'integer'], 'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],]);

            $user = User::create(['name' => $request->name_user, 'email' => $request->email, 'phone' => $request->phone, 'number' => $request->number, 'password' => Hash::make('12345678'), 'rol_id' => 3]);

            if ($request->file('logo')) {
                $team = 'team/' . str_replace(" ", "_", $request->name) . '_' . date('Y-m-d') . '_' . $request->file('logo')->getClientOriginalName();
                $team = $request->file('logo')->storeAs('public', $team);
                $team = str_replace("public/", "", $team);
            }

            $team = Teams::create(['name' => $request->name, 'slug' => $request->slug, 'logo' => $team, 'user_id' => $user->id, 'category_id' => $request->category_id]);

            TableMatch::create(['team_id' => $team->id, 'matches' => 0, 'wins' => 0, 'losses' => 0, 'draws' => 0, 'points' => 0, 'goals_for' => 0, 'goal_difference' => 0, 'goals_against' => 0, 'category_id' => $team->category_id]);

            //crea 12 codigo para el equipo
            for ($i = 0; $i < 12; $i++) {
                $code = Str::random(10);
                TeamUserCodes::create(['code' => $code, 'team_id' => $team->id,]);
            }

            DB::commit();

            return redirect()->route('teams.index')->with('status', __('Team Created Successfully!'));
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Error al crear el equipo correspondiente');
            Log::error($exception);

            return redirect()->back()->withInput()->with('statusError', __('Error creating the team'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $id = Hashids::decode($id)[0];
        $team = Teams::with('capitan', 'players')->find($id);

        return view('teams.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = Hashids::decode($id)[0];
        $capitans = User::leftJoin('teams', 'users.id', '=', 'teams.user_id')->where('users.rol_id', 3)->whereNull('teams.id')  // Filter users without a team
            ->select('users.*')->get();

        $team = Teams::find($id);

        return view('teams.edit', compact('capitans', 'team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];
        $request->validate(['name' => ['string', 'min:3'], 'acronym' => ['string', 'max:4'], 'team' => ['file'], 'capitan_id' => ['integer', 'exists:' . User::class . ',id'],]);

        $teams = Teams::find($id);

        if ($request->file('team')) {
            $team = 'team/' . str_replace(" ", "_", $request->name) . '_' . date('Y-m-d') . '_' . $request->file('team')->getClientOriginalName();
            $team = $request->file('team')->storeAs('public', $team);
            $team = str_replace("public/", "", $team);
            $teams->team = $team;
            $teams->save();
        }

        $teams->update($request->all());

        return redirect()->route('teams.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $team = Teams::find($id);
            TableMatch::where('team_id', $team->id)->delete();
            TeamUserCodes::where('team_id', $team->id)->delete();
            Storage::delete('public/'.$team->logo);
            $team->delete();

            return redirect()->route('teams.index')->with('status', 'Equipo eliminado correctamente');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1451) {
                // Error de integridad referencial (clave foránea)
                return redirect()->route('teams.index')->with('statusError', 'No se puede eliminar el Equipo. Primero elimina los jugadores asociados');
            }

            // Otro tipo de error, puedes manejarlo según tus necesidades
            return redirect()->route('teams.index')->with('statusError', 'Error al eliminar el Equipo: ' . $e->getMessage());
        }
    }

    public function showJson($id): JsonResponse
    {
        $team = Teams::withTrashed()->find($id);

        return response()->json($team);
    }

    public function pdf($id)
    {
        try {
            $team = Teams::find($id);
            $codes = TeamUserCodes::where('team_id', $team->id)
                ->where('used', false)
                ->get();
            $team->codes = $codes;

            $pdf = PDF::loadView('teams.pdf', compact('team'));

            return $pdf->stream('team.pdf');

        } catch (\Exception $exception) {
            Log::error('Error al generar el PDF del equipo correspondiente');
            Log::error($exception);

            return redirect()->back()->with('statusError', __('Error generating the team PDF'));
        }
    }
}
