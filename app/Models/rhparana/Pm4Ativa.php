<?php

namespace App\Models\rhparana;

use Reliese\Database\Eloquent\Model as Eloquent;

class Pm4Ativa extends Eloquent
{
    protected $connection = 'rhparana';
	protected $table = 'PM4_ATIVA';
	protected $primaryKey = 'RG';
	public $timestamps = false;

	protected $fillable = [
		'RG',
        'NOME',
        'UNIDADE',
        'POST_GRAD',
	];
}