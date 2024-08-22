<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Modules\Commande\Controllers\Type\TypeCommandeController;

$name = Str::plural('typeCommande');

Route::prefix($name)
    ->name("{$name}.")
    ->controller(TypeCommandeController::class)->group(function () {
        Route::get(uri: '/', action: 'index')->name("typeCommande.index");
    });
