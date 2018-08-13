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

Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes();

Route::group(['middleware' => 'auth'], function()
{
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('categories', 'CategoryController')->except('create', 'show');
    Route::resource('products', 'ProductController')->except('show');
    Route::resource('roles', 'RoleController')->only('index', 'store', 'destroy');
    Route::resource('users', 'UserController')->except('show');
    Route::get('users/{user}/roles', 'UserController@role')->name('users.roles');
    Route::put('users/{user}/roles', 'UserController@setRole')->name('users.set-role');
    Route::get('users/role-permissions', 'UserController@rolePermission')->name('users.roles-permission');
    Route::post('users/permissions', 'UserController@addPermission')->name('users.add-permission');
    Route::put('users/permissions/{role}', 'UserController@setRolePermission')->name('users.set-role-permission');
});
