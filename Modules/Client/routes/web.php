<?php

use Illuminate\Support\Facades\Route;
use Modules\Client\App\Http\Controllers\ClientController;

Route::group([], function () {
    //chaneg the status
    Route::post('/client/changestatus', [ClientController::class, 'changeStatus'])->name('client.changestatus');
    //to permanently delete
    Route::delete('/client/{id}/force_delete', [ClientController::class, 'forceDelete'])->name('client.forceDelete');
    // to restore
    Route::put('/client/{id}/restore', [ClientController::class, 'restore'])->name('client.restore');
    //liste all deleted
    Route::get('/client/trashed', [ClientController::class, 'trashed'])->name('client.trashed');
    Route::resource('client', ClientController::class)->names('client');
});
