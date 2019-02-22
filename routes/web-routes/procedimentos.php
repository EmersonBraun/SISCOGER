<?php
//Rotas do módulo Apfd
Route::group(['as'=>'apfd.','prefix' =>'apfd'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\ApfdController@index','middleware' => ['permission:listar-apfd']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\ApfdController@lista','middleware' => ['permission:listar-apfd']]);
	Route::get('rel_situacao',['as' =>'rel_situacao','uses'=>'Proc\ApfdController@rel_situacao','middleware' => ['permission:listar-apfd']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\ApfdController@create','middleware' => ['permission:criar-apfd']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\ApfdController@store','middleware' => ['permission:criar-apfd']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\ApfdController@show','middleware' => ['permission:ver-apfd']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\ApfdController@edit','middleware' => ['permission:editar-apfd']]);
	Route::put('atualizar/{ref}/{ano}',['as' =>'update','uses'=>'Proc\ApfdController@update','middleware' => ['permission:editar-apfd']]);
	Route::get('movimentos/{ref}/{ano}',['as' =>'movimentos','uses'=>'Proc\MovimentoController@movimentos','middleware' => ['permission:ver-apfd']]);
	Route::get('sobrestamentos/{ref}/{ano}',['as' =>'sobrestamentos','uses'=>'Proc\SobrestamentoController@sobrestamentos','middleware' => ['permission:ver-apfd']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\ApfdController@destroy','middleware' => ['permission:apagar-apfd']]);
});

//Rotas do módulo Desercao
Route::group(['as'=>'desercao.','prefix' =>'desercao'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\DesercaoController@index','middleware' => ['permission:listar-desercao']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\DesercaoController@lista','middleware' => ['permission:listar-desercao']]);
	Route::get('rel_situacao',['as' =>'rel_situacao','uses'=>'Proc\DesercaoController@rel_situacao','middleware' => ['permission:listar-desercao']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\DesercaoController@create','middleware' => ['permission:criar-desercao']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\DesercaoController@store','middleware' => ['permission:criar-desercao']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\DesercaoController@show','middleware' => ['permission:ver-desercao']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\DesercaoController@edit','middleware' => ['permission:editar-desercao']]);
	Route::put('atualizar/{ref}/{ano}',['as' =>'update','uses'=>'Proc\DesercaoController@update','middleware' => ['permission:editar-desercao']]);
	Route::get('movimentos/{ref}/{ano}',['as' =>'movimentos','uses'=>'Proc\MovimentoController@movimentos','middleware' => ['permission:ver-desercao']]);
	Route::get('sobrestamentos/{ref}/{ano}',['as' =>'sobrestamentos','uses'=>'Proc\SobrestamentoController@sobrestamentos','middleware' => ['permission:ver-desercao']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\DesercaoController@destroy','middleware' => ['permission:apagar-desercao']]);
});

//Rotas do módulo Exclusao
Route::group(['as'=>'exclusao.','prefix' =>'exclusao'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\ExclusaoController@index','middleware' => ['permission:listar-exclusao']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\ExclusaoController@lista','middleware' => ['permission:listar-exclusao']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\ExclusaoController@create','middleware' => ['permission:criar-exclusao']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\ExclusaoController@store','middleware' => ['permission:criar-exclusao']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\ExclusaoController@show','middleware' => ['permission:ver-exclusao']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\ExclusaoController@edit','middleware' => ['permission:editar-exclusao']]);
	Route::put('atualizar/{ref}/{ano}',['as' =>'update','uses'=>'Proc\ExclusaoController@update','middleware' => ['permission:editar-exclusao']]);
	Route::get('movimentos/{ref}/{ano}',['as' =>'movimentos','uses'=>'Proc\MovimentoController@movimentos','middleware' => ['permission:ver-exclusao']]);
	Route::get('sobrestamentos/{ref}/{ano}',['as' =>'sobrestamentos','uses'=>'Proc\SobrestamentoController@sobrestamentos','middleware' => ['permission:ver-exclusao']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\ExclusaoController@destroy','middleware' => ['permission:apagar-exclusao']]);
});

