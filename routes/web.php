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

//商家分类
Route::resource('/shopcategories','ShopcategoriesController');
//Route::patch('shopcategories/{shopcategorie}','ShopcategoriesController@update')->name('shopcategories.update');
Route::post('/shopcateupload','ShopcategoriesController@upload')->name('shopcateupload');
//商家
Route::resource('/users','UserController');

//商家信息
Route::resource('/shops','ShopController');
Route::post('/shopupload','ShopController@upload')->name('shopupload');

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

Route::get('/signindex','LoginController@sign')->name('sign.index');

Route::post('/sign','LoginController@signin')->name('sign');

//管理员登陆
Route::get('/login','LoginController@login')->name('login');
Route::post('/login','LoginController@store')->name('login');
Route::get('logout','LoginController@destroy')->name('logout');


//菜品分类
Route::resource('/menucategories','MenucategorieController');
Route::resource('/menus','MenuController');




//Route::post('/upload','MenuController@upload')->name('upload');


//活动
Route::resource('activitys','ActivityController');

//会员管理
Route::resource('members','MemberController');
Route::get('/members/status/{member}','MemberController@status')->name('members.status');



//RBAC
Route::get('rbac/roles','RbacController@roles')->name('roles.index');
Route::get('rbac/roles/create','RbacController@rcreate')->name('roles.create');
Route::post('rbac/roles/store','RbacController@sroles')->name('roles.store');
Route::get('rbac/roles/{role}/edit','RbacController@eroles')->name('roles.edit');
Route::patch('rbac/roles/{role}/update','RbacController@uroles')->name('roles.update');
Route::post('rbac/roles/{role}/destroy','RbacController@droles')->name('roles.destroy');

Route::get('/rbac/permissions','RbacController@permission')->name('permissions.index');
Route::get('/rbac/permissions/create','RbacController@pcreate')->name('permissions.create');
Route::post('/rbac/permissions/store','RbacController@pstore')->name('permissions.store');
Route::get('/rbac/permissions/{permission}/edit','RbacController@editpermission')->name('permissions.edit');
Route::patch('/rbac/permissions/{permission}/update','RbacController@upermission')->name('permissions.update');
Route::delete('/rbac/permissions/{permission}', 'RbacController@dpermission')->name('permissions.destroy');




//菜单
Route::get('/navs','NavController@index')->name('navs.index');
Route::get('/navs/create','NavController@create')->name('navs.create');
Route::post('/navs','NavController@store')->name('navs.store');
Route::get('/navs/{nav}/edit','NavController@edit')->name('navs.edit');
Route::patch('/navs/{nav}','NavController@update')->name('navs.update');

Route::delete('/navs/{nav}','NavController@destroy')->name('navs.destroy');



Route::get('/aaaa','NavController@aaaa')->name('navs.aaaa');


//活动页面
Route::resource('/events','EventController');
Route::get('/eventpc/{event}','EventController@eventpc')->name('events.eventpc');
Route::patch('/eventprize/{event}','EventController@createprize')->name('events.prize');
//开奖
Route::get('/kprize/{event}','EventController@kprize')->name('events.kprize');
//报名人数
Route::get('/events.mans/{event}','EventController@mans')->name('events.mans');

Route::get('/events.mans/{event}','EventController@mans')->name('events.mans');



//Route::resource('/events/status/{event}','EventController@status')->name('events.status');










//发邮箱
//Route::get('/mail',function (){
//    $title = '喜欢就是喜欢';
//    $content = '<p>
//重要的邮件如何才能让<span style="color: red">对方立刻查看</span>！
//随身邮，可以让您享受随时短信提醒和发送邮件可以短信通知收件人的服务，重要的邮件一个都不能少！</p>';
//    try{
//        $flag = \Illuminate\Support\Facades\Mail::send('email.default',compact('title','content'),
//            function ($message){
//                $to = '18728407510@163.com';
//                $message->from(env('MAIL_USERNAME'))->to($to)->subject('今晚十点,不见不散');
//            });
//    }catch (Exception $e){
//        return '邮件发送失败';
//    }
//
//});


Route::get('/mail',function(){
    $title = '全新体验，手机也能玩转网易邮箱2.0';
    $content = '<p>	重要的邮件如何才能让对方立刻查看随身邮，可以让您享受随时短信提醒和发送邮件可以短信通知收件人的服务，重要的邮件一个都不能少！</p>';
    try{
        \Illuminate\Support\Facades\Mail::send('email.default',compact('title','content'),
            function($message){
                $to = '1607384710@qq.com';
                $message->from(env('MAIL_USERNAME'))->to($to)->subject('阿里云数据库10月刊:Redis2发布');
            });
    }catch (Exception $e){
        return '邮件发送失败';
    }

});































