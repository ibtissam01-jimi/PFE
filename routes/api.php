<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\Tourist_GuideController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------- 
| API Routes 
|--------------------------------------------------------------------------- 
| 
| Here is where you can register API routes for your application. These 
| routes are loaded by the RouteServiceProvider and all of them will 
| be assigned to the "api" middleware group. Make something great! 
| 
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return 'home api page';
});

// Auth Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/registertest', [AuthController::class, 'test']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::post('refresh', [AuthController::class, 'refresh']);

// Tourist Guide Routes
Route::post('/guide', [Tourist_GuideController::class, 'store']);
Route::get('/guides', [Tourist_GuideController::class, 'index']);
Route::put('/guides/{id}', [Tourist_GuideController::class, 'update']);
Route::delete('/guides/{id}', [Tourist_GuideController::class, 'destroy']);
Route::post('AddGuides', [Tourist_GuideController::class, 'store']);

// Category Routes
Route::get('/categories', [CategorieController::class, 'index']);
Route::post('/add-cat', [CategorieController::class, 'store']);
Route::put('categories/{id}', [CategorieController::class, 'update']);
Route::delete('/categories/{id}', [CategorieController::class, 'destroy']);

// City Routes
Route::get('/cities', [CityController::class, 'index']);
Route::post('/AddCities', [CityController::class, 'store']);
Route::put('/cities/{id}', [CityController::class, 'update']);
Route::delete('/cities/{id}', [CityController::class, 'destroy']);
Route::get('/cities/{city}', [CityController::class, 'show']);

// Service Routes
Route::get('/services', [ServiceController::class, 'index']);
Route::post('/add-services', [ServiceController::class, 'store']);
Route::put('/services/{id}', [ServiceController::class, 'update']);
Route::delete('/services/{id}', [ServiceController::class, 'destroy']);

// Favorite Routes
Route::get('/favorites/{utilisateur_id}', [FavoriteController::class, 'index']);
Route::post('/favorites', [FavoriteController::class, 'store']);

// Submission Routes
Route::post('/new_submission', [SubmissionController::class, 'store']);
Route::delete('/service_submission/{id}', [SubmissionController::class, 'destroy']);

// Admin Routes
Route::get('/admin/profile', [AdminController::class, 'getAdminData']);
Route::put('/admin/profile', [AdminController::class, 'updateAdminData']);

// Dashboard Routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// User Routes
Route::post('/add-user', [UtilisateurController::class, 'store']);
Route::put('/utilisateurs/{id}', [UtilisateurController::class, 'update']);
Route::delete('/evaluators/{id}', [UtilisateurController::class, 'destroy']);
