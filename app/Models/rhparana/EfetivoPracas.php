<?php

namespace App\Models\rhparana;

use Reliese\Database\Eloquent\Model as Eloquent;

class EfetivoPracas extends Eloquent
{
    protected $connection = 'rhparana';
	protected $table = 'EFETIVO_PRACAS';
	protected $primaryKey = 'UserRG';
	public $timestamps = false;

	protected $fillable = [
		'UserRG',
        'nome',
        'graduacao',
        'quadro',
        'subquadro',
        'inclusao_data',
        'opm',
        'referencia',
        'cdopm', 
	];
}