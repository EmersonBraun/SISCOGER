<?php
//Rotas do módulo Adl
Route::group(['as'=>'adl.','prefix' =>'adl'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\AdlController@index','middleware' => ['permission:listar-adl']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\AdlController@lista','middleware' => ['permission:listar-adl']]);
	Route::get('andamento',['as' =>'andamento','uses'=>'Proc\AdlController@andamento','middleware' => ['permission:listar-adl']]);
	Route::get('prazos',['as' =>'prazos','uses'=>'Proc\AdlController@prazos','middleware' => ['permission:listar-adl']]);
	Route::get('rel_situacao',['as' =>'rel_situacao','uses'=>'Proc\AdlController@rel_situacao','middleware' => ['permission:listar-adl']]);
	Route::get('julgamento',['as' =>'julgamento','uses'=>'Proc\AdlController@julgamento','middleware' => ['permission:listar-adl']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\AdlController@create','middleware' => ['permission:criar-adl']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\AdlController@store','middleware' => ['permission:criar-adl']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\AdlController@show','middleware' => ['permission:ver-adl']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\AdlController@edit','middleware' => ['permission:editar-adl']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\AdlController@update','middleware' => ['permission:editar-adl']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\AdlController@destroy','middleware' => ['permission:apagar-adl']]);
});

//Rotas do módulo Cd
Route::group(['as'=>'cd.','prefix' =>'cd'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\CdController@index','middleware' => ['permission:listar-cd']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\CdController@lista','middleware' => ['permission:listar-cd']]);
	Route::get('andamento',['as' =>'andamento','uses'=>'Proc\CdController@andamento','middleware' => ['permission:listar-cd']]);
	Route::get('prazos',['as' =>'prazos','uses'=>'Proc\CdController@prazos','middleware' => ['permission:listar-cd']]);
	Route::get('rel_situacao',['as' =>'rel_situacao','uses'=>'Proc\CdController@rel_situacao','middleware' => ['permission:listar-cd']]);
	Route::get('julgamento',['as' =>'julgamento','uses'=>'Proc\CdController@julgamento','middleware' => ['permission:listar-cd']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\CdController@create','middleware' => ['permission:criar-cd']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\CdController@store','middleware' => ['permission:criar-cd']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\CdController@show','middleware' => ['permission:ver-cd']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\CdController@edit','middleware' => ['permission:editar-cd']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\CdController@update','middleware' => ['permission:editar-cd']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\CdController@destroy','middleware' => ['permission:apagar-cd']]);
});

//Rotas do módulo Cj
Route::group(['as'=>'cj.','prefix' =>'cj'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\CjController@index','middleware' => ['permission:listar-cj']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\CjController@lista','middleware' => ['permission:listar-cj']]);
	Route::get('andamento',['as' =>'andamento','uses'=>'Proc\CjController@andamento','middleware' => ['permission:listar-cj']]);
	Route::get('prazos',['as' =>'prazos','uses'=>'Proc\CjController@prazos','middleware' => ['permission:listar-cj']]);
	Route::get('rel_situacao',['as' =>'rel_situacao','uses'=>'Proc\CjController@rel_situacao','middleware' => ['permission:listar-cj']]);
	Route::get('julgamento',['as' =>'julgamento','uses'=>'Proc\CjController@julgamento','middleware' => ['permission:listar-cj']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\CjController@create','middleware' => ['permission:criar-cj']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\CjController@store','middleware' => ['permission:criar-cj']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\CjController@show','middleware' => ['permission:ver-cj']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\CjController@edit','middleware' => ['permission:editar-cj']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\CjController@update','middleware' => ['permission:editar-cj']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\CjController@destroy','middleware' => ['permission:apagar-cj']]);
});

//Rotas do módulo Fatd
Route::group(['as'=>'fatd.','prefix' =>'fatd'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\FatdController@index','middleware' => ['permission:listar-fatd']]);
	//listagem
	Route::get('lista/{ano}',['as' =>'lista','uses'=>'Proc\FatdController@lista','middleware' => ['permission:listar-fatd']]);
	Route::get('andamento/{ano}',['as' =>'andamento','uses'=>'Proc\FatdController@andamento','middleware' => ['permission:listar-fatd']]);
	Route::get('prazos/{ano}',['as' =>'prazos','uses'=>'Proc\FatdController@prazos','middleware' => ['permission:listar-fatd']]);
	Route::get('rel_situacao/{ano}',['as' =>'rel_situacao','uses'=>'Proc\FatdController@rel_situacao','middleware' => ['permission:listar-fatd']]);
	Route::get('julgamento/{ano}',['as' =>'julgamento','uses'=>'Proc\FatdController@julgamento','middleware' => ['permission:listar-fatd']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\FatdController@create','middleware' => ['permission:criar-fatd']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\FatdController@store','middleware' => ['permission:criar-fatd']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\FatdController@show','middleware' => ['permission:ver-fatd']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\FatdController@edit','middleware' => ['permission:editar-fatd']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\FatdController@update','middleware' => ['permission:editar-fatd']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\FatdController@destroy','middleware' => ['permission:apagar-fatd']]);
});

//Rotas do módulo Pad
Route::group(['as'=>'pad.','prefix' =>'pad'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\PadController@index','middleware' => ['permission:listar-pad']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\PadController@lista','middleware' => ['permission:listar-pad']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\PadController@create','middleware' => ['permission:criar-pad']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\PadController@store','middleware' => ['permission:criar-pad']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\PadController@show','middleware' => ['permission:ver-pad']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\PadController@edit','middleware' => ['permission:editar-pad']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\PadController@update','middleware' => ['permission:editar-pad']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\PadController@destroy','middleware' => ['permission:apagar-pad']]);
});
