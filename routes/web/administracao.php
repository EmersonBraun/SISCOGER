<?php
//Rotas do módulo User
Route::group(['as'=>'user.','prefix' =>'usuario'],function(){
    Route::get('',['as' =>'index','uses'=>'Administracao\User\UserController@index']);
    Route::get('apagados',['as' =>'apagados','uses'=>'Administracao\User\UserController@apagados']);
	Route::get('criar',['as' =>'create','uses'=>'Administracao\User\UserController@create']);
	Route::post('salvar',['as' =>'store','uses'=>'Administracao\User\UserController@store']);
	Route::get('editar/{id}',['as' =>'edit','uses'=>'Administracao\User\UserController@edit']);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Administracao\User\UserController@update']);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Administracao\User\UserController@destroy']);
	//Alterar senha
	Route::get('{id}/senha',['as' =>'pass','uses'=>'Administracao\User\PasswordController@passedit']);
	Route::put('{id}/senhaatualizar',['as' =>'passupdate','uses'=>'Administracao\User\PasswordController@passupdate']);
	//bloqueio e desbloqueio
	Route::get('{id}/bloquear',['as' =>'block','uses'=>'Administracao\User\UserController@block']);
	Route::get('{id}/desbloquear',['as' =>'unblock','uses'=>'Administracao\User\UserController@unblock']);
	//reenviar email
    Route::get('{id}/{resend}/reenviar',['as' =>'sendMail','uses'=>'Administracao\User\UserController@sendMail']);
	//manual usuário
	Route::get('manual',['as' =>'manual','uses'=>'Administracao\User\UserController@manual']);
	//termos do usuário
	Route::get('{id}/termocriar',['as' =>'termocriar','uses'=>'Administracao\User\TermosController@termocriar']);
    Route::post('{id}/termosalvar',['as' =>'termosalvar','uses'=>'Administracao\User\TermosController@termosalvar']);
});
//Rotas do módulo Regras
Route::group(['as'=>'role.','prefix' =>'papel','middleware' => ['role:admin']],function(){
	Route::get('',['as' =>'index','uses'=>'Administracao\RoleController@index']);
	Route::get('criar',['as' =>'create','uses'=>'Administracao\RoleController@create']);
	Route::post('salvar',['as' =>'store','uses'=>'Administracao\RoleController@store']);
	Route::get('editar/{id}',['as' =>'edit','uses'=>'Administracao\RoleController@edit']);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Administracao\RoleController@update']);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Administracao\RoleController@destroy']);
});
//Rotas do módulo Permissões
Route::group(['as'=>'permission.','prefix' =>'permissao','middleware' => ['role:admin']],function(){
    Route::get('',['as' =>'index','uses'=>'Administracao\PermissionController@index']);
    Route::get('treeview',['as' =>'treeview','uses'=>'Administracao\PermissionController@treeview']);
	Route::get('criar',['as' =>'create','uses'=>'Administracao\PermissionController@create']);
	Route::post('salvar',['as' =>'store','uses'=>'Administracao\PermissionController@store']);
	Route::get('editar/{id}',['as' =>'edit','uses'=>'Administracao\PermissionController@edit']);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Administracao\PermissionController@update']);
	Route::delete('remover/{id}',['as' =>'destroy','uses'=>'Administracao\PermissionController@destroy']);
});
//Rotas do módulo controle SJDS
Route::group(['as'=>'sjd.','prefix' =>'sjd','middleware' => ['role:admin']],function(){
	Route::get('',['as' =>'index','uses'=>'Administracao\SjdController@index']);
	Route::get('criar',['as' =>'create','uses'=>'Administracao\SjdController@create']);
	Route::post('salvar',['as' =>'store','uses'=>'Administracao\SjdController@store']);
	Route::get('editar/{id}',['as' =>'edit','uses'=>'Administracao\SjdController@edit']);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Administracao\SjdController@update']);
	Route::delete('remover/{id}',['as' =>'destroy','uses'=>'Administracao\SjdController@destroy']);
});
//Rotas do módulo Terms
Route::group(['as'=>'term.','prefix' =>'termo'],function(){
    Route::get('',['as' =>'index','uses'=>'Administracao\TermController@index']);
	Route::get('criar/{id}',['as' =>'create','uses'=>'Administracao\TermController@create']);
	Route::post('salvar/{id}',['as' =>'store','uses'=>'Administracao\TermController@store']);
});
//Rotas do módulo feriado
Route::group(['as'=>'feriado.','prefix' =>'feriado'],function(){
	Route::get('',['as' =>'index','uses'=>'Administracao\FeriadoController@index','middleware' => ['permission:listar-feriados']]);
	Route::get('criar',['as' =>'create','uses'=>'Administracao\FeriadoController@create','middleware' => ['permission:criar-feriados']]);
	Route::post('salvar',['as' =>'store','uses'=>'Administracao\FeriadoController@store','middleware' => ['permission:criar-feriados']]);
	Route::get('editar/{id}',['as' =>'edit','uses'=>'Administracao\FeriadoController@edit','middleware' => ['permission:editar-feriados']]);
	Route::put('atualizar/{id}',['as' =>'update','uses'=>'Administracao\FeriadoController@update','middleware' => ['permission:editar-feriados']]);
	Route::get('remover/{id}',['as' =>'destroy','uses'=>'Administracao\FeriadoController@destroy','middleware' => ['permission:apagar-feriados']]);
});
