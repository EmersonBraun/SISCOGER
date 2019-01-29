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
 * Class Desercao
 * 
 * @property int $id_desercao
 * @property int $id_andamento
 * @property int $id_andamentocoger
 * @property int $sjd_ref
 * @property int $sjd_ref_ano
 * @property string $cdopm
 * @property \Carbon\Carbon $fato_data
 * @property string $doc_tipo
 * @property string $doc_numero
 * @property string $termo_exclusao
 * @property string $termo_exclusao_pub
 * @property string $termo_captura
 * @property string $termo_captura_pub
 * @property string $pericia
 * @property string $pericia_pub
 * @property string $termo_inclusao
 * @property string $termo_inclusao_pub
 * @property string $opm_meta4
 * @property string $referenciavajme
 * @property int $prioridade
 *
 * @package App\Models
 */
class Desercao extends Eloquent
{
	//Activitylog
	use LogsActivity;

    protected static $logName = 'desercao';
    protected static $logAttributes = [
		'id_andamento',
		'id_andamentocoger',
		'sjd_ref',
		'sjd_ref_ano',
		'cdopm',
		'fato_data',
		'doc_tipo',
		'doc_numero',
		'termo_exclusao',
		'termo_exclusao_pub',
		'termo_captura',
		'termo_captura_pub',
		'pericia',
		'pericia_pub',
		'termo_inclusao',
		'termo_inclusao_pub',
		'opm_meta4',
		'referenciavajme',
		'prioridade'
	];
	
	protected $table = 'desercao';
	protected $primaryKey = 'id_desercao';
	public $timestamps = false;

	protected $casts = [
		'id_andamento' => 'int',
		'id_andamentocoger' => 'int',
		'sjd_ref' => 'int',
		'sjd_ref_ano' => 'int',
		'prioridade' => 'int'
	];

	protected $dates = [
		'fato_data'
	];

	protected $fillable = [
		'id_andamento',
		'id_andamentocoger',
		'sjd_ref',
		'sjd_ref_ano',
		'cdopm',
		'fato_data',
		'doc_tipo',
		'doc_numero',
		'termo_exclusao',
		'termo_exclusao_pub',
		'termo_captura',
		'termo_captura_pub',
		'pericia',
		'pericia_pub',
		'termo_inclusao',
		'termo_inclusao_pub',
		'opm_meta4',
		'referenciavajme',
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
		return $query->max('id_desercao');
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
        $this->attributes['Fato_data'] = data_bd($value);
    }

}
