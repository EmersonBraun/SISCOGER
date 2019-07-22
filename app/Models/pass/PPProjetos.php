<?php

namespace App\Models\pass;

use Reliese\Database\Eloquent\Model as Eloquent;

class PPProjetos extends Eloquent
{
    protected $connection = 'pass';
	protected $table = 'PPProjetos';
	protected $primaryKey = 'SistemaID';
	public $timestamps = false;

	protected $fillable = [
		'SistemaID',
        'ProjetoID',
        'Project',
        'Major',
        'Minor',
        'Revision'
	];
}