<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;



class UserController extends Controller
{
    //


    public function register(Request $req)
    {
        $this->validate($req, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'

        ]);

        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password)
        ]);

        return response()->json([
            "isAdded" => 1,
            "message" => "Account created succefully"
        ]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [

            'email' => 'required',
            'password' => 'required'

        ]);


        $user = User::whereEmail($request->email)->first();

        if (isset($user->id)) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('authToken')->plainTextToken;
                $user->token = $token;

                // $cookie = cookie('jwt', $token, 60 * 24); //1 day
                // return response($user)->withCookie($cookie);
                return response()->json(
                    $user
                , 200);
            }
        }

        return response()->json(['message' => 'Email ou Mot de passe Invalid!'], 401);
    }

    public function profile()
    {

        $user = Auth::user();

        if ($user) {
            $userData = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                // Add any other desired user fields here
            ];

            return response()->json(['user' => $userData], 200);
        } else {
            return response()->json(['message' => 'User not authenticated.'], 401);
        }
    }

    public function logout(Request $request){
        // $cookie = Cookie::forget('jwt');
        // return response([
        //     'message'=>'logedout'
        // ])->withCookie($cookie);

        $user = $request->user();
        $user->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response(["message"=>'success']);
    }
}
