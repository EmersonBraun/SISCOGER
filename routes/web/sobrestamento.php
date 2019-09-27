<?php
Route::group(['as'=>'sobrestamento.','prefix' =>'sobrestamento'],function(){
	Route::post('{id}',['as' =>'inserir','uses'=>'Proc\SobrestamentoController@inserir']);
});