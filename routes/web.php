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
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/showProductions', 'ProductController@index')->name('index');
Route::get('/productions', 'ProductController@get');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('management/product', 'ManagementController');

    Route::get('/management/showOwnProducts', 'ManagementController@showOwnProducts');
});
