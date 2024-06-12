<?php

use Illuminate\Support\Facades\Route;
use Modules\Language\App\Http\Controllers\LanguageController;

Route::group([], function () {
    //chaneg the status
    Route::post('/language/changestatus', [LanguageController::class, 'changeStatus'])->name('language.changestatus');
    //to permanently delete
    Route::delete('/language/{id}/force_delete', [LanguageController::class, 'forceDelete'])->name('language.forceDelete');
    // to restore
    Route::put('/language/{id}/restore', [LanguageController::class, 'restore'])->name('language.restore');
    //liste all deleted
    Route::get('/language/trashed', [LanguageController::class, 'trashed'])->name('language.trashed');
    Route::get('/languages/get-languages-json', [LanguageController::class ,'getUsersJson'])->name('users.getUsersJson');
    Route::resource('language', LanguageController::class)->names('language');
});
