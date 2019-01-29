<?php
//Rotas do módulo medalhas
Route::group(['as'=>'medalhas.','prefix' =>'medalhas'],function(){
	Route::get('',['as' =>'index','uses'=>'Policiais\MedalhasController@index','middleware' => ['permission:listar-medalhas']]);
	Route::get('criar',['as' =>'create','uses'=>'Policiais\MedalhasController@create','middleware' => ['permission:criar-medalhas']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\MedalhasController@store','middleware' => ['permission:criar-medalhas']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Policiais\MedalhasController@edit','middleware' => ['permission:editar-medalhas']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Policiais\MedalhasController@update','middleware' => ['permission:editar-medalhas']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Policiais\MedalhasController@destroy','middleware' => ['permission:remover-medalhas']]);
});

//Rotas do módulo elogio
Route::group(['as'=>'elogios.','prefix' =>'elogios'],function(){
	Route::get('',['as' =>'index','uses'=>'Policiais\ElogiosController@index','middleware' => ['permission:listar-elogios']]);
	Route::get('criar',['as' =>'create','uses'=>'Policiais\ElogiosController@create','middleware' => ['permission:criar-elogios']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\ElogiosController@store','middleware' => ['permission:criar-elogios']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Policiais\ElogiosController@edit','middleware' => ['permission:editar-elogios']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Policiais\ElogiosController@update','middleware' => ['permission:editar-elogios']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Policiais\ElogiosController@destroy','middleware' => ['permission:remover-elogios']]);
});

//Rotas do módulo Excluidos
Route::group(['as'=>'excluidos.','prefix' =>'excluidos'],function(){
	Route::get('',['as' =>'index','uses'=>'Policiais\ExcluidosController@index','middleware' => ['permission:listar-excluidos']]);
	Route::get('criar',['as' =>'create','uses'=>'Policiais\ExcluidosController@create','middleware' => ['permission:criar-excluidos']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\ExcluidosController@store','middleware' => ['permission:criar-excluidos']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Policiais\ExcluidosController@edit','middleware' => ['permission:editar-excluidos']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Policiais\ExcluidosController@update','middleware' => ['permission:editar-excluidos']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Policiais\ExcluidosController@destroy','middleware' => ['permission:remover-excluidos']]);
});

//Rotas do módulo punidos 
Route::group(['as'=>'punidos.','prefix' =>'punidos'],function(){
	Route::get('',['as' =>'index','uses'=>'Policiais\PunidosController@index','middleware' => ['permission:listar-punidos']]);
	Route::get('criar',['as' =>'create','uses'=>'Policiais\PunidosController@create','middleware' => ['permission:criar-punidos']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\PunidosController@store','middleware' => ['permission:criar-punidos']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Policiais\PunidosController@edit','middleware' => ['permission:editar-punidos']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Policiais\PunidosController@update','middleware' => ['permission:editar-punidos']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Policiais\PunidosController@destroy','middleware' => ['permission:remover-punidos']]);
});

//Rotas do módulo Reintegrados
Route::group(['as'=>'reintegrados.','prefix' =>'reintegrados'],function(){
	Route::get('',['as' =>'index','uses'=>'Policiais\ReintegradosController@index','middleware' => ['permission:listar-reintegrados']]);
	Route::get('criar',['as' =>'create','uses'=>'Policiais\ReintegradosController@create','middleware' => ['permission:criar-reintegrados']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\ReintegradosController@store','middleware' => ['permission:criar-reintegrados']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Policiais\ReintegradosController@edit','middleware' => ['permission:editar-reintegrados']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Policiais\ReintegradosController@update','middleware' => ['permission:editar-reintegrados']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Policiais\ReintegradosController@destroy','middleware' => ['permission:remover-reintegrados']]);
});

//Rotas do módulo denunciados 
Route::group(['as'=>'denunciados.','prefix' =>'denunciados'],function(){
	Route::get('',['as' =>'index','uses'=>'Policiais\DenunciadosController@index','middleware' => ['permission:listar-denunciados']]);
	Route::get('criar',['as' =>'create','uses'=>'Policiais\DenunciadosController@create','middleware' => ['permission:criar-denunciados']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\DenunciadosController@store','middleware' => ['permission:criar-denunciados']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Policiais\DenunciadosController@edit','middleware' => ['permission:editar-denunciados']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Policiais\DenunciadosController@update','middleware' => ['permission:editar-denunciados']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Policiais\DenunciadosController@destroy','middleware' => ['permission:remover-denunciados']]);
}); 

//Rotas do módulo Presos
Route::group(['as'=>'presos.','prefix' =>'presos'],function(){
	Route::get('',['as' =>'index','uses'=>'Policiais\PresosController@index','middleware' => ['permission:listar-presos']]);
	Route::get('criar',['as' =>'create','uses'=>'Policiais\PresosController@create','middleware' => ['permission:criar-presos']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\PresosController@store','middleware' => ['permission:criar-presos']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Policiais\PresosController@edit','middleware' => ['permission:editar-presos']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Policiais\PresosController@update','middleware' => ['permission:editar-presos']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Policiais\PresosController@destroy','middleware' => ['permission:remover-presos']]);
});

