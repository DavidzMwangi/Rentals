<?php
Route::group(['middleware'=>['auth','role:Landlord'],'prefix'=>'landlord','as'=>'landlord.','namespace'=>'Landlord'],function () {

Route::get('dashboard','HomeController@landlordDashboard')->name('dashboard');

//apartment routes
    Route::get('apartments','ApartmentController')->name('apartments');
    Route::get('new_apartment','ApartmentController@newAppartmentView')->name('new_apartment');
    Route::post('save_new_apartment','ApartmentController@saveNewApartment')->name('save_new_apartment');
});