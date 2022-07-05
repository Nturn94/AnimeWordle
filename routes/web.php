<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Models\Anime;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//For showing an image
Route::get('/',[ImageController::class,'viewImage'])->name('images.view');

Route::get('/autocomplete',[ImageController::class,'Autocomplete'])->name('autocomplete');

Route::get('/scrape',[ImageController::class,'Scrape'])->name('scrape.view');

Route::post('/store-comment',[ImageController::class,'Postanimezz'])->name('anime.store');

Route::post('/guess-answer',[ImageController::class,'Guess'])->name('anime.guess');

// URL::forceScheme('https');
