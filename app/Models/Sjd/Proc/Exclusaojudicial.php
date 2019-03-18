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
 * Class Exclusaojudicial
 * 
 * @property int $id_exclusaojudicial
 * @property string $rg
 * @property string $cargo
 * @property string $nome
 * @property string $cdopm_quandoexcluido
 * @property string $origem_proc
 * @property int $origem_sjd_ref
 * @property int $origem_sjd_ref_ano
 * @property string $origem_opm
 * @property string $processo
 * @property string $complemento
 * @property string $vara
 * @property string $numerounico
 * @property \Carbon\Carbon $data
 * @property \Carbon\Carbon $exclusao_data
 * @property string $obs_txt
 * @property int $portaria_numero
 * @property int $bg_numero
 * @property int $bg_ano
 * @property int $prioridade
 *
 * @package App\Models
 */
class Exclusaojudicial extends Eloquent
{	
	protected $table = 'exclusaojudicial';
	protected $primaryKey = 'id_exclusaojudicial';
	public $timestamps = false;

	protected $casts = [
		'origem_sjd_ref' => 'int',
		'origem_sjd_ref_ano' => 'int',
		'portaria_numero' => 'int',
		'bg_numero' => 'int',
		'bg_ano' => 'int',
		'prioridade' => 'int'
	];

	protected $dates = [
		'data',
		'exclusao_data'
	];

	protected $fillable = [
		'rg',
		'cargo',
		'nome',
		'cdopm_quandoexcluido',
		'origem_proc',
		'origem_sjd_ref',
		'origem_sjd_ref_ano',
		'origem_opm',
		'processo',
		'complemento',
		'vara',
		'numerounico',
		'data',
		'exclusao_data',
		'obs_txt',
		'portaria_numero',
		'bg_numero',
		'bg_ano',
		'prioridade'
    ];
    
    //Activitylog
	use LogsActivity;

    protected static $logName = 'exclusaojudicial';
    protected static $logAttributes = [
		'rg',
		'cargo',
		'nome',
		'cdopm_quandoexcluido',
		'origem_proc',
		'origem_sjd_ref',
		'origem_sjd_ref_ano',
		'origem_opm',
		'processo',
		'complemento',
		'vara',
		'numerounico',
		'data',
		'exclusao_data',
		'obs_txt',
		'portaria_numero',
		'bg_numero',
		'bg_ano',
		'prioridade'
    ];
    
    use PresentableTrait;
    protected $presenter = 'App\Presenters\ExclusaojudicialPresenter';

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
		return $query->max('id_exclusaojudicial');
    }
    
    //mutators (para alterar na hora da exibição)
    public function getDataAttribute($value)
    {
        if($value == '0000-00-00' || $value == null)
        {
            return '';
        }
        else
        {
            return $value->format('d/m/Y');
        }
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setDataAttribute($value)
    {
        $this->attributes['data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getExclusaoDataAttribute($value)
    {
        if($value == '0000-00-00' || $value == null)
        {
            return '';
        }
        else
        {
            return $value->format('d/m/Y');
        }
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setExclusaoDataAttribute($value)
    {
        $this->attributes['exclusao_data'] = data_bd($value);
    }
}
