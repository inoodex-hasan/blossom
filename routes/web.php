<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Public Frontend Pages
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/our-story/{slug?}', [PageController::class, 'ourStory'])->name('our-story');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/inquiry', [PageController::class, 'inquiry'])->name('inquiry');

// Public Form Submissions
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/inquiry', [InquiryController::class, 'store'])->name('inquiry.store');

// Login Route Redirect to Admin Login
Route::get('/login', fn () => redirect()->route('filament.admin.auth.login'))->name('login');
