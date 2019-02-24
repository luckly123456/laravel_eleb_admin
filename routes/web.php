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

//商家信息
Route::resource('/users','UserController');
Route::get('/users/audit','UserController@audit')->name('users.audit');

//商品状态
Route::resource('/shops','ShopController');
Route::any('/shops/{shop}','ShopController@update')->name('shops.update');

//管理员
Route::resource('/admins','AdminController');
Route::any('/admins/{admin}','AdminController@update')->name('admins.update');



//管理员注册
Route::get('/sign','LoginController@sign')->name('sign');
Route::post('/sign','LoginController@signin')->name('sign');

//管理员登陆
Route::get('/login','LoginController@login')->name('login');
Route::post('/login','LoginController@store')->name('login');