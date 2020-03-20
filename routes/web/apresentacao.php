<?php
//Rotas do módulo Apresentacao
Route::group(['as'=>'apresentacao.','prefix' =>'apresentacao'],function(){
    Route::get('apagados/{ano?}/{cdopm?}',['as' =>'apagados','uses'=>'Apresentacao\ApresentacaoController@apagados','middleware' => ['role:admin']]);
    Route::post('',['as' =>'search','uses'=>'Apresentacao\ApresentacaoController@search','middleware' => ['permission:listar-apresentacao']]);
	Route::get('criar',['as' =>'create','uses'=>'Apresentacao\ApresentacaoController@create','middleware' => ['permission:criar-apresentacao']]);
	Route::get('editar/{ref}/{ano?}',['as' =>'edit','uses'=>'Apresentacao\ApresentacaoController@edit','middleware' => ['permission:editar-apresentacao']]);
    Route::get('memorando/{id}',['as' =>'memorando','uses'=>'Apresentacao\ApresentacaoController@memorando']);
    Route::get('previstas',['as' =>'previstas','uses'=>'Apresentacao\ApresentacaoController@previstas','middleware' => ['permission:listar-apresentacao']]);
    Route::get('list/{ano?}/{mes?}/{cdopm?}',['as' =>'index','uses'=>'Apresentacao\ApresentacaoController@index','middleware' => ['permission:listar-apresentacao']]);
    Route::get('destroy/{id}',['as' =>'destroy','uses'=>'Apresentacao\ApresentacaoController@destroy','middleware' => ['permission:apagar-apresentacao']]);
    Route::get('restore/{id}',['as' =>'restore','uses'=>'Apresentacao\ApresentacaoController@restore','middleware' => ['role:admin']]);
    Route::get('forceDelete/{id}',['as' =>'forceDelete','uses'=>'Apresentacao\ApresentacaoController@forceDelete','middleware' => ['role:admin']]);
});
//Rotas do módulo Memorando
Route::group(['as'=>'memorando.','prefix' =>'memorando'],function(){
	Route::get('',['as' =>'index','uses'=>'Apresentacao\MemorandoController@index','middleware' => ['permission:listar-memorando-apresentacao']]);
	Route::get('criar',['as' =>'create','uses'=>'Apresentacao\MemorandoController@create','middleware' => ['permission:criar-memorando-apresentacao']]);
	// Route::post('salvar',['as' =>'store','uses'=>'Apresentacao\MemorandoController@store','middleware' => ['permission:criar-memorando-apresentacao']]);
	// Route::get('editar/{id}',['as' =>'edit','uses'=>'Apresentacao\MemorandoController@edit','middleware' => ['permission:editar-memorando-apresentacao']]);
	// Route::put('atualizar/{id}',['as' =>'update','uses'=>'Apresentacao\MemorandoController@update','middleware' => ['permission:editar-memorando-apresentacao']]);
	// Route::delete('remover/{id}',['as' =>'destroy','uses'=>'Apresentacao\MemorandoController@destroy','middleware' => ['permission:apagar-memorando-apresentacao']]);
});
//Rotas do módulo Locais de apresentação
Route::group(['as'=>'local.','prefix' =>'local'],function(){
    Route::get('',['as' =>'index','uses'=>'Apresentacao\LocalController@index','middleware' => ['permission:listar-locais']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Apresentacao\LocalController@apagados','middleware' => ['permission:listar-locais']]);
	Route::get('criar',['as' =>'create','uses'=>'Apresentacao\LocalController@create','middleware' => ['permission:criar-locais']]);
	Route::post('salvar',['as' =>'store','uses'=>'Apresentacao\LocalController@store','middleware' => ['permission:criar-locais']]);
	Route::get('editar/{id}',['as' =>'edit','uses'=>'Apresentacao\LocalController@edit','middleware' => ['permission:editar-locais']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Apresentacao\LocalController@update','middleware' => ['permission:editar-locais']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Apresentacao\LocalController@destroy','middleware' => ['permission:apagar-locais']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Apresentacao\LocalController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Apresentacao\LocalController@forceDelete','middleware' => ['role:admin']]);
});
//Rotas do módulo NotaCoger
Route::group(['as'=>'notacoger.','prefix' =>'notacoger'],function(){
    Route::get('lista/{ano?}',['as' =>'index','uses'=>'Apresentacao\NotaCogerController@index','middleware' => ['permission:listar-notas-coger']]);
    Route::get('apagados/{ano?}',['as' =>'apagados','uses'=>'Apresentacao\NotaCogerController@apagados','middleware' => ['role:admin']]);
	Route::get('criar',['as' =>'create','uses'=>'Apresentacao\NotaCogerController@create','middleware' => ['permission:criar-notas-coger']]);
	Route::post('salvar',['as' =>'store','uses'=>'Apresentacao\NotaCogerController@store','middleware' => ['permission:criar-notas-coger']]);
	Route::get('editar/{ref}/{ano?}',['as' =>'edit','uses'=>'Apresentacao\NotaCogerController@edit','middleware' => ['permission:editar-notas-coger']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Apresentacao\NotaCogerController@update','middleware' => ['permission:editar-notas-coger']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Apresentacao\NotaCogerController@destroy','middleware' => ['permission:apagar-notas-coger']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Apresentacao\NotaCogerController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Apresentacao\NotaCogerController@forceDelete','middleware' => ['role:admin']]);
});
//Rotas do módulo email
Route::group(['as'=>'email.','prefix' =>'email'],function(){
    Route::get('',['as' =>'index','uses'=>'Apresentacao\EmailController@index','middleware' => ['permission:listar-notas-coger']]);
	// Route::get('criar',['as' =>'create','uses'=>'Apresentacao\EmailController@create','middleware' => ['permission:criar-notas-coger']]);
	// Route::post('salvar',['as' =>'store','uses'=>'Apresentacao\EmailController@store','middleware' => ['permission:criar-notas-coger']]);
	// Route::get('editar/{ref}/{ano?}',['as' =>'edit','uses'=>'Apresentacao\EmailController@edit','middleware' => ['permission:editar-notas-coger']]);
	// Route::put('atualizar/{id}',['as' =>'update','uses'=>'Apresentacao\EmailController@update','middleware' => ['permission:editar-notas-coger']]);
	// Route::get('remover/{id}',['as' =>'destroy','uses'=>'Apresentacao\EmailController@destroy','middleware' => ['permission:apagar-notas-coger']]);
});
//Rotas do módulo autoridade OM
Route::group(['as'=>'autoridadeom.','prefix' =>'autoridadeom','middleware' => ['permission:listar-dados-unidade']],function(){
    Route::get('comando',['as' =>'comando','uses'=>'Apresentacao\DadosOmController@comando']);
    Route::get('outras',['as' =>'outras','uses'=>'Apresentacao\DadosOmController@outras']);
    Route::get('formulario',['as' =>'form','uses'=>'Apresentacao\DadosOmController@form','middleware' => ['permission:editar-dados-unidade']]);
});