<?php

namespace App\Repositories\OPM;

use Cache;
use App\Models\rhparana\Municipio;
use App\Models\rhparana\Municipio2;

class MunicipioRepository
{
    protected $model;
    protected $model2;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24; 
 
	public function __construct(Municipio $model, Municipio2 $model2)
	{
		$this->model = $model;
		$this->model2 = $model2;
    }

    public static function nome($id_municipio) // função usada em presenters
    {
        //tempo de cahe
        $expiration = 60 * 24 * 30; //um mês
        if(!$id_municipio) return '';
        $registros = Cache::tags('municipio')->remember('municipio:'.$id_municipio, $expiration, function() use($id_municipio){
            try {
                $municipio = Municipio::where('id_municipio','like',$id_municipio.'%')->first();
            } catch (\Throwable $th) {
                //throw $th;
                $municipio = Municipio2::where('id_municipio','like',$id_municipio.'%')->first();
            }
             
             if($municipio) return $municipio->municipio;
             return 'Não encontrado';
        });

        return $registros;
    }
}