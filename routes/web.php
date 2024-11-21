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

Route::get('/district-suggestions', [DistrictController::class, 'getSuggestions'])->name('district.suggestions');
Route::get('/taluka-suggestions', [TalukaController::class, 'getSuggestions'])->name('taluka.suggestions');
Route::get('/village-suggestions', [VillageController::class, 'getSuggestions'])->name('village.suggestions');


Route::middleware(['auth', 'users:0'])->group(function () {
    Route::group(['prefix'=>'user'], function () {
        Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');
        Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('user/update/', [UserController::class, 'update'])->name('user.update');
        Route::get('user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
        Route::get('user/viewevent', [UserController::class, 'viewevent'])->name('view.user.event');
    
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::post('/profile/update', [UserController::class, 'profileupdate'])->name('profile.update');
    });
});

Route::middleware(['auth', 'users:1'])->group(function () {
    Route::group(['prefix'=>'admin'], function () {

        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/viewevents', [AdminController::class, 'viewevent'])->name('view.events');

        Route::get('/view/family/byvillage', [FamilyPerVillageController::class, 'familybyvillage'])->name('family.village');

        Route::get('/family-members/{ph_no}', [FamilyInformationController::class, 'familyinfo'])->name('family.members');

        Route::get('/family', [AdminController::class, 'familyinfo'])->name('family.info');

        Route::get('/adminprofile', [AdminController::class, 'profile'])->name('admin.profile');

        Route::get('/add-event', [EventController::class, 'create'])->name('createevent');

        Route::get('/members', [UserController::class, 'view'])->name('view.members');

        Route::post('event/store', [EventController::class, 'eventstore'])->name('event.store');
        Route::get('event/edit/{id}', [EventController::class, 'edit'])->name('event.edit');
        Route::post('event/update/{id}', [EventController::class, 'update'])->name('event.update');
        Route::get('event/delete/{id}', [EventController::class, 'delete'])->name('event.delete');

        Route::get('/eventstatus', [EventController::class, 'eventstatus'])->name('eventstatus');
    });
});

