<?php

use App\Http\Controllers\issues;
use App\Http\Controllers\personController;
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

Route::get('/registro', function(){
    return view('register');
})->name('Registro');

Route::get('/logIn', [personController::class, 'logInWeb'])->name('StartAdventure');

Route::post('/registro',[personController::class, 'RegisterNewUserWeb'])->name('VenderElAlma');

