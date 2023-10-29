<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    //show all listings
    public function index()
    {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search', 'content']))->paginate(8) //same as Listing:all();
        ]);

    }

    // Single Listing
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);

    }

    public function create()
    {
        return view('listings.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->user()->id;

        Listing::create($formFields);

        return redirect('/')->with('message', "Listing created successfully");
    }

    public function edit(Listing $listing)
    {
        return view("listings.edit", ['listing' => $listing]);
    }

    public function update(Request $request, Listing $listing)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', "Listing updated successfully");
    }

    public function destroy(Listing $listing){
        $listing->delete();
        return redirect("/")->with("message",$listing->title . " deleted successfully!");
    }

    public function manage(){
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
