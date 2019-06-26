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

    Route::group(['prefix'=>'complaint','as'=>'complaint.'],function (){
        Route::get('new_complaint','ComplaintController@newComplaint')->name('new_complaint');
        Route::post('save_new_complaint','ComplaintController@saveNewComplaint')->name('save_new_complaint');
        Route::get('all_complaints','ComplaintController@allComplaints')->name('all_complaints');
        Route::get('delete_complaint/{complaint}','ComplaintController@deleteComplaint')->name('delete_complaint');
        Route::get('view_complaints_responses/{complaint}','ComplaintController@viewComplaintsResponses')->name('view_complaints_responses');
        Route::post('save_new_complaint_response','ComplaintController@saveNewComplaintResponse')->name('save_new_complaint_response');

    });

    //vacate route
    Route::group(['prefix'=>'vacate','as'=>'vacate.'],function (){
       Route::get('vacation','VacationController')->name('vacation');
       Route::post('save_new_vacation','VacationController@saveNewVacation')->name('save_new_vacation');

    });
});