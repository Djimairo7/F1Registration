<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Race;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Retrieve all races from the database
        $races = Race::all();

        // Return the view with all races
        return view('home', ['races' => $races]);
    }
}
