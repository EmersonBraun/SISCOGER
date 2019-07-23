<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Administracao;

use Reliese\Database\Eloquent\Model as Eloquent;
//para monitorar o CREATE, UPDATE e DELETE e salvar log automaticamente
use Spatie\Activitylog\Traits\LogsActivity;
// para 'apresentar' já formatado e tirar lógica das views
use Laracasts\Presenter\PresentableTrait;
/**
 * Class Feriado
 * 
 * @property int $id_feriado
 * @property \Carbon\Carbon $data
 * @property string $feriado
 *
 * @package App\Models
 */
class Feriado extends Eloquent
{
	//Activitylog
	use LogsActivity;

    protected static $logName = 'feriado';
    protected static $logAttributes = [
		'data',
		'feriado'
	];
	
	protected $table = 'feriado';
	protected $primaryKey = 'id_feriado';
	public $timestamps = false;

	protected $dates = [
		'data'
	];

	protected $fillable = [
		'data',
		'feriado'
    ];

    use PresentableTrait;
    protected $presenter = 'App\Presenters\administracao\FeriadoPresenter';
    
    public function getDataAttribute($value)
    {
        if($value == '0000-00-00' || $value == null)
        {
            return '';
        }
        else
        {
            return date( 'd/m/Y' , strtotime($value));
        }
    }

    public function setDataAttribute($value)
    {
        $this->attributes['data'] = data_bd($value);
    }
}
