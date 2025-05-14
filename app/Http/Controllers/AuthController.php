<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show the login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle the login form submission
    public function login(Request $request)
    {
        // Validate the form input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($request->only('email', 'password'))) {
            // Redirect to the dashboard if authentication is successful
            return redirect()->route('dashboard');
        }

        // If authentication fails, redirect back with an error message
        return back()->withErrors(['email' => 'The provided credentials are incorrect.']);
    }
}

