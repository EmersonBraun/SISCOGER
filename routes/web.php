<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aqui é onde você pode registrar rotas da web para seu aplicativo. Estes
| rotas são carregadas pelo RouteServiceProvider dentro de um grupo que
| contém o grupo de middleware "web".
*/
Route::get('teste', ['as'=>'teste','uses'=>'Testes\testeBD@opm']);
//Route::get('fds', ['as'=>'fds','uses'=>'Testes\testeBD@fds']);
//Route::get('tabelas/{conn}/{colunas?}', ['as'=>'teste','uses'=>'Testes\testeBD@tabelas']);
// Route::get('colunas/{nome}', ['as'=>'teste','uses'=>'Testes\testeBD@colunas']);
// Route::get('colunas2/{nome}', ['as'=>'teste','uses'=>'Testes\testeBD@colunas2']);
//Route::get('bd/{conn}/{nome}/{limite}/{c1?}/{oper?}{c2?}', ['as'=>'bd','uses'=>'Testes\testeBD@bd']);
//Route::get('bd/{nome?}', ['as'=>'bd','uses'=>'Testes\testeBD@search']);
Route::get('bd/qtds', ['as'=>'bd','uses'=>'Testes\testeBD@qtds']);
Route::get('bd/acesso/{rg}', ['as'=>'acesso','uses'=>'Testes\testeBD@acesso']);
// Route::get('bd/bdgeral', ['as'=>'bdgeral','uses'=>'Testes\testeBD@bdgeral']);
//para rodar os testes
$middleware = [];
if ( !App::runningUnitTests() ) {
    $middleware[] = 'api.auth';
    Auth::routes();
}

/* -------------- ROTAS HOME/DASHBOARD -------------- */
// Route::get('/home', ['as' =>'home','uses'=>'Relatorios\PendenciasController@index']);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('home/{opm}', ['as' =>'home.opm','uses'=>'Relatorios\PendenciasController@index', 'middleware' => ['permission:todas-unidades']]);

Route::match(['get'],'trocaropm', ['as' =>'trocaropm','uses'=>'Relatorios\PendenciasController@trocaropm', 'middleware' => ['permission:todas-unidades']]);
Route::get('logout', 'HomeController@logout')->middleware('auth.unique.user');

