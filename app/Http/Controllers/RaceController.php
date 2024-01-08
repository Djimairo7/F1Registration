<?php

namespace App\Http\Controllers;

use App\Models\Race;

class RaceController extends Controller
{
    //
    public function show($raceName)
    {
        $race = Race::where('name', $raceName)->first();

        if (!$race) {
            abort(404);
        }

        return view('race.show', compact('race'));
    }
}
