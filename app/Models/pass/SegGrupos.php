<?php

namespace App\Models\pass;

use Reliese\Database\Eloquent\Model as Eloquent;

class SegGrupos extends Eloquent
{
    protected $connection = 'pass';
	protected $table = 'seg_grupos';
	protected $primaryKey = 'grupoid';
	public $timestamps = false;

	protected $fillable = [
		'grupoid',
        'descricao'
	];
}