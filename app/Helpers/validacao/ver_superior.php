<?php
//para verificar se pode ver se o procedimento é de superior e pode ser visto 
if (! function_exists('ver_superior')) 
{
	function ver_superior($envolvido, $user)
	{
        //verifica se o usuário tem permissão para ver superior s/n
        $verSuperior = (hasPermission($user, "ver-superior") == true) ? 1 : 0;
        $ehsuperior = 0;
        //verifica se o procedimento é de superior
        if(isset($envolvido))
        {
            foreach ($envolvido as $e) 
            {
                if(sistema('posto',session()->get('cargo')) > sistema('posto',$e['cargo'])) 
                {
                    $ehsuperior = 1;
                    break;
                }
            }
        }

        /*caso o procedimento for de superior e não puder ver superior aborta */
        if ($ehsuperior == 1 && $verSuperior == 0) 
        {
            return abort(403);
        }
        else
        {
            return false;
        }
	}
}