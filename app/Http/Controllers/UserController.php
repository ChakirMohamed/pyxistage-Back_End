<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    //


    public function register(Request $req){
        $this->validate($req,[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required'

        ]);

        $user = User::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>Hash::make($req->password)
        ]);

        return response()->json([
            "isAdded"=>1,
            "message"=>"Account created succefully"
        ]);
    }

    public function login(Request $request)
    {
        $this->validate($request,[

            'email'=>'required',
            'password'=>'required'

        ]);
        $user = User::whereEmail($request->email)->first();

        if (isset($user->id)) {
            if(Hash::check($request->password,$user->password)){
                $token = $user->createToken('authToken')->plainTextToken;
                $user->token = $token;
                return response()->json([
                    'user' => $user
                ], 200);
            }
        }

        return response()->json(['message' => 'Email ou Mot de passe Invalid!'], 401);
    }

    public function profile(){
        return new UserResource(auth()->user());
    }
}
