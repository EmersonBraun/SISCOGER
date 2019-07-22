<?php

namespace App\Models\rhparana\copel;

use Reliese\Database\Eloquent\Model as Eloquent;

class CopelLogradouro extends Eloquent
{
    protected $connection = 'rhparana';
	protected $table = 'COPEL_LOGRADOURO';
	protected $primaryKey = 'GID';
	public $timestamps = false;

	protected $fillable = [
		'UF',
        'CDMUNICIPIO',
        'CDLOGRADOURO',
        'CDTIPOLOGRADOURO_OLD',
        'CDTITULOLOGRADOURO_OLD',
        'NOME_OLD',
        'CDTIPOLOGRADOURO',
        'CDTITULOLOGRADOURO',
        'NOME',
        'CDLOGRADOUROINICIO',
        'CDLOGRADOUROFIM',
        'SISTEMA_COPEL',
        'GID',
	];
}