<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate( [
            'name' => 'required|string|min:3',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:4',
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

        $token = Auth::login($user);
         
        return response()->json([
            'message' => 'registered Successfully',
            'user' => $user,
            'Authorization'=> [
                'token'=> $token,
                'type'=> 'Bearer',
            ]
        ], 201);
    }

    public function test(){
        return response()->json(['data' => 'test']);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Check if the credentials match an admin
        $admin = Admin::where('email', $credentials['email'])->first();
        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            $token = Auth::login($admin);
            return response()->json([
                'status' => 'success',
                'user' => $admin,
                'Authorization' => [
                    'token' => $token,
                    'type' => 'Bearer',
                ]
            ], 200);
        }

        // Check if the credentials match a regular user
        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'Authorization' => [
                'token' => $token,
                'type' => 'Bearer',
            ]
        ], 200);
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user && method_exists($user, 'currentAccessToken') && $user->currentAccessToken()) {
            $user->currentAccessToken()->delete();
        }

        Auth::logout();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh(){
        return response()->json([
            'message' => 'refreshed Successfully',
            'user' => Auth::user(),
            'Authorization'=> [
                'token'=> Auth::refresh(),
                'type'=> 'Bearer',
            ]
        ], 200);
    }
}
