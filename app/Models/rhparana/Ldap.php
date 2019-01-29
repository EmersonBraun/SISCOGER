<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 26 Apr 2018 20:05:42 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Ldap
 * 
 * @property int $id
 * @property string $uid
 * @property string $dn
 * @property string $givenname
 * @property string $sn
 * @property string $cn
 * @property string $employeenumber
 * @property string $rg
 * @property string $rguf
 * @property string $cpf
 * @property string $birthdate
 * @property string $telephonenumber
 * @property string $mail
 * @property string $description
 * @property string $mailforwardingaddress
 * @property int $uidnumber
 * @property string $gidnumber
 * @property string $accountstatus
 *
 * @package App\Models
 */
class Ldap extends Eloquent
{
	protected $table = 'ldap';
	public $timestamps = false;

	protected $casts = [
		'uidnumber' => 'int'
	];

	protected $fillable = [
		'uid',
		'dn',
		'givenname',
		'sn',
		'cn',
		'employeenumber',
		'rg',
		'rguf',
		'cpf',
		'birthdate',
		'telephonenumber',
		'mail',
		'description',
		'mailforwardingaddress',
		'uidnumber',
		'gidnumber',
		'accountstatus'
	];
}
