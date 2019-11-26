<?php
//Rotas do módulo medalhas
Route::group(['as'=>'medalha.','prefix' =>'medalha'],function(){
	Route::get('',['as' =>'index','uses'=>'Policiais\MedalhaController@index','middleware' => ['permission:listar-medalhas']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Policiais\MedalhaController@apagados','middleware' => ['role:admin']]);
    Route::get('criar',['as' =>'create','uses'=>'Policiais\MedalhaController@create','middleware' => ['permission:criar-medalhas']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\MedalhaController@store','middleware' => ['permission:criar-medalhas']]);
	Route::get('editar/{id}',['as' =>'edit','uses'=>'Policiais\MedalhaController@edit','middleware' => ['permission:editar-medalhas']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Policiais\MedalhaController@update','middleware' => ['permission:editar-medalhas']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Policiais\MedalhaController@destroy','middleware' => ['permission:apagar-medalhas']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Policiais\MedalhaController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Policiais\MedalhaController@forceDelete','middleware' => ['role:admin']]);
});
//Rotas do módulo elogio
Route::group(['as'=>'elogio.','prefix' =>'elogio'],function(){
	Route::get('busca',['as' =>'index','uses'=>'Policiais\ElogioController@index','middleware' => ['permission:listar-elogios']]);
    Route::post('resultado',['as' =>'search','uses'=>'Policiais\ElogioController@search','middleware' => ['permission:listar-elogios']]);
    Route::get('criar',['as' =>'create','uses'=>'Policiais\ElogioController@create','middleware' => ['permission:criar-elogios']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\ElogioController@store','middleware' => ['permission:criar-elogios']]);
	Route::get('editar/{id}',['as' =>'edit','uses'=>'Policiais\ElogioController@edit','middleware' => ['permission:editar-elogios']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Policiais\ElogioController@update','middleware' => ['permission:editar-elogios']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Policiais\ElogioController@destroy','middleware' => ['permission:apagar-elogios']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Policiais\ElogioController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Policiais\ElogioController@forceDelete','middleware' => ['role:admin']]);
});
//Rotas do módulo Excluidos
Route::group(['as'=>'excluido.','prefix' =>'excluido'],function(){
    Route::get('conselho',['as' =>'conselho','uses'=>'Policiais\ExcluidoController@conselho','middleware' => ['permission:listar-exclusao']]);
    Route::get('judicial',['as' =>'judicial','uses'=>'Policiais\ExcluidoController@judicial','middleware' => ['permission:listar-exclusao']]);
    
    Route::get('criar',['as' =>'create','uses'=>'Policiais\ExcluidoController@create','middleware' => ['permission:criar-excluidos']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\ExcluidoController@store','middleware' => ['permission:criar-excluidos']]);
	Route::get('editar/{id}',['as' =>'edit','uses'=>'Policiais\ExcluidoController@edit','middleware' => ['permission:editar-excluidos']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Policiais\ExcluidoController@update','middleware' => ['permission:editar-excluidos']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Policiais\ExcluidoController@destroy','middleware' => ['permission:apagar-excluidos']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Policiais\ExcluidoController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Policiais\ExcluidoController@forceDelete','middleware' => ['role:admin']]);
});
//Rotas do módulo punidos 
Route::group(['as'=>'punido.','prefix' =>'punido'],function(){
    Route::get('conselho',['as' =>'conselho','uses'=>'Policiais\PunidoController@conselho','middleware' => ['permission:listar-punidos']]);
    Route::get('{proc?}',['as' =>'index','uses'=>'Policiais\PunidoController@index','middleware' => ['permission:listar-punidos']]);
	Route::get('criar',['as' =>'create','uses'=>'Policiais\PunidoController@create','middleware' => ['permission:criar-punidos']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\PunidoController@store','middleware' => ['permission:criar-punidos']]);
	Route::get('editar/{id}',['as' =>'edit','uses'=>'Policiais\PunidoController@edit','middleware' => ['permission:editar-punidos']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Policiais\PunidoController@update','middleware' => ['permission:editar-punidos']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Policiais\PunidoController@destroy','middleware' => ['permission:apagar-punidos']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Policiais\PunidoController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Policiais\PunidoController@forceDelete','middleware' => ['role:admin']]);
});
//Rotas do módulo Reintegrados
Route::group(['as'=>'reintegrado.','prefix' =>'reintegrado'],function(){
    Route::get('',['as' =>'index','uses'=>'Policiais\ReintegradoController@index','middleware' => ['permission:listar-reintegrados']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Policiais\ReintegradoController@apagados','middleware' => ['role:admin']]);
	Route::get('criar',['as' =>'create','uses'=>'Policiais\ReintegradoController@create','middleware' => ['permission:criar-reintegrados']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\ReintegradoController@store','middleware' => ['permission:criar-reintegrados']]);
	Route::get('editar/{id}',['as' =>'edit','uses'=>'Policiais\ReintegradoController@edit','middleware' => ['permission:editar-reintegrados']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Policiais\ReintegradoController@update','middleware' => ['permission:editar-reintegrados']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Policiais\ReintegradoController@destroy','middleware' => ['permission:apagar-reintegrados']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Policiais\ReintegradoController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Policiais\ReintegradoController@forceDelete','middleware' => ['role:admin']]);
});
//Rotas do módulo denunciados 
Route::group(['as'=>'denunciado.','prefix' =>'denunciado'],function(){
	Route::get('',['as' =>'index','uses'=>'Policiais\DenunciadoController@index','middleware' => ['permission:listar-denunciados']]);
	Route::get('denunciados',['as' =>'denunciados','uses'=>'Policiais\DenunciadoController@listaDenunciados','middleware' => ['permission:listar-denunciados']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Policiais\DenunciadoController@apagados','middleware' => ['role:admin']]);
	Route::get('criar',['as' =>'create','uses'=>'Policiais\DenunciadoController@create','middleware' => ['permission:criar-denunciados']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\DenunciadoController@store','middleware' => ['permission:criar-denunciados']]);
	Route::get('editar/{id}',['as' =>'edit','uses'=>'Policiais\DenunciadoController@edit','middleware' => ['permission:editar-denunciados']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Policiais\DenunciadoController@update','middleware' => ['permission:editar-denunciados']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Policiais\DenunciadoController@destroy','middleware' => ['permission:apagar-denunciados']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Policiais\DenunciadoController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Policiais\DenunciadoController@forceDelete','middleware' => ['role:admin']]);
}); 
//Rotas do módulo Presos
Route::group(['as'=>'preso.','prefix' =>'preso'],function(){
    Route::get('',['as' =>'index','uses'=>'Policiais\PresoController@index','middleware' => ['permission:listar-presos']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Policiais\PresoController@apagados','middleware' => ['role:admin']]);
	Route::get('criar',['as' =>'create','uses'=>'Policiais\PresoController@create','middleware' => ['permission:criar-presos']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\PresoController@store','middleware' => ['permission:criar-presos']]);
	Route::get('editar/{id}',['as' =>'edit','uses'=>'Policiais\PresoController@edit','middleware' => ['permission:editar-presos']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Policiais\PresoController@update','middleware' => ['permission:editar-presos']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Policiais\PresoController@destroy','middleware' => ['permission:apagar-presos']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Policiais\PresoController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Policiais\PresoController@forceDelete','middleware' => ['role:admin']]);
});
//Rotas do módulo Presos outros
Route::group(['as'=>'presooutro.','prefix' =>'presooutro'],function(){
    Route::get('',['as' =>'index','uses'=>'Policiais\PresoOutroController@index','middleware' => ['permission:listar-presos-outros']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Policiais\PresoOutroController@apagados','middleware' => ['role:admin']]);
	Route::get('criar',['as' =>'create','uses'=>'Policiais\PresoOutroController@create','middleware' => ['permission:criar-presos-outros']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\PresoOutroController@store','middleware' => ['permission:criar-presos-outros']]);
	Route::get('editar/{id}',['as' =>'edit','uses'=>'Policiais\PresoOutroController@edit','middleware' => ['permission:editar-presos-outros']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Policiais\PresoOutroController@update','middleware' => ['permission:editar-presos-outros']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Policiais\PresoOutroController@destroy','middleware' => ['permission:apagar-presos-outros']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Policiais\PresoOutroController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Policiais\PresoOutroController@forceDelete','middleware' => ['role:admin']]);
});
// //Rotas do módulo procedimento 
// NÃO IMPLEMENTADO AINDA
// Route::group(['as'=>'procedimento.','prefix' =>'procedimento'],function(){
//     Route::get('',['as' =>'index','uses'=>'Policiais\ProcedimentoController@index','middleware' => ['permission:listar-procedimentos']]);
//     Route::get('apagados',['as' =>'apagados','uses'=>'Policiais\ProcedimentoController@apagados','middleware' => ['role:admin']]);
// 	Route::get('criar',['as' =>'create','uses'=>'Policiais\ProcedimentoController@create','middleware' => ['permission:criar-procedimentos']]);
// 	Route::post('salvar',['as' =>'store','uses'=>'Policiais\ProcedimentoController@store','middleware' => ['permission:criar-procedimentos']]);
// 	Route::get('editar/{id}',['as' =>'edit','uses'=>'Policiais\ProcedimentoController@edit','middleware' => ['permission:editar-procedimentos']]);
// 	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Policiais\ProcedimentoController@update','middleware' => ['permission:editar-procedimentos']]);
//     Route::get('remover/{id}',['as' =>'destroy','uses'=>'Policiais\ProcedimentoController@destroy','middleware' => ['permission:apagar-procedimentos']]);
//     Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Policiais\ProcedimentoController@restore','middleware' => ['role:admin']]);
//     Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Policiais\ProcedimentoController@forceDelete','middleware' => ['role:admin']]);
// }); 
//Rotas do módulo comportamento 
Route::group(['as'=>'comportamento.','prefix' =>'comportamento'],function(){
    Route::get('{posto}/{parte?}',['as' =>'index','uses'=>'Policiais\ComportamentoController@index','middleware' => ['permission:listar-comportamentos']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Policiais\ComportamentoController@apagados','middleware' => ['role:admin']]);
    Route::get('criar',['as' =>'create','uses'=>'Policiais\ComportamentoController@create','middleware' => ['permission:criar-comportamento']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\ComportamentoController@store','middleware' => ['permission:criar-comportamento']]);
	Route::get('editar/{id}',['as' =>'edit','uses'=>'Policiais\ComportamentoController@edit','middleware' => ['permission:editar-comportamento']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Policiais\ComportamentoController@update','middleware' => ['permission:editar-comportamento']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Policiais\ComportamentoController@destroy','middleware' => ['permission:apagar-comportamento']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Policiais\ComportamentoController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Policiais\ComportamentoController@forceDelete','middleware' => ['role:admin']]);
}); 
//Rotas do módulo respondendo 
Route::group(['as'=>'respondendo.','prefix' =>'respondendo'],function(){
    Route::get('',['as' =>'index','uses'=>'Policiais\RespondendoController@index','middleware' => ['permission:listar-respondendo']]);
    Route::post('busca',['as' =>'search','uses'=>'Policiais\RespondendoController@search','middleware' => ['permission:listar-respondendo']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Policiais\RespondendoController@apagados','middleware' => ['role:admin']]);
	Route::get('criar',['as' =>'create','uses'=>'Policiais\RespondendoController@create','middleware' => ['permission:criar-respondendo']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\RespondendoController@store','middleware' => ['permission:criar-respondendo']]);
	Route::get('editar/{id}',['as' =>'edit','uses'=>'Policiais\RespondendoController@edit','middleware' => ['permission:editar-respondendo']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Policiais\RespondendoController@update','middleware' => ['permission:editar-respondendo']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Policiais\RespondendoController@destroy','middleware' => ['permission:apagar-respondendo']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Policiais\RespondendoController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Policiais\RespondendoController@forceDelete','middleware' => ['role:admin']]);
}); 
//Rotas do módulo restricoes 
Route::group(['as'=>'restricao.','prefix' =>'restricao'],function(){
	Route::get('lista/{ano?}',['as' =>'index','uses'=>'Policiais\RestricaoController@index','middleware' => ['permission:listar-restricoes']]);
	Route::get('criar',['as' =>'create','uses'=>'Policiais\RestricaoController@create','middleware' => ['permission:criar-restricoes']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\RestricaoController@store','middleware' => ['permission:criar-restricoes']]);
	Route::get('editar/{id}',['as' =>'edit','uses'=>'Policiais\RestricaoController@edit','middleware' => ['permission:editar-restricoes']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Policiais\RestricaoController@update','middleware' => ['permission:editar-restricoes']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Policiais\RestricaoController@destroy','middleware' => ['permission:apagar-restricoes']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Policiais\RestricaoController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Policiais\RestricaoController@forceDelete','middleware' => ['role:admin']]);
});
//Rotas do módulo Suspensos
Route::group(['as'=>'suspenso.','prefix' =>'suspenso'],function(){
    Route::get('',['as' =>'index','uses'=>'Policiais\SuspensoController@index','middleware' => ['permission:listar-suspensos']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Policiais\SuspensoController@apagados','middleware' => ['role:admin']]);
    Route::get('criar',['as' =>'create','uses'=>'Policiais\SuspensoController@create','middleware' => ['permission:criar-suspensos']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\SuspensoController@store','middleware' => ['permission:criar-suspensos']]);
	Route::get('editar/{id}',['as' =>'edit','uses'=>'Policiais\SuspensoController@edit','middleware' => ['permission:editar-suspensos']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Policiais\SuspensoController@update','middleware' => ['permission:editar-suspensos']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Policiais\SuspensoController@destroy','middleware' => ['permission:apagar-suspensos']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Policiais\SuspensoController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Policiais\SuspensoController@forceDelete','middleware' => ['role:admin']]);
});
//Rotas do módulo ObitosLesoes
Route::group(['as'=>'obitolesao.','prefix' =>'falecimento'],function(){
    Route::get('',['as' =>'index','uses'=>'Policiais\ObitoLesaoController@index','middleware' => ['permission:listar-obitos-lesoes']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Policiais\ObitoLesaoController@apagados','middleware' => ['role:admin']]);
    Route::get('criar',['as' =>'create','uses'=>'Policiais\ObitoLesaoController@create','middleware' => ['permission:criar-obitos-lesoes']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\ObitoLesaoController@store','middleware' => ['permission:criar-obitos-lesoes']]);
	Route::get('editar/{id}',['as' =>'edit','uses'=>'Policiais\ObitoLesaoController@edit','middleware' => ['permission:editar-obitos-lesoes']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Policiais\ObitoLesaoController@update','middleware' => ['permission:editar-obitos-lesoes']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Policiais\ObitoLesaoController@destroy','middleware' => ['permission:apagar-obitos-lesoes']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Policiais\ObitoLesaoController@restore','middleware' => ['role:admin']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Policiais\ObitoLesaoController@forceDelete','middleware' => ['role:admin']]);
});
//Rotas do módulo MortosFeridos
// NÃO IMPLEMENTADO AINDA
// Route::group(['as'=>'mortoferido.','prefix' =>'mortoferido'],function(){
// 	Route::get('',['as' =>'index','uses'=>'Policiais\MortoFeridoController@index','middleware' => ['permission:listar-mortos-feridos']]);
//     Route::get('criar',['as' =>'create','uses'=>'Policiais\MortoFeridoController@create','middleware' => ['permission:criar-mortos-feridos']]);
//     Route::get('apagados',['as' =>'apagados','uses'=>'Policiais\MortoFeridoController@apagados','middleware' => ['role:admin']]);
// 	Route::post('salvar',['as' =>'store','uses'=>'Policiais\MortoFeridoController@store','middleware' => ['permission:criar-mortos-feridos']]);
// 	Route::get('editar/{id}',['as' =>'edit','uses'=>'Policiais\MortoFeridoController@edit','middleware' => ['permission:editar-mortos-feridos']]);
// 	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Policiais\MortoFeridoController@update','middleware' => ['permission:editar-mortos-feridos']]);
//     Route::get('remover/{id}',['as' =>'destroy','uses'=>'Policiais\MortoFeridoController@destroy','middleware' => ['permission:apagar-mortos-feridos']]);
//     Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Policiais\MortoFeridoController@restore','middleware' => ['role:admin']]);
//     Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Policiais\MortoFeridoController@forceDelete','middleware' => ['role:admin']]);
// });