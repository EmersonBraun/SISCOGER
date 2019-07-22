<?php

namespace App\Models\pass;

use Reliese\Database\Eloquent\Model as Eloquent;

class PPGrupoDireito extends Eloquent
{
    protected $connection = 'pass';
	protected $table = 'PPGrupoDireito';
	protected $primaryKey = 'GrupoID';
	public $timestamps = false;

	protected $fillable = [
		'GrupoID',
        'DireitoID'
	];
}