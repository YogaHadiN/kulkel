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
Route::get('tools', 'ToolsController@index');
Route::post('tools/sms_bulanan', 'ToolsController@smsBulanan');
Route::post('tools/sms_harian', 'ToolsController@smsHarian');
Route::post('tools/email_tundaan_ujian', 'ToolsController@EmailTundaanUjian');
Route::get('beritas', 'WelcomeController@events');
Route::get('beritas/{id}', 'WelcomeController@show');
Route::get('library/{token}/konfirmasi', 'LibraryController@konfirmasi');
Route::get('welcome/seminars', 'SeminarsController@welcome');
Route::get('welcome/seminars/{id}', 'SeminarsController@welcomeShow');
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logout' );
Route::group(['middleware' => 'auth'], function () {
	Route::get('qrcode', 'QrCodeController@index');
	Route::get('topiks/create/{id}', 'TopiksController@createTopik');
	Route::resource('topiks', 'TopiksController');
	Route::get('emails', 'EmailController@index');
	Route::post('emails', 'EmailController@postMail');
	Route::resource('email', 'EmailController');
	Route::resource('ebooks', 'EbooksController');
	Route::resource('videos', 'VideosController');
	Route::resource('jenis_stases', 'JenisStasesController');
 
	Route::get('users/{id}/riwayat_peminjaman', 'UsersController@perpus');
	Route::get('users/{user_id}/pembacaans/{pembacaan_id}/edit', 'UsersController@edit_pembacaan');
	Route::get('users/{user_id}/pembacaans/create', 'UsersController@create_pembacaan');
	Route::get('users/{user_id}/ujians/{ujian_id}/edit', 'UsersController@edit_ujian');
	Route::get('users/{user_id}/create/ujians', 'UsersController@create_ujian');
	Route::get('users/{user_id}/stase/{stase_id}/edit', 'UsersController@stase_edit');
	Route::get('users/{user_id}/stase/create', 'UsersController@stase_create');
	Route::get('users/{user_id}/stase/{$stase_id}', 'UsersController@stase_create');
	Route::get('users/{id}/image', 'UsersController@image');
	Route::post('users/{id}/upload', 'UsersController@uploadImage');
	Route::get('home', 'HomeController@index');
	Route::get('/library/view', 'LibraryController@view');
	Route::get('seminars', 'SeminarsController@index');
	Route::get('seminars/{id}', 'SeminarsController@show');
	Route::group(['middleware' => 'adminOnly'], function () {
		Route::get('library/pinjam/{id}', 'LibraryController@pinjam');
		Route::get('library/kembalikan/{id}', 'LibraryController@kembalikan');
		Route::put('library/kembalikan/{id}', 'LibraryController@kembalikanBuku');
		Route::post('library/pinjam', 'LibraryController@pinjamBuku');
		Route::get('library/riwayatPeminjaman', 'LibraryController@riwayatPeminjaman');
	});

	Route::resource('seminars', 'SeminarsController');
	Route::resource('library', 'LibraryController');
	Route::resource('gardenias', 'GardeniasController');
	Route::resource('events', 'EventsController');
	Route::resource('rsnds', 'RsndsController');
	Route::get('ujians/getPenguji', 'UjiansController@getPenguji');
	Route::resource('ujians', 'UjiansController');
	Route::resource('pegangans/staf', 'StafPegangansController');
	Route::resource('pegangans/residen', 'ResidenPegangansController');
	Route::get('stases/getMonth', 'StasesController@getMonth');
	Route::resource('stases', 'StasesController');
	Route::resource('polis', 'PolisController');
	Route::resource('sub_bagians', 'SubBagiansController');
	Route::get('polis/ajax/get/jaga', 'PolisController@getPoliJaga');
	Route::resource('pembacaans', 'PembacaansController');
	Route::resource('users', 'UsersController');
	Route::post('users/ajax', 'UsersController@ajaxUpdateStase');
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
