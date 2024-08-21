<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Authentication routes
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.store');

Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ->name('logout');


// Routes accessible to both 'admin' role and 'member' role
Route::middleware(['auth:sanctum', 'role:member,admin'])->group(function () {
    //Users
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{user}', [UserController::class, 'show']);
    Route::put('users/{user}', [UserController::class, 'update']);
    Route::patch('users/{user}', [UserController::class, 'update']);

    //Activities
    Route::get('activities', [ActivityController::class, 'index']);
    Route::get('activities/{activity}', [ActivityController::class, 'show']);

    //Bookings
    Route::get('bookings', [BookingController::class, 'index']);
    Route::get('bookings/{booking}', [BookingController::class, 'show']);
    Route::post('bookings', [BookingController::class, 'store']);
    Route::put('bookings/{booking}', [BookingController::class, 'update']);
    Route::patch('bookings/{booking}', [BookingController::class, 'update']);

    //Payments
    Route::get('payments', [PaymentController::class, 'index']);
    Route::get('payments/{payment}', [PaymentController::class, 'show']);
    Route::post('payments', [PaymentController::class, 'store']);

    //Subscriptions
    Route::post('subscriptions', [SubscriptionController::class, 'store']);
    Route::get('subscriptions', [SubscriptionController::class, 'index']);
    Route::get('subscriptions/{subscription}', [SubscriptionController::class, 'show']);
});

// Routes accessible to 'admin' role only
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    //Users
    Route::delete('users/{user}', [UserController::class, 'destroy']);
    //Activities
    Route::post('activities', [ActivityController::class, 'store']);
    Route::put('activities/{activity}', [ActivityController::class, 'update']);
    Route::patch('activities/{activity}', [ActivityController::class, 'update']);
    Route::delete('activities/{activity}', [ActivityController::class, 'destroy']);
    //Trainers
    Route::get('trainers', [TrainerController::class, 'index']);
    Route::get('trainers/{trainer}', [TrainerController::class, 'show']);
    Route::post('trainers', [TrainerController::class, 'store']);
    Route::put('trainers/{trainer}', [TrainerController::class, 'update']);
    Route::patch('trainers/{trainer}', [TrainerController::class, 'update']);
    Route::delete('trainers/{trainer}', [TrainerController::class, 'destroy']);
    //Bookings
    Route::delete('bookings/{booking}', [BookingController::class, 'destroy']);
    //Payments
    Route::put('payments/{payment}', [PaymentController::class, 'update']);
    Route::patch('payments/{payment}', [PaymentController::class, 'update']);
    Route::delete('payments/{payment}', [PaymentController::class, 'destroy']);
    //Subscriptions
    Route::put('subscriptions/{subscription}', [SubscriptionController::class, 'update']);
    Route::patch('subscriptions/{subscription}', [SubscriptionController::class, 'update']);
    Route::delete('subscriptions/{subscription}', [SubscriptionController::class, 'destroy']);
});
