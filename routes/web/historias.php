<?php
Route::group(['as'=>'historia.','prefix' =>'historia'],function(){
	Route::get('',['as' =>'ver','uses'=>'Historia\HistoriaController@index']);
	Route::post('salvar',['as' =>'store','uses'=>'Historia\HistoriaController@store']);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Historia\HistoriaController@update']);
	Route::get('{id}/remover',['as' =>'destroy','uses'=>'Historia\HistoriaController@destroy']);
});