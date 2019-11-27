<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 24 Sep 2018 13:05:06 +0000.
 */

namespace App\Models\Sjd\Proc;

use Reliese\Database\Eloquent\Model as Eloquent;
//para monitorar o CREATE, UPDATE e DELETE e salvar log automaticamente
use Spatie\Activitylog\Traits\LogsActivity;
// para 'apresentar' já formatado e tirar lógica das views
use Laracasts\Presenter\PresentableTrait;
// para não apagar diretamente, inserir data em "deleted_at"
use Illuminate\Database\Eloquent\SoftDeletes;
class It extends Eloquent
{
    use SoftDeletes;

	protected $table = 'it';
	protected $primaryKey = 'id_it';
	public $timestamps = true;

	protected $casts = [
		'id_andamento' => 'int',
		'id_andamentocoger' => 'int',
		'sjd_ref' => 'int',
		'sjd_ref_ano' => 'int',
		'id_causa_acidente' => 'int',
		'id_resp_civil' => 'int',
		'prioridade' => 'int'
	];

	protected $dates = [
		'fato_data',
		'abertura_data',
		'boletiminterno_data',
		'relatorio_data',
		'solucao_unidade_data',
        'solucao_complementar_data',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
    
    public static $files = [
        'relatorio_file',
		'solucao_unidade_file',
		'solucao_complementar_file',
    ];

    protected $fillable = [
		'id_andamento',
        'id_andamentocoger',
        'cdopm',
		'sjd_ref',
		'sjd_ref_ano',
		'fato_data',
		'abertura_data',
        'vtr_placa',
        'vtr_prefixo',
        'vtr_propriedade',
        'portaria_numero',
        'boletiminterno_numero',
        'boletiminterno_data',
        'tipo_acidente',
        'avarias',
        'situacao_objeto',
        'sintese_txt',
        'br_numero',
        'situacaoviatura',
        'acordoamigavel',
        'id_causa_acidente',
        'id_resp_civil',
        'arquivo_numero',
        'protocolo_numero',
        'acaojudicial',
        'danoestimado_rs',
        'danoreal_rs',
        'opm_meta4',
        'objetoprocedimento',
        'identificacao_arma',
        'identificacao_municao',
        'identificacao_semovente',
        'outros',
        'relatorio_file',
        'solucao_unidade_file',
        'solucao_unidade_data',
        'solucao_complementar_file',
        'solucao_complementar_data',
        'prioridade',
        'deleted_at',
        'created_at',
        'updated_at',
    ];


    //Activitylog
	use LogsActivity;

    protected static $logName = 'it';
	protected static $logAttributes = ['*'];
	protected static $logOnlyDirty = true;
    

     
    use PresentableTrait;
    protected $presenter = 'App\Presenters\proc\ItPresenter';

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
		return $query->max('id_it');
    }
    
    //mutators (para alterar na hora da exibição)
    public function getFatoDataAttribute($value)
    {
        if($value == '0000-00-00' || $value == null) return '';
        else return date( 'd/m/Y' , strtotime($value));
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setFatoDataAttribute($value)
    {
        $this->attributes['fato_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getAberturaDataAttribute($value)
    {
        if($value == '0000-00-00' || $value == null) return '';
        else return date( 'd/m/Y' , strtotime($value));
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setAberturaDataAttribute($value)
    {
        $this->attributes['abertura_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getBoletiminternoDataAttribute($value)
    {
        if($value == '0000-00-00' || $value == null) return '';
        else return date( 'd/m/Y' , strtotime($value));
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setBoletiminternoDataAttribute($value)
    {
        $this->attributes['Boletiminterno_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getRelatorioDataAttribute($value)
    {
        if($value == '0000-00-00' || $value == null) return '';
        else return date( 'd/m/Y' , strtotime($value));
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setRelatorioDataAttribute($value)
    {
        $this->attributes['relatorio_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getSolucaoUnidadeDataAttribute($value)
    {
        if($value == '0000-00-00' || $value == null) return '';
        else return date( 'd/m/Y' , strtotime($value));
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setSolucaoUnidadeDataAttribute($value)
    {
        $this->attributes['solucao_unidade_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getSolucaoComplementarDataAttribute($value)
    {
        if($value == '0000-00-00' || $value == null) return '';
        else return date( 'd/m/Y' , strtotime($value));
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setSolucaoComplementarDataAttribute($value)
    {
        $this->attributes['solucao_complementar_data'] = data_bd($value);
    }

}
