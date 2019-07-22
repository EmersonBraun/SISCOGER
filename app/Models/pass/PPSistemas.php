<?php

namespace App\Models\pass;

use Reliese\Database\Eloquent\Model as Eloquent;

class PPSistemas extends Eloquent
{
    protected $connection = 'pass';
	protected $table = 'PPSistemas';
	protected $primaryKey = 'SistemaID';
	public $timestamps = false;

	protected $fillable = [
		'SistemaID',
        'Descricao'
	];
}