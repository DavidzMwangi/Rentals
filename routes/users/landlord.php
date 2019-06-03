<?php
Route::group(['middleware'=>['auth','role:Landlord'],'prefix'=>'landlord','as'=>'landlord.'],function () {

Route::get('dashboard','HomeController@landlordDashboard')->name('dashboard');
});