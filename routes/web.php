<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\PasswordController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;
use Laravel\Fortify\Http\Controllers\RecoveryCodeController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\ProfileInformationController;
use Laravel\Fortify\Http\Controllers\TwoFactorSecretKeyController;
use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\ConfirmedTwoFactorAuthenticationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
   return view('home');    
})->middleware(['auth','verified']);

//// admin routes


    Route::middleware(['auth:admin'])->group(function () {
        Route::view('/admin/home','admin.home')->name('admin.home');
        Route::post('/admin/logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');

        // Route::get('/admin/email/verify', [EmailVerificationPromptController::class, '__invoke'])->name('admin.verification.notice');
        // Route::get('/admin/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->name('admin.verification.verify');
        // Route::post('/admin/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->name('admin.verification.send');
        // Route::put('/admin/user/profile-information', [ProfileInformationController::class, 'update'])->name('admin.user-profile-information.update');
        // Route::put('/admin/user/password', [PasswordController::class, 'update'])->name('admin.user-password.update');
        Route::get('/admin/user/confirm-password', [ConfirmablePasswordController::class, 'show']);
        Route::get('/admin/user/confirmed-password-status', [ConfirmedPasswordStatusController::class, 'show'])->name('admin.password.confirmation');
        Route::post('/admin/user/confirm-password', [ConfirmablePasswordController::class, 'store'])->name('admin.password.confirm');
        // Route::get('/admin/two-factor-challenge', [TwoFactorAuthenticatedSessionController::class, 'create'])->name('admin.two-factor.login');
        // Route::post('/admin/two-factor-challenge', [TwoFactorAuthenticatedSessionController::class, 'store']);
        // Route::post('/admin/user/two-factor-authentication', [TwoFactorAuthenticationController::class, 'store'])->name('admin.two-factor.enable');
        // Route::post('/admin/user/confirmed-two-factor-authentication', [ConfirmedTwoFactorAuthenticationController::class, 'store'])->name('admin.two-factor.confirm');
        // Route::delete('/admin/user/two-factor-authentication', [TwoFactorAuthenticationController::class, 'destroy'])->name('admin.two-factor.disable');
        // Route::get('/admin/user/two-factor-qr-code', [TwoFactorQrCodeController::class, 'show'])->name('admin.two-factor.qr-code');
        // Route::get('/admin/user/two-factor-secret-key', [TwoFactorSecretKeyController::class, 'show'])->name('admin.two-factor.secret-key');
        // Route::get('/admin/user/two-factor-recovery-codes', [RecoveryCodeController::class, 'index'])->name('admin.two-factor.recovery-codes');
        // Route::post('/admin/user/two-factor-recovery-codes', [RecoveryCodeController::class, 'store']);
});

    Route::middleware(['guest:admin'])->group(function () {
        Route::view('/admin/login','admin.login');
        Route::post('/admin/login', [AuthenticatedSessionController::class, 'store'])->name('admin.login');

        Route::view('/admin/register','admin.register');
        Route::post('/admin/register', [RegisteredUserController::class, 'store'])->name('admin.register');
        

        Route::get('/admin/forgot-password', [PasswordResetLinkController::class, 'create'])->name('admin.password.request');
        Route::get('/admin/reset-password/{token}', [NewPasswordController::class, 'create'])->name('admin.password.reset');
        Route::post('/admin/forgot-password', [PasswordResetLinkController::class, 'store'])->name('admin.password.email');
        Route::post('/admin/reset-password', [NewPasswordController::class, 'store'])->name('admin.password.update');
    });
