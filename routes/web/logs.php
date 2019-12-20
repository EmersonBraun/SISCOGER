<?php
//Route::group(['as'=>'log.','prefix' =>'log','middleware' => ['permission:supervisao']],function(){
Route::group(['as'=>'log.','prefix' =>'log'],function(){
    Route::get('criado/{name}',['as' =>'created','uses'=>'Log\LogController@created']);
    Route::get('ultimoacesso',['as' =>'ultimoacesso','uses'=>'Log\LogController@ultimoacesso']);
    Route::get('atualizado/{name}',['as' =>'updated','uses'=>'Log\LogController@updated']);
    Route::get('apagado/{name}',['as' =>'deleted','uses'=>'Log\LogController@deleted']);
    Route::get('restaurado/{name}',['as' =>'restored','uses'=>'Log\LogController@restored']);
});