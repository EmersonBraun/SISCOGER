<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
 */

namespace App\Models\Sjd\Proc;

use Reliese\Database\Eloquent\Model as Eloquent;
//para monitorar o CREATE, UPDATE e DELETE e salvar log automaticamente
use Spatie\Activitylog\Traits\LogsActivity;
/**
 * Class Pad
 * 
 * @property int $id_pad
 * @property int $id_andamento
 * @property int $id_andamentocoger
 * @property int $sjd_ref
 * @property int $sjd_ref_ano
 * @property string $doc_origem_txt
 * @property \Carbon\Carbon $fato_data
 * @property string $cdopm
 * @property string $sintese_txt
 * @property string $portaria_numero
 * @property \Carbon\Carbon $portaria_data
 * @property string $doc_tipo
 * @property string $doc_numero
 * @property \Carbon\Carbon $abertura_data
 * @property string $relatorio_file
 * @property string $solucao_file
 * @property int $prioridade
 *
 * @package App\Models
 */
class Pad extends Eloquent
{
	//Activitylog
	use LogsActivity;

    protected static $logName = 'pad';
    protected static $logAttributes = [
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
	
	protected $table = 'pad';
	protected $primaryKey = 'id_pad';
	public $timestamps = false;

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
		'abertura_data'
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
        if($value == '0000-00-00')
        {
            return '';
        }
        else
        {
            return date( 'd/m/Y' , strtotime($value));
        }
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setFatoDataAttribute($value)
    {
        $this->attributes['fato_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getPortariaDataAttribute($value)
    {
        if($value == '0000-00-00')
        {
            return '';
        }
        else
        {
            return date( 'd/m/Y' , strtotime($value));
        }
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setPortariaDataAttribute($value)
    {
        $this->attributes['portaria_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getAberturaDataAttribute($value)
    {
        if($value == '0000-00-00')
        {
            return '';
        }
        else
        {
            return date( 'd/m/Y' , strtotime($value));
        }
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setAberturaDataAttribute($value)
    {
        $this->attributes['abertura_data'] = data_bd($value);
    }

}
