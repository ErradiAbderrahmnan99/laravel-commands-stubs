<?php

use Illuminate\Support\Facades\Route;

$routeGroups = [
    "Nature/Nature",
];
foreach ($routeGroups as $group) {
    Route::group([], __DIR__.'/'.$group.'.php');
}
