<?php

use Illuminate\Database\Seeder;
use App\Models\Race;

class RacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Race::factory(10)->create();
    }
}
