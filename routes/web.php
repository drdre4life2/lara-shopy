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
    Route::match(['get', 'post'], '/customers/redact', ['uses' => 'CarrierController@customerRedact', 'as' => 'redact']);
    Route::match(['get', 'post'], 'shop/redact', ['uses' => 'CarrierController@shopRedact', 'as' => 'shop/redact']);
    Route::match(['get', 'post'], 'customers/data_request', ['uses' => 'CarrierController@dataRequest', 'as' => 'data_request']);
    Route::match(['get', 'post'],'confirm',['uses' => 'ClicknshipController@confirm', 'as' => 'confirm' ] );

    //add more Routes here
});

// Route::get('/save', function () {
//     return view('dashboard.index');
// });
//Route::post('click-save','ClicknshipController@crate')->name('click-save');
//Route::get('/dashboard' ,'ClicknshipController@index');
