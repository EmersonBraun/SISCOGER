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
 * Class Saidiligencia
 * 
 * @property int $id_saidiligencias
 * @property int $sai
 * @property string $rg_cadastro
 * @property \Carbon\Carbon $data
 * @property string $cdopm
 * @property string $opm_abreviatura
 * @property string $diligencias_txt
 * @property string $digitador
 *
 * @package App\Models
 */
class Saidiligencia extends Eloquent
{
    use SoftDeletes;

	protected $primaryKey = 'id_saidiligencias';
	public $timestamps = false;

	protected $casts = [
		'sai' => 'int'
	];

	protected $dates = [
		'data'
	];

	protected $fillable = [
		'sai',
		'rg_cadastro',
		'data',
		'cdopm',
		'opm_abreviatura',
		'diligencias_txt',
		'digitador'
    ];
    
    //Activitylog
	use LogsActivity;
    protected static $logName = 'saidiligencias';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    
    use PresentableTrait;
    protected $presenter = 'App\Presenters\policiais\SaidiligenciaPresenter';

    //mutators (para alterar na hora da exibição)
    public function getDataAttribute($value)
    {
        if($value == '0000-00-00' || $value == null) return '';
        else return date( 'd/m/Y' , strtotime($value));
    }

    //mutator para alterar na hora de salvar no bd
    public function setDataAttribute($value)
    {
        $this->attributes['data'] = data_bd($value);
    }
}
