<?php

use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\MenuBilderController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/
// Route::group(['as' => 'app.', 'prefix' => 'app', 'middleware' => ['auth']], function () {


// });




Route::get('/dashboard', DashboardController::class)->name('dashboard');

// Roles and Users 

Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);

// profile routes 

Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');

// security routes 

Route::get('profile/security', [ProfileController::class, 'changePassword'])->name('profile.password.change');
Route::put('profile/security', [ProfileController::class, 'updatePassword'])->name('profile.password.update');


// Backups routes 

Route::resource('backups', BackupController::class)
    ->only(['index', 'store', 'destroy']);
Route::get('backups/{file_name}', [BackupController::class, 'download'])->name('backups.download');
Route::get('backups/clean', [BackupController::class, 'clean'])->name('backups.clean');



// pages

Route::resource('pages', PageController::class);

// menus

Route::resource('menus', MenuController::class)->except('show');


Route::group(['as' => 'menus.', 'prefix' => 'menus/{id}'], function () {

    Route::get('builder', [MenuBilderController::class, 'index'])->name('builder');
    Route::post('order', [MenuBilderController::class, 'order'])->name('order');
    Route::get('item/create', [MenuBilderController::class, 'itemCreate'])->name('item.create');
    Route::post('item/store', [MenuBilderController::class, 'itemStore'])->name('item.store');


    Route::get('item/{itemId}/edit', [MenuBilderController::class, 'itemEdit'])->name('item.edit');
    Route::put('item/{itemId}/update', [MenuBilderController::class, 'itemUpdate'])->name('item.update');



    Route::delete('item/{itemId}/destroy', [MenuBilderController::class, 'itemDestroy'])->name('item.destroy');
});


Route::group(['as' => 'settings.', 'prefix' => 'setting'], function () {

    Route::get('general', [SettingController::class, 'general'])->name('general');
    Route::put('general/update', [SettingController::class, 'generalUpdate'])->name('general.update');
});
