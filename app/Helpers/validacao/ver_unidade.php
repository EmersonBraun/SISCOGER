<?php
use App\User;
//para verificar se pode ver a unidade do procedimento
if (! function_exists('ver_unidade')) 
{
	function ver_unidade($proc)
	{
        //verifica se o usuário tem permissão para ver todas unidades s/n
        $verTodasUnidades = (User::permission('todas-unidades')->count() != NULL) ? 1 : 0;

        //verificar se a opm de login é diferente da unidade do procedimento
        if($proc instanceof Illuminate\Database\Eloquent\Collection) 
        {
            $opm = ($proc->cdopm != session()->get('cdopmbase')) ? 1 : 0;
        } 
        else 
        {
            $opm = ($proc['cdopm'] != session()->get('cdopmbase')) ? 1 : 0;
        }

        /*não pode ver todas unidades e a unidade do procedimento diferente da opm do login
        *redireciona o erro de acesso não permitido */
        if ($verTodasUnidades == 0 && $opm == 1) 
        {
            return abort(403);
        }
        else
        {
            return false;
        }
	}
}