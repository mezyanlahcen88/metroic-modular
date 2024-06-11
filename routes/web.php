<?php

use App\Models\Language;
use Illuminate\Support\Carbon;
use App\Models\LanguageTranslate;
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

Route::get('/word', function () {
    $model = 'Post';
    $modelLower = 'post';
    $plural = 'posts';
    $now = Carbon::now();
    $translations = [
        [
            'model' => $model,
            'language_id' => 1,
            'label' => $modelLower . '_action_add',
            'translation' => 'Add ' . $modelLower,
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'model' => $model,
            'language_id' => 1,
            'label' => $modelLower . '_action_show',
            'translation' => 'Show ' . $modelLower,
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'model' => $model,
            'language_id' => 1,
            'label' => $modelLower . '_action_edit',
            'translation' => 'Edit ' . $modelLower,
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'model' => $model,
            'language_id' => 1,
            'label' => $modelLower . '_action_delete',
            'translation' => 'Delete ' . $modelLower,
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'model' => $model,
            'language_id' => 1,
            'label' => $modelLower . '_action_restore',
            'translation' => 'Restore ' . $modelLower,
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'model' => $model,
            'language_id' => 1,
            'label' => $modelLower . '_message_add',
            'translation' => $model . ' successfully created',
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'model' => $model,
            'language_id' => 1,
            'label' => $modelLower . '_message_show',
            'translation' => $model . ' successfully showed',
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'model' => $model,
            'language_id' => 1,
            'label' => $modelLower . '_message_edit',
            'translation' => $model . ' successfully updated',
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'model' => $model,
            'language_id' => 1,
            'label' => $modelLower . '_message_delete',
            'translation' => $model . ' successfully deleted',
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'model' => $model,
            'language_id' => 1,
            'label' => $modelLower . '_message_restore',
            'translation' => $model . ' successfully restored',
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'model' => $model,
            'language_id' => 1,
            'label' => $modelLower . '_message_activated',
            'translation' => $model . ' has been successfully activated',
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'model' => $model,
            'language_id' => 1,
            'label' => $modelLower . '_message_inactivated',
            'translation' => $model . ' has been successfully inactivated',
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'model' => $model,
            'language_id' => 1,
            'label' => $modelLower . '_form_manage_posts',
            'translation' => 'manage ' . $plural,
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'model' => $model,
            'language_id' => 1,
            'label' => $modelLower . '_form_posts_list',
            'translation' => 'list of ' . $plural,
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'model' => $model,
            'language_id' => 1,
            'label' => $modelLower . '_form_deleted_posts_list',
            'translation' => 'list deleted ' . $plural,
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'model' => $model,
            'language_id' => 1,
            'label' => $modelLower . '_form_manage_deleted_posts',
            'translation' => 'manage deleted ' . $plural,
            'created_at' => $now,
            'updated_at' => $now,
        ],
    ];

    LanguageTranslate::insert($translations);
});