//Rotas do módulo ipm
Route::group(['as'=>'ipm.','prefix' =>'ipm'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\IpmController@index','middleware' => ['permission:listar-ipm']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\IpmController@lista','middleware' => ['permission:listar-ipm']]);
	Route::get('andamento',['as' =>'andamento','uses'=>'Proc\IpmController@andamento','middleware' => ['permission:listar-ipm']]);
	Route::get('prazos',['as' =>'prazos','uses'=>'Proc\IpmController@prazos','middleware' => ['permission:listar-ipm']]);
	Route::get('rel_situacao',['as' =>'rel_situacao','uses'=>'Proc\IpmController@rel_situacao','middleware' => ['permission:listar-ipm']]);
	Route::get('resultado',['as' =>'resultado','uses'=>'Proc\IpmController@resultado','middleware' => ['permission:listar-ipm']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\IpmController@create','middleware' => ['permission:criar-ipm']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\IpmController@store','middleware' => ['permission:criar-ipm']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\IpmController@show','middleware' => ['permission:ver-ipm']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\IpmController@edit','middleware' => ['permission:editar-ipm']]);
	Route::put('atualizar/{ref}/{ano}',['as' =>'update','uses'=>'Proc\IpmController@update','middleware' => ['permission:editar-ipm']]);
	Route::get('movimentos/{ref}/{ano}',['as' =>'movimentos','uses'=>'Proc\MovimentoController@movimentos','middleware' => ['permission:ver-ipm']]);
	Route::get('sobrestamentos/{ref}/{ano}',['as' =>'sobrestamentos','uses'=>'Proc\SobrestamentoController@sobrestamentos','middleware' => ['permission:ver-ipm']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\IpmController@destroy','middleware' => ['permission:apagar-ipm']]);
});

//Rotas do módulo Iso
Route::group(['as'=>'iso.','prefix' =>'iso'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\IsoController@index','middleware' => ['permission:listar-iso']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\IsoController@lista','middleware' => ['permission:listar-iso']]);
	Route::get('andamento',['as' =>'andamento','uses'=>'Proc\IsoController@andamento','middleware' => ['permission:listar-iso']]);
	Route::get('prazos',['as' =>'prazos','uses'=>'Proc\IsoController@prazos','middleware' => ['permission:listar-iso']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\IsoController@create','middleware' => ['permission:criar-iso']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\IsoController@store','middleware' => ['permission:criar-iso']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\IsoController@show','middleware' => ['permission:ver-iso']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\IsoController@edit','middleware' => ['permission:editar-iso']]);
	Route::put('atualizar/{ref}/{ano}',['as' =>'update','uses'=>'Proc\IsoController@update','middleware' => ['permission:editar-iso']]);
	Route::get('movimentos/{ref}/{ano}',['as' =>'movimentos','uses'=>'Proc\MovimentoController@movimentos','middleware' => ['permission:ver-iso']]);
	Route::get('sobrestamentos/{ref}/{ano}',['as' =>'sobrestamentos','uses'=>'Proc\SobrestamentoController@sobrestamentos','middleware' => ['permission:ver-iso']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\IsoController@destroy','middleware' => ['permission:apagar-iso']]);
});

//Rotas do módulo It
Route::group(['as'=>'it.','prefix' =>'it'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\ItController@index','middleware' => ['permission:listar-it']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\ItController@lista','middleware' => ['permission:listar-it']]);
	Route::get('andamento',['as' =>'andamento','uses'=>'Proc\ItController@andamento','middleware' => ['permission:listar-it']]);
	Route::get('prazos',['as' =>'prazos','uses'=>'Proc\ItController@prazos','middleware' => ['permission:listar-it']]);
	Route::get('rel_valores',['as' =>'rel_valores','uses'=>'Proc\ItController@rel_valores','middleware' => ['permission:listar-it']]);
	Route::get('julgamento',['as' =>'julgamento','uses'=>'Proc\ItController@julgamento','middleware' => ['permission:listar-it']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\ItController@create','middleware' => ['permission:criar-it']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\ItController@store','middleware' => ['permission:criar-it']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\ItController@show','middleware' => ['permission:ver-it']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\ItController@edit','middleware' => ['permission:editar-it']]);
	Route::put('atualizar/{ref}/{ano}',['as' =>'update','uses'=>'Proc\ItController@update','middleware' => ['permission:editar-it']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\ItController@destroy','middleware' => ['permission:apagar-it']]);
	Route::get('movimentos/{ref}/{ano}',['as' =>'movimentos','uses'=>'Proc\MovimentoController@movimentos','middleware' => ['permission:ver-it']]);
	Route::get('sobrestamentos/{ref}/{ano}',['as' =>'sobrestamentos','uses'=>'Proc\SobrestamentoController@sobrestamentos','middleware' => ['permission:ver-it']]);
	Route::get('documentacao',['as' =>'documentacao','uses'=>'Proc\ItController@documentacao']);
});

