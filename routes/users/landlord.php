<?php
Route::group(['middleware'=>['auth','role:Landlord'],'prefix'=>'landlord','as'=>'landlord.','namespace'=>'Landlord'],function () {

Route::get('dashboard','HomeController@landlordDashboard')->name('dashboard');

//apartment routes
    Route::get('apartments','ApartmentController')->name('apartments');
    Route::get('new_apartment','ApartmentController@newAppartmentView')->name('new_apartment');
    Route::post('save_new_apartment','ApartmentController@saveNewApartment')->name('save_new_apartment');

    //building routes
    Route::get('building','BuildingController@building')->name('building');
    Route::get('get_apartment_buildings/{apartment_id}','BuildingController@getApartmentBuildings')->name('get_apartment_buildings');
    Route::post('save_new_building','BuildingController@saveNewBuilding')->name('save_new_building');


    //rooms
    Route::get('rooms','RoomController@rooms')->name('rooms');
    Route::get('get_building_apartments/{apartment_id}','RoomController@getBuildingApartments')->name('get_building_apartments');
    Route::get('get_rooms_building/{building_id}','RoomController@getRoomsBuilding')->name('get_rooms_building');
    Route::post('save_new_room','RoomController@saveNewRoom')->name('save_new_room');


    //tenants
    Route::get('tenants','TenantController@tenants')->name('tenants');
    Route::get('get_occupied_rooms/{building_id}','TenantController@getOccupiedRooms')->name('get_occupied_rooms');


    });
