<?php

use Illuminate\Support\Facades\Route;

Route::get('/',"EquipmentTypeController@index");
Route::get('/edit/{id}',"EquipmentTypeController@edit");
Route::get('/show/{id}',"EquipmentTypeController@show");
Route::get('/create',"EquipmentTypeController@create");
Route::post('/store',"EquipmentTypeController@store");
Route::post('/update/{id}',"EquipmentTypeController@update");
Route::delete('/delete/{id}',"EquipmentTypeController@delete")->name("equipmenttype.delete");

Route::delete('/equipment/delete/{id}',"EquipmentlistController@delete")->name("equipmentlist.delete");
Route::get('/createitem/{id}',"EquipmentlistController@create");
Route::post('/equipmentstore/{id}',"EquipmentlistController@store");
Route::get('/equipmentinfo/{id}',"EquipmentlistController@edit");
Route::post('/equipmentupdate/{id}',"EquipmentlistController@update");

Route::delete('/specification/delete/{id}',"SpecificationController@delete")->name("specificationlist.delete");
Route::post('/specification/update/{id}',"SpecificationController@update")->name("specificationlist.update");
Route::post('/specification/store/{id}',"SpecificationController@store")->name("specificationlist.store");
