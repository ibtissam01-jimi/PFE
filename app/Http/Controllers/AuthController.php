<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Exception;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make([
            'name' => 'required|string|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'data not valide']);
        }

        $newUser = new User();
        $newUser->name = $request->name;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->password);
        $newUser->save();

        return response()->json([
            'message' => 'user Created Succesfully',
            'redirect' => '/login'
        ]);

    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->withErrors([
                'email' => 'The provided credentials do not match our records.',401
            ]);
        }
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'logged in',
            'user' => $user,
            'token' => $token,
            'redirect' => '/dashboard'
        ]);


    }

    public function dashboard(){
        try{

            return response()->json(['message'=> 'Authenticated']);
        }catch(Exception $e){
            return response()->json(['error'=>$e]);
        }
    }
}
