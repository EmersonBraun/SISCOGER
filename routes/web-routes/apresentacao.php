<?php
//Rotas do módulo Apresentacao
Route::group(['as'=>'apresentacao.','prefix' =>'apresentacao'],function(){
	Route::get('',['as' =>'index','uses'=>'Apresentacao\ApresentacaoController@index','middleware' => ['permission:listar-apresentacao']]);
	Route::get('criar',['as' =>'create','uses'=>'Apresentacao\ApresentacaoController@create','middleware' => ['permission:criar-apresentacao']]);
	Route::post('salvar',['as' =>'store','uses'=>'Apresentacao\ApresentacaoController@store','middleware' => ['permission:criar-apresentacao']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Apresentacao\ApresentacaoController@edit','middleware' => ['permission:editar-apresentacao']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Apresentacao\ApresentacaoController@update','middleware' => ['permission:editar-apresentacao']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Apresentacao\ApresentacaoController@destroy','middleware' => ['permission:apagar-apresentacao']]);
	Route::get('buscar',['as' =>'buscar','uses'=>'Apresentacao\ApresentacaoController@buscar','middleware' => ['permission:listar-apresentacao']]);
});

//Rotas do módulo Excel
Route::group(['as'=>'excel.','prefix' =>'excel'],function(){
	Route::get('',['as' =>'index','uses'=>'Apresentacao\ExcelController@index','middleware' => ['permission:listar-excel']]);
	Route::get('criar',['as' =>'create','uses'=>'Apresentacao\ExcelController@create','middleware' => ['permission:criar-excel']]);
	Route::post('salvar',['as' =>'store','uses'=>'Apresentacao\ExcelController@store','middleware' => ['permission:criar-excel']]);
});

//Rotas do módulo Memorando
Route::group(['as'=>'memorando.','prefix' =>'memorando'],function(){
	Route::get('',['as' =>'index','uses'=>'Apresentacao\MemorandoController@index','middleware' => ['permission:listar-memorando-apresentacao']]);
	Route::get('criar',['as' =>'create','uses'=>'Apresentacao\MemorandoController@create','middleware' => ['permission:criar-memorando-apresentacao']]);
	Route::post('salvar',['as' =>'store','uses'=>'Apresentacao\MemorandoController@store','middleware' => ['permission:criar-memorando-apresentacao']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Apresentacao\MemorandoController@edit','middleware' => ['permission:editar-memorando-apresentacao']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Apresentacao\MemorandoController@update','middleware' => ['permission:editar-memorando-apresentacao']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Apresentacao\MemorandoController@destroy','middleware' => ['permission:apagar-memorando-apresentacao']]);
});

//Rotas do módulo Locais de apresentação
Route::group(['as'=>'locais.','prefix' =>'locais','middleware' => ['permission:']],function(){
	Route::get('',['as' =>'index','uses'=>'Apresentacao\LocaisController@index','middleware' => ['permission:listar-locais']]);
	Route::get('criar',['as' =>'create','uses'=>'Apresentacao\LocaisController@create','middleware' => ['permission:criar-locais']]);
	Route::post('salvar',['as' =>'store','uses'=>'Apresentacao\LocaisController@store','middleware' => ['permission:criar-locais']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Apresentacao\LocaisController@edit','middleware' => ['permission:editar-locais']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Apresentacao\LocaisController@update','middleware' => ['permission:editar-locais']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Apresentacao\LocaisController@destroy','middleware' => ['permission:apagar-locais']]);
});

//Rotas do módulo NotaCoger
Route::group(['as'=>'notacoger.','prefix' =>'notacoger'],function(){
	Route::get('',['as' =>'index','uses'=>'Apresentacao\NotaCogerController@index','middleware' => ['permission:listar-notas-coger']]);
	Route::get('criar',['as' =>'create','uses'=>'Apresentacao\NotaCogerController@create','middleware' => ['permission:criar-notas-coger']]);
	Route::post('salvar',['as' =>'store','uses'=>'Apresentacao\NotaCogerController@store','middleware' => ['permission:criar-notas-coger']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Apresentacao\NotaCogerController@edit','middleware' => ['permission:editar-notas-coger']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Apresentacao\NotaCogerController@update','middleware' => ['permission:editar-notas-coger']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Apresentacao\NotaCogerController@destroy','middleware' => ['permission:apagar-notas-coger']]);
});