<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Paypack\Paypack;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Payment::latest()->get();
        $data->load('user');
        return view('admin.payments', ['payments' => $data]);
    }

    public function patientList()
    {
        $data = Payment::latest()->where('user_id', Auth::id())->get();
        return view('patient.payments', ['payments' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate(
            [
                'payment' => 'required|numeric',
                'phone' => 'required|numeric|regex:/^07\d{8}$/',
            ],
            [
                'phone.regex' => 'The phone number must start with "07" and be 10 digits long.',
            ]
        );
        $payment = Payment::find($request->payment);
        $token = Str::random(10);
        if ($payment != null) {
            $schedule = Schedule::find($payment->schedule_id);
            $schedule->payment = true;
            $schedule->update();
            $payment->status = 'payed';
            $payment->update();
            $paypackInstance = $this->paypackConfig()->Cashin([
                "amount" => $payment->amount,
                "phone" => $request->phone,
            ]);
            return redirect('/amployee/payments');
        } else {
            return redirect('/employee/payments')->withErrors('Payment not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function paypackConfig()
    {
        $paypack = new Paypack();

        $paypack->config([
            'client_id' => env('PAYPACK_CLIENT_ID'),
            'client_secret' => env('PAYPACK_CLIENT_SECRET'),
        ]);

        return $paypack;
    }
}
