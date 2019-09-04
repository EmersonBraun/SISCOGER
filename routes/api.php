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

Route::group(['as'=>'fdi.','prefix' =>'fdi'],function(){
    Route::get('dadosGerais/{rg}',['as' =>'dadosGerais','uses'=>'FDI\FDIListController@dadosGerais']);
    Route::get('dadosAdicionais/{rg}',['as' =>'dadosAdicionais','uses'=>'FDI\FDIListController@dadosAdicionais']);
    Route::get('comportamento/{rg}',['as' =>'comportamento','uses'=>'FDI\FDIListController@comportamento']);
    Route::get('preso/{rg}',['as' =>'preso','uses'=>'FDI\FDIListController@preso']);
    Route::get('suspenso/{rg}',['as' =>'suspenso','uses'=>'FDI\FDIListController@suspenso']);
    Route::get('excluido/{rg}',['as' =>'excluido','uses'=>'FDI\FDIListController@excluido']);
    Route::get('subJudice/{rg}',['as' =>'subJudice','uses'=>'FDI\FDIListController@subJudice']);
    Route::get('denunciaCivil/{rg}',['as' =>'denunciaCivil','uses'=>'FDI\FDIListController@denunciaCivil']);
    Route::get('prisoes/{rg}',['as' =>'prisoes','uses'=>'FDI\FDIListController@prisoes']);
    Route::get('restricoes/{rg}',['as' =>'restricoes','uses'=>'FDI\FDIListController@restricoes']);
    Route::get('afastamentos/{rg}',['as' =>'afastamentos','uses'=>'FDI\FDIListController@afastamentos']);
    Route::get('dependentes/{rg}',['as' =>'dependentes','uses'=>'FDI\FDIListController@dependentes']);
    Route::get('sai/{rg}',['as' =>'sai','uses'=>'FDI\FDIListController@sai']);
    Route::get('objetos/{rg}',['as' =>'objetos','uses'=>'FDI\FDIListController@objetos']);
    Route::get('membros/{rg}',['as' =>'membros','uses'=>'FDI\FDIListController@membros']);
    Route::get('comportamentos/{rg}',['as' =>'comportamentos','uses'=>'FDI\FDIListController@comportamentos']);
    Route::get('elogios/{rg}',['as' =>'elogios','uses'=>'FDI\FDIListController@elogios']);
    Route::get('punicoes/{rg}',['as' =>'punicoes','uses'=>'FDI\FDIListController@punicoes']);
    Route::get('tramitacao/{rg}',['as' =>'tramitacao','uses'=>'FDI\FDIListController@tramitacao']);
    Route::get('tramitacaoopm/{rg}',['as' =>'tramitacaoopm','uses'=>'FDI\FDIListController@tramitacaoopm']);
    Route::get('apresentacoes/{rg}',['as' =>'apresentacoes','uses'=>'FDI\FDIListController@apresentacoes']);
    Route::get('procOutros/{rg}',['as' =>'procOutros','uses'=>'FDI\FDIListController@procOutros']);
    Route::get('log/{rg}',['as' =>'log','uses'=>'FDI\FDIListController@log']);
    // pegar cautelas do PM pelo RG
    Route::get('cautelas/{rg}',['as' =>'cautelas','uses'=>'FDI\FDIListController@@cautelas']);
    Route::group(['as'=>'protocolo.','prefix' =>'protocolo'],function(){
        Route::get('list/{rg}',['as' =>'list','uses'=>'Policiais\ProtocoloController@list']);
        Route::post('store',['as' =>'store','uses'=>'Policiais\ProtocoloController@store']);
        Route::delete('delete/{id}',['as' =>'delete','uses'=>'Policiais\ProtocoloController@delete']);
        Route::get('list/{proc}/{id}/{arquivo}',['as' =>'index','uses'=>'Policiais\ProtocoloController@index']);
        //Route::post('remover',['as' =>'remover','uses'=>'UploadController@remover']);
    });

});
// rotas componente Arquivos/FileUpload.vue
Route::group(['as'=>'fileupload.','prefix' =>'fileupload'],function(){
    Route::post('store',['as' =>'store','uses'=>'FileUpload\FileUploadController@store']);
    Route::get('show/{proc}/{procid}/{arquivo}/{hash}',['as' =>'show','uses'=>'FileUpload\FileUploadController@show']);
    Route::delete('delete/{id}',['as' =>'delete','uses'=>'FileUpload\FileUploadController@delete']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'FileUpload\FileUploadController@destroy']);
    Route::get('list/{proc}/{id}/{arquivo}',['as' =>'index','uses'=>'FileUpload\FileUploadController@index']);
	//Route::post('remover',['as' =>'remover','uses'=>'UploadController@remover']);
});
// rotas componente SubForm/ProcedOrigem.vue
Route::group(['as'=>'ligacao.','prefix' =>'ligacao'],function(){
    Route::get('list/{proc}/{ref}/{ano?}',['as' =>'index.refano','uses'=>'Subform\LigacaoApiController@list']);
    Route::post('store',['as' =>'store','uses'=>'Subform\LigacaoApiController@store']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Subform\LigacaoApiController@destroy']);
});
// rotas componente SubForm/Acusado.vue
Route::group(['as'=>'acusado.','prefix' =>'acusado'],function(){
    Route::get('list/{proc}/{id}/{situacao}',['as' =>'index','uses'=>'Subform\AcusadoApiController@list']);
    Route::post('store',['as' =>'store','uses'=>'Subform\AcusadoApiController@store']);
    Route::post('edit/{id}',['as' =>'edit','uses'=>'Subform\AcusadoApiController@edit']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Subform\AcusadoApiController@destroy']);
});
// rotas componente SubForm/Membros.vue
Route::group(['as'=>'membros.','prefix' =>'membros'],function(){
    Route::get('list/{proc}/{id}/{situacao}',['as' =>'index','uses'=>'Subform\MembroApiController@list']);
    Route::post('store',['as' =>'store','uses'=>'Subform\MembroApiController@store']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Subform\MembroApiController@destroy']);
});
// rotas componente SubForm/Vitima.vue
Route::group(['as'=>'vitima.','prefix' =>'vitima'],function(){
    Route::get('list/{proc}/{id}',['as' =>'index','uses'=>'Subform\VitimaApiController@list']);
    Route::post('store',['as' =>'store','uses'=>'Subform\VitimaApiController@store']);
    Route::post('edit/{id}',['as' =>'edit','uses'=>'Subform\VitimaApiController@edit']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Subform\VitimaApiController@destroy']);
});
// rotas componente SubForm/Movimento.vue
Route::group(['as'=>'movimento.','prefix' =>'movimento'],function(){
    Route::get('list/{proc}/{id}',['as' =>'index','uses'=>'Subform\MovimentoApiController@list']);
    Route::post('store',['as' =>'store','uses'=>'Subform\MovimentoApiController@store']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Subform\MovimentoApiController@destroy']);
});
// rotas componente SubForm/Sobrestamento.vue
Route::group(['as'=>'sobrestamento.','prefix' =>'sobrestamento'],function(){
    Route::get('list/{proc}/{id}',['as' =>'index','uses'=>'Subform\SobrestamentoApiController@list']);
    Route::post('store',['as' =>'store','uses'=>'Subform\SobrestamentoApiController@store']);
    Route::post('edit/{id}',['as' =>'edit','uses'=>'Subform\SobrestamentoApiController@edit']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Subform\SobrestamentoApiController@destroy']);
});
// rotas componente SubForm/Arquivo.vue
Route::group(['as'=>'arquivo.','prefix' =>'arquivo'],function(){
    Route::get('list/{proc}/{id}',['as' =>'index','uses'=>'Subform\ArquivoApiController@list']);
    Route::post('store',['as' =>'store','uses'=>'Subform\ArquivoApiController@store']);
    Route::post('edit/{id}',['as' =>'edit','uses'=>'Subform\ArquivoApiController@edit']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Subform\ArquivoApiController@destroy']);
});

Route::group(['as'=>'dados.','prefix' =>'dados'],function(){
    // pegar sugestões de RG e NOME
    Route::post('sugest',['as' =>'sugestrg','uses'=>'Subform\PMApiController@sugest']);
    // pegar dados do PM pelo RG
    Route::get('pm/{rg}',['as' =>'pm','uses'=>'Subform\PMApiController@dados']);
    // pegar dados do Procedimento pelo Nome/ref/ano
    Route::get('proc/{proc}/{ref}/{ano}',['as' =>'proc','uses'=>'Subform\ProcApiController@dados']);
    // pegar lista dos Envolvido pelo Proc/id/situacao
    Route::get('envolvido/{proc}/{id}/{situacao?}',['as' =>'envolvido','uses'=>'Subform\EnvolvidoApiController@list']);
    // pegar lista dos membros pelo Proc/id/
    Route::get('membros/{proc}/{id}',['as' =>'membros','uses'=>'Subform\EnvolvidoApiController@membros']);
});
Route::group(['as'=>'proc.','prefix' =>'proc'],function(){
    //para atualizar um campo de um procedimento
    Route::post('update/{proc}/{id}/{campo}',['as' =>'update','uses'=>'Subform\ProcApiController@update']);
    Route::get('dadocampo/{proc}/{id}/{campo}',['as' =>'dadocampo','uses'=>'Subform\ProcApiController@dadocampo']);
});

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('its', 'ItAPIController');*/