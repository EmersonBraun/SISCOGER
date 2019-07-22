<?php

namespace App\Models\rhparana;

use Reliese\Database\Eloquent\Model as Eloquent;

class Pmcm extends Eloquent
{
    protected $connection = 'rhparana';
	protected $table = 'pm_cm';
	protected $primaryKey = 'ID_META4';
	public $timestamps = false;

	protected $fillable = [
		'ID_META4',
        'STD_OR_HR_PERIOD',
        'secao',
        'uf',
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
        'nome_mae',
        'nome_pai',
        'numero_titulo',
        'zona',  
	];
}