<?php

namespace App\Http\Controllers;

use App\Models\Answers;
use App\Models\Clues;
use App\Models\PlayedGames;
use App\Models\Round;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{

    public function getGame(){
        $aa = Round::with('clues', 'answers')->get();
//        dd($aa);
        dd($aa);
//        foreach ($aa as $item) {
//            $item['clues'] = $item->clues;
//            $item['answers'] = $item->clues->answers;
//        }
    }

    public function checkAnswer(Request $request){
        //clue_id
        //answer

        $data = $request->all();
        $round = Round::where('id', ($data['round_id']))->with('answers')->first();
        if($round){

        }
        if(strtolower($data['answer']) === strtolower($round['answers']['right_answer']) ){
            PlayedGames::insert([
                'user_id' => auth()->id(),
                'round_id' => $round['id'],
                'correct_answer' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            $user = User::where('id', auth()->id())->first();
            $user->daily_streak++;
            $user->correct_streak++;
            $user->save();
            return response()->json(['right' => 'Right answer']);
        }
        PlayedGames::insert([
            'user_id' => auth()->id(),
            'round_id' => $round['id'],
            'correct_answer' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        $user = User::where('id', auth()->id())->first();
        $user->daily_streak++;
        $user->save();
        return response()->json(['wrong' => 'Wrong answer']);


    }

    public function getRounds(){
        return Round::with('clues', 'answers')->get();
    }

    public function dailyPoints(Request $request){
        $data = $request->all();
        $user = User::where('id', $data['id'])->first();
        $dailyStreak = $user['daily_streak'];
        $correctStreak = $user['correct_streak'];
        return response()->json(['daily_streak' => $dailyStreak, 'correct_streak' => $correctStreak]);
    }

    public function presentGames(Request $request){

    }
}
