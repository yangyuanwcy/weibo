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
//主页，帮助页、关于页
Route::get('/','StaticPagesController@home')->name('home');
Route::get('help','StaticPagesController@help')->name('help');
Route::get('about','StaticPagesController@about')->name('about');
//用户注册
Route::get('signup','UsersController@create')->name('signup');
Route::resource('users','UsersController');
//用户登录、登出
Route::get('login','SessionsController@create')->name('login');
Route::post('login','SessionsController@store')->name('login');
Route::delete('logout','SessionsController@destroy')->name('logout');
//用户激活
Route::get('signup/confirm/{token}','UsersController@confirmEmail')->name('confirm_email');
//用户密码重置
Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset','Auth\ResetPasswordController@reset')->name('password.update');

//微博
Route::resource('statuses','StatusesController',['only'=>['store','destroy']]);