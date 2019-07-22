<?php

namespace App\Models\pass;

use Reliese\Database\Eloquent\Model as Eloquent;

class Opm extends Eloquent
{
    protected $connection = 'pass';
	protected $table = 'opm';
	protected $primaryKey = 'CODIGO';
	public $timestamps = false;

	protected $fillable = [
		'CODIGO',
        'CDMUNICIPIO',
        'ABREVIATURA',
        'DESCRICAO',
        'ENDERECO',
        'BAIRRO',
        'Col007',
        'CEP',
        'Col009',
        'ACI',
        'CINE',
        'COMUNITARIO',
        'OPMSIGLA'
	];
}