//Rotas do módulo procedimento 
Route::group(['as'=>'procedimento.','prefix' =>'procedimento'],function(){
	Route::get('',['as' =>'index','uses'=>'Policiais\ProcedimentoController@index','middleware' => ['permission:listar-procedimentos']]);
	Route::get('criar',['as' =>'create','uses'=>'Policiais\ProcedimentoController@create','middleware' => ['permission:criar-procedimentos']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\ProcedimentoController@store','middleware' => ['permission:criar-procedimentos']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Policiais\ProcedimentoController@edit','middleware' => ['permission:editar-procedimentos']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Policiais\ProcedimentoController@update','middleware' => ['permission:editar-procedimentos']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Policiais\ProcedimentoController@destroy','middleware' => ['permission:remover-procedimentos']]);
}); 

//Rotas do módulo comportamento 
Route::group(['as'=>'comportamento.','prefix' =>'comportamento'],function(){
	Route::get('',['as' =>'index','uses'=>'Policiais\ComportamentoController@index','middleware' => ['permission:listar-comportamento']]);
	Route::get('criar',['as' =>'create','uses'=>'Policiais\ComportamentoController@create','middleware' => ['permission:criar-comportamento']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\ComportamentoController@store','middleware' => ['permission:criar-comportamento']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Policiais\ComportamentoController@edit','middleware' => ['permission:editar-comportamento']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Policiais\ComportamentoController@update','middleware' => ['permission:editar-comportamento']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Policiais\ComportamentoController@destroy','middleware' => ['permission:remover-comportamento']]);
}); 

//Rotas do módulo respondendo 
Route::group(['as'=>'respondendo.','prefix' =>'respondendo'],function(){
	Route::get('',['as' =>'index','uses'=>'Policiais\RespondendoController@index','middleware' => ['permission:listar-respondendo']]);
	Route::get('criar',['as' =>'create','uses'=>'Policiais\RespondendoController@create','middleware' => ['permission:criar-respondendo']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\RespondendoController@store','middleware' => ['permission:criar-respondendo']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Policiais\RespondendoController@edit','middleware' => ['permission:editar-respondendo']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Policiais\RespondendoController@update','middleware' => ['permission:editar-respondendo']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Policiais\RespondendoController@destroy','middleware' => ['permission:remover-respondendo']]);
}); 

//Rotas do módulo restricoes 
Route::group(['as'=>'restricoes.','prefix' =>'resticoes'],function(){
	Route::get('',['as' =>'index','uses'=>'Policiais\RestricoesController@index','middleware' => ['permission:listar-restricoes']]);
	Route::get('criar',['as' =>'create','uses'=>'Policiais\RestricoesController@create','middleware' => ['permission:criar-restricoes']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\RestricoesController@store','middleware' => ['permission:criar-restricoes']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Policiais\RestricoesController@edit','middleware' => ['permission:editar-restricoes']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Policiais\RestricoesController@update','middleware' => ['permission:editar-restricoes']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Policiais\RestricoesController@destroy','middleware' => ['permission:remover-restricoes']]);
});

//Rotas do módulo Suspensos
Route::group(['as'=>'suspensos.','prefix' =>'suspensos'],function(){
	Route::get('',['as' =>'index','uses'=>'Policiais\SuspensosController@index','middleware' => ['permission:listar-suspensos']]);
	Route::get('criar',['as' =>'create','uses'=>'Policiais\SuspensosController@create','middleware' => ['permission:criar-suspensos']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\SuspensosController@store','middleware' => ['permission:criar-suspensos']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Policiais\SuspensosController@edit','middleware' => ['permission:editar-suspensos']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Policiais\SuspensosController@update','middleware' => ['permission:editar-suspensos']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Policiais\SuspensosController@destroy','middleware' => ['permission:remover-suspensos']]);
});


//Rotas do módulo ObitosLesoes
Route::group(['as'=>'obitoslesoes.','prefix' =>'obitoslesoes'],function(){
	Route::get('',['as' =>'index','uses'=>'Policiais\ObitosLesoesController@index','middleware' => ['permission:listar-obitos-lesoes']]);
	Route::get('criar',['as' =>'create','uses'=>'Policiais\ObitosLesoesController@create','middleware' => ['permission:criar-obitos-lesoes']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\ObitosLesoesController@store','middleware' => ['permission:criar-obitos-lesoes']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Policiais\ObitosLesoesController@edit','middleware' => ['permission:editar-obitos-lesoes']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Policiais\ObitosLesoesController@update','middleware' => ['permission:editar-obitos-lesoes']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Policiais\ObitosLesoesController@destroy','middleware' => ['permission:remover-obitos-lesoes']]);
});

//Rotas do módulo MortosFeridos
Route::group(['as'=>'mortosferidos.','prefix' =>'mortosferidos'],function(){
	Route::get('',['as' =>'index','uses'=>'Policiais\MortosFeridosController@index','middleware' => ['permission:listar-mortos-feridos']]);
	Route::get('criar',['as' =>'create','uses'=>'Policiais\MortosFeridosController@create','middleware' => ['permission:criar-mortos-feridos']]);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\MortosFeridosController@store','middleware' => ['permission:criar-mortos-feridos']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Policiais\MortosFeridosController@edit','middleware' => ['permission:editar-mortos-feridos']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Policiais\MortosFeridosController@update','middleware' => ['permission:editar-mortos-feridos']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Policiais\MortosFeridosController@destroy','middleware' => ['permission:remover-mortos-feridos']]);
});