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
Route::get('general/switch-language/{lang}', 'GeneralController@switchLanguage');

Route::get('/', 'HomeController@index');
Route::get('/product/list/{category_id}', 'ProductController@getProductsByClass');
Route::resource('/about-us', 'AboutUsController');
Route::get('/cart/view', 'CartController@view');
Route::resource('/cart', 'CartController');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
