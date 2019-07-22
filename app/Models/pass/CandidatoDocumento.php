<?php

namespace App\Models\pass;

use Reliese\Database\Eloquent\Model as Eloquent;

class CandidatoDocumento extends Eloquent
{
    protected $connection = 'pass';
	protected $table = 'candidato_documento';
	protected $primaryKey = 'candidato_id';
	public $timestamps = false;

	protected $fillable = [
        'candidato_id',
        'documento_id'
	];
}