<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Administracao;

use Reliese\Database\Eloquent\Model as Eloquent;
use Spatie\Activitylog\Traits\LogsActivity;
/**
 * Class Cadastroopmcoger
 * 
 * @property int $id_cadastroopmcoger
 * @property string $cdopm
 * @property string $opm_nome_por_extenso
 * @property int $id_municipio
 * @property string $opm_intermediaria_cdopm
 * @property string $opm_intermediaria_nome_por_extenso
 * @property string $opm_autoridade_rg
 * @property string $opm_autoridade_cargo
 * @property string $opm_autoridade_quadro
 * @property string $opm_autoridade_subquadro
 * @property string $opm_autoridade_nome
 * @property string $opm_autoridade_funcao
 * @property string $opm_autoridade_funcao_respondendo
 * @property string $memorando_sigla
 * @property \Carbon\Carbon $dh
 * @property string $usuario_rg
 *
 * @package App\Models
 */
class Cadastroopmcoger extends Eloquent
{
    //Activitylog
	use LogsActivity;
    protected static $logName = 'cadastroopmcoger';
    protected static $logAttributes = ['*'];
	protected static $logOnlyDirty = true;

	protected $table = 'cadastroopmcoger';
	protected $primaryKey = 'id_cadastroopmcoger';
	public $timestamps = false;

	protected $casts = [
		'id_municipio' => 'int'
	];

	protected $dates = [
		'dh'
	];

	protected $fillable = [
		'cdopm',
		'opm_nome_por_extenso',
		'id_municipio',
		'opm_intermediaria_cdopm',
		'opm_intermediaria_nome_por_extenso',
		'opm_autoridade_rg',
		'opm_autoridade_cargo',
		'opm_autoridade_quadro',
		'opm_autoridade_subquadro',
		'opm_autoridade_nome',
		'opm_autoridade_funcao',
		'opm_autoridade_funcao_respondendo',
		'memorando_sigla',
		'dh',
		'usuario_rg'
	];
}
