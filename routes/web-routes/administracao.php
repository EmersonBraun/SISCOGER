<?php
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

//Rotas do módulo Terms
Route::group(['as'=>'terms.','prefix' =>'termo'],function(){
	Route::get('',['as' =>'index','uses'=>'Administracao\TermsController@index']);
	Route::get('criar',['as' =>'create','uses'=>'Administracao\TermsController@create']);
	Route::post('salvar',['as' =>'store','uses'=>'Administracao\TermsController@store']);
});
/*
Route::group(['as'=>'terms.','prefix' =>'termo'],function(){
	Route::get('',['as' =>'index','uses'=>'Administracao\TermsController@index','middleware' => ['permission:listar-termos']]);
	Route::get('criar',['as' =>'create','uses'=>'Administracao\TermsController@create','middleware' => ['permission:criar-termos']]);
	Route::post('salvar',['as' =>'store','uses'=>'Administracao\TermsController@store','middleware' => ['permission:criar-termos']]);
});
*/

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