<?php

use App\Http\Controllers\ClicknshipController;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
 //   return view('welcome');
//});
Route::get('/', function () {
    return view('welcome');
})->middleware(['auth.shopify'])->name('home');


Route::group(['middleware' => '\Spatie\HttpLogger\Middlewares\HttpLogger::class'], function () {
    Route::get('/dashboard', 'ClicknshipController@index');
    Route::match(['get', 'post'], '/click-save', ['uses' => 'ClicknshipController@create', 'as' => 'click-save']);
    Route::match(['get', 'post'], '/carrier', ['uses' => 'CarrierController@store', 'as' => 'carrier']);
    Route::match(['get', 'post'], '/privacy', ['uses' => 'CarrierController@privacy', 'as' => 'privacy']);

    //add more Routes here
});

// Route::get('/save', function () {
//     return view('dashboard.index');
// });
//Route::post('click-save','ClicknshipController@crate')->name('click-save');
//Route::get('/dashboard' ,'ClicknshipController@index');
