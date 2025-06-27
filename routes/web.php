<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

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

// Home Route - LOCAL ARTICLES ONLY
Route::get('/', [ArticleController::class, 'home'])->name('home');

// Article Routes - Public
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/popular', [ArticleController::class, 'popular'])->name('articles.popular');
Route::get('/search', [ArticleController::class, 'search'])->name('articles.search');

// API Routes for search suggestions
Route::get('/api/search-suggestions', [ArticleController::class, 'searchSuggestions'])->name('api.search-suggestions');

// Local News Routes (replaces external news)
Route::get('/local-news', [ArticleController::class, 'localNews'])->name('local.news');

// Article Routes - Auth Required
Route::middleware(['auth'])->group(function () {
    // Artikel Management
    Route::get('/publish', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    
    // Article delete route with proper redirect
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    
    Route::post('/articles/{article}/publish', [ArticleController::class, 'publish'])->name('articles.publish');
    
    // User's Articles
    Route::get('/my-articles', [ArticleController::class, 'myArticles'])->name('articles.my');
    
    // Comment Routes
    Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    
    // Admin Routes
    Route::get('/admin/ensure-categories', [ArticleController::class, 'ensureCategories'])->name('admin.ensure-categories');
    
    // Article Management Routes
    Route::post('/articles/{article}/duplicate', [ArticleController::class, 'duplicate'])->name('articles.duplicate');
    Route::post('/articles/{article}/toggle-archive', [ArticleController::class, 'toggleArchive'])->name('articles.toggle-archive');
    Route::get('/articles/{article}/analytics', [ArticleController::class, 'analytics'])->name('articles.analytics');
});

// Advanced Search Route
Route::get('/advanced-search', [ArticleController::class, 'advancedSearch'])->name('articles.advanced-search');

// Category Routes - Dynamic Category Pages
Route::get('/category/{category:id}', [ArticleController::class, 'byCategory'])->name('category.show');

// Individual Article Route - MOVED DOWN to avoid conflicts with other routes
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// Trending Articles Route - Enhanced with filters
Route::get('/trending', [ArticleController::class, 'trending'])->name('trending');

