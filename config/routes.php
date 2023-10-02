<?php

use App\Controllers\AdminController;
use App\Controllers\CategoryController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\MovieController;
use App\Controllers\RegisterController;
use App\Kernel\Router\Route;
use App\Middlewares\AdminMiddleware;
use App\Middlewares\GuestMiddleware;

return [
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/categories', [CategoryController::class, 'index']),

    Route::get('/register', [RegisterController::class, 'index'], [GuestMiddleware::class]),
    Route::post('/register', [RegisterController::class, 'register']),

    Route::get('/login', [LoginController::class, 'index'], [GuestMiddleware::class]),
    Route::post('/login', [LoginController::class, 'login']),

    Route::post('/logout', [LoginController::class, 'logout']),

    Route::get('/admin', [AdminController::class, 'index'], [AdminMiddleware::class]),

    Route::get('/admin/categories/create', [CategoryController::class, 'create'], [AdminMiddleware::class]),
    Route::post('/admin/categories/create', [CategoryController::class, 'store'], [AdminMiddleware::class]),
    Route::get('/admin/categories/destroy', [CategoryController::class, 'destroy'], [AdminMiddleware::class]),
    Route::get('/admin/categories/edit', [CategoryController::class, 'edit'], [AdminMiddleware::class]),
    Route::post('/admin/categories/edit', [CategoryController::class, 'update'], [AdminMiddleware::class]),

    Route::get('/admin/movies/create', [MovieController::class, 'create'], [AdminMiddleware::class]),
    Route::post('/admin/movies/create', [MovieController::class, 'store'], [AdminMiddleware::class]),
    Route::get('/admin/movies/destroy', [MovieController::class, 'destroy'], [AdminMiddleware::class]),
    Route::get('/admin/movies/edit', [MovieController::class, 'edit'], [AdminMiddleware::class]),
    Route::post('/admin/movies/edit', [MovieController::class, 'update'], [AdminMiddleware::class]),

    Route::get('/movies', [MovieController::class, 'show']),
    Route::post('/movies/review', [MovieController::class, 'review']),
];
