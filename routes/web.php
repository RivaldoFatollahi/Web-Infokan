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


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    // Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/reports', [PublicReportController::class, 'store'])->middleware('auth')->name('reports.store');
    Route::get('/laporan', function () {return view('public-laporan');})->name('laporan');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('/announcements', AnnouncementController::class)->names('announcements');
    Route::resource('/houses', HouseController::class)->names('houses');
    Route::resource('/users', UserController::class)->names('users');
    Route::resource('/reports', ReportController::class)->names('reports');
    Route::post('/reports/reply', [ReportController::class, 'storeReply'])
    ->name('reports.reply');
    Route::get('/reports/{id}', [ReportController::class, 'show'])->name('reports.show');
});

require __DIR__ . '/auth.php';
