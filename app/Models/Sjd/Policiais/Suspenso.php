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
/**
 * Class Suspenso
 * 
 * @property int $id_suspenso
 * @property string $rg
 * @property string $cargo
 * @property string $nome
 * @property string $processo
 * @property string $infracao
 * @property string $numerounico
 * @property \Carbon\Carbon $inicio_data
 * @property \Carbon\Carbon $fim_data
 * @property string $obs_txt
 *
 * @package App\Models
 */
class Suspenso extends Eloquent
{
    use SoftDeletes;

	protected $table = 'suspenso';
	protected $primaryKey = 'id_suspenso';
	public $timestamps = false;

	protected $dates = [
		'inicio_data',
		'fim_data'
	];

	protected $fillable = [
		'rg',
		'cargo',
		'nome',
		'processo',
		'infracao',
		'numerounico',
		'inicio_data',
		'fim_data',
		'obs_txt'
    ];
    
    //Activitylog
	use LogsActivity;
    protected static $logName = 'suspenso';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    
    use PresentableTrait;
    protected $presenter = 'App\Presenters\policiais\SuspensoPresenter';

    //mutators (para alterar na hora da exibição)
    public function getInicioDataAttribute($value)
    {
        return data_br($value);
    }

    //mutator para alterar na hora de salvar no bd
    public function setInicioDataAttribute($value)
    {
        $this->attributes['inicio_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getFimDataAttribute($value)
    {
        return data_br($value);
    }

    //mutator para alterar na hora de salvar no bd
    public function setFimDataAttribute($value)
    {
        $this->attributes['fim_data'] = data_bd($value);
    }
}
