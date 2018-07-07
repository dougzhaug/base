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

Route::domain('admin.witschool.test')->group(function () {
    Route::get('/', 'Admin\IndexController@index')->name('admin');

    //登陆
    Route::get('login', 'Admin\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Admin\LoginController@login');

    //注册
    Route::get('register', 'Admin\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Admin\RegisterController@register');

    //找回密码
    Route::get('password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Admin\ResetPasswordController@reset');

    //登出
    Route::post('logout', 'Admin\LoginController@logout')->name('logout');

    //权限管理
    Route::get('permission/index', 'Admin\PermissionController@index');
    Route::get('permission/create', 'Admin\PermissionController@create')->name('permission.create');

});

