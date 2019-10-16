<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;

use App\Repositories\BaseRepository;
use App\Models\rhparana\Reserva;

class ReservaRepository extends BaseRepository
{
    protected $model;
    protected $expiration = 60 * 24 * 7;  //uma semana

	public function __construct(Reserva $model)
	{
        $this->model = $model;     
    }
    
    public function cleanCache()
	{
        Cache::tags('reserva')->flush();
    }

    public function all()
	{

        $registros = Cache::tags('reserva')->remember('todos_reserva', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    }
    
    public function get($rg)
	{

        $registro = Cache::tags('reserva')->remember('reserva:rg'.$rg, $this->expiration, function() use ($rg){
            return $this->model->where('UserRG','=', $rg)->first();
        });

        if($registro) {
            return (object) [
                'CARGO' => $registro['posto'],
                'QUADRO' => $registro['quadro'],
                'SUBQUADRO' => $registro['subquadro'],
                'NOME' => $registro['nome'],
                'RG' => $registro['UserRG'],
                'OPM_DESCRICAO' => '-',
                'NASCIMENTO' => '',
                'ADMISSAO_REAL' => $registro['data'],
                'CIDADE' => '-',
                'EMAIL_META4' => '-',
                'SEXO' => '-',
                'STATUS' => "registro",
                'SITUACAO' => "Normal",
                'CDOPM' => null,
                'OPM_DESCRICAO' => 'Não encontrado',
            ];
        } else {
            return false;
        }
    }

    public function sugest($dados, $limit)
    {
        $type = ($dados['type'] == 'rg') ? 'UserRG' : 'nome';

        $query = $this->model->select('UserRG as rg','nome')
                        ->where($type,'like', '%'.$dados['search'].'%')
                        ->distinct($type);

        return $query->limit(floor($limit))->get()->toArray();
    }
}

