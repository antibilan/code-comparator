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

use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\FkkoController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ParseController;
use App\Services\Comparator\ComparatorService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', [MainController::class, 'index'])->middleware('auth')->name('home');

Route::get ('/login', function() {
    if(Auth::check()) {
        return redirect(
                route('home',
                ['authUsername' => Auth::user()->email]
            )
        );
    }return view('login');
})->name('login');

Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::get('/logout', function(){
    Auth::logout();
    return redirect(route('home'));
})->name('logout');

Route::get('/registration', function(){
    if(Auth::check()){
        return redirect(route('home'));
    }
    return view('registration');
})->name('registration');

Route::post('/registration', [\App\Http\Controllers\Auth\RegisterController::class, 'store']);

Route::get('/search', [MainController::class, 'search'])->name('search');

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

#FKKO
Route::get('/fkko', function(){
   dd( App\Fkko::find(1) );
});
Route::get('/fkko/createEntry', [FkkoController::class, 'create'])->name('createFkkoEntry');
Route::get('/fkko/fill', function(){
    $file = storage_path().'\app\public\uploads\fkko.htm';
    $parsedDocument = (new App\Services\Parser\ParserService)->parseFile($file);    
    (new FkkoController)->fill($parsedDocument);
})->name('fillFkko');
Route::get('/fkko/truncate', [FkkoController::class, 'truncate'])->name('truncateFkko');
