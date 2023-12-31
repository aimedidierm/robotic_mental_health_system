<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function landing()
    {
        $data = Testimonial::get();
        $data->load('user');
        return view('landing', ['data' => $data]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email', $email)->first();
        if ($user != null) {
            $passwordMatch = Hash::check($password, $user->password);
            if ($passwordMatch) {
                Auth::login($user);
                if ($user->role == 'patient') {
                    return redirect("/patient");
                } elseif ($user->role == 'doctor') {
                    return redirect("/doctor");
                } elseif ($user->role == 'admin') {
                    return redirect("/admin");
                } else {
                    return back()->withErrors('Role not found');
                }
            } else {
                return redirect(route("login"))->withErrors(['msg' => 'Incorect password']);
            }
        } else {
            return redirect(route("login"))->withErrors(['msg' => 'Incorect email and password']);
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect(route("login"));
        } else {
            return back();
        }
    }

    public function signup()
    {
        $data = Province::get()->load('districts.sectors.cells.villages');
        return view('sign-up', ['address' => $data]);
    }
}
