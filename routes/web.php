<?php

use App\Http\Controllers\BannerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MetadataController;
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

    });

});
