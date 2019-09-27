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

Route::get('/', "HomeController@index");

Route::get("/hack/{id}", function($id){
    auth()->loginUsingId($id);
    return redirect('/');
});

Route::get("/form/search", function(){
    return view("search");
});


Auth::routes();



Route::get('/products', 'ProductController@index')->middleware('auth');
Route::get('/products/create', 'ProductController@create')->middleware('auth');
Route::post('/products', 'ProductController@store')->middleware('auth');
Route::get('/products/{product}', 'ProductController@show');
Route::get('/products/{product}/edit', 'ProductController@edit')->middleware('auth');
Route::put('/products/{product}/update', 'ProductController@update')->middleware('auth');
Route::delete('/products/{product}/delete', 'ProductController@destroy')->middleware('auth');
Route::get('/search/products', 'ProductController@search');

Route::post('/comments/{id}', 'CommentController@store');
