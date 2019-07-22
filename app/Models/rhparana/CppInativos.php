<?php

namespace App\Models\rhparana;

use Reliese\Database\Eloquent\Model as Eloquent;

class CppInativos extends Eloquent
{
    protected $connection = 'rhparana';
	protected $table = 'CPP_INATIVOS';
	protected $primaryKey = 'UserRG';
	public $timestamps = false;

	protected $fillable = [
		'UserRG',
        'NOME',
        'graduacao',
        'reserva_data'
	];
}