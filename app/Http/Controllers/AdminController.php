<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Score;

class AdminController extends Controller
{
    public function index()
    {
        $scores = Score::with('user')->orderBy('score', 'asc')->get();
        $allusers = User::all();
        if (Auth::user()->IsAdmin == 1) {
            return view('auth.admin', compact('allusers', 'scores'));
        } else {
            return redirect()->route('home');
        }
    }
}
