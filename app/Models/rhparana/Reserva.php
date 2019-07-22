<?php

namespace App\Models\rhparana;

use Reliese\Database\Eloquent\Model as Eloquent;

class Reserva extends Eloquent
{
    protected $connection = 'rhparana';
	protected $table = 'RESERVA';
	protected $primaryKey = 'UserRG';
	public $timestamps = false;

	protected $fillable = [
		'UserRG',
        'nome',
        'posto',
        'quadro',
        'subquadro',
        'data',
        'id',
	];
}