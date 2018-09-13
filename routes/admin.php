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
    //首页
    Route::get('/', 'Admin\IndexController@index')->name('index');

    //提示页面
    Route::get('prompt','Admin\PromptController@index')->name('prompt');

    /*** 登陆注册 ***/
    //登录
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
    /*** 登陆注册(完) ***/

    /*** 管理员管理 ***/
    Route::get('admin', 'Admin\AdminController@index')->name('admin');
    Route::post('admin', 'Admin\AdminController@index')->name('admin');

    Route::get('admin/create', 'Admin\AdminController@create')->name('admin.create');
    Route::post('admin/store', 'Admin\AdminController@store')->name('admin.store');

    Route::get('admin/show', 'Admin\AdminController@show')->name('admin.show');

    Route::get('admin/edit/{admin}', 'Admin\AdminController@edit')->name('admin.edit');
    Route::post('admin/update/{admin}', 'Admin\AdminController@update')->name('admin.update');

    Route::get('admin/destroy/{id}', 'Admin\AdminController@destroy')->name('admin.destroy');
    /*** 管理员管理(完) ***/

    /*** 角色管理 ***/
    Route::get('role','Admin\RoleController@index')->name('role');
    Route::post('role','Admin\RoleController@index')->name('role');

    Route::get('role/create','Admin\RoleController@create')->name('role.create');
    Route::post('role/store','Admin\RoleController@store')->name('role.store');

    Route::get('role/show', 'Admin\RoleController@show')->name('role.show');

    Route::get('role/edit/{role}', 'Admin\RoleController@edit')->name('role.edit');
    Route::post('role/update{role}', 'Admin\RoleController@update')->name('role.update');

    Route::get('role/destroy/{role}', 'Admin\RoleController@destroy')->name('role.destroy');

//    Route::get('role/assign/{role}','Admin\RoleController@assign')->name('role.assign');
//    Route::post('role/assign/{role}','Admin\RoleController@assign')->name('role.assign');

    //获取所有的权限节点
    Route::post('role/get_permissions/{role?}','Admin\RoleController@get_permissions')->name('role.get_permissions');
    /*** 角色管理(完) ***/

    /*** 权限管理 ***/
    Route::get('permission', 'Admin\PermissionController@index')->name('permission');

    Route::get('permission/create/{pid?}', 'Admin\PermissionController@create')->name('permission.create');
    Route::post('permission/store', 'Admin\PermissionController@store')->name('permission.store');

    Route::get('permission/edit/{permission}', 'Admin\PermissionController@edit')->name('permission.edit');
    Route::post('permission/update/{permission}', 'Admin\PermissionController@update')->name('permission.update');

    Route::get('permission/destroy/{permission}', 'Admin\PermissionController@destroy')->name('permission.destroy');

    Route::post('permission/sort', 'Admin\PermissionController@sort')->name('permission.sort');
    /*** 权限管理(完) ***/


    /*** 七牛云 ***/
    Route::get('qiniuCloud/get_up_token', 'Admin\QiniuCloudController@get_up_token')->name('qiniuCloud.get_up_token');
    Route::get('qiniuCloud/get_up_url', 'Admin\QiniuCloudController@get_up_url')->name('qiniuCloud.get_up_url');
});

