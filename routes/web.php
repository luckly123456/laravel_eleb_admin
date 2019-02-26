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

//Route::get('/', function () {
//    return view('welcome');
//});

//商品分类
Route::resource('/shopcategories','ShopcategoriesController');
Route::post('/shopcateupload','ShopcategoriesController@upload')->name('shopcateupload');
//商家信息
Route::resource('/users','UserController');

//Route::get('/users/audit','UserController@audit')->name('users.audit');

//商品状态
Route::resource('/shops','ShopController');
Route::post('/shopupload','ShopController@upload')->name('shopupload');
Route::any('/shops/{shop}','ShopController@update')->name('shops.update');

//商家审核
Route::get('/audit','UserController@audit')->name('users.audit');
//完成审核
Route::get('/check/{user}','UserController@check')->name('users.check');
Route::get('/reset/{user}','UserController@reset')->name('users.reset');
Route::post('/resetped/{user}','UserController@resetped')->name('users.resetped');


//管理员
Route::resource('/admins','AdminController');
Route::any('/admins/{admin}','AdminController@update')->name('admins.update');
Route::get('/reset/{admin}','AdminController@reset')->name('admins.reset');
Route::post('/resetped/{admin}','AdminController@resetped')->name('admins.resetped');



//管理员注册
Route::get('/sign','LoginController@sign')->name('sign');
Route::post('/sign','LoginController@signin')->name('sign');

//管理员登陆
Route::get('/login','LoginController@login')->name('login');
Route::post('/login','LoginController@store')->name('login');
Route::get('logout','LoginController@destroy')->name('logout');


//菜品分类
Route::resource('/menucategories','MenucategorieController');




Route::post('/upload','MenuController@upload')->name('upload');


//活动
Route::resource('activitys','ActivityController');














