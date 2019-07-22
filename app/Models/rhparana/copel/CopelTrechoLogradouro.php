<?php

namespace App\Models\rhparana\copel;

use Reliese\Database\Eloquent\Model as Eloquent;

class CopeTrecholLogradouro extends Eloquent
{
    protected $connection = 'rhparana';
	protected $table = 'COPEL_TRECHO_LOGRADOURO';
	protected $primaryKey = 'CDLOGRADOURO';
	public $timestamps = false;

	protected $fillable = [
		'CDLOGRADOURO',
        'CDTRECHO',
        'NUMINICIAL',
        'NUMFINAL',
        'STARTX',
        'STARTY',
        'ENDX',
        'ENDY',
        'COMPRIMENTOTRECHO',
        'cod_local_trlog',
        'UF',
        'CDMUNICIPIO',
        'CDLOGINICIO',
        'CDLOGFIM',
        'CDBAIRRO',
        'gid', 
	];
}