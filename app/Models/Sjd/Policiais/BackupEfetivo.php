<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 05 Jun 2019 14:13:26 +0000.
 */

namespace App\Models\Sjd\Policiais;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class BackupEfetivo
 * 
 * @property int $id
 * @property string $rg
 * @property string $nome
 * @property string $situacao
 *
 * @package App\Models\Sjd\Policiais
 */
class BackupEfetivo extends Eloquent
{
	protected $table = 'backup_efetivo';
	public $timestamps = false;

	protected $fillable = [
		'rg',
        'nome',
        'cdopm',
		'situacao'
	];
}
