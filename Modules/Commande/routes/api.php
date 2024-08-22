<?php

use Illuminate\Support\Facades\Route;

$routeGroups = [
    "Type/TypeCommande",

];
foreach ($routeGroups as $group) {
    Route::group([], __DIR__.'/'.$group.'.php');
}
