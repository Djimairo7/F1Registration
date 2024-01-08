<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
            $countryName = Str::slug($race['Circuit']['Location']['country']);
            $imageName = str_replace('-', '%20', Str::slug($race['Circuit']['Location']['country'])) . '.png'; //convert - to %20 for compatibility with the URL
            $imageUrl = 'https://media.formula1.com/content/dam/fom-website/2018-redesign-assets/Track%20icons%204x3/' . $imageName;
            $raceImages[$countryName] = $imageUrl;
        };

        $currentDate = \Carbon\Carbon::parse('2024-09-22'); //set custom date
        // $currentDate = now(); // set back to the current date

        // dd($drivers);

        $this->app->instance('races', $races['MRData']['RaceTable']['Races']);
        $this->app->instance('drivers', $drivers['MRData']['DriverTable']['Drivers']);
        $this->app->instance('raceImages', $raceImages);
        $this->app->instance('currentDate', $currentDate);
    }
}
