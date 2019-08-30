<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 29 Aug 2019 13:22:32 +0000.
 */

namespace App\Models\Sjd\Busca;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Tramitacao
 * 
 * @property int $id_tramitacao
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
class Tramitacao extends Eloquent
{
	protected $table = 'tramitacao';
	protected $primaryKey = 'id_tramitacao';
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
