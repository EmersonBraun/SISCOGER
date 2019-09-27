<?php
Route::group(['as'=>'om.','prefix' =>'om','middleware' => ['role:admin']],function(){
	Route::get('',['as' =>'index','uses'=>'OM\OMController@index']);
});