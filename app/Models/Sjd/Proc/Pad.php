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
class Pad extends Eloquent
{
    use SoftDeletes;

	protected $table = 'pad';
	protected $primaryKey = 'id_pad';
	public $timestamps = true;

	protected $casts = [
		'id_andamento' => 'int',
		'id_andamentocoger' => 'int',
		'sjd_ref' => 'int',
		'sjd_ref_ano' => 'int',
		'prioridade' => 'int'
    ];

	protected $dates = [
		'fato_data',
		'portaria_data',
        'abertura_data',
        'deleted_at'
    ];
    
    public static $files = [
        'relatorio_file',
		'solucao_file',
    ];

	protected $fillable = [
		'id_andamento',
		'id_andamentocoger',
		'sjd_ref',
		'sjd_ref_ano',
		'doc_origem_txt',
		'fato_data',
		'cdopm',
		'sintese_txt',
		'portaria_numero',
		'portaria_data',
		'doc_tipo',
		'doc_numero',
		'abertura_data',
		'relatorio_file',
		'solucao_file',
		'prioridade'
    ];
    
    //Activitylog
	use LogsActivity;

    protected static $logName = 'pad';
    protected static $logAttributes = ['*'];
	protected static $logOnlyDirty = true;
    
    use PresentableTrait;
    protected $presenter = 'App\Presenters\proc\PadPresenter';
 
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
		return $query->max('id_pad');
    }
    
    //mutators (para alterar na hora da exibição)
    public function getFatoDataAttribute($value)
    {
        return data_br($value);
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setFatoDataAttribute($value)
    {
        $this->attributes['fato_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getPortariaDataAttribute($value)
    {
        return data_br($value);
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setPortariaDataAttribute($value)
    {
        $this->attributes['portaria_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getAberturaDataAttribute($value)
    {
        return data_br($value);
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setAberturaDataAttribute($value)
    {
        $this->attributes['abertura_data'] = data_bd($value);
    }

}
