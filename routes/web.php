<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\ChapterController;

Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
Route::view('/dashboard', 'dashboard')->middleware('auth')->name('dashboard');
Route::middleware('auth.token')->get('/stories', function () {return view('stories.index');});
Route::middleware('auth.token')->get('/stories-auther', function () {return view('auther.index');});
Route::middleware('auth.token')->post('/stories', [StoryController::class, 'store']);
Route::middleware('auth.token')->get('/story/create/',function () {return view('stories.create');})->name('story.create');
Route::middleware('auth.token')->get('/story/{id}/chapters', [ChapterController::class, 'showChapters']);
Route::middleware('auth.token')->get('/story/chapters/edit/{id}', [ChapterController::class, 'edit'])->name('chapters.edit');
Route::middleware('auth.token')->get('/story/{storyId}/create-chapter', [ChapterController::class, 'showChapterForm'])->name('story.create-chapter');
Route::middleware('auth.token')->get('/leaderboard', function () {return view('leaderboard.index');});


Route::get('/most-writer', function () {
    return view('leaderboard.home');
});

///////////////////////////
Route::get('/', function () {
    return view('stories.stories');
});
