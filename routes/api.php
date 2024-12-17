<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\API\APIController;


Route::post('/store',[UserController::class, 'store'])->name('storedata');

Route::post('/login', [APIController::class, 'login'])->name('loggedin');

Route::middleware('auth:api')->group(function () {
    
    Route::post('/logout', [APIController::class, 'logout'])->name('loggedout');
    
    Route::post('/user', [APIController::class, 'display']);
    Route::post('/edit', [APIController::class, 'edit'])->name('user.edit');
    Route::post('/delete', [APIController::class, 'delete'])->name('user.delete');
    
    Route::post('/weeklyevents', [APIController::class, 'weeklyevents'])->name('view.users.event');
    Route::post('/events', [APIController::class, 'viewevents'])->name('view.event');
    
    Route::post('/byvillage', [APIController::class, 'byvillage'])->name('byvillage');
    
    // Route::post('/byphlink', [APIController::class, 'byphlink'])->name('byphlink');

});
