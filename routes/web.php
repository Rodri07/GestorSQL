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


use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\ConsultaController;

Route::get('/', function () {
    return redirect('/Index-consultas-DDL');
});
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');


// CRUD DDL
Route::get('/Index-consultas-DDL', [ConsultaController::class, 'indexDDL'])->name('gestor-consultasDDL')->middleware('auth');
Route::get('/crear-tabla', [ConsultaController::class, 'create'])->name('crear-tabla')->middleware('auth');
Route::post('/crear-tabla', [ConsultaController::class, 'store'])->name('guardar-tabla')->middleware('auth');

// CRUD DML
Route::get('/consultas-dml', [ConsultaController::class, 'indexDML'])->name('consultas-dml')->middleware('auth');
Route::post('/ejecutar-consulta-dml',[ConsultaController::class, 'executeDML'])->name('ejecutar-consulta-dml')->middleware('auth');

// CRUD DCL
Route::get('/consultas-dcl', [ConsultaController::class, 'indexDCL'])->name('consultas-dcl')->middleware('auth');
Route::post('/ejecutar-consulta-dcl',[ConsultaController::class, 'executeDCL'])->name('ejecutar-consulta-dcl')->middleware('auth');

// Mostrar todas las tablas de Restaurante
Route::get('/database/tables', [ConsultaController::class, 'showTables'])->name('show-tables')->middleware('auth');




























Route::group(['middleware' => 'auth'], function () {
    Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
    Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
    Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
    Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
    Route::get('/{page}', [PageController::class, 'index'])->name('page');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
