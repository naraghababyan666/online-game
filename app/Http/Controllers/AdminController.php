<?php

namespace App\Http\Controllers;

use App\Models\Answers;
use App\Models\Clues;
use App\Models\Round;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function storeRound(){
//        $new_round = new Round;
//        $new_round->created_at = Carbon::now();
//        $new_round->updated_at = Carbon::now();
//        $new_round->save();
        Round::insert([
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $id = DB::getPdo()->lastInsertId();
        $round = Round::find($id);
        $round->round_name = 'Round_'.$id;
        $round->save();
        return response()->json(['success' => 'Game round successfully created!']);
    }


    public function store(Request $request)
    {
        $data = $request->all();
        if($data['clue'] && $data['answer'] && $data['round_id']){
            $clue = Clues::insertGetId([
                'clue' => $data['clue'],
                'round_id' => $data['round_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            Answers::insert([
                'right_answer' => $data['answer'],
                'round_id' => $data['round_id']
            ]);

            return response()->json(['success' => 'Successfully added']);
        }
        return response()->json(['fail' => 'Invalid clue/answer']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd(Clues::where('id', $id)->with('answers')->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        Clues::where('id', $id)->update([
            'clue' => $data['clue'],
            'updated_at' => Carbon::now()
        ]);
        Answers::where('clue_Id', $id)->update([
            'right_answer'=>$data['answer'],
            'clue_id' => $id
        ]);

        return response()->json(['success' => 'Successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
//        $answer = Answers::where('clue_id', $id)->first()->id;
//        if($answer){
//            Answers::destroy($answer);
//        }
        Clues::destroy($id);
        return response()->json(['success' => 'Successfully deleted']);
    }


    public function authAdmin(Request $request){
        $data = $request->all();
        if($data['user_name'] && $data['password']){
            $user = User::where('user_name', $data['user_name'])->first();
            if($user){
                if($data['user_name'] === $user['user_name']){
                    if($data['password'] === $user['password']){
                        Auth::login($user);
                        $token = $user->createToken($data['user_name'])->plainTextToken;
                        return response()->json(['user' => $user, 'token' => $token]);
                    }
                    return response()->json(['fail' => 'Invalid password']);
                }
            }
            return response()->json(['failed' => 'Invalid username']);
        }else{
            return response()->json(['failed' => 'Invalid username/password']);
        }
    }

    public function getClues(){
        return Clues::with('answers')->get();
    }
}
