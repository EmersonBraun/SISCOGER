<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('acess/rhpr/{name?}', ['as' =>'api.opm','uses'=>'_Api\RHPR\OPMApiController@omsjd']);

Route::group(['as'=>'sjd.','prefix' =>'sjd'],function(){
    Route::group(['as'=>'proc.','prefix' =>'proc'],function(){
        Route::group(['as'=>'adl.','prefix' =>'adl'],function(){
            Route::get('search/{id}', ['as' =>'api.adl','uses'=>'_Api\SJD\Proc\AdlApiController@find']);
            Route::get('refano/{ref}/{ano}', ['as' =>'api.adlref','uses'=>'_Api\SJD\Proc\AdlApiController@refAno']);
            Route::get('all', ['as' =>'api.adlall','uses'=>'_Api\SJD\Proc\AdlApiController@all']);
            Route::get('ano/{ano}', ['as' =>'api.adlano','uses'=>'_Api\SJD\Proc\AdlApiController@ano']);
            Route::get('andamento', ['as' =>'api.adland','uses'=>'_Api\SJD\Proc\AdlApiController@andamento']);
            Route::get('andamentoano/{ano}', ['as' =>'api.adlandano','uses'=>'_Api\SJD\Proc\AdlApiController@andamentoAno']);
            Route::get('prazos', ['as' =>'api.adlprazo','uses'=>'_Api\SJD\Proc\AdlApiController@prazos']);
            Route::get('prazosano/{ano}', ['as' =>'api.adlprazoano','uses'=>'_Api\SJD\Proc\AdlApiController@prazosAno']);
            Route::get('relsituacao', ['as' =>'api.adlrelsit','uses'=>'_Api\SJD\Proc\AdlApiController@relSituacao']);
            Route::get('relsituacaoano/{ano}', ['as' =>'api.adlrelsituano','uses'=>'_Api\SJD\Proc\AdlApiController@relSituacaoAno']);
            Route::get('julgamento', ['as' =>'api.adljulg','uses'=>'_Api\SJD\Proc\AdlApiController@julgamento']);
            Route::get('julgamentoano/{ano}', ['as' =>'api.adljulgano','uses'=>'_Api\SJD\Proc\AdlApiController@julgamentoAno']);
        });
    });
});
// rotas componente Arquivos/FileUpload.vue
Route::group(['as'=>'fileupload.','prefix' =>'fileupload'],function(){
    Route::post('store',['as' =>'store','uses'=>'_Api\SJD\Proc\FileUploadController@store']);
    Route::get('show/{proc}/{procid}/{arquivo}/{hash}',['as' =>'show','uses'=>'_Api\SJD\Proc\FileUploadController@show']);
    Route::delete('delete/{id}',['as' =>'delete','uses'=>'_Api\SJD\Proc\FileUploadController@delete']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'_Api\SJD\Proc\FileUploadController@destroy']);
    Route::get('list/{proc}/{id}/{arquivo}',['as' =>'index','uses'=>'_Api\SJD\Proc\FileUploadController@index']);
	//Route::post('remover',['as' =>'remover','uses'=>'UploadController@remover']);
});
// rotas componente SubForm/ProcedOrigem.vue
Route::group(['as'=>'ligacao.','prefix' =>'ligacao'],function(){
    Route::get('list/{proc}/{ref}/{ano?}',['as' =>'index.refano','uses'=>'_Api\SJD\Proc\LigacaoApiController@list']);
    Route::post('store',['as' =>'store','uses'=>'_Api\SJD\Proc\LigacaoApiController@store']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'_Api\SJD\Proc\LigacaoApiController@destroy']);
});
// rotas componente SubForm/Acusado.vue
Route::group(['as'=>'acusado.','prefix' =>'acusado'],function(){
    Route::get('list/{proc}/{id}/{situacao}',['as' =>'index','uses'=>'_Api\SJD\PM\AcusadoApiController@list']);
    Route::post('store',['as' =>'store','uses'=>'_Api\SJD\PM\AcusadoApiController@store']);
    Route::post('edit/{id}',['as' =>'edit','uses'=>'_Api\SJD\PM\AcusadoApiController@edit']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'_Api\SJD\PM\AcusadoApiController@destroy']);
});
// rotas componente SubForm/Membros.vue
Route::group(['as'=>'membros.','prefix' =>'membros'],function(){
    Route::get('list/{proc}/{id}/{situacao}',['as' =>'index','uses'=>'_Api\SJD\PM\MembroApiController@list']);
    Route::post('store',['as' =>'store','uses'=>'_Api\SJD\PM\MembroApiController@store']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'_Api\SJD\PM\MembroApiController@destroy']);
});
// rotas componente SubForm/Vitima.vue
Route::group(['as'=>'vitima.','prefix' =>'vitima'],function(){
    Route::get('list/{proc}/{id}',['as' =>'index','uses'=>'_Api\SJD\PM\VitimaApiController@list']);
    Route::post('store',['as' =>'store','uses'=>'_Api\SJD\PM\VitimaApiController@store']);
    Route::post('edit/{id}',['as' =>'edit','uses'=>'_Api\SJD\PM\VitimaApiController@edit']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'_Api\SJD\PM\VitimaApiController@destroy']);
});
// rotas componente SubForm/Movimento.vue
Route::group(['as'=>'movimento.','prefix' =>'movimento'],function(){
    Route::get('list/{proc}/{id}',['as' =>'index','uses'=>'_Api\SJD\Proc\MovimentoApiController@list']);
    Route::post('store',['as' =>'store','uses'=>'_Api\SJD\Proc\MovimentoApiController@store']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'_Api\SJD\Proc\MovimentoApiController@destroy']);
});
// rotas componente SubForm/Sobrestamento.vue
Route::group(['as'=>'sobrestamento.','prefix' =>'sobrestamento'],function(){
    Route::get('list/{proc}/{id}',['as' =>'index','uses'=>'_Api\SJD\Proc\SobrestamentoApiController@list']);
    Route::post('store',['as' =>'store','uses'=>'_Api\SJD\Proc\SobrestamentoApiController@store']);
    Route::post('edit/{id}',['as' =>'edit','uses'=>'_Api\SJD\Proc\SobrestamentoApiController@edit']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'_Api\SJD\Proc\SobrestamentoApiController@destroy']);
});
// rotas componente SubForm/Arquivo.vue
Route::group(['as'=>'arquivo.','prefix' =>'arquivo'],function(){
    Route::get('list/{proc}/{id}',['as' =>'index','uses'=>'_Api\SJD\Proc\ArquivoApiController@list']);
    Route::post('store',['as' =>'store','uses'=>'_Api\SJD\Proc\ArquivoApiController@store']);
    Route::post('edit/{id}',['as' =>'edit','uses'=>'_Api\SJD\Proc\ArquivoApiController@edit']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'_Api\SJD\Proc\ArquivoApiController@destroy']);
});
Route::group(['as'=>'dados.','prefix' =>'dados'],function(){
    // pegar sugestões de RG e NOME
    Route::post('sugest',['as' =>'sugestrg','uses'=>'_Api\SJD\PM\PMApiController@sugest']);
    // pegar dados do PM pelo RG
    Route::get('pm/{rg}',['as' =>'pm','uses'=>'_Api\SJD\PM\PMApiController@dados']);
    // pegar cautelas do PM pelo RG
    Route::get('cautelas/{rg}',['as' =>'cautelas','uses'=>'_Api\SJD\PM\PMApiController@cautelas']);
    // pegar dados do Procedimento pelo Nome/ref/ano
    Route::get('proc/{proc}/{ref}/{ano}',['as' =>'proc','uses'=>'_Api\SJD\Proc\ProcApiController@dados']);
    // pegar lista dos Envolvido pelo Proc/id/situacao
    Route::get('envolvido/{proc}/{id}/{situacao?}',['as' =>'envolvido','uses'=>'_Api\SJD\PM\EnvolvidoApiController@list']);
    // pegar lista dos membros pelo Proc/id/
    Route::get('membros/{proc}/{id}',['as' =>'membros','uses'=>'_Api\SJD\PM\EnvolvidoApiController@membros']);
});
Route::group(['as'=>'proc.','prefix' =>'proc'],function(){
    //para atualizar um campo de um procedimento
    Route::post('update/{proc}/{id}/{campo}',['as' =>'update','uses'=>'_Api\SJD\Proc\ProcApiController@update']);
    Route::get('dadocampo/{proc}/{id}/{campo}',['as' =>'dadocampo','uses'=>'_Api\SJD\Proc\ProcApiController@dadocampo']);
});

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('its', 'ItAPIController');*/