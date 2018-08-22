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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Auth::routes();

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
Route::get('get/contact/{contactcode}', 'ContactController@getContact');


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
// 进仓状态
Route::get('jincang/status/{jcno}', 'JincangController@status')->name('jincang_status');

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


// 地址列表
Route::any('address', function(){return redirect(route('address_list'));});
Route::any('address/list', 'AddrController@lists')->name('address_list');
// 查看或修改地址
Route::get('address/view/{cata}/{code}', 'AddrController@show')->name('address_view');
Route::post('address/view/{cata}/{code}', 'AddrController@update');
// 添加地址（添加/提交）
Route::get('address/add', 'AddrController@add')->name('address_add');
Route::post('address/add', 'AddrController@create');
// 删除地址
Route::get('address/del/{cata}/{code}', 'AddrController@delete')->name('address_del');

// 目的港列表
Route::any('port', function(){return redirect(route('port_list'));});
Route::any('port/list', 'PortController@lists')->name('port_list');
// 查看或修改目的港
Route::get('port/view/{code}', 'PortController@show')->name('port_view');
Route::post('port/view/{code}', 'PortController@update');
// 添加目的港（添加/提交）
Route::get('port/add', 'PortController@add')->name('port_add');
Route::post('port/add', 'PortController@create');
// 删除目的港
Route::get('port/del/{code}', 'PortController@delete')->name('port_del');

// 客户列表
Route::any('client', function(){return redirect(route('client_list'));});
Route::any('client/list', 'ClientController@lists')->name('client_list');
// 查看或修改客户
Route::get('client/view/{cata}/{code}', 'ClientController@show')->name('client_view');
Route::post('client/view/{cata}/{code}', 'ClientController@update');
// 添加客户（添加/提交）
Route::get('client/add', 'ClientController@add')->name('client_add');
Route::post('client/add', 'ClientController@create');
// 删除客户
Route::get('client/del/{cata}/{code}', 'ClientController@delete')->name('client_del');;

// 销售列表
Route::any('seller', function(){return redirect(route('seller_list'));});
Route::any('seller/list', 'SellerController@lists')->name('seller_list');
// 查看或修改销售
Route::get('seller/view/{code}', 'SellerController@show')->name('seller_view');
Route::post('seller/view/{code}', 'SellerController@update');
// 添加销售（添加/提交）
Route::get('seller/add', 'SellerController@add')->name('seller_add');
Route::post('seller/add', 'SellerController@create');
// 删除销售
Route::get('seller/del/{code}', 'SellerController@delete')->name('seller_del');;

// 用户列表
Route::get('user/list', 'UserController@lists');
// 用户添加
Route::get('user/add', 'UserController@add');
// 用户修改
Route::post('user/edit', 'UserController@edit');
// 用户删除
Route::post('user/del', 'UserController@del');

// 货物追踪首页
Route::get('track','TrackController@index')->name('track_index');
// 航空公司官网货运追踪网址列表
Route::get('track/airline','TrackController@airline')->name('track_airline');
// 本系统内查询货物状态
Route::get('track/status/{mawb}','TrackController@status')->name('track_status');
// 运抵报告及放行信息
Route::get('track/arrival/{mawb}','TrackController@arrival')->name('track_arrival');
// 航班信息
Route::get('track/flight/{mawb}','TrackController@flight')->name('track_flight');

// 统计首页
Route::get('stats','StatsController@index')->name('stats_index');
Route::any('stats/hawb','StatsController@hawbQty')->name('stats_hawb');
Route::get('stats/mawb','StatsController@mawbQty')->name('stats_mawb');

// 企业通讯录
// 联系人列表
Route::any('contact', function(){return redirect(route('contact_list'));});
Route::any('contact/list', 'ContactController@lists')->name('contact_list');
// 查看或修改联系人
Route::get('contact/view/{id}', 'ContactController@show')->name('contact_view');
Route::post('contact/view/{id}', 'ContactController@update');
// 添加联系人（添加/提交）
Route::get('contact/add', 'ContactController@add')->name('contact_add');
Route::post('contact/add', 'ContactController@create');
// 删除联系人
Route::get('contact/del/{id}', 'ContactController@delete')->name('contact_del');
