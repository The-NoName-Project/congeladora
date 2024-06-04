<?php

namespace App\Http\Controllers;

use App\Models\Schedules;
use App\Utils\DateUtil;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedules::all();
        $dates =  [
            'Lunes',
            'Martes',
            'Miércoles',
            'Jueves',
            'Viernes',
            'Sábado',
            'Domingo'
        ];


        return view('schedules.index', compact('schedules', 'dates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'date' => ['required'],
                'opening_time' => ['required', 'before:closing_time'],
                'closing_time' => ['required', 'after:opening_time'],
            ]);

            $date = DateUtil::translateDayOfWeek($request->date);
            $date = DateUtil::dayOfWeekDate($date);

            $request->merge([
                'date' => $date->format('Y-m-d'),
                'opening_time' => Carbon::parse($request->opening_time)
                    ->format('H:i'),
                'closing_time' => Carbon::parse($request->closing_time)
                    ->addHour()->format('H:i'),
            ]);

            DB::beginTransaction();

            Schedules::create($request->all());

            DB::commit();

            return redirect()->route('schedules.index')->with('success', 'Schedule created successfully');
        } catch (\Exception $e) {
            Log::error('An error occurred while creating the schedule', ['error' => $e->getMessage()]);

            return redirect()->route('schedules.index')->with('error', 'An error occurred while creating the schedule')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($date)
    {
        try {

        $date = Carbon::parse($date)->format('l');
        $weekday = DateUtil::dateOfday($date);

        $weekday = $weekday->format('Y-m-d');

        $schedules_times = Schedules::where('date', $weekday)->first();

        if ($schedules_times === null) {
            return response()->json(['error' => 'No schedules found for this day']);
        }

        $times = [];
        $i = 0;
        $period = CarbonPeriod::create(
            $schedules_times->opening_time,
            1 . 'hour',
            $schedules_times->closing_time
        )
            ->toArray();

        while($i < count($period) - 1) {
            $times[] = [
                'starting_time' => $period[$i]->format('H:i'),
                'ending_time' => $period[$i + 1]->format('H:i')
            ];

            $i++;
        }

        return response()->json($times);
        } catch (\Exception $e) {
            Log::error('An error occurred while creating the schedule', ['error' => $e->getMessage()]);

            return redirect()->route('schedules.index')->with('error', 'An error occurred while creating the schedule')->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedules $schedules)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedules $schedules)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedules $schedules)
    {
        //
    }
}
