<?php

namespace App\Models\rhparana;

use Reliese\Database\Eloquent\Model as Eloquent;

class OpmImpMeta4 extends Eloquent
{
    protected $connection = 'rhparana';
	protected $table = 'OPM_IMP_META4';
	protected $primaryKey = 'UNIDADE_META4';
	public $timestamps = false;

	protected $fillable = [
		'UNIDADE_META4',
        'DESCRICAO_META4',
        'ID_PAI',
        'DESCRICAO_PAI',
        'UNIDADE_PMPR',
        'CD_LOCAL_TRABALHO',
        'LOCAL_TRABALHO',
        'DATA_INICIO',
        'DATA_FIM',
        'LOGRADOURO',
        'BAIRRO',
        'MUNICIPIO',
        'CEP',
        'DDD',
        'TELEFONE',
	];
}