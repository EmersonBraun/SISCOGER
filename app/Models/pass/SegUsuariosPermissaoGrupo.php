<?php

namespace App\Models\pass;

use Reliese\Database\Eloquent\Model as Eloquent;

class SegUsuriosPermissaoGrupo extends Eloquent
{
    protected $connection = 'pass';
	protected $table = 'seg_usuario_permissao_grupo';
	protected $primaryKey = 'usuarioid';
	public $timestamps = false;

	protected $fillable = [
		'usuarioid',
        'grupoid'
	];
}