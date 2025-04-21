<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\Tourist_GuideController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UtilisateurController;

/*
|---------------------------------------------------------------------- 
| Web Routes 
|---------------------------------------------------------------------- 
| Here is where you can register web routes for your application. 
| These routes are loaded by the RouteServiceProvider and all of them 
| will be assigned to the "web" middleware group. Make something great! 
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Routes Utilisateur
Route::post('/addUser', [UtilisateurController::class, 'store']);
Route::get('/evaluators', [UtilisateurController::class, 'index']);
Route::delete('/evaluators/{id}', [UtilisateurController::class, 'destroy']);

// Routes Authentification
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::post('refresh', [AuthController::class, 'refresh']);
Route::get('/registertest', [AuthController::class, 'test']);

// Routes Soumissions
Route::get('/submissions', [SubmissionController::class, 'index']);
Route::post('/new_submission', [SubmissionController::class, 'store']);

// Routes Dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);

// Routes Services
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/places', [ServiceController::class, 'getAllPlaces']);

// Routes Villes et Guides
Route::get('/cities', [CityController::class, 'index']);
Route::get('/guides', [Tourist_GuideController::class, 'index']);

// Routes Catégories
Route::get('/categories', [CategorieController::class, 'index']);
