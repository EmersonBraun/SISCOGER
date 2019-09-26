<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 20 Sep 2019 14:49:04 +0000.
 */

namespace App\Models\Sjd\Email;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class EmailsSistema
 * 
 * @property int $id
 * @property string $action
 * @property string $identification
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class EmailsSistema extends Eloquent
{
	protected $table = 'emails_sistema';

	protected $fillable = [
		'action',
        'identification',
        'subject'
	];
}
