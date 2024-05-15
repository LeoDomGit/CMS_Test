<?php

namespace Leo\Scores\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Leo\Scores\Scores;
use Leo\Users\Models\User;
use Leo\Users\Role;

class ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $idRole = Role::where('name', 'players')->value('id');

        $users = User::where('idRole', $idRole)->get();
        foreach ($users as $user) {
            $playTimes = $this->getPlayTimes();
            for ($i = 0; $i < $playTimes; $i++) {
                $score = rand(0, 9);
                if ($i < $playTimes * 0.2) {
                    $score += 5;
                }

                Scores::create([
                    'idUser' => $user->id,
                    'score' => $score,
                ]);
            }
        }
    }
    private function getPlayTimes()
    {
        $randomNumber = rand(1, 100);


        if ($randomNumber <= 20) {
            return rand(5, 10);
        } else {
            return rand(0, 4);
        }
    }
}
