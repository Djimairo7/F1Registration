<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification; // Import the Notification model class
use App\Models\Score; // Import the Score class from the correct namespace

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //* GET info from API
        $races = Cache::remember('races', 180, function () {
            $racesreq = Http::withoutVerifying()->get('http://ergast.com/api/f1/2024.json');
            return $racesreq->json();
        });

        $drivers = Cache::remember('drivers', 180, function () {
            $driversreq = Http::withoutVerifying()->get('http://ergast.com/api/f1/2023/drivers.json'); //2023 for testing purposes. 2024 gives nothing
            return $driversreq->json();
        });

        // dd($getRaces, $getDrivers);

        // Get the corresponding race preview image for each race
        $raceImages = [];
        foreach ($races['MRData']['RaceTable']['Races'] as $race) {
            $raceName = str_replace('Grand Prix', '', $race['raceName']);
            $imageName = str_replace('-', '%20', $raceName) . '%20carbon.png'; //convert - to %20 for compatibility with the URL
            $imageUrl = 'https://media.formula1.com/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/' . $imageName;
            $raceImages[] = $imageUrl;
        };

        dd($races['MRData']['RaceTable']['Races']);

        // https://media.formula1.com/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/Emilia%20Romagna%20carbon.png
        // https://media.formula1.com/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/Great%20Britain%20carbon.png

        $currentDate = \Carbon\Carbon::parse('2024-09-22'); //set custom date
        // $currentDate = now(); // set back to the current date

        $currentRace = null; //set the current race to null for fallback
        if (!empty($races)) {
            foreach ($races['MRData']['RaceTable']['Races'] as $key => $race) {
                $raceStartDate = \Carbon\Carbon::parse($race['date']); //set the start date to the start date of a race
                $raceEndDate = isset($races[$key + 1]) ? \Carbon\Carbon::parse($races[$key + 1]['date']) : null; //set the end date to the start date plus 1
                if ($currentDate->between($raceStartDate, $raceEndDate)) {
                    //check the race start and the race end date to see if the current date is in between them
                    $currentRace = $race; //set the current race to the race that currently going on
                    break;
                }
            }
        }
        // Get the leaderboard data
        $users = Score::where('race_name', $currentRace['raceName'])->orderBy('score', 'desc')->get();


        $this->app->instance('races', $races['MRData']['RaceTable']['Races']);
        $this->app->instance('drivers', $drivers['MRData']['DriverTable']['Drivers']);
        $this->app->instance('currentRace', $currentRace);
        view()->share('raceImages', $raceImages);
        view()->share('currentDate', $currentDate);
        view()->share('currentRace', $currentRace);
        view()->share('users', $users);
    }
}
