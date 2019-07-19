<?php
namespace App\Presenters\log;

use Laracasts\Presenter\Presenter;
use App\User;

class logPresenter extends Presenter {
    

    public function translateDescription()
    {
        switch ($this->description) {
            case 'created': return 'criado'; break;
            case 'deleted': return 'apagado'; break;
            case 'updated': return 'atualizado'; break;
            default: return ''; break;
        }
    }

    public function nome()
    {
        $user = User::findOrFail($this->causer_id);
        return $user->nome;
    }

    public function rg()
    {
        $user = User::findOrFail($this->causer_id);
        return $user->rg;
    }

    public function properties()
    {
        $l = json_decode($this->properties);
        dd($l->attributes);
        //return $user->rg;
    }
}
/*
protected $fillable = [
		'log_name',
		'description',
		'subject_id',
		'subject_type',
		'causer_id',
		'causer_type',
		'properties'
    ];
    */