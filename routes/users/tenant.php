<?php
Route::group(['middleware'=>['auth','role:Tenant'],'prefix'=>'tenant','as'=>'tenant.','namespace'=>'Tenant'],function () {

    Route::get('dashboard', 'HomeController@tenantDashBoard')->name('dashboard');
    Route::get('profile', 'UserController@profileView')->name('profile');
    Route::post('update_user_profile', 'UserController@updateUserProfile')->name('update_user_profile');

    Route::group(['prefix'=>'room','as'=>'room.'],function (){
        Route::get('room_info','RoomController@roomInfo')->name('room_info');
    });

});