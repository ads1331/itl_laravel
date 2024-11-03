<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\GuestListController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');


Route::get('/guest_lists', [GuestListController::class, 'index'])->name('');
Route::get('/guest_lists/{id}', [GuestListController::class, 'show']);
Route::patch('/guest_lists/{id}', [GuestListController::class, 'update']);

Route::get('/tables', [TableController::class, 'index']);
Route::get('/tables/{id}', [TableController::class, 'show'])->name('tables.show');
Route::patch('/tables/{id}', [TableController::class, 'update']);
Route::get('/tables/{id}/guests', [TableController::class, 'guests']);
Route::get('/tables_stats', [TableController::class, 'stats']);
Route::post('/tables', [TableController::class, 'store']);


Route::get('/guests/{id}', [GuestController::class, 'show'])->name('guests.show');
Route::post('/guests', [GuestController::class, 'store']);