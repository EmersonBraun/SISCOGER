<?php

namespace App\Models\rhparana;

use Reliese\Database\Eloquent\Model as Eloquent;

class ContatoReserva extends Eloquent
{
    protected $connection = 'rhparana';
	protected $table = 'CONTATORESERVA';
	protected $primaryKey = 'rg';
	public $timestamps = false;

	protected $fillable = [
		'RG',
        'FONE',
        'EMAIL',
        'ATUALIZACAO_DATA'
	];
}