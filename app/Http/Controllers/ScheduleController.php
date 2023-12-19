<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Price;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'doctor') {
            $services = Service::all();
            $data = Schedule::where('doctor_id', Auth::id())->where('payment', true)->get();
            $data->load('patient');
            return view('doctor.schedules', ['schedules' => $data, 'services' => $services]);
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
        $doctors = User::where('role', 'doctor')
            ->where(function ($query) {
                $query->orWhereNotNull('available_1')
                    ->orWhereNotNull('available_2')
                    ->orWhereNotNull('available_3');
            })
            ->get();
        return view('patient.chat', ['services' => $data, 'totalServices' => $total, 'doctors' => $doctors]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'availableTime' => 'required',
                'availableDoctor' => 'required',
                'serviceChoice' => 'required',
                'shortDescription' => 'required|string',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                ['errors' => $validator->errors()],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $selectedService = Service::where('id', $request->serviceChoice)->first();
        $doctor = User::find($request->availableDoctor);
        if ($doctor) {
            if ($request->availableTime == 1) {
                $availableTime = $doctor->available_1;
                $doctor->available_1 = null;
                $doctor->update();
            } elseif ($request->availableTime == 2) {
                $availableTime = $doctor->available_2;
                $doctor->available_2 = null;
                $doctor->update();
            } elseif ($request->availableTime == 3) {
                $availableTime = $doctor->available_3;
                $doctor->available_3 = null;
                $doctor->update();
            } else {
                # code...
            }
            $price = Price::latest()->first();
            $schedule = new Schedule;
            $schedule->title = $selectedService->title;
            $schedule->user_id = Auth::id();
            $schedule->doctor_id = $doctor->id;
            $schedule->date = $availableTime;
            $schedule->comment = $request->shortDescription;
            $schedule->save();
            $payment = new Payment;
            $payment->amount = $price->amount;
            $payment->schedule_id = $schedule->id;
            $payment->user_id = Auth::id();
            $payment->save();
            return response()->json(['message' => 'chat created']);
        } else {
            return response()->json(['message' => 'Doctor not found']);
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

    public function report(Request $request)
    {
        if (Auth::user()->role == 'admin') {
            $total = Payment::sum('amount');
            $data = Schedule::with('patient', 'doctor', 'payments')
                ->where('title', $request->status)
                ->whereYear('date', '=', $request->year)
                ->get();
            $groupedData = $data->groupBy('doctor_id');
            $doctorIncomes = [];
            foreach ($groupedData as $doctorId => $schedules) {
                $totalIncome = $schedules->sum(function ($schedule) {
                    return $schedule->payments->amount ?? 0;
                });
                $doctorIncomes[$doctorId] = $totalIncome;
            }
            $pdf = Pdf::loadView('admin.report', ['groupedData' => $groupedData, 'doctorIncomes' => $doctorIncomes, 'income' => $total]);
            return $pdf->download('report.pdf');
        } else {
            $data = Schedule::where('doctor_id', Auth::id())
                ->where('title', $request->status)
                ->whereYear('date', '=', $request->year)
                ->get();
            $data->load('patient', 'doctor');
            $pdf = Pdf::loadView('doctor.report', ['data' => $data]);
            return $pdf->download('report.pdf');
        }
    }
}
