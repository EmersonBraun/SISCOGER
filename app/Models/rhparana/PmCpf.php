<?php

namespace App\Models\rhparana;

use Reliese\Database\Eloquent\Model as Eloquent;

class PmCpf extends Eloquent
{
    protected $connection = 'pm_cpf';
	protected $table = 'PM4_ATIVA';
	protected $primaryKey = 'ID_META4';
	public $timestamps = false;

	protected $fillable = [
		'ID_META4',
        'STD_OR_HR_PERIOD',
        'DATA_ADMISSAO',
        'NOME',
        'RG',
        'CLASSE',
        'NASCIMENTO',
        'ID_SEXO',
        'SEXO',
        'ADMISSAO_REAL',
        'EMAIL_META4',
        'FUNCAO',
        'CARGO',
        'QUADRO',
        'SUBQUADRO',
        'PROMOCAO',
        'REFERENCIA',
        'BAIRRO',
        'CIDADE',
        'OPM_DESCRICAO',
        'OPM_META4',
        'CDOPM',
        'cpf', 
	];
}