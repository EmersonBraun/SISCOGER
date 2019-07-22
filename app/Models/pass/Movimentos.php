<?php

namespace App\Models\pass;

use Reliese\Database\Eloquent\Model as Eloquent;

class Movimentos extends Eloquent
{
    protected $connection = 'pass';
	protected $table = 'movimentos';
	protected $primaryKey = 'data';
	public $timestamps = false;

	protected $fillable = [
		'opmorigem',
        'opmdestino',
        'rg',
        'nome',
        'data'
	];
}