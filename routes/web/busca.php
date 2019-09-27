<?php
//Rotas do módulo Busca
Route::group(['as'=>'busca.','prefix' =>'busca'],function(){
    Route::get('pm',['as' =>'pm','uses'=>'Busca\BuscaController@pm']);
	Route::post('fdi',['as' =>'fdi','uses'=>'Busca\BuscaController@fdi']);
	//para trazer via ajax
	Route::post('getpmrg/{rg}',['as' =>'getpmrg','uses'=>'Busca\BuscaController@getpmrg']);
	//função envia rg e traz nome e posto
    Route::post('completadados',['as' =>'completadados','uses'=>'Busca\BuscaController@completadados']);
    // opções de dados para o componente Form/SugestRg
	Route::post('opcoes/nome',['as' =>'opcoesnome','uses'=>'Busca\BuscaController@opcoesnome']);
    Route::post('opcoes/rg',['as' =>'opcoesrg','uses'=>'Busca\BuscaController@opcoesrg']);
    // ofendido
    Route::group(['as'=>'ofendido.','prefix' =>'ofendido'],function(){
        Route::get('',['as' =>'search','uses'=>'Busca\BuscaController@searchOfendido','middleware' => ['permission:buscar-ofendido']]);   
        Route::post('resultado',['as' =>'result','uses'=>'Busca\BuscaController@resultOfendido','middleware' => ['permission:buscar-ofendido']]);   
    });
    // envolvido
    Route::group(['as'=>'envolvido.','prefix' =>'envolvido'],function(){
        Route::get('',['as' =>'search','uses'=>'Busca\BuscaController@searchEnvolvido','middleware' => ['permission:buscar-envolvido']]);   
        Route::post('resultado',['as' =>'result','uses'=>'Busca\BuscaController@resultEnvolvido','middleware' => ['permission:buscar-envolvido']]);   
    });
    // nominal
    Route::group(['as'=>'nominal.','prefix' =>'nominal'],function(){
        Route::get('',['as' =>'search','uses'=>'Busca\BuscaController@searchNominal','middleware' => ['permission:buscar-pm']]);   
        Route::post('resultado',['as' =>'result','uses'=>'Busca\BuscaController@resultNominal','middleware' => ['permission:buscar-pm']]);   
    });
	Route::get('documentacao',['as' =>'documentacao','uses'=>'Busca\BuscaController@documentacao']);
	Route::get('pdf',['as' =>'pdf','uses'=>'Busca\BuscaController@pdf']);
    Route::get('tramitacao/{ano}',['as' =>'tramitacao','uses'=>'Busca\BuscaController@tramitacao']);
    Route::get('tramitacaocoger/{ano}',['as' =>'tramitacaocoger','uses'=>'Busca\BuscaController@tramitacaoCoger']);
});