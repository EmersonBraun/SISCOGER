<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\arquivamento;

use Cache;

use App\Repositories\BaseRepository;

use App\Models\Sjd\Proc\Arquivo;
use Illuminate\Support\Facades\DB;
class ArquivamentoRepository extends BaseRepository
{
    protected $model;
    protected static $expiration = 60 * 24;//um dia; 

	public function __construct( Arquivo $model)
	{
        $this->model = $model;
    }

    public static function cleanCache()
	{
        Cache::tags('arquivamento')->flush();
    }
    
    public function all()
	{
        $registros = Cache::tags('arquivamento')->remember('todos_arquivamento', self::$expiration, function() {
            return $this->model->all();
        });
        return $registros;
    } 

    public function proc($proc, $id)
	{
        $registros = Cache::tags('arquivamento')->remember('arquivamento:'.$proc.':'.$id, self::$expiration, function() use ($proc, $id){
            return $this->model->where('id_'.$proc,'=',$id)->get();
        });
        return $registros;
    } 

    public function local($local)
	{
        if($local == 'cautela') $registros = $this->cautela();
        else $registros = $this->outros($local);
        return $registros;
    } 

    public function cautela() 
    {
        $registros = Cache::tags('arquivamento')->remember('arquivamento:cautela', self::$expiration, function() {
            return $this->model
            ->select(DB::raw('arquivo.*, DATEDIFF(NOW(),arquivo_data) as tempo'))
            ->where([
                ['numero','0'],
                ['letra','-'],
                ['local_atual','Cautela (Saida)']
            ])
            ->groupBy('procedimento', 'sjd_ref','sjd_ref_ano')
            ->get();
        });

        return $registros;
    }

    public function outros($local)
    {
        $tipolocal = $this->tipolocal($local);
        $registros = Cache::tags('arquivamento')->remember('arquivamento:'.$local, self::$expiration, function() use ($tipolocal){
            return $this->model->where('local_atual',$tipolocal)->get();
        });

        return $registros;
    }

    public function tipolocal($local)
    {
        $tipos = [
            'coger' => 'Arquivo COGER',
            'pmpr' => 'Arquivo Geral(PMPR)'
        ];

        return array_get($tipos,null, $local);
    }

}

