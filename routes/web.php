<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReceivableController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/quick-preview', [AuthController::class, 'quickPreview'])->name('quick.preview');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/module/accounts-receivable', [ReceivableController::class, 'index'])->name('module.ar');
Route::post('/module/accounts-receivable', [ReceivableController::class, 'store'])->name('ar.store');
Route::post('/module/accounts-receivable/{id}/mark-paid', [ReceivableController::class, 'markPaid'])->name('ar.markPaid');

Route::get('/module/{slug}', [DashboardController::class, 'show'])->name('module.show');
Route::get('/admin-dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');