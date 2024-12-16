<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
use App\Http\Controllers\StoryController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ContributionController;

Route::post('/stories', [StoryController::class, 'store']);
Route::get('/stories', [StoryController::class, 'index']);


Route::middleware('auth:sanctum')->post('/stories/{storyId}/chapters', [ChapterController::class, 'store']);

Route::middleware('auth:sanctum')->get('/leaderboard', [ContributionController::class, 'index']);


Route::patch('/story/status/{id}', [StoryController::class, 'updateStatus']);
Route::middleware('auth:sanctum')->patch('/chapters/{id}', [ChapterController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/chapters/{id}', [ChapterController::class, 'destroy']);
// routes/api.php
Route::middleware('auth:sanctum')->delete('/chapters/{id}', [ChapterController::class, 'destroy']);


Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user']);
