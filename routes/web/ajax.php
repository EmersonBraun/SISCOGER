<?php
Route::group(['as'=>'ajax.','prefix' =>'ajax'],function(){
    // Route::post('acusado/ligacao',['as' =>'ligacao.store','uses'=>'Ajax\ProcController@store']);
    // Route::get('proc/ligacao/list/{proc}/{ref}/{ano?}',['as' =>'ligacao.index','uses'=>'Ajax\ProcController@list']);
    // Route::delete('proc/ligacao/remover/{id}',['as' =>'ligacao.destroy','uses'=>'Ajax\ProcController@destroy']);
	Route::post('add/form',['as' =>'add','uses'=>'Ajax\ViewController@add']);
	//Route::post('ligacao',['as' =>'ligacao','uses'=>'Ajax\AjaxController@ligacao']);
});