<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh-token', [AuthController::class, 'refresh']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::apiResource('project', ProjectController::class);
    Route::apiResource('tag', TagController::class);
    Route::apiResource('experience', ExperienceController::class);
    Route::apiResource('education', EducationController::class);
    Route::apiResource('certification', CertificationController::class);
    Route::apiResource('contact', ContactController::class);
    Route::apiResource('skill', SkillController::class);
});