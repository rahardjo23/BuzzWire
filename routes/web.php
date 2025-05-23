<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController; // TAMBAHAN IMPORT

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    
    // Tambahan untuk artikel
    Route::get('/my-articles', [ProfileController::class, 'articles'])->name('profile.articles');
    Route::get('/my-drafts', [ProfileController::class, 'drafts'])->name('profile.drafts');
});

// Article Routes - Public
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/popular', [ArticleController::class, 'popular'])->name('articles.popular');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/search', [ArticleController::class, 'search'])->name('articles.search');

// Article Routes - Auth Required
Route::middleware(['auth'])->group(function () {
    // Artikel Management
    Route::get('/publish', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    Route::post('/articles/{article}/publish', [ArticleController::class, 'publish'])->name('articles.publish');
    
    // User's Articles
    Route::get('/my-articles', [ArticleController::class, 'myArticles'])->name('articles.my');
    
    // TAMBAHAN: Comment Routes
    Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    
    // Admin Routes
    Route::get('/admin/ensure-categories', [ArticleController::class, 'ensureCategories'])->name('admin.ensure-categories');
});

// Category Routes
Route::get('/category/{category}', [ArticleController::class, 'byCategory'])->name('category.show');

// Home Route
Route::get('/', [ArticleController::class, 'home'])->name('home');

// Test Route
Route::get('/tes', function () {
    return view('tes');
});

// Static Category Pages
Route::get('/politics', function () {
    return view('politics');
})->name('politics');

Route::get('/technology', function () {
    return view('technology');
})->name('technology');

Route::get('/health', function () {
    return view('health');
})->name('health');

Route::get('/sports', function () {
    return view('sports');
})->name('sports');

Route::get('/crime', function () {
    return view('crime');
})->name('crime');

Route::get('/science', function () {
    return view('science');
})->name('science');

Route::get('/economic', function () {
    return view('economic');
})->name('economic');

Route::get('/travel', function () {
    return view('travel');
})->name('travel');