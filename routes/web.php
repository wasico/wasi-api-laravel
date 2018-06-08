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

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('propiedades',
	[
		'as'   => 'properties-list',
		'uses' => 'PropertiesController@getProperties'
	]);

Route::get('propiedades/propiedad/{prop_id}',
	[
		'as'   => 'property-detail',
		'uses' => 'PropertiesController@getProperty'
	]);
Route::post('cliente/contacto',
	[
		'as'   => 'send-contact-form',
		'uses' => 'CustomerController@contactRealtor'
	]);
Route::get('nuestra-empresa',
	[
		'as'   => 'about-us',
		'uses' => 'AgencyController@aboutUs'
	]);
Route::get('contacto',
	[
		'as'   => 'contact-us',
		'uses' => 'AgencyController@contactUs'
	]);