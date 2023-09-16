<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        if(User::where('name', request('name'))->exists()){
            return response()->json(['message' => 'User already created'], 200);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>bcrypt($request->password)
        ]);
        $token = JWTAuth::fromUser($user);
        
        return Response()->json(['token'=>$token, 'expires_in' => JWTAuth::factory()->getTTL() * 60 ], 201);
        
    }

    public function login(Request $request){
        $credentials = $request->only('name', 'password');

        if(! $token = auth()->attempt($credentials)){
            return response()->json(['error' => 'Unauthorized'], 401);

        }
        return response()->json(['token' => $token], 200);

    }
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
