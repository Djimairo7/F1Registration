<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\User;
class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //users met een profiel
        User::factory(10)->create()
        ->each(function ($user){
            $user->profile()->save(Profile::factory()->make());
        });
    }
}
