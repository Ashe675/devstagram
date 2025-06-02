<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    
    public function store(Request $request)
    {
        // Log the user out
        auth()->logout();

        // Redirect to the home page with a success message
        return redirect()->route('home')->with('success', 'Logged out successfully!');
    }
    
}
