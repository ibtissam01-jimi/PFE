<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate( [
            'name' => 'required|string|min:3',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:4',
            //'role' => 'required|string|in:admin,user,business '
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = 'user';
        $user->nationality = $request->nationality;
        $user->birth_date = $request->birth_date;
        $user->password = Hash::make($request->password);
        $user->save();

        
        $token= Auth::login($user);
         
        //$roleController = new RoleController();
        //$roleController->assignRole($user);
        return response()->json([
            'message' => 'registered Succesfully',
            'user' => $user,
            'Authorization'=> [
                'token'=> $token,
                'type'=> 'Bearer',
            ]
            ], 201);
   
    }
    public function test(){
        return response()->json(['data'=>'test']);
    }

    public function login(Request $request){
        $credentials= $request->only('email','password');

        $token = Auth::attempt($credentials);
        if(!$token){
            return response()->json([
                'status'=>'error',
                'message'=> 'Login not valide'
            ],401);
        }
        $user = Auth::user();
        return response()->json([
            'status'=>'success',
            'user' => $user,
            'Authorization'=> [
                'token'=> $token,
                'type'=> 'Bearer',
            ]
            ], 200);
    }

    public function logout(Request $request)
{
    $user = $request->user();

    if ($user) {
        $user->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    return response()->json([
        'status' => 'error',
        'message' => 'User not authenticated',
    ], 401);
}

    public function refresh(){
        return response()->json([
            'message' => 'refreshed Succesfully',
            'user' => Auth::user(),
            'Authorization'=> [
                'token'=> Auth::refresh(),
                'type'=> 'Bearer',
            ]
            ], 200);
    }
}
