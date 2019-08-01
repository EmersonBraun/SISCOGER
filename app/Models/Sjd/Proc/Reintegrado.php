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
// para não apagar diretamente, inserir data em "deleted_at"
use Illuminate\Database\Eloquent\SoftDeletes;
class Reintegrado extends Eloquent
{
    use SoftDeletes;

	protected $table = 'reintegrado';
	protected $primaryKey = 'id_reintegrado';
	public $timestamps = true;

	protected $casts = [
		'sjd_ref' => 'int',
		'sjd_ref_ano' => 'int',
		'bg_numero' => 'int',
		'bg_ano' => 'int'
	];

	protected $dates = [
        'retorno_data',
        'deleted_at'
	];

	protected $fillable = [
		'rg',
		'cargo',
		'nome',
		'motivo',
		'procedimento',
		'sjd_ref',
		'sjd_ref_ano',
		'retorno_data',
		'bg_numero',
		'bg_ano'
    ];
    
    //Activitylog
	use LogsActivity;

    protected static $logName = 'reintegrado';
    protected static $logAttributes = ['*'];
	protected static $logOnlyDirty = true;
    
    use PresentableTrait;
    protected $presenter = 'App\Presenters\proc\ReintegradoPresenter';

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
		return $query->max('id_reintegrado');
    }
    
    //mutators (para alterar na hora da exibição)
    public function getRetornoDataAttribute($value)
    {
        if($value == '0000-00-00' || $value == null) return '';
        else return date( 'd/m/Y' , strtotime($value));
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setRetornoDataAttribute($value)
    {
        $this->attributes['retorno_data'] = data_bd($value);
    }
}
