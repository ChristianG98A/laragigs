<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
    // dd(User::pluck("name","email"));

        return view('admin.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search', 'content']))->paginate(8), //same as Listing:all();
            'users' => User::latest()->paginate(8)
        ]);
    }

    public function addUser(Request $request){ 
        $user = new User();
        return view('admin.add-user', []);
    }

    public function editUser(Request $request, User $user){
        $listings = Listing::where('user_id', $user->id)->get();
        return view('admin.edit-user', ['user'=> $user, 'listings' => $listings]);
    }


}
