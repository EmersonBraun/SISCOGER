<?php
//Aqui fica a parte de lógica dos controllers, para não ficar enchendo de atribuições erradas
namespace App\Services;

class QueryService 
{

	public function __construct()
    {
    }

    public function mount($dados)
	{
        $query = [];

        foreach ($dados as $key => $val) {
            // verificação para o comparativo
            $operator = '=';

            $fim_string = substr($key, -4, 4);
            if($fim_string == '_ini' || $fim_string == '_fim') {
                $operator = ($fim_string == '_ini') ? '>=' : '<='; 
                $key = substr_replace($key,'',-4,4);

                if(substr($key, -4, 4) !== '_ano') $val = $val.'-01-01';
            }

            //adicionar o que precisa de config sistema para busca
            $sistema = ['andamento','situacao'];
            if(in_array($key,$sistema)) {
                $this->sistema($dados,$query);
            } else {
                if($val) array_push($query,[$key,$operator,$val]);
            }  
        }

        return $query;
    }
    
    public function sistema($dados, $query)
    {
        if($dados['andamento']) array_push($query,['id_andamento','=',array_search($dados['andamento'],config('sistema.andamento'))]);
        if($dados['situacao']) array_push($query,['situacao','=',array_search($dados['situacao'],config('sistema.procSituacao'))]);
    }
}

