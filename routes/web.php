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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', function (){
    Auth::logout();
    return redirect('/');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'DashBoardController@index');

    //users
    Route::get('/users', 'AdminUserController@list');
    Route::get('/user/{id}', 'AdminUserController@get_user')->name('get_user');
    Route::post('/user/{id}','AdminUserController@editUser')->name('get_user');
    // post method for edit user

    //
    Route::get('/roles', 'AdminUserController@rolesForm');
    Route::post('/roles', 'AdminUserController@changeRolesPermission')->name('rolesChange');

});