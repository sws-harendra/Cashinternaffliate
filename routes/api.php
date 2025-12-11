<?php

use App\Http\Controllers\api\UserProfileController;
use App\Http\Controllers\api\auth\UserAuthController;


Route::get('/status', function () {
    return response()->json([
        'status' => true,
        'message' => 'API is working'
    ]);
});
Route::post('/send-otp', [UserAuthController::class, 'sendOtp']);
Route::post('/verify-otp', [UserAuthController::class, 'verifyOtp']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [UserAuthController::class, 'profile']);
    Route::post('/logout', [UserAuthController::class, 'logout']);
    Route::put('/profile/update', [UserProfileController::class, 'update']);

});