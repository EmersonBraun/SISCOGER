<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:03 +0000.
 */

namespace App\Models\Sjd\Busca;

use Reliese\Database\Eloquent\Model as Eloquent;
//para monitorar o CREATE, UPDATE e DELETE e salvar log automaticamente
use Spatie\Activitylog\Traits\LogsActivity;
/**
 * Class Tramitacaoopm
 * 
 * @property int $id_tramitacaoopm
 * @property string $rg
 * @property string $cargo
 * @property string $nome
 * @property string $rg_cadastro
 * @property \Carbon\Carbon $data
 * @property string $cdopm
 * @property string $opm_abreviatura
 * @property string $descricao_txt
 * @property string $digitador
 *
 * @package App\Models
 */
class Tramitacaoopm extends Eloquent
{
	//Activitylog
	use LogsActivity;

    protected static $logName = 'tramitacaoopm';
    protected static $logAttributes = [
		'rg',
		'cargo',
		'nome',
		'rg_cadastro',
		'data',
		'cdopm',
		'opm_abreviatura',
		'descricao_txt',
		'digitador'
	];
	
	protected $table = 'tramitacaoopm';
	protected $primaryKey = 'id_tramitacaoopm';
	public $timestamps = false;

	protected $dates = [
		'data'
	];

	protected $fillable = [
		'rg',
		'cargo',
		'nome',
		'rg_cadastro',
		'data',
		'cdopm',
		'opm_abreviatura',
		'descricao_txt',
		'digitador'
	];
}
