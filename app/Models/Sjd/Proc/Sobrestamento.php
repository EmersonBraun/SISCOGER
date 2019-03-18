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
 * Class Sobrestamento
 * 
 * @property int $id_sobrestamento
 * @property string $rg
 * @property \Carbon\Carbon $inicio_data
 * @property string $publicacao_inicio
 * @property \Carbon\Carbon $termino_data
 * @property string $publicacao_termino
 * @property string $motivo
 * @property int $id_cj
 * @property int $id_cd
 * @property int $id_sindicancia
 * @property int $id_fatd
 * @property int $id_iso
 * @property int $id_it
 * @property int $id_adl
 * @property int $id_pad
 * @property int $id_sai
 * @property int $id_proc_outros
 * @property string $doc_controle_inicio
 * @property string $doc_controle_termino
 *
 * @package App\Models
 */
class Sobrestamento extends Eloquent
{    
	protected $table = 'sobrestamento';
	protected $primaryKey = 'id_sobrestamento';
	public $timestamps = false;

	protected $casts = [
		'id_cj' => 'int',
		'id_cd' => 'int',
		'id_sindicancia' => 'int',
		'id_fatd' => 'int',
		'id_iso' => 'int',
		'id_it' => 'int',
		'id_adl' => 'int',
		'id_pad' => 'int',
		'id_sai' => 'int',
		'id_proc_outros' => 'int'
	];

	protected $dates = [
		'inicio_data',
		'termino_data'
	];

	protected $fillable = [
		'rg',
		'inicio_data',
		'publicacao_inicio',
		'termino_data',
		'publicacao_termino',
		'motivo',
		'id_cj',
		'id_cd',
		'id_sindicancia',
		'id_fatd',
		'id_iso',
		'id_it',
		'id_adl',
		'id_pad',
		'id_sai',
		'id_proc_outros',
		'doc_controle_inicio',
		'doc_controle_termino'
    ];
    
    //Activitylog
    use LogsActivity;
    
    protected static $logName = 'sobrestamento';
    protected static $logAttributes = [
		'rg',
		'inicio_data',
		'publicacao_inicio',
		'termino_data',
		'publicacao_termino',
		'motivo',
		'id_cj',
		'id_cd',
		'id_sindicancia',
		'id_fatd',
		'id_iso',
		'id_it',
		'id_adl',
		'id_pad',
		'id_sai',
		'id_proc_outros',
		'doc_controle_inicio',
		'doc_controle_termino'
    ];
    
    use PresentableTrait;
    protected $presenter = 'App\Presenters\SobrestamentoPresenter';

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
		return $query->max('id_sobrestamento');
    }
    
    //mutators (para alterar na hora da exibição)
    public function getInicioDataAttribute($value)
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
    public function setInicioDataAttribute($value)
    {
        $this->attributes['inicio_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getTerminoDataAttribute($value)
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
    public function setTerminoDataAttribute($value)
    {
        $this->attributes['termino_data'] = data_bd($value);
    }
}
