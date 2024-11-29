<?php

use App\Http\Controllers\FamilyInformationController;
use App\Http\Controllers\FamilyPerVillageController;
use App\Http\Controllers\TalukaController;
use App\Http\Controllers\VillageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DistrictController;

// Route::get('/index', function () {
//     return view('admin.add-event');
// });

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login-in');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/store',[UserController::class, 'store'])->name('store');

Route::middleware(['auth', 'users:0'])->group(function () {
    Route::group(['prefix'=>'user'], function () {
        Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/update', [UserController::class, 'update'])->name('user.update');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
        Route::get('/viewevent', [UserController::class, 'viewevent'])->name('view.user.event');
    
        Route::get('family/members', [UserController::class, 'userview'])->name('family.user');
        
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::post('/profile/update', [UserController::class, 'profileupdate'])->name('profile.update');
    });
});

Route::middleware(['auth', 'users:1'])->group(function () {
    Route::group(['prefix'=>'admin'], function () {

        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/viewevents', [AdminController::class, 'viewevent'])->name('view.events');

        Route::get('/view/family/byvillage', [FamilyPerVillageController::class, 'familybyvillage'])->name('family.village');

        Route::get('/family-members', [FamilyInformationController::class, 'familyinfo'])->name('family.members');

        Route::get('/approval', [AdminController::class, 'approval'])->name('user-approval');

        Route::get('/adminprofile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::post('/profile/update', [AdminController::class, 'updateprofile'])->name('admin.profile.update');

        Route::get('/add-event', [EventController::class, 'create'])->name('createevent');

        Route::get('/members', [UserController::class, 'view'])->name('view.members');

        Route::post('event/store', [EventController::class, 'eventstore'])->name('event.store');
        Route::get('event/edit/{id}', [EventController::class, 'edit'])->name('event.edit');
        Route::post('event/update/{id}', [EventController::class, 'update'])->name('event.update');
        Route::get('event/delete/{id}', [EventController::class, 'delete'])->name('event.delete');

        Route::get('/eventstatus', [EventController::class, 'eventstatus'])->name('eventstatus');
    });
});

