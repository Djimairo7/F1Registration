<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

    public function delete($id)
    {
        // dd($score);
        $score = Score::findorFail($id);
        $score->delete();
        return redirect()->route('admin')
            ->with('success', 'Record deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'score' => 'required',
            // Add other validation rules as needed
        ]);

        // Find the Score with the given ID
        $score = Score::findOrFail($id);

        // Update the Score with the request data
        $score->score = $request->score;
        $score->save();

        // Redirect back with a success message
        return redirect()->route('admin')->with('success', 'Score updated successfully');
    }
}
