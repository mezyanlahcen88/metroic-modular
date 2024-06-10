<?php

use App\Models\Language;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Apps\PermissionManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::name('admin.')->group(function () {
        Route::get('/admin/users/profile', [UserManagementController::class ,'profile'])->name('users.profile');
        Route::get('/admin/users/get-users-json', [UserManagementController::class ,'getUsersJson'])->name('users.getUsersJson');
        Route::resource('/admin/users', UserManagementController::class);
        Route::resource('/admin/roles', RoleManagementController::class);
        Route::resource('/admin/permissions', PermissionManagementController::class);
    });

});

Route::get('/error', function () {
    abort(500);
});
Route::get('/langg', function () {
    return storeTranslaionToLang();
    // return Language::pluck('name','id');
});
Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';
