<?php
Route::group(['as'=>'movimento.','prefix' =>'movimento'],function(){
	Route::post('{id}',['as' =>'inserir','uses'=>'Proc\MovimentoController@inserir']);
});