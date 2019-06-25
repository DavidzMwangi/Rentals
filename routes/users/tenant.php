<?php
Route::group(['middleware'=>['auth','role:Tenant'],'prefix'=>'tenant','as'=>'tenant.','namespace'=>'Tenant'],function () {

    Route::get('dashboard', 'HomeController@tenantDashBoard')->name('dashboard');
    Route::get('profile', 'UserController@profileView')->name('profile');
    Route::post('update_user_profile', 'UserController@updateUserProfile')->name('update_user_profile');

    Route::group(['prefix'=>'room','as'=>'room.'],function (){
        Route::get('room_info','RoomController@roomInfo')->name('room_info');
        Route::get('damages','DamageController')->name('damages');
        Route::get('get_rooms_building/{building_id}','RoomController@getRoomsBuilding')->name('get_rooms_building');
        Route::get('get_building_apartments/{apartment_id}','RoomController@getBuildingApartments')->name('get_building_apartments');

    });


});