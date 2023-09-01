<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'doctor') {
            $data = Schedule::where('doctor_id', Auth::id())->get();
            $data->load('patient');
            return view('doctor.schedules', ['schedules' => $data]);
        } else if (Auth::user()->role == 'patient') {
            $data = Schedule::where('user_id', Auth::id())->get();
            $data->load('doctor');
            return view('patient.schedules', ['schedules' => $data]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Service::get();
        $total = Service::get()->count();
        return view('patient.chat', ['services' => $data, 'totalServices' => $total]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'availabilityTime' => 'required|date',
            'serviceChoice' => 'required|numeric',
            'shortDescription' => 'required|string',
        ]);

        $selectedService = Service::where('id', $request->serviceChoice)->first();
        $doctorId = User::where('role', 'doctor')->inRandomOrder()->first();
        $schedule = new Schedule;
        $schedule->title = $selectedService->title;
        $schedule->user_id = Auth::id();
        $schedule->doctor_id = $doctorId->id;
        $schedule->date = $request->availabilityTime;
        $schedule->comment = $request->shortDescription;
        $schedule->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
