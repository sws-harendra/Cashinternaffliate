<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\backend\admins\auth\AdminAuthController;
use App\Http\Controllers\backend\admins\dashboard\AdminClickController;
use App\Http\Controllers\backend\admins\dashboard\AdminSettingController;
use App\Http\Controllers\backend\admins\dashboard\AdminTrainingVideoController;
use App\Http\Controllers\backend\admins\dashboard\AdminAffiliateProductController;
use App\Http\Controllers\backend\admins\dashboard\AdminTrainingCategoryController;
use App\Http\Controllers\backend\admins\dashboard\AdminAffiliateCategoryController;
use App\Http\Controllers\backend\admins\dashboard\AdminTrainingSubCategoryController;
use App\Http\Controllers\backend\admins\dashboard\AdminAffiliateSubCategoryController;
use App\Http\Controllers\backend\admins\dashboard\AdminProductsEarningLevelController;

Route::get('/', function () {
    return view('backend.admins.pages.dashboard');
});


Route::get('/c/{product}/{user}', [TrackingController::class, 'redirect'])->name('tracking.redirect');


Route::group(
    ['prefix' => 'admins', 'as' => 'admins.'],
    function () {
        Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AdminAuthController::class, 'login'])->name('login.submit');
        Route::group(['middleware' => 'auth:admin'], function () {
            Route::get('dashboard', function () {
                return view('backend.admins.pages.dashboard');
            })->name('dashboard');

            Route::get('logout', [AdminAuthController::class, 'logout'])->name('logout');


            Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings');
            Route::post('/settings/update', [AdminSettingController::class, 'update'])->name('settings.update');


            // Affiliate Categories Routes
            Route::get('/affiliate-categories', [AdminAffiliateCategoryController::class, 'index'])->name('affiliate-categories.index');

            Route::get('/affiliate-categories/create', [AdminAffiliateCategoryController::class, 'create'])->name('affiliate-categories.create');

            Route::post('/affiliate-categories/store', [AdminAffiliateCategoryController::class, 'store'])->name('affiliate-categories.store');

            Route::get('/affiliate-categories/{id}/edit', [AdminAffiliateCategoryController::class, 'edit'])->name('affiliate-categories.edit');

            Route::post('/affiliate-categories/{id}/update', [AdminAffiliateCategoryController::class, 'update'])->name('affiliate-categories.update');

            Route::get('/affiliate-categories/{id}/delete', [AdminAffiliateCategoryController::class, 'destroy'])->name('affiliate-categories.delete');

            // Affiliate Sub Categories Routes
    
            Route::get('/affiliate-subcategories', [AdminAffiliateSubCategoryController::class, 'index'])
                ->name('affiliate-subcategories.index');

            Route::get('/affiliate-subcategories/create', [AdminAffiliateSubCategoryController::class, 'create'])
                ->name('affiliate-subcategories.create');

            Route::post('/affiliate-subcategories/store', [AdminAffiliateSubCategoryController::class, 'store'])
                ->name('affiliate-subcategories.store');

            Route::get('/affiliate-subcategories/{id}/edit', [AdminAffiliateSubCategoryController::class, 'edit'])
                ->name('affiliate-subcategories.edit');

            Route::post('/affiliate-subcategories/{id}/update', [AdminAffiliateSubCategoryController::class, 'update'])
                ->name('affiliate-subcategories.update');

            Route::get('/affiliate-subcategories/{id}/delete', [AdminAffiliateSubCategoryController::class, 'delete'])
                ->name('affiliate-subcategories.delete');


            // Affiliate Products Routes
            Route::get('/affiliate-products', [AdminAffiliateProductController::class, 'index'])
                ->name('affiliate-products.index');
            Route::get('/affiliate-products/create', [AdminAffiliateProductController::class, 'create'])
                ->name('affiliate-products.create');
            Route::post('/affiliate-products/store', [AdminAffiliateProductController::class, 'store'])
                ->name('affiliate-products.store');
            Route::get('/affiliate-products/{id}/edit', [AdminAffiliateProductController::class, 'edit'])
                ->name('affiliate-products.edit');
            Route::post('/affiliate-products/{id}/update', [AdminAffiliateProductController::class, 'update'])
                ->name('affiliate-products.update');
            Route::get('/affiliate-products/{id}/delete', [AdminAffiliateProductController::class, 'destroy'])
                ->name('affiliate-products.delete');

            Route::get('/get-subcategories/{category_id}', function ($category_id) {
                return \App\Models\AffiliateSubCategory::where('category_id', $category_id)
                    ->where('status', 'active')
                    ->get();
            })->name('get-subcategories');

            Route::get('/affiliate-products/{id}/details', [AdminAffiliateProductController::class, 'details'])
                ->name('affiliate-products.details');

            Route::post('/affiliate-products/{id}/details/update', [AdminAffiliateProductController::class, 'detailsUpdate'])
                ->name('affiliate-products.details.update');


            // Earning Levels
            Route::get('/affiliate-products/{id}/earning-levels', [AdminProductsEarningLevelController::class, 'index'])
                ->name('earning-levels.index');

            Route::post('/affiliate-products/{id}/earning-levels/store', [AdminProductsEarningLevelController::class, 'store'])
                ->name('earning-levels.store');

            Route::get('/affiliate-products/earning-levels/{level_id}/edit', [AdminProductsEarningLevelController::class, 'edit'])
                ->name('earning-levels.edit');

            Route::post('/affiliate-products/earning-levels/{level_id}/update', [AdminProductsEarningLevelController::class, 'update'])
                ->name('earning-levels.update');

            Route::delete('/affiliate-products/earning-levels/{level_id}/delete', [AdminProductsEarningLevelController::class, 'delete'])
                ->name('earning-levels.delete');

            Route::prefix('affiliate')->group(function () {

                Route::get('/clicks', [AdminClickController::class, 'index'])
                    ->name('affiliate.clicks');

                Route::get('/clicks/{id}/convert', [AdminClickController::class, 'convertPage'])
                    ->name('affiliate.clicks.convert');

                // Level complete (hold money)
                Route::post('/clicks/{id}/level-complete', [AdminClickController::class, 'completeLevel'])
                    ->name('affiliate.clicks.level.complete');

                // Final approval
                Route::post('/clicks/{id}/final-approve', [AdminClickController::class, 'finalApprove'])
                    ->name('affiliate.clicks.final.approve');
            });



            // Training Category CRUD
            Route::get('training-category', [AdminTrainingCategoryController::class, 'index'])->name('training-category.index');
            Route::get('training-category/create', [AdminTrainingCategoryController::class, 'create'])->name('training-category.create');
            Route::post('training-category/store', [AdminTrainingCategoryController::class, 'store'])->name('training-category.store');
            Route::get('training-category/{id}/edit', [AdminTrainingCategoryController::class, 'edit'])->name('training-category.edit');
            Route::post('training-category/{id}/update', [AdminTrainingCategoryController::class, 'update'])->name('training-category.update');
            Route::get('training-category/{id}/delete', [AdminTrainingCategoryController::class, 'delete'])->name('training-category.delete');


            Route::prefix('training-subcategory')->group(function () {

                Route::get('/', [AdminTrainingSubCategoryController::class, 'index'])
                    ->name('training-subcategory.index');

                Route::get('/create', [AdminTrainingSubCategoryController::class, 'create'])
                    ->name('training-subcategory.create');

                Route::post('/store', [AdminTrainingSubCategoryController::class, 'store'])
                    ->name('training-subcategory.store');

                Route::get('/edit/{id}', [AdminTrainingSubCategoryController::class, 'edit'])
                    ->name('training-subcategory.edit');

                Route::post('/update/{id}', [AdminTrainingSubCategoryController::class, 'update'])
                    ->name('training-subcategory.update');

                Route::get('/delete/{id}', [AdminTrainingSubCategoryController::class, 'delete'])
                    ->name('training-subcategory.delete');
            });


            Route::prefix('training-videos')->group(function () {

                Route::get('/', [AdminTrainingVideoController::class, 'index'])
                    ->name('training-videos.index');

                Route::get('/create', [AdminTrainingVideoController::class, 'create'])
                    ->name('training-videos.create');

                Route::post('/store', [AdminTrainingVideoController::class, 'store'])
                    ->name('training-videos.store');

                Route::get('/edit/{id}', [AdminTrainingVideoController::class, 'edit'])
                    ->name('training-videos.edit');

                Route::post('/update/{id}', [AdminTrainingVideoController::class, 'update'])
                    ->name('training-videos.update');

                Route::get('/delete/{id}', [AdminTrainingVideoController::class, 'delete'])
                    ->name('training-videos.delete');
            });





        });

    }

);