<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function auth(Request $request){
        $data = $request->all();
        if($data['user_name']){
            $user = User::where('user_name', $data['user_name'])->first();
            if($user){
                Auth::attempt(['user_name'=> $data['user_name'], 'password' => $data['user_name']]);

                $token = $user->createToken($data['user_name'])->plainTextToken;
                return response()->json(['user' => $user, 'token' => $token]);
            }

            $newUser = User::create([
                'user_name' => $data['user_name'],
                'password' => Hash::make($data['user_name']),
            ]);

            $token = $newUser->createToken($data['user_name'])->plainTextToken;

            $response = ['user' => $newUser, 'token' => $token];
            auth()->login($newUser);
            return response()->json(['success' => $response]);

        }
    }

    public function checkAuth(){
        dd(auth('sanctum')->check());
    }
}
