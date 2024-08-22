<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Modules\Commande\Controllers\Type\TypeCommandeController;

$name = Str::plural('type-commande');

Route::prefix($name)
    ->name("{$name}.")
    ->middleware(['auth:api'])
    ->controller(TypeCommandeController::class)->group(function () {

    });
