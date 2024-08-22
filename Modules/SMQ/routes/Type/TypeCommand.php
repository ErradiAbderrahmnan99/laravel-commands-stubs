<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Modules\SMQ\Controllers\Type\TypeCommandController;

$name = Str::plural('type');

Route::prefix($name)
    ->name("{$name}.")
    ->middleware(['auth:api'])
    ->controller(TypeCommandController::class)->group(function () {

    });
