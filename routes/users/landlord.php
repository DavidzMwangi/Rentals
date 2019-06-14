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
    });
