<?php
Route::group(['as'=>'session.','prefix' =>'session'],function(){
    Route::get('dados',['as' =>'dados','uses'=>'Dev\SessionController@dados']);
});