//Rotas do módulo ProcOutros
Route::group(['as'=>'procoutros.','prefix' =>'procoutros'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\ProcOutrosController@index','middleware' => ['permission:listar-proc-outros']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\ProcOutrosController@lista','middleware' => ['permission:listar-proc-outros']]);
	Route::get('andamento',['as' =>'andamento','uses'=>'Proc\ProcOutrosController@andamento','middleware' => ['permission:listar-proc-outros']]);
	Route::get('prazos',['as' =>'prazos','uses'=>'Proc\ProcOutrosController@prazos','middleware' => ['permission:listar-proc-outros']]);
	Route::get('rel_situacao',['as' =>'rel_situacao','uses'=>'Proc\ProcOutrosController@rel_situacao','middleware' => ['permission:listar-proc-outros']]);
	Route::get('julgamento',['as' =>'julgamento','uses'=>'Proc\ProcOutrosController@julgamento','middleware' => ['permission:listar-proc-outros']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\ProcOutrosController@create','middleware' => ['permission:criar-proc-outros']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\ProcOutrosController@store','middleware' => ['permission:criar-proc-outros']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\ProcOutrosController@show','middleware' => ['permission:ver-proc-outros']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\ProcOutrosController@edit','middleware' => ['permission:editar-proc-outros']]);
	Route::put('atualizar/{ref}/{ano}',['as' =>'update','uses'=>'Proc\ProcOutrosController@update','middleware' => ['permission:editar-proc-outros']]);
	Route::get('movimentos/{ref}/{ano}',['as' =>'movimentos','uses'=>'Proc\MovimentoController@movimentos','middleware' => ['permission:ver-proc-outros']]);
	Route::get('sobrestamentos/{ref}/{ano}',['as' =>'sobrestamentos','uses'=>'Proc\SobrestamentoController@sobrestamentos','middleware' => ['permission:ver-proc-outros']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\ProcOutrosController@destroy','middleware' => ['permission:apagar-proc-outros']]);
});

//Rotas do módulo recurso
Route::group(['as'=>'recurso.','prefix' =>'recurso'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\RecursoController@index','middleware' => ['permission:listar-recursos']]);
	Route::get('lista',['as' =>'lista','uses'=>'Proc\RecursoController@lista','middleware' => ['permission:listar-recursos']]);
	Route::get('criar',['as' =>'create','uses'=>'Proc\RecursoController@create','middleware' => ['permission:criar-recursos']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\RecursoController@store','middleware' => ['permission:criar-recursos']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\RecursoController@show','middleware' => ['permission:ver-recursos']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\RecursoController@edit','middleware' => ['permission:editar-recursos']]);
	Route::put('atualizar/{ref}/{ano}',['as' =>'update','uses'=>'Proc\RecursoController@update','middleware' => ['permission:editar-recursos']]);
	Route::get('movimentos/{ref}/{ano}',['as' =>'movimentos','uses'=>'Proc\MovimentoController@movimentos','middleware' => ['permission:ver-recursos']]);
	Route::get('sobrestamentos/{ref}/{ano}',['as' =>'sobrestamentos','uses'=>'Proc\SobrestamentoController@sobrestamentos','middleware' => ['permission:ver-recursos']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\RecursoController@destroy','middleware' => ['permission:apagar-recursos']]);
});

//Rotas do módulo Sindicancia
Route::group(['as'=>'sindicancia.','prefix' =>'sindicancia'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\SindicanciaController@index','middleware' => ['permission:listar-sindicancia']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\SindicanciaController@lista','middleware' => ['permission:listar-sindicancia']]);
	Route::get('andamento',['as' =>'andamento','uses'=>'Proc\SindicanciaController@andamento','middleware' => ['permission:listar-sindicancia']]);
	Route::get('prazos',['as' =>'prazos','uses'=>'Proc\SindicanciaController@prazos','middleware' => ['permission:listar-sindicancia']]);
	Route::get('rel_situacao',['as' =>'rel_situacao','uses'=>'Proc\SindicanciaController@rel_situacao','middleware' => ['permission:listar-sindicancia']]);
	Route::get('resultado',['as' =>'resultado','uses'=>'Proc\SindicanciaController@resultado','middleware' => ['permission:listar-sindicancia']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\SindicanciaController@create','middleware' => ['permission:criar-sindicancia']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\SindicanciaController@store','middleware' => ['permission:criar-sindicancia']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\SindicanciaController@show','middleware' => ['permission:ver-sindicancia']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\SindicanciaController@edit','middleware' => ['permission:editar-sindicancia']]);
	Route::put('atualizar/{ref}/{ano}',['as' =>'update','uses'=>'Proc\SindicanciaController@update','middleware' => ['permission:editar-sindicancia']]);
	Route::get('movimentos/{ref}/{ano}',['as' =>'movimentos','uses'=>'Proc\MovimentoController@movimentos','middleware' => ['permission:ver-sindicancia']]);
	Route::get('sobrestamentos/{ref}/{ano}',['as' =>'sobrestamentos','uses'=>'Proc\SobrestamentoController@sobrestamentos','middleware' => ['permission:ver-sindicancia']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\SindicanciaController@destroy','middleware' => ['permission:apagar-sindicancia']]);
});