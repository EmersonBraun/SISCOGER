<?php

namespace App\Models\pass;

use Reliese\Database\Eloquent\Model as Eloquent;

class Movimentos extends Eloquent
{
    protected $connection = 'pass';
	protected $table = 'LOG_QUERY';
	protected $primaryKey = 'rg';
	public $timestamps = false;

	protected $fillable = [
		'rg',
        'grupoID',
        'ip',
        'datahora',
        'query'
	];
}