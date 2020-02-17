<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Apr 2018 00:27:02 +0000.
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
 * Class Sai
 * 
 * @property int $id_sai
 * @property string $rg
 * @property string $cargo
 * @property string $nome
 * @property string $rg_cadastro
 * @property \Carbon\Carbon $data
 * @property string $docorigem
 * @property string $cdopm
 * @property string $cdopm_fato
 * @property string $cdopm_controle
 * @property string $opm_abreviatura
 * @property string $sintese_txt
 * @property string $digitador
 * @property string $arquivopasta
 * @property string $bou_ano1
 * @property string $bou_numero1
 * @property int $id_municipio
 * @property string $bairro
 * @property string $logradouro
 * @property string $numerodoc
 * @property string $motivo_principal
 * @property string $motivo_secundario
 * @property string $desc_outros
 * @property int $id_andamento
 * @property int $id_andamentocoger
 * @property int $sjd_ref
 * @property \Carbon\Carbon $abertura_data
 * @property int $sjd_ref_ano
 * @property string $vtr1_placa
 * @property string $vtr1_prefixo
 * @property string $vtr2_placa
 * @property string $vtr2_prefixo
 * @property string $relatorio1
 * @property \Carbon\Carbon $relatorio1_data
 * @property string $relatorio1_file
 * @property string $relatorio2
 * @property \Carbon\Carbon $relatorio2_data
 * @property string $relatorio2_file
 * @property string $relatorio3
 * @property \Carbon\Carbon $relatorio3_data
 * @property string $relatorio3_file
 * @property string $bou_ano2
 * @property string $bou_ano3
 * @property string $bou_numero2
 * @property string $bou_numero3
 *
 * @package App\Models
 */
class Sai extends Eloquent
{
    use SoftDeletes;

	protected $table = 'sai';
	protected $primaryKey = 'id_sai';
	public $timestamps = false;

	protected $casts = [
		'id_municipio' => 'int',
		'id_andamento' => 'int',
		'id_andamentocoger' => 'int',
		'sjd_ref' => 'int',
		'sjd_ref_ano' => 'int'
	];

	protected $dates = [
		'data',
		'abertura_data',
		'relatorio1_data',
		'relatorio2_data',
		'relatorio3_data'
	];

	protected $fillable = [
		'rg',
		'cargo',
		'nome',
		'rg_cadastro',
		'data',
		'docorigem',
		'cdopm',
		'cdopm_fato',
		'cdopm_controle',
		'opm_abreviatura',
		'sintese_txt',
		'digitador',
		'arquivopasta',
		'bou_ano1',
		'bou_numero1',
		'id_municipio',
		'bairro',
		'logradouro',
		'numerodoc',
		'motivo_principal',
		'motivo_secundario',
		'desc_outros',
		'id_andamento',
		'id_andamentocoger',
		'sjd_ref',
		'abertura_data',
		'sjd_ref_ano',
		'vtr1_placa',
		'vtr1_prefixo',
		'vtr2_placa',
		'vtr2_prefixo',
		'relatorio1',
		'relatorio1_data',
		'relatorio1_file',
		'relatorio2',
		'relatorio2_data',
		'relatorio2_file',
		'relatorio3',
		'relatorio3_data',
		'relatorio3_file',
		'bou_ano2',
		'bou_ano3',
		'bou_numero2',
		'bou_numero3'
    ];
    
    //Activitylog
	use LogsActivity;
    protected static $logName = 'sai';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    
    use PresentableTrait;
    protected $presenter = 'App\Presenters\policiais\SaiPresenter';

    //mutators (para alterar na hora da exibição)
    public function getDataAttribute($value)
    {
        return data_br($value);
    }

    //mutator para alterar na hora de salvar no bd
    public function setDataAttribute($value)
    {
        $this->attributes['data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getAberturaDataAttribute($value)
    {
        return data_br($value);
    }

    //mutator para alterar na hora de salvar no bd
    public function setAberturaDataAttribute($value)
    {
        $this->attributes['abertura_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getRelatorio1DataAttribute($value)
    {
        return data_br($value);
    }

    //mutator para alterar na hora de salvar no bd
    public function setRelatorio1DataAttribute($value)
    {
        $this->attributes['relatorio1_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getRelatorio2DataAttribute($value)
    {
        return data_br($value);
    }

    //mutator para alterar na hora de salvar no bd
    public function setRelatorio2DataAttribute($value)
    {
        $this->attributes['relatorio2_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getRelatorio3DataAttribute($value)
    {
        return data_br($value);
    }

    //mutator para alterar na hora de salvar no bd
    public function setRelatorio3DataAttribute($value)
    {
        $this->attributes['relatorio3_data'] = data_bd($value);
    }
}
