<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function create(){
        return view('profile.create');
    }
    public function store(){
        return " ";
    }
}
