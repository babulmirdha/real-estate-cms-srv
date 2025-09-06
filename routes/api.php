
<?php

use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;


Route::get('/health', fn () => ['status' => 'ok']);
Route::apiResource('projects', ProjectController::class);
