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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/laptops', 'LaptopPageController')->name('laptops');
Route::get('/smartphones', 'SmartphonePageController')->name('smartphones');
Route::get('/televisions', 'TelevisionPageController')->name('televisions');

Route::get('/{category}/{id}', 'ProductController')->name('product');

Route::post('/{category}/{id}/comment', 'ProductController@comment')->name('comment');

Route::middleware(['auth'])->group(function () {
    Route::get('/{category}/{id}/order', 'OrderController')->name('order');
    Route::post('/{category}/{id}/order', 'OrderController@handle')->name('order');
});