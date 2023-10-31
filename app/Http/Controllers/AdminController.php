<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // dd(User::pluck("name","email"));

        return view('admin.index', [
            'listings' => Listing::all(),
            'users' => User::all(),
        ]);
    }

    public function addUser(Request $request)
    {
        $user = new User();
        return view('admin.add-user', []);
    }

    public function editUser(Request $request, User $user)
    {
        $listings = Listing::where('user_id', $user->id)->get();
        return view('admin.edit-user', ['user' => $user, 'listings' => $listings]);
    }
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

    public function deleteUserPage(User $user)
    {
        return view('admin.delete-user', ['user' => $user]);
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect('/admin')->with('message', $user->name . ' deleted successfully!');
    }


}
