<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\WasteCalculatorHistoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/program', [PageController::class, 'programs'])->name('programs');
Route::get('/galeri', [PageController::class, 'gallery'])->name('gallery');
Route::get('/berita', [PageController::class, 'news'])->name('news');
Route::get('/informasi', [PageController::class, 'information'])->name('information');
Route::get('/kontak', [PageController::class, 'contact'])->name('contact');
Route::post('/kontak/kirim', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/kalkulator-sampah', [PageController::class, 'wasteCalculator'])->name('waste-calculator');

Route::get('/prosedur', [PageController::class, 'procedure'])->name('procedure');

Route::prefix('kalkulator-sampah')->name('waste-calculator.history.')->group(function (): void {
    Route::get('/riwayat', [WasteCalculatorHistoryController::class, 'index'])->name('index');
    Route::post('/riwayat', [WasteCalculatorHistoryController::class, 'store'])->name('store');
    Route::delete('/riwayat/{id}', [WasteCalculatorHistoryController::class, 'destroy'])->name('destroy');
    Route::post('/riwayat/bulk-delete', [WasteCalculatorHistoryController::class, 'bulkDelete'])->name('bulk-delete');
    Route::get('/riwayat/export-csv', [WasteCalculatorHistoryController::class, 'exportCsv'])->name('export-csv');
});
