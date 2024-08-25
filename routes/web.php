<?php

use Illuminate\Support\Facades\Route;

// Middlewares
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthMiddleware;


// Controllers
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;

//      Admin Controllers
use App\Http\Controllers\admin\MainController as AdminMainController;

//      Member Controllers
use App\Http\Controllers\member\MainController as MemberMainController;


// MAIN ROUTES
Route::get('/', [MainController::class, 'index'])->name('main.index');
Route::get('/account', [MainController::class, 'account'])->name('main.account');

// AUTH ROUTES
Route::prefix('/auth')->name('auth.')->controller(AuthController::class)->group(function()
{
    // Authentification
    Route::get('/login', 'login')->name('login');
    Route::get('/register', 'register')->name('register');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/email-verification/{user_token}', 'emailVerification')->name('email-verification');
    Route::get('/email-verification/{user_token}/sresend', 'emailVerificationResend')->name('email-verification.resend');

    Route::post('/login', 'loginPost')->name('toLogin');
    Route::post('/register', 'registerPost')->name('toRegister');
    Route::post('/email-verification', 'emailVerificationPost')->name('toVerifyEmail');

    // Passwords
    Route::prefix('/password')->name('password.')->group(function()
    {
        Route::get('/forget', 'forget')->name('forget');
        Route::get('/reset/{password_token}', 'reset')->name('reset');
        Route::get('/change', 'change')->name('change');

        Route::post('/forget', 'forgetPost')->name('toForget');
        Route::post('/reset', 'resetPost')->name('toReset');
        Route::post('/change', 'changePost')->name('toChange');
    });
});

// ADMIN ROUTES
Route::prefix("/admin")->middleware([AdminMiddleware::class])->name("admin.")->group(function(){
    Route::get('/', [AdminMainController::class, 'index'])->name('index');
});


// MEMBER ROUTES
Route::prefix("/member")->middleware([AuthMiddleware::class])->name("member.")->group(function(){
    Route::get('/', [MemberMainController::class, 'index'])->name('index');
});