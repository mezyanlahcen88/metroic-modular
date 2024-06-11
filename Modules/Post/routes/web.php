<?php

use Illuminate\Support\Facades\Route;
use Modules\Post\App\Http\Controllers\PostController;

Route::group([], function () {
    //chaneg the status
    Route::post('/post/changestatus', [PostController::class, 'changeStatus'])->name('post.changestatus');
    //to permanently delete
    Route::delete('/post/{id}/force_delete', [PostController::class, 'forceDelete'])->name('post.forceDelete');
    // to restore
    Route::put('/post/{id}/restore', [PostController::class, 'restore'])->name('post.restore');
    //liste all deleted
    Route::get('/post/trashed', [PostController::class, 'trashed'])->name('post.trashed');
    Route::resource('client', PostController::class)->names('client');
});
