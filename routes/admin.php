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

Route::namespace('Admin')->group(function () {
    //首页
    Route::get('/', 'IndexController@index')->name('index');
    //DEMO
    Route::get('/demo', 'IndexController@demo');

    //提示页面
    Route::get('prompt','PromptController@index')->name('prompt');

    /*** 登陆注册 ***/
    //登录
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    //注册
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
    //找回密码
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    //登出
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
    /*** 登陆注册(完) ***/

    /*** 管理员管理 ***/
    Route::resource('admin', 'AdminController');
//    Route::get('admin', 'AdminController@index')->name('admin');
    Route::post('admin/index', 'AdminController@index')->name('admin');

//    Route::get('admin/create', 'AdminController@create')->name('admin.create');
//    Route::post('admin/store', 'AdminController@store')->name('admin.store');
//
//    Route::get('admin/show', 'AdminController@show')->name('admin.show');
//
//    Route::get('admin/edit/{admin}', 'AdminController@edit')->name('admin.edit');
//    Route::post('admin/update/{admin}', 'AdminController@update')->name('admin.update');
//
//    Route::get('admin/destroy/{id}', 'AdminController@destroy')->name('admin.destroy');
    /*** 管理员管理(完) ***/

    /*** 角色管理 ***/
//    Route::get('role','Rbac\RoleController@index')->name('role');
//    Route::post('role','Rbac\RoleController@index')->name('role');
//
    Route::get('role/create','Rbac\RoleController@create')->name('role.create');
    Route::post('role/store','Rbac\RoleController@store')->name('role.store');
//
//    Route::get('role/show', 'Rbac\RoleController@show')->name('role.show');
//
//    Route::get('role/edit/{role}', 'Rbac\RoleController@edit')->name('role.edit');
//    Route::post('role/update{role}', 'Rbac\RoleController@update')->name('role.update');
//
//    Route::get('role/destroy/{role}', 'Rbac\RoleController@destroy')->name('role.destroy');

//    Route::get('role/assign/{role}','Admin\RoleController@assign')->name('role.assign');
//    Route::post('role/assign/{role}','Admin\RoleController@assign')->name('role.assign');

    //获取所有的权限节点
    Route::post('role/get_permissions/{role?}','Rbac\RoleController@get_permissions')->name('role.get_permissions');
    /*** 角色管理(完) ***/

    /*** 权限管理 ***/
//    Route::get('permission', 'Rbac\PermissionController@index')->name('permission');
//
//    Route::get('permission/create/{pid?}', 'Rbac\PermissionController@create')->name('permission.create');
//    Route::post('permission/store', 'Rbac\PermissionController@store')->name('permission.store');
//
//    Route::get('permission/edit/{permission}', 'Rbac\PermissionController@edit')->name('permission.edit');
//    Route::post('permission/update/{permission}', 'Rbac\PermissionController@update')->name('permission.update');
//
//    Route::get('permission/destroy/{permission}', 'Rbac\PermissionController@destroy')->name('permission.destroy');
//
//    Route::post('permission/sort', 'Rbac\PermissionController@sort')->name('permission.sort');
    /*** 权限管理(完) ***/

    //权限管理
    Route::resource('permissions', 'Rbac\PermissionsController');
    Route::get('permissions/create/{id?}', 'Rbac\PermissionsController@create');
    Route::post('permissions/index', 'Rbac\PermissionsController@index');
    Route::post('permissions/sort/{permission}', 'Rbac\PermissionsController@sort');
    Route::post('permissions/toggle_nav/{permission}', 'Rbac\PermissionsController@toggleNav');

    //角色管理
    Route::resource('roles', 'Rbac\RolesController');
    Route::post('roles/index', 'Rbac\RolesController@index');
    Route::post('roles/permission_tree/{role?}', 'Rbac\RolesController@permissionTree');
    Route::post('roles/status/{role?}', 'Rbac\RolesController@status');

    /*** 七牛云 ***/
    Route::get('qiniuCloud/get_up_token', 'Admin\QiniuCloudController@get_up_token')->name('qiniuCloud.get_up_token');
    Route::get('qiniuCloud/get_up_url', 'Admin\QiniuCloudController@get_up_url')->name('qiniuCloud.get_up_url');
});

