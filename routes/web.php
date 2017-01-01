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

// AJAX获取数据库数据填入表单
Route::get('get/dest/{dest}', 'PortController@getPort');
Route::get('get/forward/{forwardcode}', 'ClientController@getForward');
Route::get('get/factory/{factorycode}', 'ClientController@getFactory');
Route::get('get/carrier/{carrier}', 'ClientController@getCarrierName');
Route::get('get/seller/{forward}', 'SellerController@getSeller');
Route::get('get/hshipper/{shippercode}', 'AddrController@getHShipper');
Route::get('get/hconsignee/{consigneecode}', 'AddrController@getHConsignee');
Route::get('get/hnotify/{notifycode}', 'AddrController@getHNotify');
Route::get('get/mconsignee/{oversea}', 'AddrController@getMConsignee');


// 进仓列表
Route::any('jincang', function(){return redirect(route('jincang_list'));});
Route::any('jincang/list', 'JincangController@lists')->name('jincang_list');
// 进仓信息（查看/修改）
Route::get('jincang/view/{jcno}', 'JincangController@show')->name('jincang_view');
Route::post('jincang/view/{jcno}', 'JincangController@update');
// 进仓输入（输入/提交）
Route::get('jincang/add', 'JincangController@add')->name('jincang_add');
Route::post('jincang/add', 'JincangController@create');
// 进仓删除
Route::get('jincang/del/{jcno}', 'JincangController@delete')->name('jincang_del');

// 分单列表
Route::any('hawb', function(){return redirect(route('hawb_list'));});
Route::any('hawb/list', 'HawbController@lists')->name('hawb_list');
// 分单信息（查看/修改）
Route::get('hawb/view/{hawb}', 'HawbController@show')->name('hawb_view');
Route::post('hawb/view/{hawb}', 'HawbController@update');
// 分单输入（输入/提交）
Route::get('hawb/add', 'HawbController@add')->name('hawb_add');
Route::post('hawb/add', 'HawbController@create');
// 分单删除
Route::get('hawb/del/{hawb}', 'HawbController@delete')->name('hawb_del');
// 分单打印
Route::get('hawb/print/{hawb}', 'HawbController@hawbPrint')->name('hawb_print');
Route::post('hawb/print/{hawb}', 'HawbController@hawbSavePrint');

// 总单列表
Route::any('mawb', function(){return redirect(route('mawb_list'));});
Route::any('mawb/list', 'MawbController@lists')->name('mawb_list');
// 总单打印
Route::get('mawb/print/{mawb}', 'MawbController@mawbPrint')->name('mawb_print');
Route::post('mawb/print/{mawb}', 'MawbController@mawbSavePrint');
// 总单删除
Route::get('mawb/del/{mawb}', 'MawbController@delete')->name('mawb_del');

// 清单查找(按总单号)
Route::get('manifest', 'ManifestController@search');
// 清单信息
Route::get('manifest/view/{mawb}', 'ManifestController@show')->name('manifest');
// 导出清单
Route::get('manifest/export/{mawb}', 'ManifestController@export')->name('manifest_export');

// 打印单证
Route::get('print/hawb/{hawb}', 'PrintController@printHawb')->name('print_hawb');
Route::get('print/mawb/{mawb}', 'PrintController@printMawb')->name('print_mawb');

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
Route::any('address', function(){return redirect(route('address_list'));});
Route::any('address/list', 'AddrController@lists')->name('address_list');
// 查看或修改地址
Route::get('address/view/{code}', 'AddrController@show')->name('address_view');
Route::post('address/view/{code}', 'AddrController@update');
// 添加地址（添加/提交）
Route::get('address/add', 'AddrController@add')->name('address_add');
Route::post('address/add', 'AddrController@create');
// 删除地址
Route::get('address/del/{code}', 'AddrController@delete')->name('address_del');


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



Auth::routes();

Route::get('/home', 'HomeController@index');
