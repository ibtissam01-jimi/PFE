<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubmissionController;
use Illuminate\Http\Request;


use App\Http\Controllers\CityController;
use App\Http\Controllers\Tourist_GuideController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UtilisateurController;

Route::post('/addUser', [UtilisateurController::class, 'store']);

Route::get('/cities', [CityController::class, 'index']);
Route::get('/guides', [Tourist_GuideController::class, 'index']);

Route::get('/services', [ServiceController::class, 'index']);

Route::get('/submissions', [SubmissionController::class, 'index']);
Route::get('/evaluators', [UtilisateurController::class, 'index']);


Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class, 'logout'])->middleware('auth:api');
Route::post('refresh', [AuthController::class, 'refresh']);

Route::get('/registertest',[AuthController::class,'test']);



Route::post('/new_submission',[SubmissionController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index']);



Route::get('/categories', [CategorieController::class, 'index']);

Route::get('/places', [ServiceController::class, 'getAllPlaces']);



Route::delete('/evaluators/{id}', [UtilisateurController::class, 'destroy']);

