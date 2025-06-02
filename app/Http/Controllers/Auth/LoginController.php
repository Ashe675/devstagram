<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (!auth()->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return back()->with([
                'error' => 'The provided credentials do not match our records.',
            ]);
        }


        $redirect = $request->input('redirect') ?? route('posts.index', auth()->user()->username);
        return redirect()->to($redirect)->with('success', 'Logged in successfully!');
    }
}
