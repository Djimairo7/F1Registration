<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $profiles = Profile::all()->sortByDesc('updated_at'); 
        return view('profiles.index', compact ('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfileRequest $request)
    {
        $request->validated([
            'user_id' => 'required',
            'firstname' => 'required',
            'lastname' => 'required'
        ]);
        Profile::create($request->all());

        return redirect()->route('profiles.index')->with('success', 'Profile created successfully');
    }
   
   
    
        

    

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        return view('profiles.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        $validatedData = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'user_id' => 'required'
        ]);

        $profile->update($request->all());

        return redirect()->route('profiles.index')->with('success', 'Profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();
        return redirect()->route('profiles.index')->with('success', 'Profile deleted succesfully');
    }
}
