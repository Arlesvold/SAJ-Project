<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/program', [PageController::class, 'programs'])->name('programs');
Route::get('/galeri', [PageController::class, 'gallery'])->name('gallery');
Route::get('/berita', [PageController::class, 'news'])->name('news');
Route::get('/informasi', [PageController::class, 'information'])->name('information');
Route::get('/kontak', [PageController::class, 'contact'])->name('contact');
Route::get('/kalkulator-sampah', [PageController::class, 'wasteCalculator'])->name('waste-calculator');
