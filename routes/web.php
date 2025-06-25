<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Middleware\RedaksiMiddleware;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\Public\ProfileController;
use App\Http\Controllers\Public\NewsController as PublicNewsController;

Route::get('/', function () {
    return redirect()->route('berita.index');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [GoogleController::class, 'logout'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

});

Route::middleware([AdminMiddleware::class])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::resource('/roles', RoleController::class);

    Route::get('admin/users', [UserController::class,'index'])->name('users.index');
    Route::get('admin/users/create', [UserController::class,'create'])->name('users.create');
    Route::post('admin/users',       [UserController::class,'store'])->name('users.store');
    Route::get('admin/users/{user}/edit',       [UserController::class,'edit'])->name('users.edit');
    Route::put('admin/users/{user}',       [UserController::class,'update'])->name('users.update');

    Route::resource('/news_categories', NewsCategoryController::class);
});

Route::middleware([RedaksiMiddleware::class])->group(function () {

    Route::resource('redaksi', NewsController::class);

});

Route::middleware([UserMiddleware::class])->group(function () {});


Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');

    Route::get('/auth/google/redirect', [GoogleController::class, 'callback'])->name('google.callback');
});

Route::get('/berita', [PublicNewsController::class, 'index'])->name('berita.index');

Route::get('/berita/{year}/{month}/{day}/{news_id}/{slug}', [PublicNewsController::class, 'show'])->name('berita.show');

Route::get('/author/{author:username}', [AuthorController::class, 'show'])->name('author.username');
