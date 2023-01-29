<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function formRegister()
    {
        return view('web.auth.register');
    }

    public function register(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'confirm_password' => 'same:password',
            ]
        );

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => 0,
        ]);

        return redirect()->route('web.auth.form-login')->with('success', 'Registered Successfully');
    }

    public function formLogin()
    {
        return view('web.auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/');
        }
        return redirect()->back()->with('error', 'Your Email or Password are invalid');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
