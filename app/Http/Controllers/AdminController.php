<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = User::latest()->where('role', 'admin')->get();
        return view('admin.admins', ['admins' => $admins]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $price = Price::latest()->first();
        return view('admin.settings', compact('price'));
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

        $admin = new User;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->role = 'admin';
        $admin->password = bcrypt('password');
        $admin->save();
        return redirect('/admin');
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
                'price' => 'required|numeric'
            ],
            $messages = [
                'phone.regex' => 'The phone number must start with "07" and be 10 digits long.',
            ]
        );

        if ($request->password == $request->password_confirmation) {
            $admin = User::find(Auth::id());
            $admin->name = $request->name;
            $admin->phone = $request->phone;
            $admin->password = bcrypt($request->password);
            $admin->update();
            $price = new Price;
            $price->amount = $request->price;
            $price->save();
            return redirect('/admin/settings');
        } else {
            return redirect('/admin/settings')->withErrors('Passwords not match');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = User::find($id);
        if ($admin != null) {
            $admin->delete();
            return redirect('/admin');
        } else {
            return redirect('/admin')->withErrors('Admin account not found');
        }
    }
}
