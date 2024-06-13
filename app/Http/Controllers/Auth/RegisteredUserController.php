<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TeamUserCodes;
use App\Models\User;
use App\Models\UserTeam;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        try {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'integer', 'unique:'.User::class],
            'number' => ['required', 'integer', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        DB::beginTransaction();

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'number' => $request->number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol_id' => 4,
        ]);

        UserTeam::create([
            'user_id' => $user->id,
            'team_id' => TeamUserCodes::where('code', $request->code)->first()->team_id,
        ]);

        event(new Registered($user));

        DB::commit();

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return back()->with('error', 'Ha ocurrido un error, por favor intenta de nuevo.');
        }
    }
}
