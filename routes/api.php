<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

$modulePath = base_path('Modules');
$modules = array_filter(glob($modulePath . '/*'), 'is_dir');

foreach ($modules as $module) {
    $moduleRoutesPath = "{$module}/routes/api.php";

    if (file_exists($moduleRoutesPath)) {
        Route::prefix('v1')->group($moduleRoutesPath);
    }
}
