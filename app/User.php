<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:03 +0000.
 */

namespace App;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
//para monitorar o CREATE, UPDATE e DELETE e salvar log automaticamente
use Spatie\Activitylog\Traits\LogsActivity;
use App\Notifications\ResetPassword;
/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $rg
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *id
 *email 	
 *rg
 *password
 *block 
 *nome 
 *cargo 
 *quadro 
 *subquadro 
 *opm_descricao
 *cdopm 
 *remember_token
 *created_at
 *updated_at
 *ultimo_acesso
 * @package App\Models
 */
class User extends Authenticatable 
{
    use SoftDeletes;
    use Notifiable;
    use HasRoles;
     //Activitylog
    use LogsActivity;
    

    protected static $logName = 'user';
    protected static $logAttributes = [
		'email',
		'rg',
		'password',
		'block',
		'termos',
		'nome',
		'classe',
		'cargo', 
		'quadro', 
		'subquadro', 
		'opm_descricao',
		'cdopm'

	];

     protected $guard_name = 'web';
//class User extends Eloquent
//{
	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'email',
		'rg',
		'password',
		'block',
		'tentativas',
		'termos',
		'nome',
		'classe',
		'cargo', 
		'quadro', 
		'subquadro', 
		'opm_descricao',
		'cdopm',
		'remember_token',
		'sessao',
		'id_sessao'

    ];
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

	// public function setPasswordAttribute($password)
	// {   
	//     $this->attributes['password'] = bcrypt($password);
	// }
}
