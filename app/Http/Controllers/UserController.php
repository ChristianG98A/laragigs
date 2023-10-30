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

    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            "email" => ["required", "email"],
            "password" => ["required"]
        ]);
        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect("/")->with("success", "Welcome!");
        }
        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
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
        $formFields['role'] = "user";

        // Create user
        $user = User::create($formFields);

        // Login
        if (auth()->user()->role == "admin") {
            return redirect('/admin')->with('success', 'User created successfully');
        }
        // auth()->user()->role == "admin" ? redirect('admin')->with('success', 'User created successfully') 
        // : 
        // auth()->login($user);
        auth()->login($user);

        return redirect('/')->with('success', 'User created and logged in');
    }

    //Admin update
    public function update(Request $request, User $user)
    {
        $formFields = $request->validate([
            "name" => ["required", "string", "min:3"],
            "email" => ["required", "string", "email"],
            'password' => ['required', 'string', 'confirmed'],
        ]);

        $user->update($formFields);

        return back()->with('message', "User " . $user->name . " updated successfully");
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
