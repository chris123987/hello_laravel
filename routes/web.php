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

Route::get('/','Test\StaticPagesController@home')->name('home');
Route::get('/help','Test\StaticPagesController@help')->name('help');

Route::get('/signup','Test\UserController@create')->name('signup');


