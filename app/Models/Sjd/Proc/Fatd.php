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
 * Class Fatd
 * 
 * @property int $id_fatd
 * @property int $id_andamento
 * @property int $id_andamentocoger
 * @property int $sjd_ref
 * @property int $sjd_ref_ano
 * @property \Carbon\Carbon $fato_data
 * @property \Carbon\Carbon $abertura_data
 * @property string $sintese_txt
 * @property string $cdopm
 * @property string $doc_tipo
 * @property string $doc_numero
 * @property string $doc_origem_txt
 * @property string $despacho_numero
 * @property \Carbon\Carbon $portaria_data
 * @property string $fato_file
 * @property string $relatorio_file
 * @property string $sol_cmt_file
 * @property string $sol_cg_file
 * @property string $rec_ato_file
 * @property string $rec_cmt_file
 * @property string $rec_crpm_file
 * @property string $rec_cg_file
 * @property string $opm_meta4
 * @property string $notapunicao_file
 * @property string $publicacaonp
 * @property int $prioridade
 * @property string $situacao_fatd
 * @property string $motivo_fatd
 * @property string $motivo_outros
 *
 * @package App\Models
 */
class Fatd extends Eloquent
{
	//Activitylog
	use LogsActivity;

    protected static $logName = 'fatd';
    protected static $logAttributes = [
		'id_andamento',
		'id_andamentocoger',
		'sjd_ref',
		'sjd_ref_ano',
		'fato_data',
		'abertura_data',
		'sintese_txt',
		'cdopm',
		'doc_tipo',
		'doc_numero',
		'doc_origem_txt',
		'despacho_numero',
		'portaria_data',
		'fato_file',
		'relatorio_file',
		'sol_cmt_file',
		'sol_cg_file',
		'rec_ato_file',
		'rec_cmt_file',
		'rec_crpm_file',
		'rec_cg_file',
		'opm_meta4',
		'notapunicao_file',
		'publicacaonp',
		'prioridade',
		'situacao_fatd',
		'motivo_fatd',
		'motivo_outros'
	];
	
	protected $table = 'fatd';
	protected $primaryKey = 'id_fatd';
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
		'abertura_data',
		'portaria_data'
	];

	protected $fillable = [
		'id_andamento',
		'id_andamentocoger',
		'sjd_ref',
		'sjd_ref_ano',
		'fato_data',
		'abertura_data',
		'sintese_txt',
		'cdopm',
		'doc_tipo',
		'doc_numero',
		'doc_origem_txt',
		'despacho_numero',
		'portaria_data',
		'fato_file',
		'relatorio_file',
		'sol_cmt_file',
		'sol_cg_file',
		'rec_ato_file',
		'rec_cmt_file',
		'rec_crpm_file',
		'rec_cg_file',
		'opm_meta4',
		'notapunicao_file',
		'publicacaonp',
		'prioridade',
		'situacao_fatd',
		'motivo_fatd',
		'motivo_outros'
	];

	//query scope - para auxir a montagem da query
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
		return $query->max('id_fatd');
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
}
