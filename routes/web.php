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

Route::get('/', 'DashboardController@index')->name('/');

Auth::routes();

Route::resource('boxes','BoxesController');
Route::get('inboundbox','BoxesController@inbound')->name('boxes.inboundbox');
Route::post('inboundboxes','BoxesController@inboundboxes')->name('boxes.inboundboxes');
Route::get('outboundbox','BoxesController@outbound')->name('boxes.outboundbox');
Route::post('outboundboxes','BoxesController@outboundboxes')->name('boxes.outboundboxes');

<<<<<<< HEAD
Route::get('deletebox','BoxesController@delete')->name('boxes.delete');

Route::resource('tag','TagController',['except' => [
		'update','edit'
	]]);
Route::get('tagdelete','TagController@delete')->name('tag.delete');

Route::resource('asset','AssetController',['except' => [
		'update','destroy','edit'
	]]);

Route::resource('employee','EmployeesController');
Route::get('deletemployee','EmployeesController@delete')->name('employee.delete');
=======
Route::post('api/v1/store/entrancegate','APIController@entrancegate');
Route::post('api/v1/store/exitgate','APIController@exitgate');
Route::post('api/v1/store/position','APIController@position');
>>>>>>> master
