<?php

use App\Http\Controllers\User\BookController;
use App\Http\Controllers\User\HistoryController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\LoanController;

Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/books/{id}', [LandingController::class, 'detail'])->name('landing.detail');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboard::class, 'index'])->name('dashboard');
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{id}', [UserDashboard::class, 'detail'])->name('books.detail');
    Route::get('/histories', [HistoryController::class, 'index'])->name('histories');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::get('/books',[AdminBookController::class, 'index'])->name('books');
    Route::get('/books/create', [AdminBookController::class, 'create'])->name('books.create');
    Route::post('/books', [AdminBookController::class, 'store'])->name('books.store');
    Route::get('/books/{id}/edit', [AdminBookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{id}', [AdminBookController::class, 'update'])->name('books.update');
    Route::get('/books/{id}', [AdminBookController::class, 'show'])->name('books.show');
    Route::delete('/books/{id}', [AdminBookController::class, 'destroy'])->name('books.destroy');


    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');


    Route::get('/members', [MemberController::class, 'index'])->name('members.index');
    Route::get('/members/{member}/edit', [MemberController::class, 'edit'])->name('members.edit');
    Route::put('/members/{member}', [MemberController::class, 'update'])->name('members.update');
    Route::delete('/members/{member}', [MemberController::class, 'destroy'])->name('members.destroy');

    Route::get('loans', [App\Http\Controllers\Admin\LoanController::class, 'index'])->name('loans.index');
    Route::get('fines/{fine}/edit', [LoanController::class, 'editFine'])->name('loans.edit');
    Route::put('fines/{fine}', [LoanController::class, 'updateFine'])->name('loans.update');

});