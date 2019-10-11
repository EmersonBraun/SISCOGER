<?php
// Route::get('/home', ['as' =>'home','uses'=>'Relatorios\PendenciasController@index']);
Route::get('/home', ['as' =>'home','uses'=>'HomeController@index', 'middleware' => ['checkSession']]);
Route::get('home/{opm}', ['as' =>'home.opm','uses'=>'HomeController@index', 'middleware' => ['permission:todas-unidades']]);
Route::get('logout', 'HomeController@logout');