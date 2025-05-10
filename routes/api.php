<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTypeController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\UserController;
use App\Models\Project;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::resource('project', ProjectController::class)->only(['index', 'show']);
Route::resource('tag', TagController::class)->only(['index', 'show']);
Route::resource('experience', ExperienceController::class)->only(['index', 'show']);
Route::resource('education', EducationController::class)->only(['index', 'show']);
Route::resource('certification', CertificationController::class)->only(['index', 'show']);
Route::resource('contact', ContactController::class)->only(['index', 'show']);
Route::resource('skill', SkillController::class)->only(['index', 'show']);
Route::resource('project_type', ProjectTypeController::class)->only(['index', 'show']);
Route::resource('technology', TechnologyController::class)->only(['index', 'show']);

Route::get('test', function() {
    return response()->json(Project::factory()->makeOne());
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh-token', [AuthController::class, 'refresh']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::apiResource('project', ProjectController::class)->except(['index', 'show']);
    Route::get('project/{id}/tags', [ProjectController::class, 'tags']);
    Route::apiResource('tag', TagController::class)->except(['index', 'show']);
    Route::get('tag/{tag}/projects', [TagController::class, 'projects']);
    Route::apiResource('experience', ExperienceController::class)->except(['index', 'show']);
    Route::apiResource('education', EducationController::class)->except(['index', 'show']);
    Route::apiResource('certification', CertificationController::class)->except(['index', 'show']);
    Route::apiResource('contact', ContactController::class)->except(['index', 'show']);
    Route::apiResource('skill', SkillController::class)->except(['index', 'show']);
    Route::apiResource('project_type', ProjectTypeController::class)->except(['index', 'show']);
    Route::apiResource('technology', TechnologyController::class)->except(['index', 'show']);
    Route::apiResource('user', UserController::class)->except(['store']);
});