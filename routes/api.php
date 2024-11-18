<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\API\APIController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::post('/store',[UserController::class, 'store'])->name('store');

Route::post('/login', [APIController::class, 'login'])->name('loggedin');

Route::post('/weeklyevents', [APIController::class, 'weeklyevents'])->name('view.user.event');
Route::post('/events', [APIController::class, 'viewevents'])->name('view.events');

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [APIController::class, 'logout'])->name('logout');
    Route::get('/user', [APIController::class, 'display']);
});