/* -------------- ROTAS ADMINISTRAÇÃO -------------- */
//Rotas do módulo User
Route::group(['as'=>'users.','prefix' =>'usuarios','middleware' => ['role:admin']],function(){
	Route::get('',['as' =>'index','uses'=>'Administracao\UserController@index']);
	Route::get('criar',['as' =>'create','uses'=>'Administracao\UserController@create']);
	Route::post('salvar',['as' =>'store','uses'=>'Administracao\UserController@store']);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Administracao\UserController@edit']);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Administracao\UserController@update']);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Administracao\UserController@destroy']);
	//Alterar senha
	Route::get('{id}/senha',['as' =>'pass','uses'=>'Administracao\UserController@passedit']);
	Route::put('{id}/senhaatualizar',['as' =>'passupdate','uses'=>'Administracao\UserController@passupdate']);
	//bloqueio e desbloqueio
	Route::get('{id}/bloquear',['as' =>'block','uses'=>'Administracao\UserController@block']);
	Route::get('{id}/desbloquear',['as' =>'unblock','uses'=>'Administracao\UserController@unblock']);
	//manual usuário
	Route::get('manual',['as' =>'manual','uses'=>'Administracao\UserController@manual']);
	//termos do usuário
	Route::get('{id}/termocriar',['as' =>'termocriar','uses'=>'Administracao\UserController@termocriar']);
	Route::post('{id}/termosalvar',['as' =>'termosalvar','uses'=>'Administracao\UserController@termosalvar']);
});
//Rotas do módulo Regras
Route::group(['as'=>'roles.','prefix' =>'papeis','middleware' => ['role:admin']],function(){
	Route::get('',['as' =>'index','uses'=>'Administracao\RoleController@index']);
	Route::get('criar',['as' =>'create','uses'=>'Administracao\RoleController@create']);
	Route::post('salvar',['as' =>'store','uses'=>'Administracao\RoleController@store']);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Administracao\RoleController@edit']);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Administracao\RoleController@update']);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Administracao\RoleController@destroy']);
});
//Rotas do módulo Permissões
Route::group(['as'=>'permissions.','prefix' =>'permissoes','middleware' => ['role:admin']],function(){
	Route::get('',['as' =>'index','uses'=>'Administracao\PermissionController@index']);
	Route::get('criar',['as' =>'create','uses'=>'Administracao\PermissionController@create']);
	Route::post('salvar',['as' =>'store','uses'=>'Administracao\PermissionController@store']);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Administracao\PermissionController@edit']);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Administracao\PermissionController@update']);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Administracao\PermissionController@destroy']);
});
//Rotas do módulo controle SJDS
Route::group(['as'=>'sjd.','prefix' =>'sjd','middleware' => ['role:admin']],function(){
	Route::get('',['as' =>'index','uses'=>'Administracao\SjdController@index']);
	Route::get('criar',['as' =>'create','uses'=>'Administracao\SjdController@create']);
	Route::post('salvar',['as' =>'store','uses'=>'Administracao\SjdController@store']);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Administracao\SjdController@edit']);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Administracao\SjdController@update']);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Administracao\SjdController@destroy']);
});
//Rotas do módulo Terms
Route::group(['as'=>'terms.','prefix' =>'termo'],function(){
	Route::get('',['as' =>'index','uses'=>'Administracao\TermsController@index']);
	Route::get('criar',['as' =>'create','uses'=>'Administracao\TermsController@create']);
	Route::post('salvar',['as' =>'store','uses'=>'Administracao\TermsController@store']);
});
//Rotas do módulo feriado
Route::group(['as'=>'feriados.','prefix' =>'feriado'],function(){
	Route::get('',['as' =>'index','uses'=>'Administracao\FeriadoController@index','middleware' => ['permission:listar-feriados']]);
	Route::get('criar',['as' =>'create','uses'=>'Administracao\FeriadoController@create','middleware' => ['permission:criar-feriados']]);
	Route::post('salvar',['as' =>'store','uses'=>'Administracao\FeriadoController@store','middleware' => ['permission:criar-feriados']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Administracao\FeriadoController@edit','middleware' => ['permission:editar-feriados']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Administracao\FeriadoController@update','middleware' => ['permission:editar-feriados']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Administracao\FeriadoController@destroy','middleware' => ['permission:listar-feriados']]);
});
//Rotas do módulo Unidades
Route::group(['as'=>'unidades.','prefix' =>'unidades'],function(){
	Route::get('',['as' =>'index','uses'=>'Administracao\UnidadesController@index','middleware' => ['permission:listar-unidades']]);
	Route::get('criar',['as' =>'create','uses'=>'Administracao\UnidadesController@create','middleware' => ['permission:criar-unidades']]);
	Route::post('salvar',['as' =>'store','uses'=>'Administracao\UnidadesController@store','middleware' => ['permission:criar-unidades']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Administracao\UnidadesController@edit','middleware' => ['permission:editar-unidades']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Administracao\UnidadesController@update','middleware' => ['permission:editar-unidades']]);
});
/* -------------- ROTAS EMAIL -------------- */
//Rotas do módulo Email
/*Route::group(['as'=>'mail.','prefix' =>'email'],function(){
	Route::get('enviar',['as' =>'send','uses'=>'Administracao\MailController@send']);
	Route::get('enviados',['as' =>'sent','uses'=>'Administracao\MailController@sent','middleware' => ['permission:listar-email-agendados']]);
	Route::get('criar',['as' =>'create','uses'=>'Administracao\MailController@create','middleware' => ['permission:criar-email-agendados']]);
	Route::post('salvar',['as' =>'store','uses'=>'Administracao\MailController@store','middleware' => ['permission:criar-email-agendados']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Administracao\MailController@edit','middleware' => ['permission:editar-email-agendados']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Administracao\MailController@update','middleware' => ['permission:editar-email-agendados']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Administracao\MailController@destroy','middleware' => ['permission:apagar-email-agendados']]);
	//Relatório afastados
	Route::get('afastados',['as' =>'afastados','uses'=>'Administracao\MailController@sendAfastados']);
	//Relatório presos
	Route::get('presos',['as' =>'presos','uses'=>'Administracao\MailController@sendPresos']);
	//email lembrete apresentação
	Route::get('apresentacao/enviar',['as' =>'apresentacao.send','uses'=>'Administracao\MailController@sendApresentacao']);
	//listagem email enviados
	Route::get('apresentacao/enviados',['as' =>'apresentacao.sent','uses'=>'Administracao\MailController@sentApresentacao','middleware' => ['permission:listar-email-apresentacao']]);
});*/
/* -------------- ROTAS APRESENTAÇÃO -------------- */
//Rotas do módulo Apresentacao
Route::group(['as'=>'apresentacao.','prefix' =>'apresentacao'],function(){
	Route::get('',['as' =>'index','uses'=>'Apresentacao\ApresentacaoController@index','middleware' => ['permission:listar-apresentacao']]);
	Route::get('criar',['as' =>'create','uses'=>'Apresentacao\ApresentacaoController@create','middleware' => ['permission:criar-apresentacao']]);
	Route::post('salvar',['as' =>'store','uses'=>'Apresentacao\ApresentacaoController@store','middleware' => ['permission:criar-apresentacao']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Apresentacao\ApresentacaoController@edit','middleware' => ['permission:editar-apresentacao']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Apresentacao\ApresentacaoController@update','middleware' => ['permission:editar-apresentacao']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Apresentacao\ApresentacaoController@destroy','middleware' => ['permission:apagar-apresentacao']]);
	Route::get('buscar',['as' =>'buscar','uses'=>'Apresentacao\ApresentacaoController@buscar','middleware' => ['permission:listar-apresentacao']]);
});
//Rotas do módulo Excel
Route::group(['as'=>'excel.','prefix' =>'excel'],function(){
	Route::get('',['as' =>'index','uses'=>'Apresentacao\ExcelController@index','middleware' => ['permission:listar-excel']]);
	Route::get('criar',['as' =>'create','uses'=>'Apresentacao\ExcelController@create','middleware' => ['permission:criar-excel']]);
	Route::post('salvar',['as' =>'store','uses'=>'Apresentacao\ExcelController@store','middleware' => ['permission:criar-excel']]);
});
//Rotas do módulo Memorando
Route::group(['as'=>'memorando.','prefix' =>'memorando'],function(){
	Route::get('',['as' =>'index','uses'=>'Apresentacao\MemorandoController@index','middleware' => ['permission:listar-memorando-apresentacao']]);
	Route::get('criar',['as' =>'create','uses'=>'Apresentacao\MemorandoController@create','middleware' => ['permission:criar-memorando-apresentacao']]);
	Route::post('salvar',['as' =>'store','uses'=>'Apresentacao\MemorandoController@store','middleware' => ['permission:criar-memorando-apresentacao']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Apresentacao\MemorandoController@edit','middleware' => ['permission:editar-memorando-apresentacao']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Apresentacao\MemorandoController@update','middleware' => ['permission:editar-memorando-apresentacao']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Apresentacao\MemorandoController@destroy','middleware' => ['permission:apagar-memorando-apresentacao']]);
});
//Rotas do módulo Locais de apresentação
Route::group(['as'=>'locais.','prefix' =>'locais','middleware' => ['permission:']],function(){
	Route::get('',['as' =>'index','uses'=>'Apresentacao\LocaisController@index','middleware' => ['permission:listar-locais']]);
	Route::get('criar',['as' =>'create','uses'=>'Apresentacao\LocaisController@create','middleware' => ['permission:criar-locais']]);
	Route::post('salvar',['as' =>'store','uses'=>'Apresentacao\LocaisController@store','middleware' => ['permission:criar-locais']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Apresentacao\LocaisController@edit','middleware' => ['permission:editar-locais']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Apresentacao\LocaisController@update','middleware' => ['permission:editar-locais']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Apresentacao\LocaisController@destroy','middleware' => ['permission:apagar-locais']]);
});
//Rotas do módulo NotaCoger
Route::group(['as'=>'notacoger.','prefix' =>'notacoger'],function(){
	Route::get('',['as' =>'index','uses'=>'Apresentacao\NotaCogerController@index','middleware' => ['permission:listar-notas-coger']]);
	Route::get('criar',['as' =>'create','uses'=>'Apresentacao\NotaCogerController@create','middleware' => ['permission:criar-notas-coger']]);
	Route::post('salvar',['as' =>'store','uses'=>'Apresentacao\NotaCogerController@store','middleware' => ['permission:criar-notas-coger']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Apresentacao\NotaCogerController@edit','middleware' => ['permission:editar-notas-coger']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Apresentacao\NotaCogerController@update','middleware' => ['permission:editar-notas-coger']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Apresentacao\NotaCogerController@destroy','middleware' => ['permission:apagar-notas-coger']]);
});
/* -------------- ROTAS PROCESSOS E PROCEDIMENTOS -------------- */

//Rotas do módulo Adl
Route::group(['as'=>'adl.','prefix' =>'adl'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\AdlController@index','middleware' => ['permission:listar-adl']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\AdlController@lista','middleware' => ['permission:listar-adl']]);
	Route::get('andamento',['as' =>'andamento','uses'=>'Proc\AdlController@andamento','middleware' => ['permission:listar-adl']]);
	Route::get('prazos',['as' =>'prazos','uses'=>'Proc\AdlController@prazos','middleware' => ['permission:listar-adl']]);
	Route::get('rel_situacao',['as' =>'rel_situacao','uses'=>'Proc\AdlController@rel_situacao','middleware' => ['permission:listar-adl']]);
    Route::get('julgamento',['as' =>'julgamento','uses'=>'Proc\AdlController@julgamento','middleware' => ['permission:listar-adl']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Proc\AdlController@apagados','middleware' => ['permission:listar-adl']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\AdlController@create','middleware' => ['permission:criar-adl']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\AdlController@store','middleware' => ['permission:criar-adl']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\AdlController@show','middleware' => ['permission:ver-adl']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\AdlController@edit','middleware' => ['permission:editar-adl']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\AdlController@update','middleware' => ['permission:editar-adl']]);
    Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\AdlController@destroy','middleware' => ['permission:apagar-adl']]);
    Route::get('recuperar/{id}',['as' =>'restore','uses'=>'Proc\AdlController@restore','middleware' => ['permission:apagar-adl']]);
    Route::get('apagar/{id}',['as' =>'forceDelete','uses'=>'Proc\AdlController@forceDelete','middleware' => ['permission:apagar-adl']]);
});
//Rotas do módulo Cd
Route::group(['as'=>'cd.','prefix' =>'cd'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\CdController@index','middleware' => ['permission:listar-cd']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\CdController@lista','middleware' => ['permission:listar-cd']]);
	Route::get('andamento',['as' =>'andamento','uses'=>'Proc\CdController@andamento','middleware' => ['permission:listar-cd']]);
	Route::get('prazos',['as' =>'prazos','uses'=>'Proc\CdController@prazos','middleware' => ['permission:listar-cd']]);
	Route::get('rel_situacao',['as' =>'rel_situacao','uses'=>'Proc\CdController@rel_situacao','middleware' => ['permission:listar-cd']]);
    Route::get('julgamento',['as' =>'julgamento','uses'=>'Proc\CdController@julgamento','middleware' => ['permission:listar-cd']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Proc\CdController@apagados','middleware' => ['permission:listar-cd']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\CdController@create','middleware' => ['permission:criar-cd']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\CdController@store','middleware' => ['permission:criar-cd']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\CdController@show','middleware' => ['permission:ver-cd']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\CdController@edit','middleware' => ['permission:editar-cd']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\CdController@update','middleware' => ['permission:editar-cd']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\CdController@destroy','middleware' => ['permission:apagar-cd']]);
});
//Rotas do módulo Cj
Route::group(['as'=>'cj.','prefix' =>'cj'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\CjController@index','middleware' => ['permission:listar-cj']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\CjController@lista','middleware' => ['permission:listar-cj']]);
	Route::get('andamento',['as' =>'andamento','uses'=>'Proc\CjController@andamento','middleware' => ['permission:listar-cj']]);
	Route::get('prazos',['as' =>'prazos','uses'=>'Proc\CjController@prazos','middleware' => ['permission:listar-cj']]);
	Route::get('rel_situacao',['as' =>'rel_situacao','uses'=>'Proc\CjController@rel_situacao','middleware' => ['permission:listar-cj']]);
    Route::get('julgamento',['as' =>'julgamento','uses'=>'Proc\CjController@julgamento','middleware' => ['permission:listar-cj']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Proc\CjController@apagados','middleware' => ['permission:listar-cj']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\CjController@create','middleware' => ['permission:criar-cj']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\CjController@store','middleware' => ['permission:criar-cj']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\CjController@show','middleware' => ['permission:ver-cj']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\CjController@edit','middleware' => ['permission:editar-cj']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\CjController@update','middleware' => ['permission:editar-cj']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\CjController@destroy','middleware' => ['permission:apagar-cj']]);
});
//Rotas do módulo Fatd
Route::group(['as'=>'fatd.','prefix' =>'fatd'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\FatdController@index','middleware' => ['permission:listar-fatd']]);
	//listagem
	Route::get('lista/{ano}',['as' =>'lista','uses'=>'Proc\FatdController@lista','middleware' => ['permission:listar-fatd']]);
	Route::get('andamento/{ano}',['as' =>'andamento','uses'=>'Proc\FatdController@andamento','middleware' => ['permission:listar-fatd']]);
	Route::get('prazos/{ano}',['as' =>'prazos','uses'=>'Proc\FatdController@prazos','middleware' => ['permission:listar-fatd']]);
	Route::get('rel_situacao/{ano}',['as' =>'rel_situacao','uses'=>'Proc\FatdController@rel_situacao','middleware' => ['permission:listar-fatd']]);
    Route::get('julgamento/{ano}',['as' =>'julgamento','uses'=>'Proc\FatdController@julgamento','middleware' => ['permission:listar-fatd']]);
    Route::get('apagados/{ano}',['as' =>'apagados','uses'=>'Proc\FatdController@apagados','middleware' => ['permission:listar-fatd']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\FatdController@create','middleware' => ['permission:criar-fatd']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\FatdController@store','middleware' => ['permission:criar-fatd']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\FatdController@show','middleware' => ['permission:ver-fatd']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\FatdController@edit','middleware' => ['permission:editar-fatd']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\FatdController@update','middleware' => ['permission:editar-fatd']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\FatdController@destroy','middleware' => ['permission:apagar-fatd']]);
});
//Rotas do módulo Pad
Route::group(['as'=>'pad.','prefix' =>'pad'],function(){
    Route::get('',['as' =>'index','uses'=>'Proc\PadController@index','middleware' => ['permission:listar-pad']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\PadController@lista','middleware' => ['permission:listar-pad']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Proc\PadController@apagados','middleware' => ['permission:listar-pad']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\PadController@create','middleware' => ['permission:criar-pad']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\PadController@store','middleware' => ['permission:criar-pad']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\PadController@show','middleware' => ['permission:ver-pad']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\PadController@edit','middleware' => ['permission:editar-pad']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\PadController@update','middleware' => ['permission:editar-pad']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\PadController@destroy','middleware' => ['permission:apagar-pad']]);
});
//Rotas do módulo Apfd
Route::group(['as'=>'apfd.','prefix' =>'apfd'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\ApfdController@index','middleware' => ['permission:listar-apfd']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\ApfdController@lista','middleware' => ['permission:listar-apfd']]);
    Route::get('rel_situacao',['as' =>'rel_situacao','uses'=>'Proc\ApfdController@rel_situacao','middleware' => ['permission:listar-apfd']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Proc\ApfdController@apagados','middleware' => ['permission:listar-apfd']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\ApfdController@create','middleware' => ['permission:criar-apfd']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\ApfdController@store','middleware' => ['permission:criar-apfd']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\ApfdController@show','middleware' => ['permission:ver-apfd']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\ApfdController@edit','middleware' => ['permission:editar-apfd']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\ApfdController@update','middleware' => ['permission:editar-apfd']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\ApfdController@destroy','middleware' => ['permission:apagar-apfd']]);
});
//Rotas do módulo Desercao
Route::group(['as'=>'desercao.','prefix' =>'desercao'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\DesercaoController@index','middleware' => ['permission:listar-desercao']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\DesercaoController@lista','middleware' => ['permission:listar-desercao']]);
    Route::get('rel_situacao',['as' =>'rel_situacao','uses'=>'Proc\DesercaoController@rel_situacao','middleware' => ['permission:listar-desercao']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Proc\DesercaoController@apagados','middleware' => ['permission:listar-desercao']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\DesercaoController@create','middleware' => ['permission:criar-desercao']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\DesercaoController@store','middleware' => ['permission:criar-desercao']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\DesercaoController@show','middleware' => ['permission:ver-desercao']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\DesercaoController@edit','middleware' => ['permission:editar-desercao']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\DesercaoController@update','middleware' => ['permission:editar-desercao']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\DesercaoController@destroy','middleware' => ['permission:apagar-desercao']]);
});
//Rotas do módulo Exclusao
Route::group(['as'=>'exclusao.','prefix' =>'exclusao'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\ExclusaoController@index','middleware' => ['permission:listar-exclusao']]);
	//listagem
    Route::get('lista',['as' =>'lista','uses'=>'Proc\ExclusaoController@lista','middleware' => ['permission:listar-exclusao']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Proc\ExclusaoController@apagados','middleware' => ['permission:listar-exclusao']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\ExclusaoController@create','middleware' => ['permission:criar-exclusao']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\ExclusaoController@store','middleware' => ['permission:criar-exclusao']]);
	Route::get('ver/{id}',['as' =>'show','uses'=>'Proc\ExclusaoController@show','middleware' => ['permission:ver-exclusao']]);
	Route::get('editar/{id}',['as' =>'edit','uses'=>'Proc\ExclusaoController@edit','middleware' => ['permission:editar-exclusao']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\ExclusaoController@update','middleware' => ['permission:editar-exclusao']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\ExclusaoController@destroy','middleware' => ['permission:apagar-exclusao']]);
});
//Rotas do módulo ipm
Route::group(['as'=>'ipm.','prefix' =>'ipm'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\IpmController@index','middleware' => ['permission:listar-ipm']]);
	//listagem
	Route::get('lista/{ano}',['as' =>'lista','uses'=>'Proc\IpmController@lista','middleware' => ['permission:listar-ipm']]);
	Route::get('andamento/{ano}',['as' =>'andamento','uses'=>'Proc\IpmController@andamento','middleware' => ['permission:listar-ipm']]);
	Route::get('prazos/{ano}',['as' =>'prazos','uses'=>'Proc\IpmController@prazos','middleware' => ['permission:listar-ipm']]);
	Route::get('rel_situacao/{ano}',['as' =>'rel_situacao','uses'=>'Proc\IpmController@rel_situacao','middleware' => ['permission:listar-ipm']]);
    Route::get('resultado/{ano}',['as' =>'resultado','uses'=>'Proc\IpmController@resultado','middleware' => ['permission:listar-ipm']]);
    Route::get('apagados/{ano}',['as' =>'apagados','uses'=>'Proc\IpmController@apagados','middleware' => ['permission:listar-ipm']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\IpmController@create','middleware' => ['permission:criar-ipm']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\IpmController@store','middleware' => ['permission:criar-ipm']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\IpmController@show','middleware' => ['permission:ver-ipm']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\IpmController@edit','middleware' => ['permission:editar-ipm']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\IpmController@update','middleware' => ['permission:editar-ipm']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\IpmController@destroy','middleware' => ['permission:apagar-ipm']]);
});
//Rotas do módulo Iso
Route::group(['as'=>'iso.','prefix' =>'iso'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\IsoController@index','middleware' => ['permission:listar-iso']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\IsoController@lista','middleware' => ['permission:listar-iso']]);
	Route::get('andamento',['as' =>'andamento','uses'=>'Proc\IsoController@andamento','middleware' => ['permission:listar-iso']]);
    Route::get('prazos',['as' =>'prazos','uses'=>'Proc\IsoController@prazos','middleware' => ['permission:listar-iso']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Proc\IsoController@apagados','middleware' => ['permission:listar-iso']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\IsoController@create','middleware' => ['permission:criar-iso']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\IsoController@store','middleware' => ['permission:criar-iso']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\IsoController@show','middleware' => ['permission:ver-iso']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\IsoController@edit','middleware' => ['permission:editar-iso']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\IsoController@update','middleware' => ['permission:editar-iso']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\IsoController@destroy','middleware' => ['permission:apagar-iso']]);
});
//Rotas do módulo It
Route::group(['as'=>'it.','prefix' =>'it'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\ItController@index','middleware' => ['permission:listar-it']]);
	//listagem
	Route::get('lista/{ano}',['as' =>'lista','uses'=>'Proc\ItController@lista','middleware' => ['permission:listar-it']]);
	Route::get('andamento/{ano}',['as' =>'andamento','uses'=>'Proc\ItController@andamento','middleware' => ['permission:listar-it']]);
	Route::get('prazos/{ano}',['as' =>'prazos','uses'=>'Proc\ItController@prazos','middleware' => ['permission:listar-it']]);
	Route::get('rel_valores/{ano}',['as' =>'rel_valores','uses'=>'Proc\ItController@rel_valores','middleware' => ['permission:listar-it']]);
    Route::get('julgamento/{ano}',['as' =>'julgamento','uses'=>'Proc\ItController@julgamento','middleware' => ['permission:listar-it']]);
    Route::get('apagados/{ano}',['as' =>'apagados','uses'=>'Proc\ItController@apagados','middleware' => ['permission:listar-it']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\ItController@create','middleware' => ['permission:criar-it']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\ItController@store','middleware' => ['permission:criar-it']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\ItController@show','middleware' => ['permission:ver-it']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\ItController@edit','middleware' => ['permission:editar-it']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\ItController@update','middleware' => ['permission:editar-it']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\ItController@destroy','middleware' => ['permission:apagar-it']]);
	Route::get('documentacao',['as' =>'documentacao','uses'=>'Proc\ItController@documentacao']);
});
//Rotas do módulo ProcOutros
Route::group(['as'=>'procoutros.','prefix' =>'procoutros'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\ProcOutrosController@index','middleware' => ['permission:listar-proc-outros']]);
	//listagem
	Route::get('lista',['as' =>'lista','uses'=>'Proc\ProcOutrosController@lista','middleware' => ['permission:listar-proc-outros']]);
	Route::get('andamento',['as' =>'andamento','uses'=>'Proc\ProcOutrosController@andamento','middleware' => ['permission:listar-proc-outros']]);
	Route::get('prazos',['as' =>'prazos','uses'=>'Proc\ProcOutrosController@prazos','middleware' => ['permission:listar-proc-outros']]);
	Route::get('rel_situacao',['as' =>'rel_situacao','uses'=>'Proc\ProcOutrosController@rel_situacao','middleware' => ['permission:listar-proc-outros']]);
    Route::get('julgamento',['as' =>'julgamento','uses'=>'Proc\ProcOutrosController@julgamento','middleware' => ['permission:listar-proc-outros']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Proc\ProcOutrosController@apagados','middleware' => ['permission:listar-proc-outros']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\ProcOutrosController@create','middleware' => ['permission:criar-proc-outros']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\ProcOutrosController@store','middleware' => ['permission:criar-proc-outros']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\ProcOutrosController@show','middleware' => ['permission:ver-proc-outros']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\ProcOutrosController@edit','middleware' => ['permission:editar-proc-outros']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\ProcOutrosController@update','middleware' => ['permission:editar-proc-outros']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\ProcOutrosController@destroy','middleware' => ['permission:apagar-proc-outros']]);
});
//Rotas do módulo recurso
Route::group(['as'=>'recurso.','prefix' =>'recurso'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\RecursoController@index','middleware' => ['permission:listar-recursos']]);
    Route::get('lista',['as' =>'lista','uses'=>'Proc\RecursoController@lista','middleware' => ['permission:listar-recursos']]);
    Route::get('apagados',['as' =>'apagados','uses'=>'Proc\RecursoController@apagados','middleware' => ['permission:listar-recursos']]);
	Route::get('criar',['as' =>'create','uses'=>'Proc\RecursoController@create','middleware' => ['permission:criar-recursos']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\RecursoController@store','middleware' => ['permission:criar-recursos']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\RecursoController@show','middleware' => ['permission:ver-recursos']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\RecursoController@edit','middleware' => ['permission:editar-recursos']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\RecursoController@update','middleware' => ['permission:editar-recursos']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\RecursoController@destroy','middleware' => ['permission:apagar-recursos']]);
});
//Rotas do módulo Sindicancia
Route::group(['as'=>'sindicancia.','prefix' =>'sindicancia'],function(){
	Route::get('',['as' =>'index','uses'=>'Proc\SindicanciaController@index','middleware' => ['permission:listar-sindicancia']]);
	//listagem
	Route::get('lista/{ano}',['as' =>'lista','uses'=>'Proc\SindicanciaController@lista','middleware' => ['permission:listar-sindicancia']]);
	Route::get('andamento/{ano}',['as' =>'andamento','uses'=>'Proc\SindicanciaController@andamento','middleware' => ['permission:listar-sindicancia']]);
	Route::get('prazos/{ano}',['as' =>'prazos','uses'=>'Proc\SindicanciaController@prazos','middleware' => ['permission:listar-sindicancia']]);
	Route::get('rel_situacao/{ano}',['as' =>'rel_situacao','uses'=>'Proc\SindicanciaController@rel_situacao','middleware' => ['permission:listar-sindicancia']]);
    Route::get('resultado/{ano}',['as' =>'resultado','uses'=>'Proc\SindicanciaController@resultado','middleware' => ['permission:listar-sindicancia']]);
    Route::get('apagados/{ano}',['as' =>'apagados','uses'=>'Proc\SindicanciaController@apagados','middleware' => ['permission:listar-sindicancia']]);
	//formulários
	Route::get('criar',['as' =>'create','uses'=>'Proc\SindicanciaController@create','middleware' => ['permission:criar-sindicancia']]);
	Route::post('salvar',['as' =>'store','uses'=>'Proc\SindicanciaController@store','middleware' => ['permission:criar-sindicancia']]);
	Route::get('ver/{ref}/{ano}',['as' =>'show','uses'=>'Proc\SindicanciaController@show','middleware' => ['permission:ver-sindicancia']]);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Proc\SindicanciaController@edit','middleware' => ['permission:editar-sindicancia']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Proc\SindicanciaController@update','middleware' => ['permission:editar-sindicancia']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Proc\SindicanciaController@destroy','middleware' => ['permission:apagar-sindicancia']]);
});
/* -------------- ROTAS MOVIMENTOS -------------- */

Route::group(['as'=>'movimento.','prefix' =>'movimento'],function(){
	Route::post('{id}',['as' =>'inserir','uses'=>'Proc\MovimentoController@inserir']);
});

/* -------------- ROTAS SOBRESTAMENTOS -------------- */

Route::group(['as'=>'sobrestamento.','prefix' =>'sobrestamento'],function(){
	Route::post('{id}',['as' =>'inserir','uses'=>'Proc\SobrestamentoController@inserir']);
});

/* -------------- ROTAS BUSCA -------------- */

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
    //
	Route::get('ofendido',['as' =>'ofendido','uses'=>'Busca\BuscaController@ofendido']);
	Route::get('envolvido',['as' =>'envolvido','uses'=>'Busca\BuscaController@envolvido']);
	Route::get('documentacao',['as' =>'documentacao','uses'=>'Busca\BuscaController@documentacao']);
	Route::get('pdf',['as' =>'pdf','uses'=>'Busca\BuscaController@pdf']);
	Route::get('tramitacao',['as' =>'tramitacao','uses'=>'Busca\BuscaController@tramitacao']);
});
/* -------------- ROTAS SAI -------------- */
Route::group(['as'=>'sai.','prefix' =>'sai','middleware' => ['permission:sai']],function(){
	Route::get('',['as' =>'index','uses'=>'Policiais\SaiController@index']);
	Route::get('criar',['as' =>'create','uses'=>'Policiais\SaiController@create']);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\SaiController@store']);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Policiais\SaiController@edit']);
	Route::put('atualizar/{ref}/{ano}',['as' =>'update','uses'=>'Policiais\SaiController@update']);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Policiais\SaiController@destroy']);
});

/* -------------- ROTAS FICHA DISCIPLINAR INDIVIDUAL -------------- */
Route::group(['as'=>'fdi.','prefix' =>'fdi'],function(){
	//Route::get('',['as' =>'index','uses'=>'FDI\FdiController@index']);
	// Route::get('criar',['as' =>'create','uses'=>'FDI\FdiController@create']);
	// Route::post('salvar',['as' =>'store','uses'=>'FDI\FdiController@store']);
	Route::get('{rg}/ver',['as' =>'show','uses'=>'FDI\FdiController@show']);
	// Route::get('{rg}/editar',['as' =>'edit','uses'=>'FDI\FdiController@edit']);
	// Route::put('{rg}/atualizar',['as' =>'update','uses'=>'FDI\FdiController@update']);
});
/*
Route::group(['as'=>'fdi.','prefix' =>'fdi'],function(){
	Route::get('',['as' =>'index','uses'=>'FDI\FdiController@index','middleware' => ['permission:listar-fdi']]);
	Route::get('criar',['as' =>'create','uses'=>'FDI\FdiController@create','middleware' => ['permission:criar-fdi']]);
	Route::post('salvar',['as' =>'store','uses'=>'FDI\FdiController@store','middleware' => ['permission:criar-fdi']]);
	Route::get('{rg}/ver',['as' =>'show','uses'=>'FDI\FdiController@show','middleware' => ['permission:ver-fdi']]);
	Route::get('{rg}/editar',['as' =>'edit','uses'=>'FDI\FdiController@edit','middleware' => ['permission:editar-fdi']]);
	Route::put('{rg}/atualizar',['as' =>'update','uses'=>'FDI\FdiController@update','middleware' => ['permission:editar-fdi']]);
});
*/
/* -------------- ROTAS POLICIAIS -------------- */

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

/* -------------- ROTAS RELATÓRIOS -------------- */
//Rotas do módulo Listar
/*Route::group(['as'=>'listar.','prefix' =>'listar'],function(){
	Route::get('',['as' =>'index','uses'=>'Relatorios\ListarController@index','middleware' => ['permission:']]);
});*/

//Rotas do módulo Relatorios
/*Route::group(['as'=>'relatorios.','prefix' =>'relatorios'],function(){
	Route::get('',['as' =>'procedimentos','uses'=>'Relatorios\RelatoriosController@procedimentos','middleware' => ['permission:']]);
});*/
// armas
Route::group(['as'=>'armas.','prefix' =>'armas'],function(){
	Route::get('',['as' =>'index','uses'=>'Relatorios\ArmasController@index','middleware' => ['permission:listar-armas']]);
	Route::get('criar',['as' =>'create','uses'=>'Relatorios\ArmasController@create','middleware' => ['permission:criar-armas']]);
	Route::post('salvar',['as' =>'store','uses'=>'Relatorios\ArmasController@store','middleware' => ['permission:criar-armas']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Relatorios\ArmasController@edit','middleware' => ['permission:editar-armas']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Relatorios\ArmasController@update','middleware' => ['permission:editar-armas']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Relatorios\ArmasController@destroy','middleware' => ['permission:remover-armas']]);
});
// pendências
Route::group(['as'=>'pendencias.','prefix' =>'pendencias'],function(){
	Route::get('gerais',['as' =>'gerais','uses'=>'Relatorios\PendenciasController@geral','middleware' => ['permission:listar-relatorio-geral']]);
	Route::get('comportamento',['as' =>'comportamento','uses'=>'Relatorios\PendenciasController@comportamento','middleware' => ['permission:listar-relatorio-comportamento']]);
	Route::get('punicoes',['as' =>'punicoes','uses'=>'Relatorios\PendenciasController@punicoes','middleware' => ['permission:listar-relatorio-punicoes']]);
	Route::get('quantidade',['as' =>'quantidade','uses'=>'Relatorios\PendenciasController@quantidade','middleware' => ['permission:listar-relatorio-quantidade']]);
	Route::get('prioritarios',['as' =>'prioritarios','uses'=>'Relatorios\PendenciasController@prioritarios','middleware' => ['permission:listar-relatorio-prioritarios']]);
	Route::get('sobrestamentos',['as' =>'sobrestamentos','uses'=>'Relatorios\PendenciasController@sobrestamentos','middleware' => ['permission:listar-relatorio-sobrestamentos']]);
	Route::get('processos',['as' =>'processos','uses'=>'Relatorios\PendenciasController@processos','middleware' => ['permission:listar-relatorio-processos']]);
	Route::get('postograd',['as' =>'postograd','uses'=>'Relatorios\PendenciasController@postograd','middleware' => ['permission:listar-relatorio-postograd']]);
	Route::get('encarregados',['as' =>'encarregados','uses'=>'Relatorios\PendenciasController@encarregados','middleware' => ['permission:listar-relatorio-encarregados']]);
	Route::get('defensores',['as' =>'defensores','uses'=>'Relatorios\PendenciasController@defensores','middleware' => ['permission:listar-relatorio-defensores']]);
	Route::get('ofendidos',['as' =>'ofendidos','uses'=>'Relatorios\PendenciasController@ofendidos','middleware' => ['permission:listar-relatorio-ofendidos']]);
});
Route::group(['as'=>'sobrestamento.','prefix' =>'sobrestamento','middleware' => ['permission:listar-relatorio-sobrestamento']],function(){
	Route::get('',['as' =>'index','uses'=>'Relatorios\SobrestamentoController@index']);
	Route::get('adl',['as' =>'adl','uses'=>'Relatorios\SobrestamentoController@adl']);
	Route::get('cd',['as' =>'cd','uses'=>'Relatorios\SobrestamentoController@cd']);
	Route::get('cj',['as' =>'cj','uses'=>'Relatorios\SobrestamentoController@cj']);
	Route::get('fatd',['as' =>'fatd','uses'=>'Relatorios\SobrestamentoController@fatd']);
	Route::get('it',['as' =>'it','uses'=>'Relatorios\SobrestamentoController@it']);
	Route::get('sindicancia',['as' =>'sindicancia','uses'=>'Relatorios\SobrestamentoController@sindicancia']);
});

/* -------------- ROTAS CORREIÇÕES -------------- */
Route::group(['as'=>'correicao.','prefix' =>'correicao'],function(){
    Route::group(['as'=>'ordinaria.','prefix' =>'ordinaria'],function(){
        Route::get('',['as' =>'index','uses'=>'Correicoes\CorreicaoOrdinariaController@index','middleware' => ['permission:listar-correicao-ordinaria']]);
        Route::get('criar',['as' =>'create','uses'=>'Correicoes\CorreicaoOrdinariaController@create','middleware' => ['permission:criar-correicao-ordinaria']]);
        Route::post('salvar',['as' =>'store','uses'=>'Correicoes\CorreicaoOrdinariaController@store','middleware' => ['permission:criar-correicao-ordinaria']]);
        Route::get('{id}/editar',['as' =>'edit','uses'=>'Correicoes\CorreicaoOrdinariaController@edit','middleware' => ['permission:editar-correicao-ordinaria']]);
        Route::put('{id}/atualizar',['as' =>'update','uses'=>'Correicoes\CorreicaoOrdinariaController@update','middleware' => ['permission:editar-correicao-ordinaria']]);
        Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Correicoes\CorreicaoOrdinariaController@destroy','middleware' => ['permission:remover-correicao-ordinaria']]);
    });
    //Rotas do módulo Correicao extraordinária
    Route::group(['as'=>'extraordinaria.','prefix' =>'extraordinaria'],function(){
        Route::get('',['as' =>'index','uses'=>'Correicoes\CorreicaoExtraordinariaController@index','middleware' => ['permission:listar-correicao-extraordinaria']]);
        Route::get('criar',['as' =>'create','uses'=>'Correicoes\CorreicaoExtraordinariaController@create','middleware' => ['permission:criar-correicao-extraordinaria']]);
        Route::post('salvar',['as' =>'store','uses'=>'Correicoes\CorreicaoExtraordinariaController@store','middleware' => ['permission:criar-correicao-extraordinaria']]);
        Route::get('{id}/editar',['as' =>'edit','uses'=>'Correicoes\CorreicaoExtraordinariaController@edit','middleware' => ['permission:editar-correicao-extraordinaria']]);
        Route::put('{id}/atualizar',['as' =>'update','uses'=>'Correicoes\CorreicaoExtraordinariaController@update','middleware' => ['permission:editar-correicao-extraordinaria']]);
        Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Correicoes\CorreicaoExtraordinariaController@destroy','middleware' => ['permission:remover-correicao-extraordinaria']]);
    });
});
/* -------------- ROTAS AJUDA -------------- */
Route::group(['as'=>'ajuda.','prefix' =>'ajuda'],function(){
	Route::get('',['as' =>'index','uses'=>'Ajuda\AjudaController@index']);
	Route::get('criar',['as' =>'create','uses'=>'Ajuda\AjudaController@create']);
	Route::post('salvar',['as' =>'store','uses'=>'Ajuda\AjudaController@store']);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Ajuda\AjudaController@edit']);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Ajuda\AjudaController@update']);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Ajuda\AjudaController@destroy']);
});
/* -------------- ROTAS LOGS -------------- */
//Route::group(['as'=>'log.','prefix' =>'log','middleware' => ['permission:supervisao']],function(){
Route::group(['as'=>'log.','prefix' =>'log'],function(){
	Route::get('acessos',['as' =>'acessos','uses'=>'Log\LogController@acessos']);
	Route::get('bloqueios',['as' =>'bloqueios','uses'=>'Log\LogController@bloqueios']);
	//processos e procedimentos
	Route::get('adl',['as' =>'adl','uses'=>'Log\LogController@adl']);
	Route::get('apfd',['as' =>'apfd','uses'=>'Log\LogController@apfd']);
	Route::get('cj',['as' =>'cj','uses'=>'Log\LogController@cj']);
	Route::get('cd',['as' =>'cd','uses'=>'Log\LogController@cd']);
	Route::get('it',['as' =>'it','uses'=>'Log\LogController@it']);
	Route::get('iso',['as' =>'iso','uses'=>'Log\LogController@iso']);
	Route::get('fatd',['as' =>'fatd','uses'=>'Log\LogController@fatd']);
	Route::get('pad',['as' =>'pad','uses'=>'Log\LogController@pad']);
	Route::get('sindicancia',['as' =>'sindicancia','uses'=>'Log\LogController@sindicancia']);
	Route::get('sai',['as' =>'sai','uses'=>'Log\LogController@sai']);
	Route::get('procoutros',['as' =>'procoutros','uses'=>'Log\LogController@procoutros']);
	Route::get('desercao',['as' =>'desercao','uses'=>'Log\LogController@desercao']);
	Route::get('exclusao',['as' =>'exclusao','uses'=>'Log\LogController@exclusao']);
	Route::get('ipm',['as' =>'ipm','uses'=>'Log\LogController@ipm']);
	Route::get('movimento',['as' =>'movimento','uses'=>'Log\LogController@movimento']);
	Route::get('recurso',['as' =>'recurso','uses'=>'Log\LogController@recurso']);
	//apresentações em juizo
	Route::get('notacoger',['as' =>'notacoger','uses'=>'Log\LogController@notacoger']);
	Route::get('apresentacao',['as' =>'apresentacao','uses'=>'Log\LogController@apresentacao']);
	Route::get('locaisapresentacao',['as' =>'locaisapresentacao','uses'=>'Log\LogController@locaisapresentacao']);
	Route::get('email',['as' =>'email','uses'=>'Log\LogController@email']);
	//administração
	Route::get('consulta',['as' =>'consulta','uses'=>'Log\LogController@consulta']);
	Route::get('fdi',['as' =>'fdi','uses'=>'Log\LogController@fdi']);
	Route::get('apagados',['as' =>'apagados','uses'=>'Log\LogController@apagados']);
	Route::get('bloqueios',['as' =>'bloqueios','uses'=>'Log\LogController@bloqueios']);
	Route::get('papeis',['as' =>'papeis','uses'=>'Log\LogController@papeis']);
	Route::get('permissoes',['as' =>'permissoes','uses'=>'Log\LogController@permissoes']);
	//Policiais
	Route::get('fdi',['as' =>'fdi','uses'=>'Log\LogController@fdi']);
	Route::get('feriado',['as' =>'feriado','uses'=>'Log\LogController@feriado']);
	Route::get('cadastroopmcoger',['as' =>'cadastroopmcoger','uses'=>'Log\LogController@cadastroopmcoger']);
	Route::get('comportamentopm',['as' =>'comportamentopm','uses'=>'Log\LogController@comportamentopm']);
	Route::get('denunciacivil',['as' =>'denunciacivil','uses'=>'Log\LogController@denunciacivil']);
	Route::get('elogio',['as' =>'elogio','uses'=>'Log\LogController@elogio']);
	Route::get('reintegrado',['as' =>'reintegrado','uses'=>'Log\LogController@reintegrado']);
	Route::get('falecimento',['as' =>'falecimento','uses'=>'Log\LogController@falecimento']);
	Route::get('preso',['as' =>'preso','uses'=>'Log\LogController@preso']);
	Route::get('restricao',['as' =>'restricao','uses'=>'Log\LogController@restricao']);
	Route::get('suspenso',['as' =>'suspenso','uses'=>'Log\LogController@suspenso']);
	Route::get('tramitacaoopm',['as' =>'tramitacaoopm','uses'=>'Log\LogController@tramitacaoopm']);
});

/* -------------- ROTAS HISTÓRIA -------------- */
Route::group(['as'=>'historia.','prefix' =>'historia'],function(){
	Route::get('',['as' =>'ver','uses'=>'Historia\HistoriaController@index']);
	Route::post('salvar',['as' =>'store','uses'=>'Historia\HistoriaController@store']);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Historia\HistoriaController@update']);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Historia\HistoriaController@destroy']);
});

/* -------------- ROTAS VIA AJAX -------------- */
Route::group(['as'=>'ajax.','prefix' =>'ajax'],function(){
    // Route::post('acusado/ligacao',['as' =>'ligacao.store','uses'=>'Ajax\ProcController@store']);
    // Route::get('proc/ligacao/list/{proc}/{ref}/{ano}',['as' =>'ligacao.index','uses'=>'Ajax\ProcController@list']);
    // Route::delete('proc/ligacao/remover/{id}',['as' =>'ligacao.destroy','uses'=>'Ajax\ProcController@destroy']);
	Route::post('add/form',['as' =>'add','uses'=>'Ajax\ViewController@add']);
	//Route::post('ligacao',['as' =>'ligacao','uses'=>'Ajax\AjaxController@ligacao']);
});

/* -------------- ROTAS VUE -------------- */
Route::group(['as'=>'session.','prefix' =>'session'],function(){
    Route::get('dados',['as' =>'dados','uses'=>'Dev\SessionController@dados']);
});
/*
|EXEMPLO DE TÍTULO DE MÓDULO
*/
/* Exemplo para Crud básico
//Rotas do módulo XX
Route::group(['as'=>'XX.','prefix' =>'XX','middleware' => ['permission:']],function(){
	Route::get('',['as' =>'index','uses'=>'XXController@index','middleware' => ['permission:']]);
	Route::get('criar',['as' =>'create','uses'=>'XXController@create','middleware' => ['permission:']]);
	Route::post('salvar',['as' =>'store','uses'=>'XXController@store','middleware' => ['permission:']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'XXController@edit','middleware' => ['permission:']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'XXController@update','middleware' => ['permission:']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'XXController@destroy','middleware' => ['permission:']]);
});
*/
