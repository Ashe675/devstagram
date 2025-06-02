<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }


    public function store(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->username),
            'email' => Str::lower($request->email)]);


        // Validate the request data
        $request->validate([
            'name' => 'required|string|min:2|max:30',
            'username' => 'required|string|min:3|max:20|unique:users',
            'email' => 'required|string|email|max:60|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);


        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ]);

        // Optionally, you can log the user in after registration
        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('posts.index', auth()->user()->username)->with('success', 'Account created successfully!');
    }
}
