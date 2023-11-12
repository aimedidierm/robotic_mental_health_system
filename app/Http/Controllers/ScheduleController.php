<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'doctor') {
            $data = Schedule::where('doctor_id', Auth::id())->where('payment', true)->get();
            $data->load('patient');
            return view('doctor.schedules', ['schedules' => $data]);
        } else if (Auth::user()->role == 'patient') {
            $data = Schedule::where('user_id', Auth::id())->where('payment', true)->get();
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
        $doctors = User::where('role', 'doctor')->where('available', true)->get();
        return view('patient.chat', ['services' => $data, 'totalServices' => $total, 'doctors' => $doctors]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'availlableDoctor' => 'required',
            'serviceChoice' => 'required|numeric',
            'shortDescription' => 'required|string',
        ]);

        $selectedService = Service::where('id', $request->serviceChoice)->first();
        $doctor = User::find($request->availlableDoctor);
        if ($doctor) {
            $schedule = new Schedule;
            $schedule->title = $selectedService->title;
            $schedule->user_id = Auth::id();
            $schedule->doctor_id = $doctor->id;
            $schedule->date = now();
            $schedule->comment = $request->shortDescription;
            $schedule->save();
            $payment = new Payment;
            $payment->amount = 400;
            $payment->schedule_id = $schedule->id;
            $payment->user_id = Auth::id();
            $payment->save();
        } else {
            # code...
        }
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

    public function report()
    {
        if (Auth::user()->role == 'admin') {
            $data = Schedule::get();
            $data->load('patient', 'doctor', 'payments');
            $income = Payment::sum('amount');
            $pdf = Pdf::loadView('admin.report', ['data' => $data, 'income' => $income]);
            return $pdf->download('report.pdf');
        } else {
            $data = Schedule::where('doctor_id', Auth::id())->get();
            $data->load('patient');
            $pdf = Pdf::loadView('doctor.report', ['data' => $data]);
            return $pdf->download('report.pdf');
        }
    }
}
