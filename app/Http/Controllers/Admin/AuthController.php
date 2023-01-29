<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.login.index');
    }

    public function checkLogin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.post.index');
        }
        return redirect()->route('admin.auth.login')->with('error', 'Email or Password is invalid');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.auth.login');
    }

    public function profile()
    {
        return view('admin.login.profile');
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ], [
            'name.required' => 'User name is required',
        ]);

        $user = Auth::user();

        $data = ([
            'name' => $request->name,
        ]);

        if ($request->password) {
            $this->validate($request, [
                'password' => 'required',
                'confirm_password' => 'same',
            ], [
                'name.required' => 'Password is required',
            ]);
            $data['password'] = bcrypt($request->password);
        };

        $user->update($data);

        return redirect()->route('admin.profile.index', $user->id)->with('success', 'Update Successfully');
    }
}
