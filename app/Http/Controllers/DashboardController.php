<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $users = User::where('role', 'user')->count();
        return response()->json(['users'=> $users]);
    }
}
