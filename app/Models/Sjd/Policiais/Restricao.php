<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Policiais;

use Reliese\Database\Eloquent\Model as Eloquent;
//para monitorar o CREATE, UPDATE e DELETE e salvar log automaticamente
use Spatie\Activitylog\Traits\LogsActivity;
/**
 * Class Restricao
 * 
 * @property int $id_restricao
 * @property string $rg
 * @property string $cargo
 * @property string $nome
 * @property string $fardamento_bl
 * @property string $arma_bl
 * @property string $origem
 * @property \Carbon\Carbon $cadastro_data
 * @property \Carbon\Carbon $inicio_data
 * @property \Carbon\Carbon $fim_data
 * @property \Carbon\Carbon $retirada_data
 * @property string $proc
 * @property int $sjd_ref
 * @property int $sjd_ref_ano
 * @property string $obs_txt
 *
 * @package App\Models
 */
class Restricao extends Eloquent
{
	//Activitylog
	use LogsActivity;

    protected static $logName = 'restricao';
    protected static $logAttributes = [
		'rg',
		'cargo',
		'nome',
		'fardamento_bl',
		'arma_bl',
		'origem',
		'cadastro_data',
		'inicio_data',
		'fim_data',
		'retirada_data',
		'proc',
		'sjd_ref',
		'sjd_ref_ano',
		'obs_txt'
	];

	protected $table = 'restricao';
	protected $primaryKey = 'id_restricao';
	public $timestamps = false;

	protected $casts = [
		'sjd_ref' => 'int',
		'sjd_ref_ano' => 'int'
	];

	protected $dates = [
		'cadastro_data',
		'inicio_data',
		'fim_data',
		'retirada_data'
	];

	protected $fillable = [
		'rg',
		'cargo',
		'nome',
		'fardamento_bl',
		'arma_bl',
		'origem',
		'cadastro_data',
		'inicio_data',
		'fim_data',
		'retirada_data',
		'proc',
		'sjd_ref',
		'sjd_ref_ano',
		'obs_txt'
	];
}
