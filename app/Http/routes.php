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

Route::get('/', function () {

    return redirect('iniciar-sesion');
});
Route::resource('principal','PrincipalController');

Route::resource('actionplan','ActionplanController');

Route::resource('mccr','MccrController');

Route::resource('reporte','OutputController');
Route::resource('fpy','FpyController');

Route::resource('dwcr','DwcrController');

Route::resource('jidoka','JidokaController');

Route::resource('lineas/admin','LineasController');

Route::resource('partes/admin','PartesController');

Route::resource('downtime','DowntimeController');

Route::resource('oee','OEEController');

Route::resource('charts/fpy','FpyController');
Route::resource('excel','ExcelController'); //Controla todo lo relacionado con el uso de excel.

Route::post('admin-login',[
	'uses'=>'Auth_smb@LoginAdmin',
	'as'=>'adminlogin']);

Route::post('reset-jidoka',[
	'uses'=>'JidokaController@reset',
	'as'=>'reset']);
Route::post('refresh',[
	'uses'=>'JidokaController@postRefresh',
	'as'=>'refresh']);
Route::post('post-comments',[
	'uses'=>'OutputController@UpdateComments',
	'as'=>'updatecomments']);

Route::post('update-production',[
	'uses'=>'OutputController@UpdateProduction',
	'as'=>'updateproduction']);

Route::post('post-fails',[
	'uses'=>'OutputController@UpdateFails',
	'as'=>'updatefails']);

// Authentication routes...
Route::get('iniciar-sesion', [
	'uses'=>'Auth_smb@getLogin',
	'as'=>'login']);

Route::post('iniciar-sesion', [
	'uses'=>'Auth_smb@postLogin',
	'as'=>'getin']);

Route::get('cerrar-sesion', [
	'uses'=>'Auth\AuthController@getLogout',
	'as'=>'logout']);
      
// Registration routes...
Route::get('register', [
	'uses'=>'Auth_smb@getRegister',
	'as'=>'register']);
Route::post('register', 'Auth_smb@postRegister');

Route::get('fpyView',[
	'uses'=>'FpyController@indexView',
	'as'=>'fpyView']);

/*ROUTE: To get the andon' status to change the color in the tv.*/
Route::get('getAndon',[
	'uses'=>'LineasController@getAndon',
	'as'=>'getAndon'
	]);


/*ROUTE: To get the shift en show it in TV*/
Route::get('getTurno',[
	'uses' => 'TurnoController@getTurno',
	'as' => 'getTurno'
	]);
