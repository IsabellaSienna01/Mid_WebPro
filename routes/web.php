<?php

use App\Http\Controllers\User\BookDetailController;
use App\Http\Controllers\User\LoanController as UserLoan;
use App\Http\Controllers\User\BookController;
use App\Http\Controllers\User\HistoryController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;

Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/book-detail/{id}', [LandingController::class, 'detail'])->name('landing.detail');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboard::class, 'index'])->name('dashboard');
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/book-detail/{id}', [BookDetailController::class, 'detail'])->name('book.detail');
    Route::post('/book-detail/{id}', [UserLoan::class, 'borrow'])->name('book.borrow');
    Route::get('/histories', [HistoryController::class, 'index'])->name('histories');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::view('/books', 'admin.books.index')->name('books');
});