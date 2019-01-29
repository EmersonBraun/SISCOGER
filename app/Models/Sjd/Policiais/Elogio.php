<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 26 Apr 2018 14:16:43 +0000.
 */

namespace App\Models\Sjd\Policiais;

use Reliese\Database\Eloquent\Model as Eloquent;
//para monitorar o CREATE, UPDATE e DELETE e salvar log automaticamente
use Spatie\Activitylog\Traits\LogsActivity;
/**
 * Class Elogio
 * 
 * @property int $id_elogio
 * @property string $rg
 * @property string $rg_cadastro
 * @property string $cargo
 * @property string $nome
 * @property \Carbon\Carbon $elogio_data
 * @property string $publicacao
 * @property string $cdopm
 * @property string $opm_abreviatura
 * @property string $digitador
 * @property string $descricao_txt
 *
 * @package App\Models
 */
class Elogio extends Eloquent
{
	//Activitylog
	use LogsActivity;

    protected static $logName = 'elogio';
    protected static $logAttributes = [
		'rg',
		'rg_cadastro',
		'cargo',
		'nome',
		'elogio_data',
		'publicacao',
		'cdopm',
		'opm_abreviatura',
		'digitador',
		'descricao_txt'
	];

	protected $table = 'elogio';
	protected $primaryKey = 'id_elogio';
	public $timestamps = false;

	protected $dates = [
		'elogio_data'
	];

	protected $fillable = [
		'rg',
		'rg_cadastro',
		'cargo',
		'nome',
		'elogio_data',
		'publicacao',
		'cdopm',
		'opm_abreviatura',
		'digitador',
		'descricao_txt'
	];
}
