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
// rotas componente SubForm/ProcedOrigem.vue
Route::group(['as'=>'ligacao.','prefix' =>'ligacao'],function(){
    Route::get('list/{proc}/{ref}/{ano}',['as' =>'index','uses'=>'_Api\SJD\Proc\LigacaoApiController@list']);
    Route::post('store',['as' =>'store','uses'=>'_Api\SJD\Proc\LigacaoApiController@store']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'_Api\SJD\Proc\LigacaoApiController@destroy']);
});
// rotas componente SubForm/Acusado.vue
Route::group(['as'=>'acusado.','prefix' =>'acusado'],function(){
    Route::get('list/{proc}/{id}/{situacao}',['as' =>'index','uses'=>'_Api\SJD\PM\AcusadoApiController@list']);
    Route::post('store',['as' =>'store','uses'=>'_Api\SJD\PM\AcusadoApiController@store']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'_Api\SJD\PM\AcusadoApiController@destroy']);
});
// Route::group(['as'=>'membros.','prefix' =>'membros'],function(){
//     Route::get('list/{proc}/{id}/{situacao}',['as' =>'index','uses'=>'_Api\SJD\PM\MembrosApiController@list']);
//     Route::post('store',['as' =>'store','uses'=>'_Api\SJD\PM\MembrosApiController@store']);
//     Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'_Api\SJD\PM\MembrosApiController@destroy']);
// });
Route::group(['as'=>'vitima.','prefix' =>'vitima'],function(){
    Route::get('list/{proc}/{id}',['as' =>'index','uses'=>'_Api\SJD\PM\VitimaApiController@list']);
    Route::post('store',['as' =>'store','uses'=>'_Api\SJD\PM\VitimaApiController@store']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'_Api\SJD\PM\VitimaApiController@destroy']);
});
Route::group(['as'=>'dados.','prefix' =>'dados'],function(){
    // pegar dados do PM pelo RG
    Route::get('pm/{rg}',['as' =>'pm','uses'=>'_Api\SJD\PM\PMApiController@dados']);
    // pegar cautelas do PM pelo RG
    Route::get('cautelas/{rg}',['as' =>'cautelas','uses'=>'_Api\SJD\PM\PMApiController@cautelas']);
    // pegar dados do Procedimento pelo Nome/ref/ano
    Route::get('proc/{proc}/{ref}/{ano}',['as' =>'proc','uses'=>'_Api\SJD\Proc\ProcApiController@dados']);
    // pegar lista dos Envolvido pelo Proc/id/situacao
    Route::get('envolvido/{proc}/{id}/{situacao?}',['as' =>'envolvido','uses'=>'_Api\SJD\PM\EnvolvidoApiController@list']);
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