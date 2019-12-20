<?php
// Route::get('/home', ['as' =>'home','uses'=>'Relatorios\PendenciasController@index']);
Route::get('viewlogin', ['as' =>'viewlogin','uses'=>'LoginController@viewlogin']);
Route::get('home', ['as' =>'home','uses'=>'HomeController@index']);
Route::get('home/{opm}', ['as' =>'home.opm','uses'=>'HomeController@index', 'middleware' => ['permission:todas-unidades']]);
Route::get('logout', 'HomeController@logout');