<?php
//traz os dados do usuário
$unidade = session()->get('cdopmbase');
//caso não tenha unidade desloga
if($unidade == NULL || $unidade == '')
{
    Auth::logout();
    return redirect()->intended('login');
}