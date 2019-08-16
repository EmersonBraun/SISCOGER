<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Policiais;

use Reliese\Database\Eloquent\Model as Eloquent;
//para monitorar o CREATE, UPDATE e DELETE e salvar log automaticamente
use Spatie\Activitylog\Traits\LogsActivity;
// para 'apresentar' já formatado e tirar lógica das views
use Laracasts\Presenter\PresentableTrait;
// para não apagar diretamente, inserir data em "deleted_at"
use Illuminate\Database\Eloquent\SoftDeletes;

class Medalha extends Eloquent
{
    // use SoftDeletes;

	protected $table = 'medalha';
	protected $primaryKey = 'id_medalha';
	public $timestamps = false;

	protected $casts = [
		'id_ipm' => 'int',
	];

	protected $fillable = [
		'nome'
    ];
    
    //Activitylog
	// use LogsActivity;
    // protected static $logName = 'medalha';
    // protected static $logAttributes = ['*'];
    // protected static $logOnlyDirty = true;
    
    // use PresentableTrait;
    // protected $presenter = 'App\Presenters\policiais\MedalhaPresenter';

}
