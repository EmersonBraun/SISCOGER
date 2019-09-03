<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Sep 2019 13:03:42 +0000.
 */

namespace App\Models\Sjd\Log;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class LogFdi
 * 
 * @property int $id_log_fdi
 * @property string $rg_ficha
 * @property string $nome_ficha
 * @property string $cargo_ficha
 * @property string $cidade_ficha
 * @property string $rg_acesso
 * @property string $nome_acesso
 * @property string $cargo_acesso
 * @property string $cidade_acesso
 * @property \Carbon\Carbon $data_hora
 * @property string $ip
 *
 * @package App\Models
 */
class LogFdi extends Eloquent
{
	protected $table = 'log_fdi';
	protected $primaryKey = 'id_log_fdi';
	public $timestamps = false;

	protected $dates = [
		'data_hora'
	];

	protected $fillable = [
		'rg_ficha',
		'nome_ficha',
		'cargo_ficha',
		'cidade_ficha',
		'rg_acesso',
		'nome_acesso',
		'cargo_acesso',
		'cidade_acesso',
		'data_hora',
		'ip'
	];
}
