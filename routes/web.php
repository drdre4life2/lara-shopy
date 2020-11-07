<?php

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




// Route::get('/save', function () {
//     return view('dashboard.index');
// });
//Route::post('click-save','ClicknshipController@crate')->name('click-save');

Route::match(['get', 'post'], '/click-save', ['uses' => 'ClicknshipController@create', 'as' => 'click-save']);