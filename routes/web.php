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

// para rodar os testes
$middleware = [];
if ( !App::runningUnitTests() ) {
    $middleware[] = 'api.auth';
    Auth::routes();
}
// diretório onde estão os includes
$dir = __DIR__ .'/web/';

include $dir.'home.php'; //ROTAS HOME/DASHBOARD
include $dir.'administracao.php'; // ROTAS ADMINISTRAÇÃO
include $dir.'apresentacao.php'; //ROTAS APRESENTAÇÃO
include $dir.'processos_procedimentos.php'; //ROTAS PROCESSOS E PROCEDIMENTOS
include $dir.'movimento.php'; //ROTAS MOVIMENTOS
include $dir.'sobrestamento.php'; // ROTAS SOBRESTAMENTOS
include $dir.'busca.php'; //ROTAS BUSCA
include $dir.'fdi.php'; //ROTAS FICHA DISCIPLINAR INDIVIDUAL
include $dir.'policiais.php'; //ROTAS POLICIAIS
include $dir.'relatorios.php'; //ROTAS RELATÓRIOS
include $dir.'correicoes.php'; //ROTAS CORREIÇÕES
include $dir.'ajuda.php'; //ROTAS AJUDA
include $dir.'logs.php'; //ROTAS LOGS
include $dir.'historias.php'; //ROTAS HISTORIAS
include $dir.'ajax.php'; //ROTAS VIA AJAX
include $dir.'vue.php'; //ROTAS VUE
include $dir.'opm.php'; //ROTAS OPM
include $dir.'link.php'; //ROTAS LINK

/*
|EXEMPLO DE TÍTULO DE MÓDULO
*/
/* Exemplo para Crud básico
//Rotas do módulo XX
Route::group(['as'=>'XX.','prefix' =>'XX','middleware' => ['permission:']],function(){
	Route::get('',['as' =>'index','uses'=>'XXController@index','middleware' => ['permission:']]);
	Route::get('criar',['as' =>'create','uses'=>'XXController@create','middleware' => ['permission:']]);
	Route::post('salvar',['as' =>'store','uses'=>'XXController@store','middleware' => ['permission:']]);
	Route::get('editar/{id}',['as' =>'edit','uses'=>'XXController@edit','middleware' => ['permission:']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'XXController@update','middleware' => ['permission:']]);
	Route::delete('remover/{id}',['as' =>'destroy','uses'=>'XXController@destroy','middleware' => ['permission:']]);
});
*/
