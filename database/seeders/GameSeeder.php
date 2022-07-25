<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rounds')->insert([
            'id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('clues')->insert([
            'id' => '1',
            'clue' => 'Opposite of yes in the word',
            'round_id' => 1
        ]);
        DB::table('clues')->insert([
            'id' => '2',
            'clue' => 'Opposite of yes in the word123',
            'round_id' => 1
        ]);

        DB::table('answers')->insert([
            'id' => 1,
            'right_answer' => 'Nobody',
            'round_id' => 1
        ]);
        DB::table('users')->insert([
            'id' => 99,
            'user_name' => 'admin',
            'password' => 'admin',
        ]);
    }
}
