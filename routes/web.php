<?php

use App\Http\Controllers\BusinessCategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EducationController;
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


Route::get('/test',[LoginController::class,'test']);
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login-in');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/store',[UserController::class, 'store'])->name('store');

Route::get('/district-suggestions', [DistrictController::class, 'getDistricts'])->name('district.suggestions');
Route::get('/taluka-suggestions', [TalukaController::class, 'getTalukas'])->name('taluka.suggestions');
Route::get('/village-suggestions', [VillageController::class, 'getVillages'])->name('village.suggestions');
Route::get('/education-suggestions', [EducationController::class, 'getSuggestions'])->name('education.suggestions');
Route::get('/company-suggestions', [CompanyController::class, 'getSuggestions'])->name('company.suggestions');
Route::get('/bussiness-category-suggestions', [BusinessCategoryController::class, 'getSuggestions'])->name('business.category.suggestions');


Route::middleware(['auth:web'])->group(function () {
    Route::group(['prefix'=>'user'], function () {
        Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/update', [UserController::class, 'update'])->name('user.update');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
        Route::get('/viewevent', [UserController::class, 'viewevent'])->name('view.user.event');
    
        Route::get('my/family/members', [UserController::class, 'userview'])->name('family.user');
        
        Route::get('family/members', [UserController::class, 'familymembers'])->name('all.family.members');
        
        Route::get('members/byvillage', [UserController::class, 'membersbyvillage'])->name('members.village');
        
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::post('/profile/update', [UserController::class, 'profileupdate'])->name('profile.update');
        Route::post('/update-profile-photo', [UserController::class, 'updateProfilePhoto'])->name('user.updateProfilePhoto');
        Route::post('/profile/photo/remove', [UserController::class, 'removeProfilePhoto'])->name('profile.photo.remove');

        Route::get('/member/{id}', [UserController::class, 'memberview'])->name('view.particular.member');

        Route::get('/members/all', [UserController::class, 'allmembers'])->name('members.all');

    });
});

Route::middleware(['auth:admin'])->group(function () {
    Route::group(['prefix'=>'admin'], function () {

        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/viewevents', [AdminController::class, 'viewevent'])->name('view.events');
        
        Route::get('/users/all', [AdminController::class, 'allusers'])->name('all.users');
        
        Route::get('/users/search', [AdminController::class, 'searchusers'])->name('users.search');

        Route::get('/family/byvillage', [FamilyPerVillageController::class, 'familybyvillage'])->name('family.village');

        Route::get('/family/byvillage/family-members', [FamilyInformationController::class, 'familyinfo'])->name('family.members');

        Route::get('/approval', [AdminController::class, 'approval'])->name('user-approval');

        Route::get('/approval/user/{id}', [AdminController::class, 'viewapproval'])->name('view.approval');

        Route::get('approve/{id}', [AdminController::class, 'approve'])->name('user.approve');
        Route::get('disapprove/{id}', [AdminController::class, 'disapprove'])->name('user.disapprove');

        Route::get('/adminprofile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::post('/profile/update', [AdminController::class, 'updateprofile'])->name('admin.profile.update');
        Route::post('/update-profile-photo', [AdminController::class, 'updateProfilePhoto'])->name('updateProfilePhoto');
        Route::post('/profile/remove', [AdminController::class, 'removeProfilePhoto'])->name('admin.profile.remove');

        Route::get('/add-event', [EventController::class, 'create'])->name('createevent');

        Route::get('/add-admin', [AdminController::class, 'addadmin'])->name('add.admin');
        Route::post('/add-admin-store', [AdminController::class, 'storeaddadmin'])->name('add.admin.store');

        Route::get('/members', [UserController::class, 'view'])->name('view.members');
        Route::get('/members/edit/{id}', [AdminController::class, 'editmember'])->name('edit.members');
        Route::post('/members/update/{id}', [AdminController::class, 'updatemember'])->name('update.members');
        Route::get('/members/delete/{id}', [AdminController::class, 'deletemember'])->name('delete.members');

        Route::post('event/store', [EventController::class, 'eventstore'])->name('event.store');
        Route::get('event/edit/{id}', [EventController::class, 'edit'])->name('event.edit');
        Route::post('event/update/{id}', [EventController::class, 'update'])->name('event.update');
        Route::get('event/delete/{id}', [EventController::class, 'delete'])->name('event.delete');

        Route::get('/eventstatus', [EventController::class, 'eventstatus'])->name('eventstatus');
    
        Route::get('/members/search', [AdminController::class, 'search'])->name('members.search');
    
        Route::get('/member/{id}', [AdminController::class, 'memberview'])->name('member.view');

    });
});

