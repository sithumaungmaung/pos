	<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/home', ['uses' => 'GroupController@addgroup']); 

/*
	
*/

Route::get('/users/login', [
	'as' => 'users.login', 
	'uses' => 'UserController@login'
	]);

Route::get('users/logout', [
	'as' => 'users.logout', 
	'uses' => 'UserController@logout'
	]);

Route::resource('users', 'UserController');
Route::resource('sales', 'SalesController');
Route::resource('units','UnitsController');
Route::resource('categories','CategoriesController');
Route::resource('stocks','StocksController');

Route::get('products/testing', [
	'as' => 'products.testing', 
	'uses' => 'ProductsController@testing'
	]);

Route::get('products/search', [
	'as' => 'products.search', 
	'uses' => 'ProductsController@search'
	]);

Route::resource('products','ProductsController');


Route::get('/login', [
	'as' => 'login', 
	'uses' => 'UserController@login'
	]);

Route::get('users/search', [
	'as' => 'users.search', 
	'uses' => 'UserController@search'
	]);

Route::post('users/login', [
	'as' => 'users.postlogin', 
	'uses' => 'AuthController@login'
	]);


Route::get('users/create', [
	'as' => 'users.create',
	'uses' => 'UserController@create'
	]);

Route::post('users/store', [
	'as' => 'users.store',
	'uses' => 'UserController@store'
	]);

// Route::group(['prefix' => 'users'], function(){

// 	Route::get('/login',[
// 		'as' => 'users',
// 		'uses' => 'UserController@login'
// 		]);

// });

Route::get('sales/create',[
	'as' => 'sales.create',
	'uses' => 'SalesController@create'
	]);

Route::get('sales/search',[
	'as' => 'sales.search',
	'uses' => 'SalesController@search'
	]);