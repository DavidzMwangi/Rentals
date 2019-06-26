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

    //damage
    Route::get('new_damage','DamageController')->name('new_damage');
    Route::post('save_new_damage','DamageController@saveNewDamage')->name('save_new_damage');
    Route::get('view_all_damages','DamageController@viewAllDamages')->name('view_all_damages');

    //complaints
    Route::get('all_complaints','ComplaintController')->name('all_complaints');
    Route::get('view_complaints_responses/{complaint}','ComplaintController@viewComplaintResponses')->name('view_complaints_responses');
    Route::post('save_new_complaint_response','ComplaintController@saveNewComplaintResponse')->name('save_new_complaint_response');


    //maintenance
    Route::get('new_maintenance','MaintenanceController@newMaintenance')->name('new_maintenance');
    Route::post('save_new_maintenance','MaintenanceController@saveNewMaintenance')->name('save_new_maintenance');
    Route::get('all_maintenance','MaintenanceController@allMaintenance')->name('all_maintenance');
    Route::get('mark_maintenance_complete/{maintenance}','MaintenanceController@markMaintenanceComplete')->name('mark_maintenance_complete');


    //vacation
    Route::get('vacations','VacationController')->name('vacations');
    Route::get('approve_vacation/{vacation}','VacationController@approveVacation')->name('approve_vacation');
    });
