<?php

use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Api\ProductLookupController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public site (dibungkus 'track.view' supaya kunjungannya tercatat untuk statistik dashboard admin)
Route::middleware('track.view')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/produk', [ProductController::class, 'index'])->name('products.index');
    Route::get('/produk/{product:slug}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/favorit', function () {
        return view('favorites');
    })->name('favorites');
    Route::get('/artikel', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/artikel/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');
});

Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');

// Lightweight JSON lookup used by client-side wishlist & "recently viewed" (localStorage-based)
Route::get('/api/produk-by-ids', ProductLookupController::class)->name('api.products.lookup');

// Dashboard admin: ringkasan statistik kunjungan situs
Route::get('/dashboard', [AdminDashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', AdminProductController::class)->except(['show']);
    Route::resource('testimonials', AdminTestimonialController::class)->except(['show']);
    Route::resource('faqs', AdminFaqController::class)->except(['show']);
    Route::resource('articles', AdminArticleController::class)->except(['show']);
    Route::get('messages', [ContactMessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{message}', [ContactMessageController::class, 'show'])->name('messages.show');
    Route::delete('messages/{message}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');
    Route::get('settings', [SiteSettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SiteSettingController::class, 'update'])->name('settings.update');
});

require __DIR__.'/auth.php';
