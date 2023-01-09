<?php

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

/* Route::get('/', function () {
    return view('welcome');
}); */

use App\Http\Controllers\FkkoController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ParseController;
use App\Services\Comparator\ComparatorService;
//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/search', [MainController::class, 'search'])->name('search');
Route::get('/fkko', [FkkoController::class, 'show'])->name('showFkkoTable');

Route::post('/upload', [FileUploadController::class, 'uploadFile'])->name('upload');
Route::post('/uploadFkko', [FileUploadController::class, 'uploadFile'])->name('uploadFkko');

//Route::post('/parse', [ParseController::class, 'parse'])->name('parse');

Route::post('/compare', [ComparatorService::class, 'compareDocumentsByColumn'])->name('compare');

Route::get('/about222', function () {
	return 'About page 222222222';
});

Route::get('/bla', function () {
	return 'bla';
});

