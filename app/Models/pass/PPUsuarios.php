<?php

namespace App\Models\pass;

use Reliese\Database\Eloquent\Model as Eloquent;

class PPUsuarios extends Eloquent
{
    protected $connection = 'pass';
	protected $table = 'PPUsuarios';
	protected $primaryKey = 'UserID';
	public $timestamps = false;

	protected $fillable = [
		'UserID',
        'UserRG',
        'UserCPF',
        'UserNome',
        'UserOPM',
        'UserLogin',
        'UserEMail',
        'UserExpresso',
        'UserNivel',
        'Obs',
        'UserSenha',
        'NIVELADM',
        'senha',
        'fone',
        'ultimo_acesso',
        'UserOPMWork',
        'opm_trabalho',
        'opm_meta4'
	];
}