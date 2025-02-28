<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::apiResource('project', ProjectController::class);
Route::apiResource('tag', TagController::class);
