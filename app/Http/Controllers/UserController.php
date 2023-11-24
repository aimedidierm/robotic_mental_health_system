<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
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
        $request->validate(
            [
                'name' => 'required|string',
                'province' => 'required|string',
                'district' => 'required|string',
                'sector' => 'required|string',
                'cell' => 'required|string',
                'village' => 'required|string',
                'sponsor' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|numeric|regex:/^07\d{8}$/',
                'password' => 'required|string',
                'confirmPassword' => 'required|string',
                'age' => 'required|date',
                'status' => 'required|string|in:single,married,divorced',

            ],
            $messages = [
                'phone.regex' => 'The phone number must start with "07" and be 10 digits long.',
            ]
        );
        if ($request->password == $request->confirmPassword) {
            $user = new User;
            $user->name = $request->name;
            $user->province = $request->province;
            $user->district = $request->district;
            $user->sector = $request->sector;
            $user->cell = $request->cell;
            $user->village = $request->village;
            $user->sponsor = $request->sponsor;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->age = $request->age;
            $user->m_status = $request->status;
            $user->password = bcrypt($request->password);
            $user->role = 'patient';
            $user->created_at = now();
            $user->updated_at = null;
            $user->save();
            return redirect('/');
        } else {
            return redirect('/')->withErrors('Passwords not match');
        }
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
        //
    }
}
