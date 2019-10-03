<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\arquivamento;

use Cache;

use App\Repositories\BaseRepository;

use App\Models\Sjd\Proc\Arquivo;
use Illuminate\Support\Facades\DB;

class PrateleirasRepository extends BaseRepository
{
    protected $model;
    protected static $expiration = 60 * 24;//um dia; 

	public function __construct( Arquivo $model)
	{
        $this->model = $model;
    }

    public static function cleanCache()
	{
        Cache::tags('prateleiras')->flush();
    }
    
    public function prateleiras($numero)
    {
        $maxletra = $this->letra();
        
        foreach (range('a',$maxletra) as $letra) {
            $registros[$letra] = $this->procedimento($numero, $letra);
        }
                
        return $registros;
    }

    public function procedimento($numero, $letra)
    {
  
        $registros = Cache::tags('prateleiras')->remember('prateleiras:arquivo'.$numero.$letra, self::$expiration, function() use($numero, $letra){
            return $this->model
            ->where([
                ['local_atual','Arquivo COGER'],
                ['numero',$numero],
                ['letra',$letra]
            ])
            ->get();
        });

        return $registros; 
    }

    public function numero()
    {
        $registros = Cache::tags('prateleiras')->remember('prateleiras:numero', self::$expiration, function(){
            return $this->model->max('numero');
        });

        return $registros; 
    }

    public function letra()
    {
        $registros = Cache::tags('prateleiras')->remember('prateleiras:letra', self::$expiration, function(){
            return $this->model->max('letra');
        });

        return $registros; 
    }








}

