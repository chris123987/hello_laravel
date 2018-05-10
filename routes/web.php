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
//    return view('/static_pages/home');
//});
//首页
Route::get('/','Test\StaticPagesController@home')->name('home');
Route::get('/help','Test\StaticPagesController@help')->name('help');
//注册页面
Route::get('/signup','Test\UserController@create')->name('signup');
//处理注册提交的页面并跳转
//Route::resource('users','Test\UserController');
Route::get('/users/{user}','Test\UserController@show')->name('users.show');
Route::any('/store','Test\UserController@store')->name('store');

//登录-退出
Route::get('login','Test\SessionController@create')->name('login');
Route::post('login','Test\SessionController@store')->name('login');
Route::delete('logout','Test\SessionController@destroy')->name('logout');

//编辑表单
Route::get('/users/{user}/edit','Test\UserController@edit')->name('users.edit');
Route::any('/update/{user}','Test\UserController@update')->name('users.update');

//用户列表
Route::get('/index','Test\UserController@index')->name('users.index');

Route::delete('/destroy/{user}','Test\UserController@destroy')->name('users.destroy');

//邮件验证
Route::get('signup/confirm/{token}', 'Test\UserController@confirmEmail')->name('confirm_email');

