<?php

use App\Controllers\AdminController;
use App\Controllers\CategoryController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\MovieController;
use App\Controllers\RegisterController;
use App\Kernel\Router\Route;

return [
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/categories', [CategoryController::class, 'index']),

    Route::get('/register', [RegisterController::class, 'index']),
    Route::post('/register', [RegisterController::class, 'register']),

    Route::get('/login', [LoginController::class, 'index']),
    Route::post('/login', [LoginController::class, 'login']),

    Route::post('/logout', [LoginController::class, 'logout']),

    Route::get('/admin', [AdminController::class, 'index']),

    Route::get('/admin/categories/create', [CategoryController::class, 'create']),
    Route::post('/admin/categories/create', [CategoryController::class, 'store']),
    Route::get('/admin/categories/destroy', [CategoryController::class, 'destroy']),
    Route::get('/admin/categories/edit', [CategoryController::class, 'edit']),
    Route::post('/admin/categories/edit', [CategoryController::class, 'update']),

    Route::get('/admin/movies/create', [MovieController::class, 'create']),
    Route::post('/admin/movies/create', [MovieController::class, 'store']),
    Route::get('/admin/movies/destroy', [MovieController::class, 'destroy']),
    Route::get('/admin/movies/edit', [MovieController::class, 'edit']),
    Route::post('/admin/movies/edit', [MovieController::class, 'update']),

    Route::get('/movies', [MovieController::class, 'show']),
    Route::post('/movies/review', [MovieController::class, 'review']),
];
