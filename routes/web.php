<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home'); // Static home page route
Route::view('/contact', 'contact'); // Static contact page route

// Define the Job resource routes
Route::resource('jobs', JobController::class);
