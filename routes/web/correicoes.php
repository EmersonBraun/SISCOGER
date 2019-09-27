<?php
Route::group(['as'=>'correicao.','prefix' =>'correicao'],function(){
    Route::group(['as'=>'ordinaria.','prefix' =>'ordinaria'],function(){
        Route::get('',['as' =>'index','uses'=>'Correicoes\CorreicaoOrdinariaController@index','middleware' => ['permission:listar-correicao-ordinaria']]);
        Route::get('criar',['as' =>'create','uses'=>'Correicoes\CorreicaoOrdinariaController@create','middleware' => ['permission:criar-correicao-ordinaria']]);
        Route::post('salvar',['as' =>'store','uses'=>'Correicoes\CorreicaoOrdinariaController@store','middleware' => ['permission:criar-correicao-ordinaria']]);
        Route::get('editar/{id}',['as' =>'edit','uses'=>'Correicoes\CorreicaoOrdinariaController@edit','middleware' => ['permission:editar-correicao-ordinaria']]);
        Route::put('atualizar/{id}',['as' =>'update','uses'=>'Correicoes\CorreicaoOrdinariaController@update','middleware' => ['permission:editar-correicao-ordinaria']]);
        Route::delete('remover/{id}',['as' =>'destroy','uses'=>'Correicoes\CorreicaoOrdinariaController@destroy','middleware' => ['permission:apagar-correicao-ordinaria']]);
    });
    //Rotas do módulo Correicao extraordinária
    Route::group(['as'=>'extraordinaria.','prefix' =>'extraordinaria'],function(){
        Route::get('',['as' =>'index','uses'=>'Correicoes\CorreicaoExtraordinariaController@index','middleware' => ['permission:listar-correicao-extraordinaria']]);
        Route::get('criar',['as' =>'create','uses'=>'Correicoes\CorreicaoExtraordinariaController@create','middleware' => ['permission:criar-correicao-extraordinaria']]);
        Route::post('salvar',['as' =>'store','uses'=>'Correicoes\CorreicaoExtraordinariaController@store','middleware' => ['permission:criar-correicao-extraordinaria']]);
        Route::get('editar/{id}',['as' =>'edit','uses'=>'Correicoes\CorreicaoExtraordinariaController@edit','middleware' => ['permission:editar-correicao-extraordinaria']]);
        Route::put('atualizar/{id}',['as' =>'update','uses'=>'Correicoes\CorreicaoExtraordinariaController@update','middleware' => ['permission:editar-correicao-extraordinaria']]);
        Route::delete('remover/{id}',['as' =>'destroy','uses'=>'Correicoes\CorreicaoExtraordinariaController@destroy','middleware' => ['permission:apagar-correicao-extraordinaria']]);
    });
});