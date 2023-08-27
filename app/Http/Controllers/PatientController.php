<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
