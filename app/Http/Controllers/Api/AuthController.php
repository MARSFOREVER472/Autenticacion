<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'=>'required|string|max:255', 
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:8'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'user'=>$user,
            'accessToken'=>$token,
            'tokenType'=>'Bearer'
        ]);

    }

    public function login(Request $request) {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message'=>'unauthorized'
            ], 401);
        } 

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'accessToken'=>$token,
            'tokenType'=>'Bearer'
        ]);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message'=>'ok'
        ], 200);
    }

    public function status(Request $request) {
        return response()->json([
            'data'=>[

                'api-version'=>'1.0',
                'status'=>'active',
                'data-version'=>'1.0'

            ]
            
            ]);
    }


    
    
}