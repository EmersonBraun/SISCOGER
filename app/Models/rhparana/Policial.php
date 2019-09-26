<?php

namespace App\Models\rhparana;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Policial
 * 
 * @property string $id_meta4
 * @property string $std_or_hr_period
 * @property \Carbon\Carbon $data_admissao
 * @property string $nome
 * @property string $rg
 * @property string $classe
 * @property \Carbon\Carbon $nascimento
 * @property int $id_sexo
 * @property string $sexo
 * @property \Carbon\Carbon $admissao_real
 * @property string $email_meta4
 * @property string $funcao
 * @property string $cargo
 * @property string $quadro
 * @property string $subquadro
 * @property \Carbon\Carbon $promocao
 * @property string $referencia
 * @property string $bairro
 * @property string $cidade
 * @property string $opm_descricao
 * @property string $opm_meta4
 * @property string $cdopm
 *
 * @package App\Models
 */
class Policial extends Eloquent
{
	protected $connection = 'rhparana';
	protected $table = 'policial';
	protected $primaryKey = 'id_meta4';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_sexo' => 'int'
	];

	protected $dates = [
		'data_admissao',
		'nascimento',
		'admissao_real',
		'promocao'
	];

	public $fillable = [
		'std_or_hr_period',
		'data_admissao',
		'nome',
		'rg',
		'classe',
		'nascimento',
		'id_sexo',
		'sexo',
		'admissao_real',
		'email_meta4',
		'funcao',
		'cargo',
		'quadro',
		'subquadro',
		'promocao',
		'referencia',
		'bairro',
		'cidade',
		'opm_descricao',
		'opm_meta4',
		'cdopm'
	];

	public function getByRG($query, $rg)
    {
        return $query->where('rg',$rg);
    }
}
