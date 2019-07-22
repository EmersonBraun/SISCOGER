<?php

namespace App\Models\pass;

use Reliese\Database\Eloquent\Model as Eloquent;

class SegAplicacoes extends Eloquent
{
    protected $connection = 'pass';
	protected $table = 'seg_grupos_aplicacoes';
	protected $primaryKey = 'aplicacaoid';
	public $timestamps = false;

	protected $fillable = [
		'grupoid',
        'aplicacaoid'
	];
}