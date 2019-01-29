<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Proc\Apoio;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CausaAcidente
 * 
 * @property int $id_causa_acidente
 * @property string $causa_acidente
 *
 * @package App\Models
 */
class CausaAcidente extends Eloquent
{
	protected $table = 'causa_acidente';
	protected $primaryKey = 'id_causa_acidente';
	public $timestamps = false;

	protected $fillable = [
		'causa_acidente'
	];
}
