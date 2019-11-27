<?php
// armas
// NÃO IMPLEMENTADO AINDA
// Route::group(['as'=>'arma.','prefix' =>'arma'],function(){
// 	Route::get('',['as' =>'index','uses'=>'Relatorios\ArmaController@index','middleware' => ['permission:listar-armas']]);
// 	Route::get('criar',['as' =>'create','uses'=>'Relatorios\ArmaController@create','middleware' => ['permission:criar-armas']]);
// 	Route::post('salvar',['as' =>'store','uses'=>'Relatorios\ArmaController@store','middleware' => ['permission:criar-armas']]);
// 	Route::get('editar/{id}',['as' =>'edit','uses'=>'Relatorios\ArmaController@edit','middleware' => ['permission:editar-armas']]);
// 	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Relatorios\ArmaController@update','middleware' => ['permission:editar-armas']]);
// 	Route::delete('remover/{id}',['as' =>'destroy','uses'=>'Relatorios\ArmaController@destroy','middleware' => ['permission:apagar-armas']]);
// });
// pendências
Route::group(['as'=>'pendencia.','prefix' =>'pendencia'],function(){
	Route::get('trocaropm', ['as' =>'trocaropm','uses'=>'Relatorios\PendenciaController@trocaropm', 'middleware' => ['permission:todas-unidades']]);
	Route::post('homeoutraom', ['as' =>'homeoutraom','uses'=>'Relatorios\PendenciaController@homeOutraOM', 'middleware' => ['permission:todas-unidades']]);

	Route::get('gerais',['as' =>'gerais','uses'=>'Relatorios\PendenciaController@geral','middleware' => ['permission:listar-relatorio-geral']]);
	Route::get('graficos',['as' =>'graficos','uses'=>'Relatorios\PendenciaController@graficos','middleware' => ['permission:listar-relatorio-geral']]);
	Route::get('comportamento',['as' =>'comportamento','uses'=>'Relatorios\PendenciaController@comportamento','middleware' => ['permission:listar-relatorio-comportamento']]);
	Route::get('punicoes',['as' =>'punicoes','uses'=>'Relatorios\PendenciaController@punicoes','middleware' => ['permission:listar-relatorio-punicoes']]);
	Route::get('quantidade',['as' =>'quantidade','uses'=>'Relatorios\PendenciaController@quantidade','middleware' => ['permission:listar-relatorio-quantidade']]);
	Route::get('sobrestamentos',['as' =>'sobrestamentos','uses'=>'Relatorios\PendenciaController@sobrestamentos','middleware' => ['permission:listar-relatorio-sobrestamentos']]);
});

Route::group(['as'=>'relatorio.','prefix' =>'relatorio'],function(){
    Route::get('prioritarios/{proc}',['as' =>'prioritarios','uses'=>'Relatorios\PrioritarioController@index','middleware' => ['permission:listar-relatorio-prioritarios']]);
    Route::get('sobrestamento/{proc}',['as' =>'sobrestamento','uses'=>'Relatorios\SobrestamentoController@index','middleware' => ['permission:listar-relatorio-sobrestamentos']]);
    // encarregado
    Route::group(['as'=>'encarregado.','prefix' =>'encarregado'],function(){
        Route::get('busca',['as' =>'search','uses'=>'Relatorios\RelatorioController@searchEncarregado','middleware' => ['permission:listar-relatorio-encarregados']]);   
        Route::post('resultado',['as' =>'result','uses'=>'Relatorios\RelatorioController@resultEncarregado','middleware' => ['permission:listar-relatorio-encarregados']]);   
    });
    // ofendido
    Route::group(['as'=>'ofendido.','prefix' =>'ofendido'],function(){
        Route::get('busca',['as' =>'search','uses'=>'Relatorios\RelatorioController@searchOfendido','middleware' => ['permission:listar-relatorio-ofendidos']]);   
        Route::post('resultado',['as' =>'result','uses'=>'Relatorios\RelatorioController@resultOfendido','middleware' => ['permission:listar-relatorio-ofendidos']]);   
    });
    Route::get('defensor',['as' =>'defensor','uses'=>'Relatorios\RelatorioController@defensor','middleware' => ['permission:listar-relatorio-defensores']]);
    Route::get('abuso',['as' =>'abuso','uses'=>'Relatorios\RelatorioController@abuso']);
    Route::get('violenciadomestica',['as' =>'violenciadomestica','uses'=>'Relatorios\RelatorioController@violenciadomestica']);
    Route::get('protocolo',['as' =>'protocolo','uses'=>'Policiais\ProtocoloController@index']);
});
// processo
Route::group(['as'=>'processo.','prefix' =>'processo'],function(){
    Route::get('busca',['as' =>'search','uses'=>'Relatorios\ProcessoController@search','middleware' => ['permission:listar-relatorio-processos']]);   
    Route::post('resultado',['as' =>'result','uses'=>'Relatorios\ProcessoController@result','middleware' => ['permission:listar-relatorio-processos']]);   
});
// Relatório quantitativo por posto/graduação
Route::group(['as'=>'postograd.','prefix' =>'postograd'],function(){
    Route::get('busca',['as' =>'search','uses'=>'Relatorios\PostoGradController@search','middleware' => ['permission:listar-relatorio-postograd']]);   
    Route::post('resultado',['as' =>'result','uses'=>'Relatorios\PostoGradController@result','middleware' => ['permission:listar-relatorio-postograd']]);   
});