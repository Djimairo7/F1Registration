<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
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
        // Check if the ergast API is available and throw an error if it fails
        try {
            Http::withoutVerifying()->get('http://ergast.com/api/f1');
        } catch (\Exception $e) {
            if (filesize(base_path('public/races2024.json')) == 0 || filesize(base_path('public/drivers2024.json')) == 0) {
                // Return a response with the error message
                abort(response('<h1>An error occurred while fetching the data. <br> The API is not available right now, and not all information exists locally, please try again later.</h1>', 500));
            }
        }

        $data = Cache::remember('data', 180, function () {
            $responses = Http::pool(fn (Pool $pool) => [
                $pool->as('races')->withoutVerifying()->get('http://ergast.com/api/f1/2024.json'),
                $pool->as('drivers')->withoutVerifying()->get('http://ergast.com/api/f1/2024/drivers.json'),
            ]);

            $races = $responses['races']->successful() ? $responses['races']->json() : json_decode(File::get(base_path('public/races2024.json')), true);
            $drivers = $responses['drivers']->successful() ? $responses['drivers']->json() : json_decode(File::get(base_path('public/drivers2024.json')), true);

            if ($responses['races']->successful()) {
                File::put(base_path('public/races2024.json'), json_encode($races));
            }

            if ($responses['drivers']->successful()) {
                File::put(base_path('public/drivers2024.json'), json_encode($drivers));
            }

            return compact('races', 'drivers');
        });

        // Clear the files when they are not needed anymore
        File::put(base_path('public/races2024.json'), '');
        File::put(base_path('public/drivers2024.json'), '');

        $races = $data['races'];
        $drivers = $data['drivers'];

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

        view()->share('races', $races['MRData']['RaceTable']['Races']);
        view()->share('drivers', $drivers['MRData']['DriverTable']['Drivers']);
        view()->share('currentRace', $currentRace);
        view()->share('raceImages', $raceImages);
        view()->share('currentDate', $currentDate);
        view()->share('currentRace', $currentRace);
    }
}
