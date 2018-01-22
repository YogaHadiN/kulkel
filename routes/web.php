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

Route::get('/', 'WelcomeController@index');
Route::get('about', 'WelcomeController@about');
Route::get('beritas', 'WelcomeController@events');
Route::get('beritas/{id}', 'WelcomeController@show');

Auth::routes();

Route::get('logout', 'Auth\LoginController@logout')->name('logout' );
Route::group(['middleware' => 'auth'], function () {
	Route::get('home', 'HomeController@index');
	Route::get('/library/view', 'LibraryController@view');
	Route::group(['middleware' => 'adminOnly'], function () {
		Route::get('library/pinjam/{id}', 'LibraryController@pinjam');
		Route::get('library/kembalikan/{id}', 'LibraryController@kembalikan');
		Route::put('library/kembalikan/{id}', 'LibraryController@kembalikanBuku');
		Route::post('library/pinjam', 'LibraryController@pinjamBuku');
	});
	Route::resource('library', 'LibraryController');
	Route::resource('gardenias', 'GardeniasController');
	Route::resource('events', 'EventsController');
	Route::resource('rsnds', 'RsndsController');
	Route::resource('ujians', 'UjiansController');
	Route::resource('pegangans/staf', 'StafPegangansController');
	Route::resource('pegangans/residen', 'ResidenPegangansController');
	Route::resource('stases', 'StasesController');
	Route::resource('polis', 'PolisController');
	Route::resource('pembacaans', 'PembacaansController');
	Route::resource('users', 'UsersController');
	Route::resource('dosens', 'DosensController');
	Route::resource('residens', 'ResidensController');
	Route::get('karyawans', 'KaryawansController@index');
	Route::post('library/import', 'LibraryController@import');
});

Auth::routes();
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
