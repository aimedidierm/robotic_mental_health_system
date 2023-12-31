<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = User::latest()->where('role', 'doctor')->get();
        return view('admin.doctors', ['doctors' => $doctors]);
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
        $request->validate(
            [
                'name' => 'required|string',
                'email' => 'required|email|string|unique:users,email',
                'phone' => 'required|numeric|regex:/^07\d{8}$/',
            ],
            $messages = [
                'phone.regex' => 'The phone number must start with "07" and be 10 digits long.',
            ]
        );

        $doctor = new User;
        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->phone = $request->phone;
        $doctor->role = 'doctor';
        $doctor->password = bcrypt('password');
        $doctor->save();
        return redirect('/admin/doctors');
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
                'password' => 'nullable|string',
                'password_confirmation' => 'nullable|string',
                'phone' => 'required|numeric|regex:/^07\d{8}$/',
                'available_1' => 'required|date',
                'available_2' => 'required|date',
                'available_3' => 'required|date'
            ],
            $messages = [
                'phone.regex' => 'The phone number must start with "07" and be 10 digits long.',
            ]
        );
        if ($request->has('password')) {
            if ($request->password == $request->password_confirmation) {
                $doctor = User::find(Auth::id());
                $doctor->name = $request->name;
                $doctor->phone = $request->phone;
                $doctor->available_1 = $request->available_1;
                $doctor->available_2 = $request->available_2;
                $doctor->available_3 = $request->available_3;
                $doctor->password = bcrypt($request->password);
                $doctor->update();
                return redirect('/doctor/settings');
            } else {
                return redirect('/doctor/settings')->withErrors('Passwords not match');
            }
        } else {
            $doctor = User::find(Auth::id());
            $doctor->name = $request->name;
            $doctor->phone = $request->phone;
            $doctor->available_1 = $request->available_1;
            $doctor->available_2 = $request->available_2;
            $doctor->available_3 = $request->available_3;
            $doctor->update();
            return redirect('/doctor/settings');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = User::find($id);
        if ($doctor != null) {
            $doctor->delete();
            return redirect('/admin/doctors');
        } else {
            return redirect('/admin/doctors')->withErrors('Doctor account not found');
        }
    }
}
