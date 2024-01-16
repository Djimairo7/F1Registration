<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    public function getName()
    {
        return $this->name;
    }
    public function calculatePoints()
    {
        // Define the points for each position
        $positionPoints = [25, 18, 15, 12, 10, 8, 6, 4, 2, 1];

        // Get the scores for the current race
        $scores = Score::where('race_name', $this->name)
            ->orderBy('score', 'asc')
            ->get();

        // Assign points to the top 10 scores
        foreach ($scores as $index => $score) {
            if ($index >= 10) break; // Only assign points to the top 10 scores

            // Update the user's points
            $user = User::find($score->user_id);
            $user->points += $positionPoints[$index];
            $user->save();
        }

        // Calculate the consistency bonus
        $this->calculateConsistencyBonus();
    }

    public function calculateConsistencyBonus()
    {
        // Get all users
        $users = User::all();

        foreach ($users as $user) {
            // Get the user's scores
            $scores = Score::where('user_id', $user->id)->get();

            // Get the unique race names
            $raceNames = $scores->pluck('race_name')->unique();

            $top10InAllRaces = true;
            $top5InAllRaces = true;

            foreach ($raceNames as $raceName) {
                // Get the scores for the race
                $raceScores = Score::where('race_name', $raceName)
                    ->orderBy('score', 'asc')
                    ->get();

                // Find the position of the user's score
                $position = $raceScores->search(function ($score) use ($user) {
                    return $score->user_id == $user->id;
                });

                if ($position >= 10) {
                    $top10InAllRaces = false;
                }

                if ($position >= 5) {
                    $top5InAllRaces = false;
                }
            }

            // Assign the consistency bonus
            if ($top5InAllRaces) {
                $user->points += 20;
            } elseif ($top10InAllRaces) {
                $user->points += 10;
            }

            $user->save();
        }
    }
}
