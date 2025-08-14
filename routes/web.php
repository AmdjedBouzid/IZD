<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfferCategoryController;
use App\Http\Controllers\OfferImageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/metadata', function () {
    return view('metadata'); // Also uses same layout
});

Route::get('/admin/services', function () {
    return view('services'); // Also uses same layout
});

Route::get('/admin/messages', function () {
    return view('messages'); // Also uses same layout
});
// Route::get('/admin/offres', [OfferCategoryController::class, 'index'])
//     ->name('admin.offres');


Route::get('/login', function () {
    return view('login'); // Also uses same layout
});



Route::post('/offer-categories', [OfferCategoryController::class, 'store'])->name('offer-categories.store');
Route::delete('/admin/offres/categories/{id}', [OfferCategoryController::class, 'destroy'])
    ->name('offer-categories.destroy');

Route::post('/offers/images', [OfferImageController::class, 'store'])->name('offer-images.store');
Route::get('/admin/offres', [OfferImageController::class, 'index'])->name('offer-images.index');

Route::delete('/admin/offres/delete-multiple', [OfferImageController::class, 'deleteMultiple'])
    ->name('offer-images.delete-multiple');

Route::get('/works', [OfferImageController::class, 'indexClient'])->name('offer.images.index.client');
