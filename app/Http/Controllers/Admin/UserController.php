<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.list', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'is_admin' => 'required',
            'password' => 'required',
            'confirm_password' => 'same:password',
        ], [
            'name.required' => 'User name is required',
            'email.required' => 'Email is required',
            'is_admin.required' => 'This field is required',
            'password.required' => 'Password is required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => $request->is_admin,
        ]);

        return redirect()->route('admin.user.index')->with('success', 'Create Successfully');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'is_admin' => 'required',
        ], [
            'name.required' => 'User name is required',
            'is_admin.required' => 'This field is required',
        ]);

        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'is_admin' => $request->is_admin,
            'password' => $request->password ? $request->password : $user->password
        ]);

        return redirect()->route('admin.user.edit', $user->id)->with('success', 'Update Successfully');
    }

    public function delete($id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('admin.user.index')->with('success', 'Delete Successfully');
    }
}
