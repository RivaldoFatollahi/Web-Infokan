<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\HouseController;

use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\PublicReportController;
use App\Http\Controllers\Public\LaporanController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    // Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/reports', [PublicReportController::class, 'store'])->name('reports.store');
    Route::put('/reports/{report}', [PublicReportController::class, 'update'])->name('reports.update');
    Route::delete('/reports/{report}', [PublicReportController::class, 'destroy'])->name('reports.destroy');
    Route::get('/laporan-saya', [LaporanController::class, 'index'])->name('laporan');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/announcements', [AnnouncementController::class, 'dashboard'])->name('announcements');
    Route::get('/houses', [HouseController::class, 'houses'])->name('houses');
    Route::get('/users', [UserController::class, 'users'])->name('users');
    Route::get('/reports', [ReportController::class, 'reports'])->name('reports');
});

require __DIR__ . '/auth.php';
