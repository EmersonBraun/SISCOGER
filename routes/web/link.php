<?php
Route::group(['as'=>'link.','prefix' =>'link'],function(){
	Route::get('',['as' =>'index','uses'=>'Link\LinkController@index']);
	Route::get('criar',['as' =>'create','uses'=>'Link\LinkController@create','middleware' => ['role:admin']]);
	Route::post('salvar',['as' =>'store','uses'=>'Link\LinkController@store','middleware' => ['role:admin']]);
	Route::get('editar/{id}',['as' =>'edit','uses'=>'Link\LinkController@edit','middleware' => ['role:admin']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Link\LinkController@update','middleware' => ['role:admin']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Link\LinkController@destroy','middleware' => ['role:admin']]);
});