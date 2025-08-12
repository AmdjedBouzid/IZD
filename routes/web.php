<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BannerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MetadataController;
use App\Models\Banner;

require __DIR__.'/auth.php';

Route::get('/', [LandingPageController::class, 'index'])->name('landing');
Route::post('/sendmessage', [MessageController::class, 'store'])->name('send-message');


Route::middleware('auth')->group(function () {
    
    // ! For banners metadata
    Route::prefix('admin')->group(function () {
    
        Route::get('/', function () {
            return view('admin');
        })->name('admin');
    
        Route::get('/banners&metadata', [BannerController::class, 'index'])->name('banners&metadata');
    
    });
    
    Route::put('/metadata/{metadata}', [MetadataController::class, 'update'])->name('metadata.update');
    Route::resource('banners', BannerController::class)->only(['store']);
    Route::post('/banners/delete-multiple', [BannerController::class, 'deleteMultiple'])->name('banners.deleteMultiple');

    

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    
    Route::resource('services', ServiceController::class);
    
    Route::resource('companies', CompanyController::class);
    Route::resource('messages', MessageController::class)->only([
        'index', 'destroy'
    ]);

    Route::resource('contacts', ContactController::class)->except(['show']);
    

});


