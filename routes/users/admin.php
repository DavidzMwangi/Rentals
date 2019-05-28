<?php
Route::group(['middleware'=>['auth','role:Admin'],'prefix'=>'admin','as'=>'admin.'],function (){

    //dashboad route
    Route::get('index','DashBoardController@adminDash')->name('index');

Route::group(['prefix'=>'roles_permissions','as'=>'roles_permissions.'],function (){
    Route::get('index','RolesPermissionController')->name('index');
    Route::get('permission_roles','RolesPermissionController')->name('permission_roles');
    Route::post('get_other_permissions','RolesPermissionController@getOtherPermissions')->name('get_other_permissions');
    Route::post('get_active_permissions','RolesPermissionController@getActivePermissions')->name('get_active_permissions');
    Route::post('update_permission_to_roles','RolesPermissionController@updatePermissionRole')->name('update_permission_to_roles');
    Route::post('update_revokement_to_rules','RolesPermissionController@revokePermissionToRole')->name('update_revokement_to_rules');

}) ;


});
