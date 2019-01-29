<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Policiais;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class RespCivil
 * 
 * @property int $id_resp_civil
 * @property string $resp_civil
 *
 * @package App\Models
 */
class RespCivil extends Eloquent
{
	protected $table = 'resp_civil';
	protected $primaryKey = 'id_resp_civil';
	public $timestamps = false;

	protected $fillable = [
		'resp_civil'
	];
}
