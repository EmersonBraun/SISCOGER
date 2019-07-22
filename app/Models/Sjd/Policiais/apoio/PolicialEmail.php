<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Policiais;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PolicialEmail
 * 
 * @property int $rg
 * @property string $email
 * @property string $usuario_rg
 * @property \Carbon\Carbon $dh
 *
 * @package App\Models
 */
class PolicialEmail extends Eloquent
{
	protected $table = 'policial_email';
	protected $primaryKey = 'rg';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'rg' => 'int'
	];

	protected $dates = [
		'dh'
	];

	protected $fillable = [
		'email',
		'usuario_rg',
		'dh'
	];
}
