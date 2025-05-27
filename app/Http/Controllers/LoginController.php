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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user(); 

            if($user->hasRole("directeur")){
                return redirect()->route("dashboard");
            }
            if($user->hasRole("financier")){
                return redirect()->route("couts.index");
            }

            return redirect()->route('province.index');
        }
    
        return back()->withErrors([
            'email' => 'Invalid credentials',
        ])->withInput();
    }
}