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

use App\Http\Resources\Carrier;
use App\User;

Route::post('/user', function () {
    return Carrier::collection([]);
});


Route::middleware(['first', 'second'])->group(function () {
    Route::get('/', function () {
        // Uses first & second middleware...
    });

    Route::get('user/profile', function () {
        // Uses first & second middleware...
    });
});

// Route::get('/save', function () {
//     return view('dashboard.index');
// });
//Route::post('click-save','ClicknshipController@crate')->name('click-save');

Route::match(['get', 'post'], '/click-save', ['uses' => 'ClicknshipController@create', 'as' => 'click-save']);