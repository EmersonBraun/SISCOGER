<?php

namespace App\Models\pass;

use Reliese\Database\Eloquent\Model as Eloquent;

class Concurso extends Eloquent
{
    protected $connection = 'pass';
	protected $table = 'concurso';
	protected $primaryKey = 'rg';
	public $timestamps = false;

	protected $fillable = [
		'rg',
        'senha',
        'direito'
	];
}