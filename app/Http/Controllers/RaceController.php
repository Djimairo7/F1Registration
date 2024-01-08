<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class RaceController extends Controller
{
    //
    public function show($raceName)
    {
        $races = App::make('races');


        $race = collect($races)->first(function ($value) use ($raceName) {
            // Str::slug($value['raceName']);
            // Debugging code
            // dd(Str::slug($value['raceName']), $raceName);
            return Str::slug($value['Circuit']['circuitName']) == $raceName;
        });

        if (!$race) {
            abort(404);
        }

        return view('race.show', compact('race'));
    }
}
