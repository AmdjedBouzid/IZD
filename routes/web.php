<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BannerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LandingPageController;


require __DIR__.'/auth.php';

Route::get('/', [LandingPageController::class, 'index'])->name('landing.index');
Route::post('/sendmessage', [MessageController::class, 'store'])->name('send-message');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('services', ServiceController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('banners', BannerController::class)->except(['show', 'edit', 'update']);
    Route::resource('messages', MessageController::class)->only([
        'index', 'destroy'
    ]);
    Route::resource('contacts', ContactController::class)->except(['show']);
    
    Route::get('/admin', function () {
        return view('admin');
    })->name('admin');
});

