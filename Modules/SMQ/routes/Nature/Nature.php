<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Modules\SMQ\Controllers\Nature\NatureController;

$name = Str::plural('nature');

Route::prefix($name)
    ->name("{$name}.")
//    ->middleware(['auth:api'])
    ->controller(NatureController::class)->group(function () {
        Route::get(uri: '/', action: 'index')->name('index');;
    });
