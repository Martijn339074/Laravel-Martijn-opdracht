<?php

use App\Http\Controllers\JobController;
use App\http\Controllers\RegisterUserController;
use App\http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home'); 
Route::view('/contact', 'contact'); 

Route::resource('jobs', JobController::class);

Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);