<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/migrate', [HomeController::class, 'migrate']);
Route::get('/list', [HomeController::class, 'showRecipes']);
Route::get('/lastweekprofit', [HomeController::class, 'showLastWeekProfit']);
Route::get('/maxcapacity', [HomeController::class, 'maxCapacity']);
Route::get('/nextorderprofit', [HomeController::class, 'nextOrderProfit']);
