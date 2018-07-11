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

Route::domain(config('route.domain_admin'))->group(function () {
    Route::get('/', 'Admin\IndexController@index')->name('index');

    //提示页面
    Route::get('prompt','Admin\PromptController@index')->name('prompt');

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
    Route::get('logout', 'Admin\LoginController@logout')->name('logout');

    //权限管理
    Route::get('permission', 'Admin\PermissionController@index')->name('permission');

    Route::get('permission/create/{pid?}', 'Admin\PermissionController@create')->name('permission.create');
    Route::post('permission/store', 'Admin\PermissionController@store')->name('permission.store');

    Route::get('permission/edit/{id}', 'Admin\PermissionController@edit')->name('permission.edit');
    Route::post('permission/update', 'Admin\PermissionController@update')->name('permission.update');
    Route::post('permission/sort', 'Admin\PermissionController@sort')->name('permission.sort');

    Route::get('permission/destroy/{id}', 'Admin\PermissionController@destroy')->name('permission.destroy');

    //管理员管理
    Route::get('/admin', 'Admin\AdminController@index')->name('admin');
    Route::post('/admin', 'Admin\AdminController@index')->name('admin');
    Route::get('/admin/create', 'Admin\AdminController@create')->name('admin.create');
    Route::post('/admin/store', 'Admin\AdminController@store')->name('admin.store');

});

