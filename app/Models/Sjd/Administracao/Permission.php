<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 23 Jul 2019 12:03:21 +0000.
 */

namespace App\Models\Sjd\Administracao;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Permission
 * 
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $model_has_permissions
 * @property \Illuminate\Database\Eloquent\Collection $roles
 *
 * @package App\Models
 */
class Permission extends Eloquent
{
	protected $fillable = [
		'name',
		'guard_name'
	];

	public function model_has_permissions()
	{
		return $this->hasMany(\App\Models\ModelHasPermission::class);
	}

	public function roles()
	{
		return $this->belongsToMany(\App\Models\Role::class, 'role_has_permissions');
	}
}
