<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (Auth::user()->IsAdmin == 1) {
            return view('auth.admin', compact('user'));
        } else {
            return redirect()->route('home');
        }
    }
}
