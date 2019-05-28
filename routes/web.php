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
Route::get('test',function (){
    return view('backend.dashboard');
});

Route::group(['middleware'=>'auth'],function (){
   //roles and permission routes
    Route::group(['prefix'=>'roles_permissions','as'=>'roles_permissions.'],function (){
        Route::get('index','RolesPermissionController')->name('index');
        Route::get('permission_roles','RolesPermissionController')->name('permission_roles');
        Route::post('get_other_permissions','RolesPermissionController@getOtherPermissions')->name('get_other_permissions');
        Route::post('get_active_permissions','RolesPermissionController@getActivePermissions')->name('get_active_permissions');
        Route::post('update_permission_to_roles','RolesPermissionController@updatePermissionRole')->name('update_permission_to_roles');
        Route::post('update_revokement_to_rules','RolesPermissionController@revokePermissionToRole')->name('update_revokement_to_rules');


    }) ;

});
