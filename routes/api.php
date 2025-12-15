<?php

use App\Http\Controllers\api\UserKycController;
use App\Http\Controllers\Api\TutorialController;
use App\Http\Controllers\api\UserHomeController;
use App\Http\Controllers\Api\UserLeadController;
use App\Http\Controllers\api\AffiliateController;
use App\Http\Controllers\api\AppConfigController;
use App\Http\Controllers\api\UserWalletController;
use App\Http\Controllers\api\UserProfileController;
use App\Http\Controllers\api\UserActivityController;
use App\Http\Controllers\Api\UserReferralController;
use App\Http\Controllers\api\UserWithdrawController;
use App\Http\Controllers\api\auth\UserAuthController;
use App\Http\Controllers\api\AdvertiserCardController;
use App\Http\Controllers\Api\AffiliateProductController;
use App\Http\Controllers\api\UserPaymentMethodController;
use App\Http\Controllers\Api\RecommendedProductController;


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

    // Payment Methods
    Route::post(
        '/user/payment-method/upi',
        [UserPaymentMethodController::class, 'addUpi']
    );

    Route::post(
        '/user/payment-method/bank',
        [UserPaymentMethodController::class, 'addBank']
    );

    Route::get(
        '/user/payment-methods',
        [UserPaymentMethodController::class, 'list']
    );

    Route::post(
        '/user/payment-method/upi/update',
        [UserPaymentMethodController::class, 'updateUpi']
    );

    Route::post(
        '/user/payment-method/bank/update',
        [UserPaymentMethodController::class, 'updateBank']
    );


    Route::get('/user/wallet', [UserWalletController::class, 'wallet']);

    Route::get('/user/wallet/transactions', [UserWalletController::class, 'transactions']);

    Route::get('/user/withdrawals', [UserWithdrawController::class, 'history']);

    Route::post('/user/withdraw', [UserWithdrawController::class, 'store']);

    //kyc routes
    Route::post('/user/kyc', [UserKycController::class, 'store']);
    Route::get('/user/kyc', [UserKycController::class, 'show']);

    Route::get('/app/config', [AppConfigController::class, 'index']);

    Route::get('/advertiser-card', [AdvertiserCardController::class, 'show']);
    Route::post('/advertiser-card', [AdvertiserCardController::class, 'store']);

    Route::post('/user/activity', [UserActivityController::class, 'store']);


    Route::get('/home/banner', [UserHomeController::class, 'homebanner']);
    Route::get('/home/affiliates/category', [UserHomeController::class, 'affiliatesCategory']);
    Route::get('/home/top/products', [UserHomeController::class, 'topProducts']);


    Route::get('/category/{categoryId}/products', [AffiliateController::class, 'categoryProducts']);
    Route::get('/products/{slug}', [AffiliateProductController::class, 'productDetails']);
    Route::get('/recommended-products', [RecommendedProductController::class, 'index']);

    //tutorial
    Route::get('/tutorials', [TutorialController::class, 'index']);
    Route::get('/tutorials/category/{id}', [TutorialController::class, 'category']);
    Route::get('/tutorials/category/{id}/videos', [TutorialController::class, 'videosByCategory']);

    //leads
    // Route::get('/user/leads', [UserLeadController::class, 'index']);
    // Route::get('/user/leads/categories', [UserLeadController::class, 'categories']);

    Route::get('/user/leads/summary', [UserLeadController::class, 'summary']);
    Route::get('/user/leads/categories', [UserLeadController::class, 'categories']);
    Route::get('/user/leads/status-count', [UserLeadController::class, 'statusCount']);
    Route::get('/user/leads', [UserLeadController::class, 'index']);
    Route::get('/user/leads/{leadId}', [UserLeadController::class, 'show']);



    //my referrals
    Route::get(  '/my-referrals',  [UserReferralController::class, 'index']
);
});