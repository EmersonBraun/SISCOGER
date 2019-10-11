<?php

//Rotas do módulo Adl
Route::group(['as'=>'adl.','prefix' =>'adl'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\AdlController@index']);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\AdlController@lista','middleware' => ['permission:listar-adl']]);
	Route::get('andamento',['as' =>'andamento','uses'=>'Proc\AdlController@andamento','middleware' => ['permission:listar-adl']]);
	Route::get('prazos',['as' =>'prazos','uses'=>'Proc\AdlController@prazos','middleware' => ['permission:listar-adl']]);
	Route::get('rel_situacao',['as' =>'rel_situacao','uses'=>'Proc\AdlController@rel_situacao','middleware' => ['permission:listar-adl']]);
    Route::get('julgamento',['as' =>'julgamento','uses'=>'Proc\AdlController@julgamento','middleware' => ['permission:listar-adl']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Proc\AdlController@apagados','middleware' => ['role:admin']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\AdlController@create','middleware' => ['permission:criar-adl']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\AdlController@store','middleware' => ['permission:criar-adl']]);
	Route::get('ver/{ref}/{ano?}',['as' =>'show','uses'=>'Proc\AdlController@show','middleware' => ['permission:ver-adl']]);
	Route::get('editar/{ref}/{ano?}',['as' =>'edit','uses'=>'Proc\AdlController@edit','middleware' => ['permission:editar-adl']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\AdlController@update','middleware' => ['permission:editar-adl']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\AdlController@destroy','middleware' => ['permission:apagar-adl']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Proc\AdlController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Proc\AdlController@forceDelete','middleware' => ['role:admin']]);
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
    Route::get('apagados',['as' =>'apagados','uses'=>'Proc\CdController@apagados','middleware' => ['role:admin']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\CdController@create','middleware' => ['permission:criar-cd']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\CdController@store','middleware' => ['permission:criar-cd']]);
	Route::get('ver/{ref}/{ano?}',['as' =>'show','uses'=>'Proc\CdController@show','middleware' => ['permission:ver-cd']]);
	Route::get('editar/{ref}/{ano?}',['as' =>'edit','uses'=>'Proc\CdController@edit','middleware' => ['permission:editar-cd']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\CdController@update','middleware' => ['permission:editar-cd']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\CdController@destroy','middleware' => ['permission:apagar-cd']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Proc\CdController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Proc\CdController@forceDelete','middleware' => ['role:admin']]);
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
    Route::get('apagados',['as' =>'apagados','uses'=>'Proc\CjController@apagados','middleware' => ['role:admin']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\CjController@create','middleware' => ['permission:criar-cj']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\CjController@store','middleware' => ['permission:criar-cj']]);
	Route::get('ver/{ref}/{ano?}',['as' =>'show','uses'=>'Proc\CjController@show','middleware' => ['permission:ver-cj']]);
	Route::get('editar/{ref}/{ano?}',['as' =>'edit','uses'=>'Proc\CjController@edit','middleware' => ['permission:editar-cj']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\CjController@update','middleware' => ['permission:editar-cj']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\CjController@destroy','middleware' => ['permission:apagar-cj']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Proc\AdlController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Proc\AdlController@forceDelete','middleware' => ['role:admin']]);
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
    Route::get('apagados/{ano}',['as' =>'apagados','uses'=>'Proc\FatdController@apagados','middleware' => ['role:admin']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\FatdController@create','middleware' => ['permission:criar-fatd']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\FatdController@store','middleware' => ['permission:criar-fatd']]);
	Route::get('ver/{ref}/{ano?}',['as' =>'show','uses'=>'Proc\FatdController@show','middleware' => ['permission:ver-fatd']]);
	Route::get('editar/{ref}/{ano?}',['as' =>'edit','uses'=>'Proc\FatdController@edit','middleware' => ['permission:editar-fatd']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\FatdController@update','middleware' => ['permission:editar-fatd']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\FatdController@destroy','middleware' => ['permission:apagar-fatd']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Proc\FatdController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Proc\FatdController@forceDelete','middleware' => ['role:admin']]);
});
//Rotas do módulo Pad
Route::group(['as'=>'pad.','prefix' =>'pad'],function(){
    Route::get('',['as' =>'index','uses'=>'Proc\PadController@index','middleware' => ['permission:listar-pad']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\PadController@lista','middleware' => ['permission:listar-pad']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Proc\PadController@apagados','middleware' => ['role:admin']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\PadController@create','middleware' => ['permission:criar-pad']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\PadController@store','middleware' => ['permission:criar-pad']]);
	Route::get('ver/{ref}/{ano?}',['as' =>'show','uses'=>'Proc\PadController@show','middleware' => ['permission:ver-pad']]);
	Route::get('editar/{ref}/{ano?}',['as' =>'edit','uses'=>'Proc\PadController@edit','middleware' => ['permission:editar-pad']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\PadController@update','middleware' => ['permission:editar-pad']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\PadController@destroy','middleware' => ['permission:apagar-pad']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Proc\PadController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Proc\PadController@forceDelete','middleware' => ['role:admin']]);
});
//Rotas do módulo Apfd
Route::group(['as'=>'apfd.','prefix' =>'apfd'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\ApfdController@index','middleware' => ['permission:listar-apfd']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\ApfdController@lista','middleware' => ['permission:listar-apfd']]);
    Route::get('rel_situacao',['as' =>'rel_situacao','uses'=>'Proc\ApfdController@rel_situacao','middleware' => ['permission:listar-apfd']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Proc\ApfdController@apagados','middleware' => ['role:admin']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\ApfdController@create','middleware' => ['permission:criar-apfd']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\ApfdController@store','middleware' => ['permission:criar-apfd']]);
	Route::get('ver/{ref}/{ano?}',['as' =>'show','uses'=>'Proc\ApfdController@show','middleware' => ['permission:ver-apfd']]);
	Route::get('editar/{ref}/{ano?}',['as' =>'edit','uses'=>'Proc\ApfdController@edit','middleware' => ['permission:editar-apfd']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\ApfdController@update','middleware' => ['permission:editar-apfd']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\ApfdController@destroy','middleware' => ['permission:apagar-apfd']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Proc\ApfdController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Proc\ApfdController@forceDelete','middleware' => ['role:admin']]);
});
//Rotas do módulo Desercao
Route::group(['as'=>'desercao.','prefix' =>'desercao'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\DesercaoController@index','middleware' => ['permission:listar-desercao']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\DesercaoController@lista','middleware' => ['permission:listar-desercao']]);
    Route::get('rel_situacao',['as' =>'rel_situacao','uses'=>'Proc\DesercaoController@rel_situacao','middleware' => ['permission:listar-desercao']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Proc\DesercaoController@apagados','middleware' => ['role:admin']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\DesercaoController@create','middleware' => ['permission:criar-desercao']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\DesercaoController@store','middleware' => ['permission:criar-desercao']]);
	Route::get('ver/{ref}/{ano?}',['as' =>'show','uses'=>'Proc\DesercaoController@show','middleware' => ['permission:ver-desercao']]);
	Route::get('editar/{ref}/{ano?}',['as' =>'edit','uses'=>'Proc\DesercaoController@edit','middleware' => ['permission:editar-desercao']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\DesercaoController@update','middleware' => ['permission:editar-desercao']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\DesercaoController@destroy','middleware' => ['permission:apagar-desercao']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Proc\DesercaoController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Proc\DesercaoController@forceDelete','middleware' => ['role:admin']]);
});
//Rotas do módulo Exclusao
Route::group(['as'=>'exclusao.','prefix' =>'exclusao'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\ExclusaoController@index','middleware' => ['permission:listar-exclusao']]);
	//listagem
    Route::get('lista',['as' =>'lista','uses'=>'Proc\ExclusaoController@lista','middleware' => ['permission:listar-exclusao']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Proc\ExclusaoController@apagados','middleware' => ['role:admin']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\ExclusaoController@create','middleware' => ['permission:criar-exclusao']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\ExclusaoController@store','middleware' => ['permission:criar-exclusao']]);
	Route::get('ver/{id}',['as' =>'show','uses'=>'Proc\ExclusaoController@show','middleware' => ['permission:ver-exclusao']]);
	Route::get('editar/{id}',['as' =>'edit','uses'=>'Proc\ExclusaoController@edit','middleware' => ['permission:editar-exclusao']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\ExclusaoController@update','middleware' => ['permission:editar-exclusao']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\ExclusaoController@destroy','middleware' => ['permission:apagar-exclusao']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Proc\ExclusaoController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Proc\ExclusaoController@forceDelete','middleware' => ['role:admin']]);
});
//Rotas do módulo ipm
Route::group(['as'=>'ipm.','prefix' =>'ipm'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\IpmController@index','middleware' => ['permission:listar-ipm']]);
	//listagem
	Route::get('lista/{ano}',['as' =>'lista','uses'=>'Proc\IpmController@lista','middleware' => ['permission:listar-ipm']]);
	Route::get('andamento/{ano}',['as' =>'andamento','uses'=>'Proc\IpmController@andamento','middleware' => ['permission:listar-ipm']]);
	Route::get('prazos/{ano}',['as' =>'prazos','uses'=>'Proc\IpmController@prazos','middleware' => ['permission:listar-ipm']]);
	Route::get('rel_situacao/{ano}',['as' =>'rel_situacao','uses'=>'Proc\IpmController@rel_situacao','middleware' => ['permission:listar-ipm']]);
    Route::get('resultado/{ano}',['as' =>'resultado','uses'=>'Proc\IpmController@resultado','middleware' => ['permission:listar-ipm']]);
    Route::get('apagados/{ano}',['as' =>'apagados','uses'=>'Proc\IpmController@apagados','middleware' => ['role:admin']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\IpmController@create','middleware' => ['permission:criar-ipm']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\IpmController@store','middleware' => ['permission:criar-ipm']]);
	Route::get('ver/{ref}/{ano?}',['as' =>'show','uses'=>'Proc\IpmController@show','middleware' => ['permission:ver-ipm']]);
	Route::get('editar/{ref}/{ano?}',['as' =>'edit','uses'=>'Proc\IpmController@edit','middleware' => ['permission:editar-ipm']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\IpmController@update','middleware' => ['permission:editar-ipm']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\IpmController@destroy','middleware' => ['permission:apagar-ipm']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Proc\IpmController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Proc\IpmController@forceDelete','middleware' => ['role:admin']]);
});
//Rotas do módulo Iso
Route::group(['as'=>'iso.','prefix' =>'iso'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\IsoController@index','middleware' => ['permission:listar-iso']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\IsoController@lista','middleware' => ['permission:listar-iso']]);
	Route::get('andamento',['as' =>'andamento','uses'=>'Proc\IsoController@andamento','middleware' => ['permission:listar-iso']]);
    Route::get('prazos',['as' =>'prazos','uses'=>'Proc\IsoController@prazos','middleware' => ['permission:listar-iso']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Proc\IsoController@apagados','middleware' => ['role:admin']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\IsoController@create','middleware' => ['permission:criar-iso']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\IsoController@store','middleware' => ['permission:criar-iso']]);
	Route::get('ver/{ref}/{ano?}',['as' =>'show','uses'=>'Proc\IsoController@show','middleware' => ['permission:ver-iso']]);
	Route::get('editar/{ref}/{ano?}',['as' =>'edit','uses'=>'Proc\IsoController@edit','middleware' => ['permission:editar-iso']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\IsoController@update','middleware' => ['permission:editar-iso']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\IsoController@destroy','middleware' => ['permission:apagar-iso']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Proc\IsoController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Proc\IsoController@forceDelete','middleware' => ['role:admin']]);
});
//Rotas do módulo It
Route::group(['as'=>'it.','prefix' =>'it'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\ItController@index','middleware' => ['permission:listar-it']]);
	//listagem
	Route::get('lista/{ano}',['as' =>'lista','uses'=>'Proc\ItController@lista','middleware' => ['permission:listar-it']]);
	Route::get('andamento/{ano}',['as' =>'andamento','uses'=>'Proc\ItController@andamento','middleware' => ['permission:listar-it']]);
	Route::get('prazos/{ano}',['as' =>'prazos','uses'=>'Proc\ItController@prazos','middleware' => ['permission:listar-it']]);
	Route::get('rel_valores/{ano}',['as' =>'rel_valores','uses'=>'Proc\ItController@rel_valores','middleware' => ['permission:listar-it']]);
    Route::get('julgamento/{ano}',['as' =>'julgamento','uses'=>'Proc\ItController@julgamento','middleware' => ['permission:listar-it']]);
    Route::get('apagados/{ano}',['as' =>'apagados','uses'=>'Proc\ItController@apagados','middleware' => ['role:admin']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\ItController@create','middleware' => ['permission:criar-it']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\ItController@store','middleware' => ['permission:criar-it']]);
	Route::get('ver/{ref}/{ano?}',['as' =>'show','uses'=>'Proc\ItController@show','middleware' => ['permission:ver-it']]);
	Route::get('editar/{ref}/{ano?}',['as' =>'edit','uses'=>'Proc\ItController@edit','middleware' => ['permission:editar-it']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\ItController@update','middleware' => ['permission:editar-it']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\ItController@destroy','middleware' => ['permission:apagar-it']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Proc\ItController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Proc\ItController@forceDelete','middleware' => ['role:admin']]);
	Route::get('documentacao',['as' =>'documentacao','uses'=>'Proc\ItController@documentacao']);
});
//Rotas do módulo ProcOutros
Route::group(['as'=>'procoutro.','prefix' =>'procoutro'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\ProcOutroController@index','middleware' => ['permission:listar-proc-outros']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\ProcOutroController@lista','middleware' => ['permission:listar-proc-outros']]);
	Route::get('andamento',['as' =>'andamento','uses'=>'Proc\ProcOutroController@andamento','middleware' => ['permission:listar-proc-outros']]);
	Route::get('prazos',['as' =>'prazos','uses'=>'Proc\ProcOutroController@prazos','middleware' => ['permission:listar-proc-outros']]);
	Route::get('rel_situacao',['as' =>'rel_situacao','uses'=>'Proc\ProcOutroController@rel_situacao','middleware' => ['permission:listar-proc-outros']]);
    Route::get('julgamento',['as' =>'julgamento','uses'=>'Proc\ProcOutroController@julgamento','middleware' => ['permission:listar-proc-outros']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Proc\ProcOutroController@apagados','middleware' => ['role:admin']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\ProcOutroController@create','middleware' => ['permission:criar-proc-outros']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\ProcOutroController@store','middleware' => ['permission:criar-proc-outros']]);
	Route::get('ver/{ref}/{ano?}',['as' =>'show','uses'=>'Proc\ProcOutroController@show','middleware' => ['permission:ver-proc-outros']]);
	Route::get('editar/{ref}/{ano?}',['as' =>'edit','uses'=>'Proc\ProcOutroController@edit','middleware' => ['permission:editar-proc-outros']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\ProcOutroController@update','middleware' => ['permission:editar-proc-outros']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\ProcOutroController@destroy','middleware' => ['permission:apagar-proc-outros']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Proc\ProcOutroController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Proc\ProcOutroController@forceDelete','middleware' => ['role:admin']]);
});
//Rotas do módulo recurso
Route::group(['as'=>'recurso.','prefix' =>'recurso'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\RecursoController@index','middleware' => ['permission:listar-recursos']]);
    Route::get('lista',['as' =>'lista','uses'=>'Proc\RecursoController@lista','middleware' => ['permission:listar-recursos']]);
    Route::get('proc/{proc}',['as' =>'proc','uses'=>'Proc\RecursoController@proc','middleware' => ['permission:listar-recursos']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Proc\RecursoController@apagados','middleware' => ['role:admin']]);
	Route::get('criar',['as' =>'create','uses'=>'Proc\RecursoController@create','middleware' => ['permission:criar-recursos']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\RecursoController@store','middleware' => ['permission:criar-recursos']]);
	Route::get('ver/{ref}/{ano?}',['as' =>'show','uses'=>'Proc\RecursoController@show','middleware' => ['permission:ver-recursos']]);
	Route::get('editar/{ref}/{ano?}',['as' =>'edit','uses'=>'Proc\RecursoController@edit','middleware' => ['permission:editar-recursos']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\RecursoController@update','middleware' => ['permission:editar-recursos']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\RecursoController@destroy','middleware' => ['permission:apagar-recursos']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Proc\RecursoController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Proc\RecursoController@forceDelete','middleware' => ['role:admin']]);
});
//Rotas do módulo Sindicancia
Route::group(['as'=>'sindicancia.','prefix' =>'sindicancia'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\SindicanciaController@index','middleware' => ['permission:listar-sindicancia']]);
	//listagem
	Route::get('lista/{ano}',['as' =>'lista','uses'=>'Proc\SindicanciaController@lista','middleware' => ['permission:listar-sindicancia']]);
	Route::get('andamento/{ano}',['as' =>'andamento','uses'=>'Proc\SindicanciaController@andamento','middleware' => ['permission:listar-sindicancia']]);
	Route::get('prazos/{ano}',['as' =>'prazos','uses'=>'Proc\SindicanciaController@prazos','middleware' => ['permission:listar-sindicancia']]);
	Route::get('rel_situacao/{ano}',['as' =>'rel_situacao','uses'=>'Proc\SindicanciaController@rel_situacao','middleware' => ['permission:listar-sindicancia']]);
    Route::get('resultado/{ano}',['as' =>'resultado','uses'=>'Proc\SindicanciaController@resultado','middleware' => ['permission:listar-sindicancia']]);
    Route::get('apagados/{ano}',['as' =>'apagados','uses'=>'Proc\SindicanciaController@apagados','middleware' => ['role:admin']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\SindicanciaController@create','middleware' => ['permission:criar-sindicancia']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\SindicanciaController@store','middleware' => ['permission:criar-sindicancia']]);
	Route::get('ver/{ref}/{ano?}',['as' =>'show','uses'=>'Proc\SindicanciaController@show','middleware' => ['permission:ver-sindicancia']]);
	Route::get('editar/{ref}/{ano?}',['as' =>'edit','uses'=>'Proc\SindicanciaController@edit','middleware' => ['permission:editar-sindicancia']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\SindicanciaController@update','middleware' => ['permission:editar-sindicancia']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\SindicanciaController@destroy','middleware' => ['permission:apagar-sindicancia']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Proc\SindicanciaController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Proc\SindicanciaController@forceDelete','middleware' => ['role:admin']]);
});

/* -------------- ROTAS SAI -------------- */
Route::group(['as'=>'sai.','prefix' =>'sai','middleware' => ['permission:sai']],function(){
    Route::get('',['as' =>'index','uses'=>'Policiais\SaiController@index','middleware' => ['permission:listar-sai']]);
    //listagem
    Route::get('lista/{ano}',['as' =>'lista','uses'=>'Policiais\SaiController@lista','middleware' => ['permission:listar-sai']]);
    Route::get('andamento/{ano}',['as' =>'andamento','uses'=>'Policiais\SaiController@andamento','middleware' => ['permission:listar-sai']]);
    Route::get('motivo/{ano}',['as' =>'motivo','uses'=>'Policiais\SaiController@motivo','middleware' => ['permission:listar-sai']]);
	Route::get('prazos/{ano}',['as' =>'prazos','uses'=>'Policiais\SaiController@prazos','middleware' => ['permission:listar-sai']]);
	Route::get('resultado/{ano}',['as' =>'resultado','uses'=>'Policiais\SaiController@resultado','middleware' => ['permission:listar-sai']]);
    Route::get('apagados/{ano}',['as' =>'apagados','uses'=>'Policiais\SaiController@apagados','middleware' => ['role:admin']]);
    //formulários
    Route::get('criar',['as' =>'create','uses'=>'Policiais\SaiController@create','middleware' => ['permission:criar-sai']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\SaiController@store','middleware' => ['permission:criar-sai']]);
	Route::get('ver/{id}',['as' =>'show','uses'=>'Policiais\SaiController@show','middleware' => ['permission:ver-sai']]);
	Route::get('editar/{id}',['as' =>'edit','uses'=>'Policiais\SaiController@edit','middleware' => ['permission:editar-sai']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Policiais\SaiController@update','middleware' => ['permission:editar-sai']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Policiais\SaiController@destroy','middleware' => ['permission:apagar-sai']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Policiais\SaiController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Policiais\SaiController@forceDelete','middleware' => ['role:admin']]);
});


// arquivo
Route::group(['as'=>'arquivamento.','prefix' =>'arquivamento'],function(){
    Route::get('criar',['as' =>'create','uses'=>'Arquivamento\ArquivamentoController@create','middleware' => ['permission:criar-aquivamento']]);
    Route::post('salvar',['as' =>'save','uses'=>'Arquivamento\ArquivamentoController@save','middleware' => ['permission:criar-aquivamento']]);
    Route::get('prateleira/{numero}',['as' =>'prateleira','uses'=>'Arquivamento\ArquivamentoController@prateleira','middleware' => ['permission:ver-aquivamento']]);   
    Route::get('{local}',['as' =>'local','uses'=>'Arquivamento\ArquivamentoController@local','middleware' => ['permission:ver-aquivamento']]);   
});
