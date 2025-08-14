<?php

use App\Http\Controllers\BannerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MetadataController;
use App\Http\Controllers\OfferCategoryController;
use App\Http\Controllers\OfferImageController;
use Illuminate\Http\Request;

require __DIR__.'/auth.php';

Route::get('/', [LandingPageController::class, 'index'])->name('landing');
Route::post('/sendmessage', [MessageController::class, 'store'])->name('send-message');

Route::middleware('auth')->group(function () {
    
    Route::prefix('admin')->group(function () {

        
        Route::redirect('/', '/admin/banners&metadata')->name('admin');
        
        Route::get('/banners&metadata', [BannerController::class, 'index'])->name('banners&metadata');
        Route::put('/metadata/{metadata}', [MetadataController::class, 'update'])->name('metadata.update');
        Route::resource('banners', BannerController::class)->only(['store']);
        Route::post('/banners/delete-multiple', [BannerController::class, 'deleteMultiple'])->name('banners.deleteMultiple');

        Route::resource('messages', MessageController::class)->only(['index', 'destroy']);
        
        Route::resource('services', ServiceController::class);
        
        Route::resource('companies', CompanyController::class)->except(['show', 'create', 'edit']);

        Route::resource('contacts', ContactController::class)->except(['show', 'create', 'edit']);   
        Route::post('/admin/footer-colors', [ContactController::class, 'update'])->name('footer.colors.update'); 

        Route::get('/profile', function (Request $request) {
            return view('resetPassword',compact('request') );
        })->name('profile');

        
        Route::post('/offer-categories', [OfferCategoryController::class, 'store'])->name('offer-categories.store');
        Route::delete('/admin/offres/categories/{id}', [OfferCategoryController::class, 'destroy'])
            ->name('offer-categories.destroy');
        
        Route::post('/offers/images', [OfferImageController::class, 'store'])->name('offer-images.store');
        Route::get('/admin/offres', [OfferImageController::class, 'index'])->name('offer-images.index');
        
        Route::delete('/admin/offres/delete-multiple', [OfferImageController::class, 'deleteMultiple'])
            ->name('offer-images.delete-multiple');
        
        Route::get('/works', [OfferImageController::class, 'indexClient'])->name('offer.images.index.client');
    });

});