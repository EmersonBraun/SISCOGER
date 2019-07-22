<?php

namespace App\Models\pass;

use Reliese\Database\Eloquent\Model as Eloquent;

class PPDireitos extends Eloquent
{
    protected $connection = 'pass';
	protected $table = 'PPDireitos';
	protected $primaryKey = 'DireitoID';
	public $timestamps = false;

	protected $fillable = [
		'DireitoID',
        'Descricao'
	];
}