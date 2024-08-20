<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
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
Route::get('activities', [ActivityController::class, 'index']);
Route::get('activities/{activity}', [ActivityController::class, 'show']);
Route::post('activities', [ActivityController::class, 'store']);
Route::put('activities/{activity}', [ActivityController::class, 'update']);
Route::patch('activities/{activity}', [ActivityController::class, 'update']);
Route::delete('activities/{activity}', [ActivityController::class, 'destroy']);

//Bookings
Route::get('bookings', [BookingController::class, 'index']);
Route::get('bookings/{booking}', [BookingController::class, 'show']);
Route::post('bookings', [BookingController::class, 'store']);
Route::put('bookings/{booking}', [BookingController::class, 'update']);
Route::patch('bookings/{booking}', [BookingController::class, 'update']);
Route::delete('bookings/{booking}', [BookingController::class, 'destroy']);

//Payments
Route::get('payments', [PaymentController::class, 'index']);
Route::get('payments/{payment}', [PaymentController::class, 'show']);
Route::post('payments', [PaymentController::class, 'store']);
Route::put('payments/{payment}', [PaymentController::class, 'update']);
Route::patch('payments/{payment}', [PaymentController::class, 'update']);
Route::delete('payments/{payment}', [PaymentController::class, 'destroy']);

//Subscriptions
