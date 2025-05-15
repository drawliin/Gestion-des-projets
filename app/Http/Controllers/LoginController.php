<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login logic
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Attempt to log the user in
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // Get logged in user
    
            // Role-based redirection
            switch ($user->role) {
                case 'admin':
                    return redirect()->intended('/admin/dashboard');
                case 'gestionnaire':
                    return redirect()->intended('/gestionnaire/dashboard');
                case 'responsable_financier':
                    return redirect()->intended('/financier/dashboard');
                case 'directeur':
                    return redirect()->intended('/directeur/dashboard');
                default:
                    return redirect()->intended('/'); // fallback
            }
        }
    
        // Redirect back with error if login fails
        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->withInput();
    }
}    