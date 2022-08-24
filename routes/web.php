<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Models\Anime;

Route::get('/',[ImageController::class,'gameView'])->name('game.view');

Route::get('/autocomplete',[ImageController::class,'Autocomplete'])->name('game.autocomplete');

Route::get('/scrape',[ImageController::class,'Scrape'])->name('scrape.view');

Route::post('/store-comment',[ImageController::class,'Postanime'])->name('scrape.create');

Route::post('/guess-answer',[ImageController::class,'Guess'])->name('game.guess');

// URL::forceScheme('https');
