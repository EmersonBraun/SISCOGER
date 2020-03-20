<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| AsPI Routes
|--------------------------------------------------------------------------
|
| Here is where you can register AsPI routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "aspi" middleware group. Enjoy building your AsPI!
|
*/

// Comportamento
Route::group(['as'=>'comportamento.','prefix' =>'comportamento'],function(){
    Route::get('atual/{rg}',['as' =>'atual','uses'=>'Policiais\ComportamentoController@atual']);
    Route::get('list/{rg}',['as' =>'list','uses'=>'Policiais\ComportamentoController@list']);
    Route::post('store',['as' =>'store','uses'=>'Policiais\ComportamentoController@store']);
    Route::put('update/{id}',['as' =>'update','uses'=>'Policiais\ComportamentoController@update']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Policiais\ComportamentoController@destroy']);
});
// e-protocolo
Route::group(['as'=>'protocolo.','prefix' =>'protocolo'],function(){
    Route::get('list/{rg}',['as' =>'list','uses'=>'Policiais\ProtocoloController@list']);
    Route::post('store',['as' =>'store','uses'=>'Policiais\ProtocoloController@store']);
    Route::put('update/{id}',['as' =>'update','uses'=>'Policiais\ProtocoloController@update']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Policiais\ProtocoloController@destroy']);
});
// Denuncia civil (Outras denúncias do fdi)
Route::group(['as'=>'denuncia.','prefix' =>'denuncia'],function(){
    Route::get('estaDenunciado/{rg}',['as' =>'estaDenunciado','uses'=>'Policiais\DenunciadoController@estaDenunciado']);
    Route::get('list/{rg}',['as' =>'list','uses'=>'Policiais\DenunciadoController@list']);
    Route::post('store',['as' =>'store','uses'=>'Policiais\DenunciadoController@store']);
    Route::put('update/{id}',['as' =>'update','uses'=>'Policiais\DenunciadoController@update']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Policiais\DenunciadoController@destroy']);
});
// Preso
Route::group(['as'=>'preso.','prefix' =>'preso'],function(){
    Route::get('estaPreso/{rg}',['as' =>'estaPreso','uses'=>'Policiais\PresoController@estaPreso']);
    Route::get('list/{rg}',['as' =>'list','uses'=>'Policiais\PresoController@list']);
    Route::post('store',['as' =>'store','uses'=>'Policiais\PresoController@storeAPI']);
    Route::put('update/{id}',['as' =>'update','uses'=>'Policiais\PresoController@updateAPI']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Policiais\PresoController@destroyAPI']);
});
// Restrições
Route::group(['as'=>'restricao.','prefix' =>'restricao'],function(){
    Route::get('restricoes/{rg}',['as' =>'restricoes','uses'=>'Policiais\RestricaoController@restricoes']);
    Route::get('list/{rg}',['as' =>'list','uses'=>'Policiais\RestricaoController@list']);
    Route::post('store',['as' =>'store','uses'=>'Policiais\RestricaoController@storeAPI']);
    Route::put('update/{id}',['as' =>'update','uses'=>'Policiais\RestricaoController@updateAPI']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Policiais\RestricaoController@destroyAPI']);
});
// Elogios
Route::group(['as'=>'elogio.','prefix' =>'elogio'],function(){
    Route::get('list/{rg}',['as' =>'list','uses'=>'Policiais\ElogioController@list']);
    Route::post('store',['as' =>'store','uses'=>'Policiais\ElogioController@store']);
    Route::put('update/{id}',['as' =>'update','uses'=>'Policiais\ElogioController@update']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Policiais\ElogioController@destroy']);
});
// Tramite
Route::group(['as'=>'tramitecoger.','prefix' =>'tramitecoger'],function(){
    Route::get('list/{rg}',['as' =>'list','uses'=>'Policiais\TramitacaoController@list']);
    Route::post('store',['as' =>'store','uses'=>'Policiais\TramitacaoController@store']);
    Route::put('update/{id}',['as' =>'update','uses'=>'Policiais\TramitacaoController@update']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Policiais\TramitacaoController@destroy']);
});
Route::get('tramitacao/{rg}',['as' =>'tramitacao','uses'=>'FDI\FDIListController@tramitacao']);
// Tramiteopm
Route::group(['as'=>'tramiteopm.','prefix' =>'tramiteopm'],function(){
    Route::get('list/{rg}',['as' =>'list','uses'=>'Policiais\TramitacaoopmController@list']);
    Route::post('store',['as' =>'store','uses'=>'Policiais\TramitacaoopmController@store']);
    Route::put('update/{id}',['as' =>'update','uses'=>'Policiais\TramitacaoopmController@update']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Policiais\TramitacaoopmController@destroy']);
});
// Punições
Route::group(['as'=>'punicao.','prefix' =>'punicao'],function(){
    Route::get('list/{rg}',['as' =>'list','uses'=>'Policiais\PunidoController@list']);
    Route::post('store',['as' =>'store','uses'=>'Policiais\PunidoController@storeAPI']);
    Route::put('update/{id}',['as' =>'update','uses'=>'Policiais\PunidoController@updateAPI']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Policiais\PunidoController@destroyAPI']);
});
// medalhas
Route::group(['as'=>'medalha.','prefix' =>'medalha'],function(){
    Route::get('list/{rg}',['as' =>'list','uses'=>'Policiais\MedalhaController@list']);
    Route::post('store',['as' =>'store','uses'=>'Policiais\MedalhaController@storeAPI']);
    Route::put('update/{id}',['as' =>'update','uses'=>'Policiais\MedalhaController@updateAPI']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Policiais\MedalhaController@destroyAPI']);
});

Route::group(['as'=>'fdi.','prefix' =>'fdi'],function(){
    Route::get('dadosGerais/{rg}',['as' =>'dadosGerais','uses'=>'FDI\FDIListController@dadosGerais']);
    Route::get('dadosAdicionais/{rg}',['as' =>'dadosAdicionais','uses'=>'FDI\FDIListController@dadosAdicionais']);
    Route::get('suspenso/{rg}',['as' =>'suspenso','uses'=>'FDI\FDIListController@suspenso']);
    Route::get('excluido/{rg}',['as' =>'excluido','uses'=>'FDI\FDIListController@excluido']);
    Route::get('subJudice/{rg}',['as' =>'subJudice','uses'=>'FDI\FDIListController@subJudice']);
    Route::get('afastamentos/{rg}',['as' =>'afastamentos','uses'=>'FDI\FDIListController@afastamentos']);
    Route::get('dependentes/{rg}',['as' =>'dependentes','uses'=>'FDI\FDIListController@dependentes']);
    Route::get('sai/{rg}',['as' =>'sai','uses'=>'FDI\FDIListController@sai']);
    Route::get('objetos/{rg}',['as' =>'objetos','uses'=>'FDI\FDIListController@objetos']);
    Route::get('objetos2/{rg}',['as' =>'objetos2','uses'=>'FDI\FDIListController@objetos2']);
    Route::get('membros/{rg}',['as' =>'membros','uses'=>'FDI\FDIListController@membros']);
    Route::get('punicoes/{rg}',['as' =>'punicoes','uses'=>'FDI\FDIListController@punicoes']);
    Route::get('apresentacoes/{rg}',['as' =>'apresentacoes','uses'=>'FDI\FDIListController@apresentacoes']);
    Route::get('procOutros/{rg}',['as' =>'procOutros','uses'=>'FDI\FDIListController@procOutros']);
    Route::get('log/{rg}',['as' =>'log','uses'=>'FDI\FDIListController@log']);
    // pegar cautelas do PM pelo RG
    Route::get('cautelas/{rg}',['as' =>'cautelas','uses'=>'FDI\FDIListController@cautelas']);
});
// rotas componente Arquivos/FileUpload.vue
Route::group(['as'=>'fileupload.','prefix' =>'fileupload'],function(){
    Route::post('store',['as' =>'store','uses'=>'FileUpload\FileUploadController@store']);
    Route::get('show/{proc}/{procid}/{arquivo}/{hash}',['as' =>'show','uses'=>'FileUpload\FileUploadController@show']);
    Route::get('download/{id}',['as' =>'download','uses'=>'FileUpload\FileUploadController@download']);
    Route::delete('delete/{id}',['as' =>'delete','uses'=>'FileUpload\FileUploadController@delete']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'FileUpload\FileUploadController@destroy']);
    Route::get('list/{proc}/{id}/{arquivo}',['as' =>'index','uses'=>'FileUpload\FileUploadController@index']);
	//Route::post('remover',['as' =>'remover','uses'=>'UploadController@remover']);
});
// rotas componente SubForm/ProcedOrigem.vue
Route::group(['as'=>'ligacao.','prefix' =>'ligacao'],function(){
    Route::get('list/{proc}/{ref}/{ano?}',['as' =>'index.refano','uses'=>'Subform\LigacaoController@list']);
    Route::post('store',['as' =>'store','uses'=>'Subform\LigacaoController@store']);
    Route::post('update/{id}',['as' =>'update','uses'=>'Subform\LigacaoController@update']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Subform\LigacaoController@destroy']);
});
// rotas componente SubForm/Acusado.vue
Route::group(['as'=>'acusado.','prefix' =>'acusado'],function(){
    Route::get('list/{proc}/{id}/{situacao}',['as' =>'index','uses'=>'Subform\AcusadoController@list']);
    Route::post('store',['as' =>'store','uses'=>'Subform\AcusadoController@store']);
    Route::post('edit/{id}',['as' =>'edit','uses'=>'Subform\AcusadoController@edit']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Subform\AcusadoController@destroy']);
});
// rotas componente SubForm/Membros.vue
Route::group(['as'=>'membros.','prefix' =>'membros'],function(){
    Route::get('list/{proc}/{id}/{situacao}',['as' =>'index','uses'=>'Subform\MembroController@list']);
    Route::post('store',['as' =>'store','uses'=>'Subform\MembroController@store']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Subform\MembroController@destroy']);
});
// rotas componente SubForm/Vitima.vue
Route::group(['as'=>'vitima.','prefix' =>'vitima'],function(){
    Route::get('list/{proc}/{id}',['as' =>'index','uses'=>'Subform\VitimaController@list']);
    Route::post('store',['as' =>'store','uses'=>'Subform\VitimaController@store']);
    Route::post('edit/{id}',['as' =>'edit','uses'=>'Subform\VitimaController@edit']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Subform\VitimaController@destroy']);
});
// rotas componente SubForm/Movimento.vue
Route::group(['as'=>'movimento.','prefix' =>'movimento'],function(){
    Route::get('list/{proc}/{id}',['as' =>'index','uses'=>'Subform\MovimentoController@list']);
    Route::post('store',['as' =>'store','uses'=>'Subform\MovimentoController@store']);
    Route::post('update/{id}',['as' =>'update','uses'=>'Subform\MovimentoController@update']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Subform\MovimentoController@destroy']);
});
// rotas componente SubForm/Sobrestamento.vue
Route::group(['as'=>'sobrestamento.','prefix' =>'sobrestamento'],function(){
    Route::get('list/{proc}/{id}',['as' =>'index','uses'=>'Subform\SobrestamentoController@list']);
    Route::post('store',['as' =>'store','uses'=>'Subform\SobrestamentoController@store']);
    Route::post('edit/{id}',['as' =>'edit','uses'=>'Subform\SobrestamentoController@edit']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Subform\SobrestamentoController@destroy']);
});
// rotas componente SubForm/Arquivo.vue
Route::group(['as'=>'arquivo.','prefix' =>'arquivo'],function(){
    Route::get('list/{proc}/{id}',['as' =>'index','uses'=>'Arquivamento\ArquivamentoController@list']);
    Route::post('store',['as' =>'store','uses'=>'Arquivamento\ArquivamentoController@store']);
    Route::post('edit/{id}',['as' =>'edit','uses'=>'Arquivamento\ArquivamentoController@edit']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Arquivamento\ArquivamentoController@destroy']);
});
// Comando OPM
Route::group(['as'=>'cadastroopm.','prefix' =>'cadastroopm'],function(){
    Route::get('get/{cdopm}',['as' =>'get','uses'=>'Apresentacao\CadastroOPMController@get']);
    Route::post('store',['as' =>'store','uses'=>'Apresentacao\CadastroOPMController@store']);
    Route::put('update/{id}',['as' =>'update','uses'=>'Apresentacao\CadastroOPMController@update']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Apresentacao\CadastroOPMController@destroy']);
});
// Outras autoridades OPM
Route::group(['as'=>'cadastroopmautoridade.','prefix' =>'cadastroopmautoridade'],function(){
    Route::get('list/{id}',['as' =>'get','uses'=>'Apresentacao\CadastroOPMAutoridadeController@get']);
    Route::post('store',['as' =>'store','uses'=>'Apresentacao\CadastroOPMAutoridadeController@store']);
    Route::put('update/{id}',['as' =>'update','uses'=>'Apresentacao\CadastroOPMAutoridadeController@update']);
    Route::delete('destroy/{id}',['as' =>'destroy','uses'=>'Apresentacao\CadastroOPMAutoridadeController@destroy']);
});

// Local de Apresentacao
Route::group(['as'=>'localapresentacao.','prefix' =>'localapresentacao'],function(){
    Route::get('{nome}',['as' =>'search','uses'=>'Apresentacao\LocalController@search']);
});
// Apresentação
Route::group(['as'=>'apresentacao.','prefix' =>'apresentacao'],function(){
    Route::get('listnota/{id}',['as' =>'listNota','uses'=>'Apresentacao\ApresentacaoController@listNota']);
    Route::get('memorandogerar/{id}/{nome}/{funcao}',['as' =>'memorando_generate','uses'=>'Apresentacao\ApresentacaoController@memorando_generate']);
    Route::get('memorando/{id}',['as' =>'getApresentacao','uses'=>'Apresentacao\ApresentacaoController@getApresentacao']);
    Route::post('store',['as' =>'store','uses'=>'Apresentacao\ApresentacaoController@store']);
    Route::put('update/{id}',['as' =>'update','uses'=>'Apresentacao\ApresentacaoController@update']);
    Route::delete('destroyApi/{id}',['as' =>'destroyApi','uses'=>'Apresentacao\ApresentacaoController@destroyApi']);
    Route::get('{ref}/{ano?}',['as' =>'dadosApresentacao','uses'=>'Apresentacao\ApresentacaoController@dadosApresentacao']);
});
Route::group(['as'=>'ipm.','prefix' =>'ipm'],function(){
	Route::post('store',['as' =>'store','uses'=>'Proc\IpmController@store','middleware' => ['permission:criar-ipm']]);
	Route::put('update/{id}',['as' =>'update','uses'=>'Proc\IpmController@update','middleware' => ['permission:editar-ipm']]);
});
// Estatus Policial
Route::group(['as'=>'estatuspm.','prefix' =>'estatuspm'],function(){
    Route::get('operacaoverao',['as' =>'operacaoVerao','uses'=>'Policiais\EstatusController@operacaoVerao']);
    Route::get('{rg}',['as' =>'total','uses'=>'Policiais\EstatusController@total']);
});
// ICO
Route::group(['as'=>'ico.','prefix' =>'ico'],function(){
    Route::get('{funcao}/{dado}',['as' =>'formatacao','uses'=>'Ajuda\ICOController@formatacao']);
});
Route::group(['as'=>'dados.','prefix' =>'dados'],function(){
    // pegar sugestões de RG e NOME -> ativos/inativos/reserva
    Route::post('sugest',['as' =>'sugestrg','uses'=>'Subform\PMController@sugest']);
    // pegar sugestões de RG e NOME -> ativos
    Route::get('showsugest/{type}/{data}',['as' =>'showSugest','uses'=>'Subform\PMController@showSugest']);
    // pegar dados do PM pelo RG
    Route::get('pm/{rg}',['as' =>'pm','uses'=>'Subform\PMController@dados']);
    // pegar dados do Procedimento pelo Nome/ref/ano
    Route::get('proc/{proc}/{ref}/{ano?}',['as' =>'proc','uses'=>'Subform\ProcController@dados']);
    // pegar lista dos Envolvido pelo Proc/id/situacao
    Route::get('envolvido/{proc}/{id}/{situacao?}',['as' =>'envolvido','uses'=>'Subform\EnvolvidoController@list']);
    // pegar lista dos membros pelo Proc/id/
    Route::get('membros/{proc}/{id}',['as' =>'membros','uses'=>'Subform\EnvolvidoController@membros']);
});
Route::group(['as'=>'proc.','prefix' =>'proc'],function(){
    //para atualizar um campo de um procedimento
    Route::post('update/{proc}/{id}/{campo}',['as' =>'update','uses'=>'Subform\ProcController@update']);
    Route::get('dadocampo/{proc}/{id}/{campo}',['as' =>'dadocampo','uses'=>'Subform\ProcController@dadocampo']);
});

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('its', 'ItAPIController');*/