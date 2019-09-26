<?php
//Aqui fica a parte de lógica dos controllers, para não ficar enchendo de atribuições erradas
namespace App\Services;

useApp\Repositories\PM\EnvolvidoRepository;

class ProcedService 
{
    protected $envolvido;
	public function __construct(
        EnvolvidoRepository $envolvido
    )
    {
        $this->envolvido = $envolvido;
    }

    public function canSee($proc, $name)
	{
        if(!$proc || !$name) return false;

        if($proc instanceof Illuminate\Database\Eloquent\Collection) $proc = $proc->toArray();
        
        $canSeeOPM = $this->canSeeOPM($proc);
        if(!$canSeeOPM) return false;
        $canSeeSuperior = $this->canSeeSuperior($proc, $name);
        if(!$canSeeSuperior) return false;
    }

    //teste para verificar se pode ver outras unidades, caso não possa aborta
    public function canSeeOPM($proc)
	{
        //verifica se o usuário tem permissão para ver todas unidades s/n
        $verTodasUnidades = hasPermissionTo('todas-unidades');

        //se pode ver nem faz o resto dos testes
        if($verTodasUnidades) return true;

        //verificar se a opm de login é diferente da unidade do procedimento

        $opm = ($proc['cdopm'] !== session()->get('cdopmbase')) ? 1 : 0;

        /*não pode ver todas unidades e a unidade do procedimento diferente da opm do login
        *redireciona o erro de acesso não permitido */
        if ($verTodasUnidades == 0 && $opm == 1) {
            toast()->warning('Não tem permissão para ver outra unidade','ACESSO NEGADO!');
            return abort(403);
        }
        return true;
    }

    //teste para verificar se pode ver superior, caso não possa aborta
    public function canSeeSuperior($proc, $name)
	{
        //----envolvido do procedimento
        $envolvido = $this->envolvido->getByNameId($name, $proc['id_'.$proc]);
        
        $ehsuperior = 0;
        //verifica se o procedimento é de superior
        if(isset($envolvido))
        {
            foreach ($envolvido as $e) 
            {
                if(session('nivel') > sistema('posto',$e['cargo'])) 
                {
                    $ehsuperior = 1;
                    break;
                }
            }
        }

        /*caso o procedimento for de superior e não puder ver superior aborta */
        if ($ehsuperior) return abort(403);
        return false;

    }
  
}

