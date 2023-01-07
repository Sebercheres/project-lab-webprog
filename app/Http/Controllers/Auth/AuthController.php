<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'username' => 'required|max:255|min:5',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed|alpha_num',
        ]);

        // Create the user
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Session::put('message', 'You have successfully registered. Please login to continue.');

        // Redirect the user to the login page
        return redirect()->route('login');
    }

    public function showLoginForm()
    {
        return view('auth.login', ['success']);
    }

    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        Session::invalidate();

        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // If successful, redirect the user to the intended page
            return redirect()->intended('/');
        } else {
            // If unsuccessful, redirect the user back to the login page with an error message
            return redirect()->back()->withErrors('Invalid email or password');
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::invalidate();
        return redirect()->route('login');
    }
}
