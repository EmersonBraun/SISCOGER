<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;

use App\Repositories\BaseRepository;
use App\Models\rhparana\Inativos;

class InativoRepository extends BaseRepository
{
    protected $model;
    protected $expiration = 60 * 24 * 7;  //uma semana

	public function __construct(Inativos $model)
	{
        $this->model = $model;     
    }
    
    public function cleanCache()
	{
        Cache::tags('inativo')->flush();
    }

    public function all()
	{

        $registros = Cache::tags('inativo')->remember('todos_inativo', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    }

    public function get($rg)
	{

        $registro = Cache::tags('inativo')->remember('inativo:rg'.$rg, $this->expiration, function() use ($rg){
            return $this->model->where('CBR_NUM_RG','=', $rg)->first();
        });

        if($registro) {
            return (object) [
                'CARGO' => $registro['cargo'],
                'QUADRO' => $registro['QUADRO'],
                'SUBQUADRO' => 'RR',
                'NOME' => $registro['NOME'],
                'RG' => $registro['CBR_NUM_RG'],
                'OPM_DESCRICAO' => '-',
                'NASCIMENTO' => $registro['DT_NASC'],
                'ADMISSAO_REAL' => $registro['DT_INI_RH'],
                'CIDADE' => $registro['END_CIDADE'],
                'EMAIL_META4' => '-',
                'SEXO' => $registro['SEXO'],
                'END_RUA' => $registro['END_LOGRADOURO'],
                'END_NUM' => $registro['END_NUMERO'],
                'END_COMPL' => $registro['END_COMPL'],
                'END_BAIRRO' => $registro['END_BAIRRO'],
                'END_CIDADE' => $registro['END_CIDADE'],
                'END_CEP' => $registro['END_CEP'],
                'FONE' => $registro['FONE'],
                'STATUS' => "Inativo",
                'SITUACAO' => "Normal",
                ];
        } else {
            return false;
        }
    }

    public function sugest($dados, $limit)
    {
        $type = ($dados['type'] == 'rg') ? 'CBR_NUM_RG' : 'nome';

        $query = $this->model->select('CBR_NUM_RG as rg','nome')
                        ->where($type,'like', '%'.$dados['search'].'%')
                        ->distinct($type);

        return $query->limit(floor($limit))->get()->toArray();
    }
}

