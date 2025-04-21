<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\Tourist_GuideController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/',function(){
    return 'home api page';
});

Route::post('/register',[AuthController::class,'register']);
Route::post('/registertest',[AuthController::class,'test']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class, 'logout'])->middleware('auth:api');
Route::post('refresh', [AuthController::class, 'refresh']);


Route::post('/guide',[Tourist_GuideController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/guides',[Tourist_GuideController::class, 'index']);


Route::put('/guides/{id}', [Tourist_GuideController::class, 'update']);

// Dans routes/api.php



Route::get('/categories', [CategorieController::class, 'index']);
Route::get('/cities', [CityController::class, 'index']);


Route::put('categories/{id}', [CategorieController::class, 'update']);

// routes/api.php
use App\Http\Controllers\UtilisateurController;

Route::delete('/evaluators/{id}', [UtilisateurController::class, 'destroy']);


Route::delete('/cities/{id}', [CityController::class, 'destroy']);


// Route pour mettre à jour une ville
Route::put('/cities/{id}', [CityController::class, 'update']);


// Récupérer les données d'une ville par son ID
Route::get('/cities/{city}', [CityController::class, 'show']);




Route::delete('/categories/{id}', [CategorieController::class, 'destroy']);


Route::delete('/guides/{id}', [Tourist_GuideController::class, 'destroy']);


use App\Http\Controllers\ServiceController;
Route::delete('/services/{id}', [ServiceController::class, 'destroy']);

Route::put('/services/{id}', [ServiceController::class, 'update']);

Route::post('/add-services', [ServiceController::class, 'store']);

Route::post('/new_submission', [SubmissionController::class, 'store']);


Route::delete('/service_submission/{id}', [SubmissionController::class, 'destroy']);


Route::post('/add-user', [UtilisateurController::class, 'store']);


Route::put('/utilisateurs/{id}', [UtilisateurController::class, 'update']);

Route::post('/AddCities', [CityController::class, 'store']);



Route::post('/add-cat', [CategorieController::class, 'store']);





Route::post('AddGuides', [Tourist_GuideController::class, 'store']);

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// API route to store the city data















// Route::post('/business_submission', [S])