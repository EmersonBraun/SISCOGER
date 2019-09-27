<?php
Route::group(['as'=>'fdi.','prefix' =>'fdi'],function(){
	Route::get('{rg}/ver',['as' =>'show','uses'=>'FDI\FdiController@show']);
});