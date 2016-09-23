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
    return view('welcome');
});

Route::get('hawb', 'HawbController@list');
Route::get('hawb/show', 'HawbController@show');
Route::get('hawb/print', 'HawbController@print');
Route::post('hawb/add', 'HawbController@add');
Route::post('hawb/edit', 'HawbController@edit');
Route::post('hawb/del', 'HawbController@del');

Route::get('mawb', 'MawbController@list');
Route::get('mawb/show', 'MawbController@show');
Route::get('mawb/print', 'MawbController@print');
Route::post('mawb/add', 'MawbController@add');
Route::post('mawb/edit', 'MawbController@edit');
Route::post('mawb/del', 'MawbController@del');

Route::get('manifest', 'ManifestController@search');
Route::get('manifest/show', 'ManifestController@show');
Route::get('manifest/print', 'ManifestController@print');

Route::get('report/daily', 'ReportController@daily');
Route::get('report/month', 'ReportController@month');
Route::get('report/forward', 'ReportController@forward');

Route::get('client', 'ClientController@forward');
Route::get('address', 'AddressController@forward');
Route::get('port', 'PortController@forward');

Route::get('setting', 'ReportController@forward');
