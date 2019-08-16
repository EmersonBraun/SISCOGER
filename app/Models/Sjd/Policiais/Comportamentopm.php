<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 26 Apr 2018 14:16:43 +0000.
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
 * Class Comportamentopm
 * 
 * @property int $id_comportamentopm
 * @property \Carbon\Carbon $data
 * @property string $motivo_txt
 * @property string $publicacao
 * @property int $id_comportamento
 * @property string $rg
 * @property string $rg_cadastro
 * @property string $cdopm
 * @property string $opm_abreviatura
 *
 * @package App\Models
 */
class Comportamentopm extends Eloquent
{
    use SoftDeletes;

	//Activitylog
	use LogsActivity;
    protected static $logName = 'comportamentopm';
    protected static $logAttributes = ['*'];
	protected static $logOnlyDirty = true;

	protected $table = 'comportamentopm';
	protected $primaryKey = 'id_comportamentopm';
	public $timestamps = true;

	protected $casts = [
		'id_comportamento' => 'int'
	];

	protected $dates = [
		'data'
	];

	protected $fillable = [
		'data',
		'motivo_txt',
		'publicacao',
		'id_comportamento',
		'rg',
		'rg_cadastro',
		'cdopm',
		'opm_abreviatura'
    ];
    
    use PresentableTrait;
    protected $presenter = 'App\Presenters\policiais\ComportamentopmPresenter';

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
