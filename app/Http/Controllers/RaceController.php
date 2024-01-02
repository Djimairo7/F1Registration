<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;


class RaceController extends Controller
{
    public function index()
    {
        return view('race-selected');
    }
}