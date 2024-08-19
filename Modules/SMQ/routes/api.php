<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

$routeGroups = [

];

foreach ($routeGroups as $group) {
    Route::group([], __DIR__.'/'.$group.'.php');
}
