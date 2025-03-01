<?php

use App\Http\Controllers\CertificationController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::apiResource('project', ProjectController::class);
Route::apiResource('tag', TagController::class);
Route::apiResource('experience', ExperienceController::class);
Route::apiResource('education', EducationController::class);
Route::apiResource('certification', CertificationController::class);
