<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    /* public function register(Request $request){
        $fileds = $request->validate([
            'name' => 'required|max:150',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = User::create($fileds);
        $token = $user->createToken($user->name);

        return ['user' => $user, 'token' => $token->plainTextToken];
    } */

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return [
                "message" => "The provided credential doesn't match"
            ];
        }


        $token = $user->createToken($user->name);
        return ['user' => $user, 'token' => $token->plainTextToken];
    }

    public function logout(Request $request){
        return $request->user();
        $request->user()->tokens()->delete();

        return "You are logged out";
    }

}
