<?php

namespace App\Models\pass;

use Reliese\Database\Eloquent\Model as Eloquent;

class PPGrupos extends Eloquent
{
    protected $connection = 'pass';
	protected $table = 'PPGrupos';
	protected $primaryKey = 'SistemaID';
	public $timestamps = false;

	protected $fillable = [
		'GrupoID',
        'SistemaID',
        'ProjetoID'
	];
}