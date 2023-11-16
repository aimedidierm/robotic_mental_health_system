<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function print()
    {

        $data = User::where('role', 'patient')->get();
        $pdf = Pdf::loadView('admin.patients', ['patients' => $data]);
        return $pdf->download('patients.pdf');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string',
                'password' => 'required|string',
                'password_confirmation' => 'required|string',
                'phone' => 'required|numeric|regex:/^07\d{8}$/',
            ],
            $messages = [
                'phone.regex' => 'The phone number must start with "07" and be 10 digits long.',
            ]
        );

        if ($request->password == $request->password_confirmation) {
            $patient = User::find(Auth::id());
            $patient->name = $request->name;
            $patient->phone = $request->phone;
            $patient->password = bcrypt($request->password);
            $patient->update();
            return redirect('/patient/settings');
        } else {
            return redirect('/patient/settings')->withErrors('Passwords not match');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
