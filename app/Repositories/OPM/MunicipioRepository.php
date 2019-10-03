<?php

namespace App\Repositories\OPM;

use Cache;
use App\Models\rhparana\Municipio;

class MunicipioRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24; 
 
	public function __construct(Municipio $model)
	{
		$this->model = $model;
    }

    public static function nome($id_municipio)
    {
        //tempo de cahe
        $expiration = 60 * 24 * 30; //um mês
        if(!$id_municipio) return '';
        $registros = Cache::tags('municipio')->remember('municipio:'.$id_municipio, $expiration, function() use($id_municipio){
             $municipio = $this->model->where('id_municipio','like',$id_municipio.'%')->first();
             if($municipio) return $municipio->municipio;
             return 'Não encontrado';
        });

        return $registros;
    }
}