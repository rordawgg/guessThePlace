<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/**
 * Main Page
 */
Route::get('/', 'GameController@index');
Route::post('/score', 'GameController@score');
Route::get('/score', function() {
	return redirect('/');
});
Route::post('/score/reset', 'GameController@reset');



/**
 * Admin Page
 */

Route::get('/admin', 'AdminController@index');

Route::get('/admin/edit', 'AdminController@edit');

Route::get('/admin/new', 'AdminController@new');
Route::post('admin/new/store', 'AdminController@store');

Route::get('/admin/image/new', 'AdminController@newImage');
Route::post('/admin/image/new/store', 'AdminController@storeImage');
