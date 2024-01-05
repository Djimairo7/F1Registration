<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str; // Import the Str facade

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
        $racesreq = Http::withoutVerifying()->get('http://ergast.com/api/f1/2024.json');
        $races = $racesreq->json();

        $driversreq = Http::withoutVerifying()->get('http://ergast.com/api/f1/2023/drivers.json'); //2023 for testing purposes. 2024 gives nothing
        $drivers = $driversreq->json();

        // dd($getRaces, $getDrivers);

        // Get the corresponding race preview image for each race
        $raceImages = [];
        foreach ($races['MRData']['RaceTable']['Races'] as $race) {
            $countryName = Str::slug($race['Circuit']['Location']['country']);
            $imageName = str_replace('-', '%20', Str::slug($race['Circuit']['Location']['country'])) . '.png'; //convert - to %20 for compatibility with the URL
            $imageUrl = 'https://media.formula1.com/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/' . $imageName;
            $raceImages[$countryName] = $imageUrl;
        }

        // dd($races);

        $this->app->instance('races', $races['MRData']['RaceTable']['Races']);
        $this->app->instance('drivers', $drivers);
        $this->app->instance('raceImages', $raceImages);
    }
}
