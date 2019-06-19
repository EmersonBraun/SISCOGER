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
//Route::get('teste', ['as'=>'teste','uses'=>'Testes\testeBD@opm']);
//Route::get('fds', ['as'=>'fds','uses'=>'Testes\testeBD@fds']);
//Route::get('tabelas/{conn}/{colunas?}', ['as'=>'teste','uses'=>'Testes\testeBD@tabelas']);
// Route::get('colunas/{nome}', ['as'=>'teste','uses'=>'Testes\testeBD@colunas']);
// Route::get('colunas2/{nome}', ['as'=>'teste','uses'=>'Testes\testeBD@colunas2']);
//Route::get('bd/{conn}/{nome}/{limite}/{c1?}/{oper?}{c2?}', ['as'=>'bd','uses'=>'Testes\testeBD@bd']);
Route::get('bd/{cod}/{nome?}', ['as'=>'bd','uses'=>'Testes\testeBD@search']);
Route::get('bd/qtds', ['as'=>'bd','uses'=>'Testes\testeBD@qtds']);
// Route::get('bd/bdgeral', ['as'=>'bdgeral','uses'=>'Testes\testeBD@bdgeral']);



Auth::routes();

/*
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
|ROTAS HOME/DASHBOARD
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
// Route::get('/home', ['as' =>'home','uses'=>'Relatorios\PendenciasController@index']);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('home/{opm}', ['as' =>'home.opm','uses'=>'Relatorios\PendenciasController@index', 'middleware' => ['permission:todas-unidades']]);

Route::match(['get'],'trocaropm', ['as' =>'trocaropm','uses'=>'Relatorios\PendenciasController@trocaropm', 'middleware' => ['permission:todas-unidades']]);
Route::get('logout', 'HomeController@logout')->middleware('auth.unique.user');

// Route::resource('{proc}/{id}/{arquivo}/fileupload', 'Arquivo\FileUploadController');
// Route::resource('{proc}/{id}/{arquivo}/fileupload', 'Arquivo\FileUploadController');

/*
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
|ROTAS UPLOAD
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
*/

// Route::group(['as'=>'upload.','prefix' =>'upload'],function(){
// 	Route::post('upload',['as' =>'upload','uses'=>'UploadController@upload']);
// 	Route::post('remover',['as' =>'remover','uses'=>'UploadController@remover']);
// });

/*
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
|ROTAS ADMINISTRAÇÃO
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
*/

include 'routes/web-routes/administracao.php';

/*
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
|ROTAS EMAIL
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
*/

//Rotas do módulo Email
Route::group(['as'=>'mail.','prefix' =>'email'],function(){
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
});

/*
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
|ROTAS APRESENTAÇÃO
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
*/

include 'routes/web-routes/apresentacao.php';

/*
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
|ROTAS PROCESSOS E PROCEDIMENTOS
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
*/

include 'routes/web-routes/processos.php';
include 'routes/web-routes/procedimentos.php';

/*
|--------------------------------------------------------------------------
|ROTAS MOVIMENTOS
|--------------------------------------------------------------------------
*/

Route::group(['as'=>'movimento.','prefix' =>'movimento'],function(){
	Route::post('{id}',['as' =>'inserir','uses'=>'Proc\MovimentoController@inserir']);
});

/*
|--------------------------------------------------------------------------
|ROTAS SOBRESTAMENTOS
|--------------------------------------------------------------------------
*/

Route::group(['as'=>'sobrestamento.','prefix' =>'sobrestamento'],function(){
	Route::post('{id}',['as' =>'inserir','uses'=>'Proc\SobrestamentoController@inserir']);
});

