<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [SiteController::class, 'index'])->name('home'); // Afficher le formulaire d'inscription

// Routes pour l'authentification
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.show'); // Afficher le formulaire de connexion
Route::post('/login', [AuthController::class, 'login'])->name('login'); // Traitement du formulaire de connexion
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // Déconnexion de l'utilisateur

// Routes pour l'inscription
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.show'); // Afficher le formulaire d'inscription
Route::post('/register', [AuthController::class, 'register'])->name('register'); // Traitement du formulaire d'inscription

Route::middleware(['auth'])->get('/profile', [AuthController::class, 'profile'])->name('profile'); // Afficher le profil de l'utilisateur
