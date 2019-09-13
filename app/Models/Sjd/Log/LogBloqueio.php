<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Log;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class LogAcesso
 * 
 * @property int $id_log_acessos
 * @property int $rg
 * @property \Carbon\Carbon $datahora
 * @property string $ip
 *
 * @package App\Models
 */
class LogBloqueio extends Eloquent
{
	protected $primaryKey = 'id';

	protected $fillable = [
		'acao',
		'rg_acao',
		'rg_block',
		'ip'
	];
}