/*
|--------------------------------------------------------------------------
|ROTAS BUSCA
|--------------------------------------------------------------------------
*/
//Rotas do módulo Busca
Route::group(['as'=>'busca.','prefix' =>'busca'],function(){
    Route::get('pm',['as' =>'pm','uses'=>'Busca\BuscaController@pm']);
    Route::get('teste',['as' =>'teste','uses'=>'Busca\BuscaController@teste']);
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
/*
Route::group(['as'=>'busca.','prefix' =>'busca'],function(){
	Route::get('pm',['as' =>'pm','uses'=>'Busca\BuscaController@pm','middleware' => ['permission:buscar-pm']]);
	Route::get('ofendido',['as' =>'ofendido','uses'=>'Busca\BuscaController@ofendido','middleware' => ['permission:buscar-ofendido']]);
	Route::get('envolvido',['as' =>'envolvido','uses'=>'Busca\BuscaController@envolvido','middleware' => ['permission:buscar-envolvido']]);
	Route::get('documentacao',['as' =>'documentacao','uses'=>'Busca\BuscaController@documentacao','middleware' => ['permission:buscar-documentacao']]);
	Route::get('pdf',['as' =>'pdf','uses'=>'Busca\BuscaController@pdf','middleware' => ['permission:buscar-documentacao']]);
	Route::get('tramitacao',['as' =>'tramitacao','uses'=>'Busca\BuscaController@tramitacao','middleware' => ['permission:buscar-tramitacao-coger']]);
});
*/

/*
|--------------------------------------------------------------------------
|ROTAS PESQUISA - Para fazer buscas no banco de dados por funções AJAX ou em diversas partes do sistema
|--------------------------------------------------------------------------
*/

/*Route::group(['as'=>'pesquisa.','prefix' =>'pesquisa'],function(){
	Route::post('pm/{rg?}/{nome?}/busca',['as' =>'pm','uses'=>'PesquisaController@pm']);
	Route::post('p1/{conexao?}/{tabela}/{nome1}/{comparativo1}/{parametro1}',
		['as' =>'p1','uses'=>'PesquisaController@p1']);
	Route::post('p2/{conexao?}/{tabela}/{andor}{nome1}/{comparativo1}/{parametro1}/{nome2}/{comparativo2}/{parametro2}',
		['as' =>'p2','uses'=>'PesquisaController@p2']);
	Route::post('p3/{conexao?}/{tabela}/{andor}{nome1}/{comparativo1}/{parametro1}/{nome2}/{comparativo2}/{parametro2}/{nome3}/{comparativo3}/{parametro3}',
		['as' =>'p3','uses'=>'PesquisaController@p3']);
	Route::post('p4/{conexao?}/{tabela}/{andor}{nome1}/{comparativo1}/{parametro1}/{nome2}/{comparativo2}/{parametro2}/{nome3}/{comparativo3}/{parametro3}/{nome4}/{comparativo4}/{parametro4}',
		['as' =>'p4','uses'=>'PesquisaController@p4']);
	Route::post('p5/{conexao?}/{tabela}/{andor}{nome1}/{comparativo1}/{parametro1}/{nome2}/{comparativo2}/{parametro2}/{nome3}/{comparativo3}/{parametro3}/{nome4}/{comparativo4}/{parametro4}/{nome5}/{comparativo5}/{parametro5}',
		['as' =>'p5','uses'=>'PesquisaController@p5']);
	Route::post('p6/{conexao?}/{tabela}/{andor}{nome1}/{comparativo1}/{parametro1}/{nome2}/{comparativo2}/{parametro2}/{nome3}/{comparativo3}/{parametro3}/{nome4}/{comparativo4}/{parametro4}/{nome5}/{comparativo5}/{parametro5}/{nome6}/{comparativo6}/{parametro6}',
		['as' =>'p6','uses'=>'PesquisaController@p6']);
});*/
/*
|--------------------------------------------------------------------------
|ROTAS SAI
|--------------------------------------------------------------------------
*/
//Rotas do módulo Sai
Route::group(['as'=>'sai.','prefix' =>'sai','middleware' => ['permission:sai']],function(){
	Route::get('',['as' =>'index','uses'=>'Policiais\SaiController@index']);
	Route::get('criar',['as' =>'create','uses'=>'Policiais\SaiController@create']);
	Route::post('salvar',['as' =>'store','uses'=>'Policiais\SaiController@store']);
	Route::get('editar/{ref}/{ano}',['as' =>'edit','uses'=>'Policiais\SaiController@edit']);
	Route::put('atualizar/{ref}/{ano}',['as' =>'update','uses'=>'Policiais\SaiController@update']);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Policiais\SaiController@destroy']);
});
/*
|--------------------------------------------------------------------------
|ROTAS FICHA DISCIPLINAR INDIVIDUAL
|--------------------------------------------------------------------------
*/
//Rotas do módulo Fdi
Route::group(['as'=>'fdi.','prefix' =>'fdi'],function(){
	Route::get('',['as' =>'index','uses'=>'FDI\FdiController@index']);
	Route::get('criar',['as' =>'create','uses'=>'FDI\FdiController@create']);
	Route::post('salvar',['as' =>'store','uses'=>'FDI\FdiController@store']);
	Route::get('{rg}/ver',['as' =>'show','uses'=>'FDI\FdiController@show']);
	Route::get('{rg}/editar',['as' =>'edit','uses'=>'FDI\FdiController@edit']);
	Route::put('{rg}/atualizar',['as' =>'update','uses'=>'FDI\FdiController@update']);
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
/*
|--------------------------------------------------------------------------
|ROTAS POLICIAIS
|--------------------------------------------------------------------------
*/

include 'routes/web-routes/policiais.php';

/*
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
|ROTAS RELATÓRIOS
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
//Rotas do módulo Listar
/*Route::group(['as'=>'listar.','prefix' =>'listar'],function(){
	Route::get('',['as' =>'index','uses'=>'Relatorios\ListarController@index','middleware' => ['permission:']]);
});*/

//Rotas do módulo Relatorios
/*Route::group(['as'=>'relatorios.','prefix' =>'relatorios'],function(){
	Route::get('',['as' =>'procedimentos','uses'=>'Relatorios\RelatoriosController@procedimentos','middleware' => ['permission:']]);
});*/

//Rotas do módulo Armas
Route::group(['as'=>'armas.','prefix' =>'armas'],function(){
	Route::get('',['as' =>'index','uses'=>'Relatorios\ArmasController@index','middleware' => ['permission:listar-armas']]);
	Route::get('criar',['as' =>'create','uses'=>'Relatorios\ArmasController@create','middleware' => ['permission:criar-armas']]);
	Route::post('salvar',['as' =>'store','uses'=>'Relatorios\ArmasController@store','middleware' => ['permission:criar-armas']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Relatorios\ArmasController@edit','middleware' => ['permission:editar-armas']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Relatorios\ArmasController@update','middleware' => ['permission:editar-armas']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Relatorios\ArmasController@destroy','middleware' => ['permission:remover-armas']]);
});

//Rotas do módulo Pendencias
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

//Rotas do módulo Sobrestamento
Route::group(['as'=>'sobrestamento.','prefix' =>'sobrestamento','middleware' => ['permission:listar-relatorio-sobrestamento']],function(){
	Route::get('',['as' =>'index','uses'=>'Relatorios\SobrestamentoController@index']);
	Route::get('adl',['as' =>'adl','uses'=>'Relatorios\SobrestamentoController@adl']);
	Route::get('cd',['as' =>'cd','uses'=>'Relatorios\SobrestamentoController@cd']);
	Route::get('cj',['as' =>'cj','uses'=>'Relatorios\SobrestamentoController@cj']);
	Route::get('fatd',['as' =>'fatd','uses'=>'Relatorios\SobrestamentoController@fatd']);
	Route::get('it',['as' =>'it','uses'=>'Relatorios\SobrestamentoController@it']);
	Route::get('sindicancia',['as' =>'sindicancia','uses'=>'Relatorios\SobrestamentoController@sindicancia']);
});

/*
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
|ROTAS CORREIÇÕES 
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
//Rotas do módulo Correicao ordinária
Route::group(['as'=>'correicao.','prefix' =>'correicao'],function(){
	Route::get('',['as' =>'index','uses'=>'Correicoes\CorreicaoController@index','middleware' => ['permission:listar-correicao-ordinaria']]);
	Route::get('criar',['as' =>'create','uses'=>'Correicoes\CorreicaoController@create','middleware' => ['permission:criar-correicao-ordinaria']]);
	Route::post('salvar',['as' =>'store','uses'=>'Correicoes\CorreicaoController@store','middleware' => ['permission:criar-correicao-ordinaria']]);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Correicoes\CorreicaoController@edit','middleware' => ['permission:editar-correicao-ordinaria']]);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Correicoes\CorreicaoController@update','middleware' => ['permission:editar-correicao-ordinaria']]);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Correicoes\CorreicaoController@destroy','middleware' => ['permission:remover-correicao-ordinaria']]);

//Rotas do módulo Correicao extraordinária
	Route::get('extra',['as' =>'extra.index','uses'=>'Correicoes\CorreicaoController@indexExtra','middleware' => ['permission:listar-correicao-extraordinaria']]);
	Route::get('extra/criar',['as' =>'extra.create','uses'=>'Correicoes\CorreicaoController@createExtra','middleware' => ['permission:criar-correicao-extraordinaria']]);
	Route::post('extra/salvar',['as' =>'extra.store','uses'=>'Correicoes\CorreicaoController@storeExtra','middleware' => ['permission:criar-correicao-extraordinaria']]);
	Route::get('extra/{id}/editar',['as' =>'extra.edit','uses'=>'Correicoes\CorreicaoController@editExtra','middleware' => ['permission:editar-correicao-extraordinaria']]);
	Route::put('extra/{id}/atualizar',['as' =>'extra.update','uses'=>'Correicoes\CorreicaoController@updateExtra','middleware' => ['permission:editar-correicao-extraordinaria']]);
	Route::delete('extra/{id}/remover',['as' =>'extra.destroy','uses'=>'Correicoes\CorreicaoController@destroyExtra','middleware' => ['permission:remover-correicao-extraordinaria']]);
});
/*
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
|ROTAS AJUDA
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
//Rotas do módulo Ajuda
Route::group(['as'=>'ajuda.','prefix' =>'ajuda'],function(){
	Route::get('',['as' =>'index','uses'=>'Ajuda\AjudaController@index']);
	Route::get('criar',['as' =>'create','uses'=>'Ajuda\AjudaController@create']);
	Route::post('salvar',['as' =>'store','uses'=>'Ajuda\AjudaController@store']);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Ajuda\AjudaController@edit']);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Ajuda\AjudaController@update']);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Ajuda\AjudaController@destroy']);
});
/*
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
|ROTAS LOGS
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
//Rotas do módulo Log
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
	Route::get('feriados',['as' =>'feriados','uses'=>'Log\LogController@feriados']);
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

/*
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
|ROTAS HISTÓRIA
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
Route::group(['as'=>'historia.','prefix' =>'historia'],function(){
	Route::get('',['as' =>'ver','uses'=>'Historia\HistoriaController@index']);
	//Route::get('criar',['as' =>'create','uses'=>'Historia\HistoriaController@create']);
	Route::post('salvar',['as' =>'store','uses'=>'Historia\HistoriaController@store']);
	Route::get('{id}/editar',['as' =>'edit','uses'=>'Historia\HistoriaController@edit']);
	Route::put('{id}/atualizar',['as' =>'update','uses'=>'Historia\HistoriaController@update']);
	Route::delete('{id}/remover',['as' =>'destroy','uses'=>'Historia\HistoriaController@destroy']);
});

/*
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
|ROTAS VIA AJAX
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
//Rotas do módulo ajax
Route::group(['as'=>'ajax.','prefix' =>'ajax'],function(){
    
    // Route::post('acusado/ligacao',['as' =>'ligacao.store','uses'=>'Ajax\ProcController@store']);
    // Route::get('proc/ligacao/list/{proc}/{ref}/{ano}',['as' =>'ligacao.index','uses'=>'Ajax\ProcController@list']);
    // Route::delete('proc/ligacao/remover/{id}',['as' =>'ligacao.destroy','uses'=>'Ajax\ProcController@destroy']);


	Route::post('add/form',['as' =>'add','uses'=>'Ajax\ViewController@add']);
	Route::get('remove/{table}/{id}',['as' =>'remove','uses'=>'Ajax\ViewController@remove']);
	//Route::post('ligacao',['as' =>'ligacao','uses'=>'Ajax\AjaxController@ligacao']);
});


/*
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
|ROTAS DEV - comandos e outras funções que ajudam o desenvolvedor
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
*/

//Rotas do módulo dev
Route::group(['as'=>'dev.','prefix' =>'dev'],function(){
    // artisan
	Route::get('artisan/clearcache',['as' =>'clearcache','uses'=>'Dev\ArtisanController@clearCache']);
	Route::get('artisan/optimize',['as' =>'optimize','uses'=>'Dev\ArtisanController@optimize']);
	Route::get('artisan/routecache',['as' =>'routecache','uses'=>'Dev\ArtisanController@routeCache']);
	Route::get('artisan/routeclear',['as' =>'routeclear','uses'=>'Dev\ArtisanController@routeClear']);
	Route::get('artisan/viewclear',['as' =>'viewclear','uses'=>'Dev\ArtisanController@viewClear']);
	Route::get('artisan/configcache',['as' =>'configcache','uses'=>'Dev\ArtisanController@configCache']);
});

/*
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
|ROTAS VUE
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
*/

// dados da sessão para uso no vue
Route::group(['as'=>'session.','prefix' =>'session'],function(){
    //para atualizar um campo de um procedimento
    Route::get('dados',['as' =>'dados','uses'=>'Dev\SessionController@dados']);
});
/*
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
|EXEMPLO DE TÍTULO DE MÓDULO
|----------------------------------------------------------------------------------------------------------------------------------------------------------------
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



