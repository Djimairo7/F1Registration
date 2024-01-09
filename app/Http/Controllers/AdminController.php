<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $allusers = User::all();
        if (Auth::user()->IsAdmin == 1) {
            return view('auth.admin', compact('allusers'));
        } else {
            return redirect()->route('home');
        }
    }
}
