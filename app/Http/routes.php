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

Route::get('test', 'Controller@test');
// 分单列表
Route::any('hawb/list', 'HawbController@lists')->name('hawb_list');
// 分单信息（查看/修改）
Route::get('hawb/view/{hawb}', 'HawbController@show')->name('hawb_view');
Route::post('hawb/view/{hawb}', 'HawbController@update');
// 分单输入（输入/提交）
Route::get('hawb/add', 'HawbController@add')->name('hawb_add');
Route::post('hawb/add', 'HawbController@create');
// 分单删除
Route::post('hawb/del', 'HawbController@del');
// 分单打印
Route::get('hawb/print', 'HawbController@print')->name('hawb_print');

// 总单列表
Route::get('mawb/list', 'MawbController@lists')->name('mawb_list');
// 总单信息（查看/修改）
Route::get('mawb/view', 'MawbController@show');
// 总单打印
Route::get('mawb/print', 'MawbController@print');
// 总单输入（输入/提交）
Route::get('mawb/add', 'MawbController@add');
Route::post('mawb/add', 'MawbController@add');
// 总单修改（提交）
Route::post('mawb/edit', 'MawbController@edit');
// 总单删除
Route::post('mawb/del', 'MawbController@del');

// 清单查找(按总单号)
Route::get('manifest', 'ManifestController@search');
// 清单信息
Route::get('manifest/view', 'ManifestController@show');
// 清单打印
Route::get('manifest/print', 'ManifestController@print');

// 货量统计（按日期范围）
Route::get('report/daily', 'ReportController@daily');
// 每月货量（按月份）
Route::get('report/month', 'ReportController@month');
// 货源统计（按货源）
Route::get('report/forward', 'ReportController@forward');

// 客户列表
Route::get('client/list', 'ClientController@lists');
// 客户添加
Route::get('client/add', 'ClientController@add');
// 客户修改
Route::post('client/edit', 'ClientController@edit');
// 客户删除
Route::post('client/del', 'ClientController@del');

// 地址列表
Route::get('address/list', 'AddrController@lists');
// 地址添加
Route::get('address/add', 'AddrController@add');
// 地址修改
Route::post('address/edit', 'AddrController@edit');
// 地址删除
Route::post('address/del', 'AddrController@del');

// 目的港列表
Route::get('port/list', 'PortController@lists');
// 目的港添加
Route::get('port/add', 'PortController@add');
// 目的港修改
Route::post('port/edit', 'PortController@edit');
// 目的港删除
Route::post('port/del', 'PortController@del');

// 用户列表
Route::get('user/list', 'UserController@lists');
// 用户添加
Route::get('user/add', 'UserController@add');
// 用户修改
Route::post('user/edit', 'UserController@edit');
// 用户删除
Route::post('user/del', 'UserController@del');


