<?php

namespace App\Models\pass;

use Reliese\Database\Eloquent\Model as Eloquent;

class DepConcurso extends Eloquent
{
    protected $connection = 'pass';
	protected $table = 'dep_concurso';
	protected $primaryKey = 'UserRG';
	public $timestamps = false;

	protected $fillable = [
		'UserRG',
        'UserSenha',
        'direitos'
	];
}