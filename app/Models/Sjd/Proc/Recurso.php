<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Proc;

use Reliese\Database\Eloquent\Model as Eloquent;
//para monitorar o CREATE, UPDATE e DELETE e salvar log automaticamente
use Spatie\Activitylog\Traits\LogsActivity;
// para 'apresentar' já formatado e tirar lógica das views
use Laracasts\Presenter\PresentableTrait;
/**
 * Class Recurso
 * 
 * @property int $id_recurso
 * @property string $cdopm
 * @property string $opm
 * @property string $rg
 * @property string $nome
 * @property string $procedimento
 * @property int $sjd_ref
 * @property int $sjd_ref_ano
 * @property \Carbon\Carbon $datahora
 * @property int $id_movimento
 *
 * @package App\Models
 */
class Recurso extends Eloquent
{
	protected $table = 'recurso';
	protected $primaryKey = 'id_recurso';
	public $timestamps = false;

	protected $casts = [
		'sjd_ref' => 'int',
		'sjd_ref_ano' => 'int',
		'id_movimento' => 'int'
	];

	protected $dates = [
		'datahora'
	];

	protected $fillable = [
		'cdopm',
		'opm',
		'rg',
		'nome',
		'procedimento',
		'sjd_ref',
		'sjd_ref_ano',
		'datahora',
		'id_movimento'
    ];
    
    //Activitylog
	use LogsActivity;

    protected static $logName = 'recurso';
    protected static $logAttributes = [
		'cdopm',
		'opm',
		'rg',
		'nome',
		'procedimento',
		'sjd_ref',
		'sjd_ref_ano',
		'datahora',
		'id_movimento'
    ];
    
    use PresentableTrait;
    protected $presenter = 'App\Presenters\RecursoPresenter';

	public function scopeRef_ano($query, $ref, $ano)
	{
		return $query->where('sjd_ref','=',$ref)
				->where('sjd_ref_ano','=',$ano);
	}

	public function scopeAno($query, $ano)
	{
		return $query->where('sjd_ref_ano','=',$ano);
	}

	public function scopeAno_unidade($query, $ano, $unidade)
	{
		return $query->where('sjd_ref_ano','=',$ano)
					->where('cdopm', 'like', $unidade.'%');
	}

	public function scopeUltimo_id($query)
	{
		return $query->max('id_recurso');
    }
    
    //mutators (para alterar na hora da exibição)
    public function getDatahoraAttribute($value)
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

    //mutators (para alterar na hora de salvar no banco)
    public function setDatahoraAttribute($value)
    {
        $this->attributes['datahora'] = data_bd($value);
    }
}
