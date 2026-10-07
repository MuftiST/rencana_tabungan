<?php

use App\Http\Controllers\MenabungController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\CollaborationController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MidtransWebhookController;

Route::get('/', fn () => auth()->check() ? redirect()->route('dashboard') : view('welcome'));
Route::post('/payments/midtrans/webhook', MidtransWebhookController::class)->name('payments.midtrans.webhook');

Route::middleware('auth')->group(function () {
    Route::get('/home', [TabunganController::class, 'index'])->name('home');
    Route::get('/dashboard', [TabunganController::class, 'index'])->name('dashboard');
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('tabungan', TabunganController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
    Route::get('/tabungan/{tabungan}', [CollaborationController::class, 'show'])->name('tabungan.show');
    Route::get('/menabung/create', [MenabungController::class, 'create'])->name('menabung.create');
    Route::post('/menabung', [MenabungController::class, 'store'])->name('menabung.store');
    Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])->name('log-aktivitas.index');
    Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');
    Route::get('/statistik', [StatisticsController::class, 'index'])->name('statistik.index');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/{id}/read', [NotificationController::class, 'read'])->name('notifications.read');
    Route::get('/exports/tabungan.xlsx', [ExportController::class, 'excel'])->name('exports.excel');
    Route::get('/exports/tabungan.pdf', [ExportController::class, 'pdf'])->name('exports.pdf');
    Route::delete('/tabungan/{tabungan}/collaborators/{user}', [CollaborationController::class, 'remove'])->name('collaboration.remove');
});

require __DIR__.'/auth.php';
