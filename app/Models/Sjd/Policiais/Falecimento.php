<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Policiais;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Falecimento
 * 
 * @property int $id_falecimento
 * @property string $rg
 * @property string $cargo
 * @property string $nome
 * @property \Carbon\Carbon $data
 * @property int $id_municipio
 * @property string $endereco
 * @property string $endereco_numero
 * @property string $cdopm
 * @property int $bou_ano
 * @property string $bou_numero
 * @property int $id_situacao
 * @property string $resultado
 * @property string $descricao_txt
 *
 * @package App\Models
 */
class Falecimento extends Eloquent
{
	//Activitylog
	use LogsActivity;

    protected static $logName = 'falecimento';
    protected static $logAttributes = [
		'rg',
		'cargo',
		'nome',
		'data',
		'id_municipio',
		'endereco',
		'endereco_numero',
		'cdopm',
		'bou_ano',
		'bou_numero',
		'id_situacao',
		'resultado',
		'descricao_txt'
	];
	
	protected $table = 'falecimento';
	protected $primaryKey = 'id_falecimento';
	public $timestamps = false;

	protected $casts = [
		'id_municipio' => 'int',
		'bou_ano' => 'int',
		'id_situacao' => 'int'
	];

	protected $dates = [
		'data'
	];

	protected $fillable = [
		'rg',
		'cargo',
		'nome',
		'data',
		'id_municipio',
		'endereco',
		'endereco_numero',
		'cdopm',
		'bou_ano',
		'bou_numero',
		'id_situacao',
		'resultado',
		'descricao_txt'
	];
}
