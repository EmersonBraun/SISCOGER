<?php

namespace App\Models\rhparana\copel;

use Reliese\Database\Eloquent\Model as Eloquent;

class CopelBairro extends Eloquent
{
    protected $connection = 'rhparana';
	protected $table = 'COPEL_BAIRRO';
	protected $primaryKey = 'cdopmpc';
	public $timestamps = false;

	protected $fillable = [
		'UF',
        'CDMUNICIPIO',
        'CDBAIRRO',
        'NOME',
        'cdopm',
        'cdopmtran',
        'cdopmcb',
        'cdopmbprv',
        'cdopmflorestal',
        'cdopmpc', 
	];
}