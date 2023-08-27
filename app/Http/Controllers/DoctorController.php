<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
    public function update(Request $request, string $id)
    {
        //
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
