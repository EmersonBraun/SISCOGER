<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Oct 2019 15:20:27 +0000.
 */

namespace App\Models\Sjd\Proc;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Encaminhamento
 * 
 * @property int $id
 * @property string $proc
 * @property int $id_proc
 * @property string $cdopm_origem
 * @property \Carbon\Carbon $data_encaminhamento
 * @property string $cdopm_destino
 * @property \Carbon\Carbon $data_recebimento
 * @property bool $recebido
 *
 * @package App\Models
 */
class Encaminhamento extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'id_proc' => 'int',
		'recebido' => 'bool'
	];

	protected $dates = [
		'data_encaminhamento',
		'data_recebimento'
	];

	protected $fillable = [
		'proc',
		'id_proc',
		'cdopm_origem',
		'data_encaminhamento',
		'cdopm_destino',
		'data_recebimento',
		'recebido'
	];
}
