<?php

namespace App\Models\pass;

use Reliese\Database\Eloquent\Model as Eloquent;

class LogAcessos extends Eloquent
{
    protected $connection = 'pass';
	protected $table = 'LOG_ACESSOS';
	protected $primaryKey = 'rg';
	public $timestamps = false;

	protected $fillable = [
		'rg',
        'GrupoID',
        'ip',
        'datahora'
	];
}