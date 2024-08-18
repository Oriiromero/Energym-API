<?php

use App\Http\Controllers\TrainerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Trainers
Route::get('trainers', [TrainerController::class, 'index']);
Route::get('trainers/{trainer}', [TrainerController::class, 'show']);
Route::post('trainers', [TrainerController::class, 'store']);
Route::put('trainers/{trainer}', [TrainerController::class, 'update']);
Route::patch('trainers/{trainer}', [TrainerController::class, 'update']);
Route::delete('trainers/{trainer}', [TrainerController::class, 'destroy']);

//Activities
//Bookings
//Payments
//Subscriptions
