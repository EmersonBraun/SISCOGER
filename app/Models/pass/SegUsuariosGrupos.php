<?php

namespace App\Models\pass;

use Reliese\Database\Eloquent\Model as Eloquent;

class SegUsuariosGrupo extends Eloquent
{
    protected $connection = 'pass';
	protected $table = 'seg_usuario_grupo';
	protected $primaryKey = 'usuarioid';
	public $timestamps = false;

	protected $fillable = [
		'usuarioid',
        'grupoid'
	];
}