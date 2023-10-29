<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show Register/Create form
    public function index()
    {
        return view("users.register");
    }

    public function login(Request $request)
    {
        return view("users.login");
    }

    public function authenticate(Request $request){
        $formFields = $request->validate([
            "email"=> ["required","email"],
            "password"=> ["required"]
        ]);
        if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            return redirect("/")->with("success","Welcome!");
        }
        return back()->withErrors(['email'=> 'Invalid credentials'])->onlyInput('email');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            "name" => ["required", "string", "min:3"],
            "email" => ["required", "string", "email", Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'confirmed'],
            // in we have 'confirmed', it will check for another field of type password_validation

        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create user
        $user = User::create($formFields);

        // Login
        auth()->login($user);

        return redirect('/')->with('success', 'User created and logged in');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect('/')->with('success', 'Goodbye!');
    }
}