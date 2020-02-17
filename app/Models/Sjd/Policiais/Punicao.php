<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 22 Aug 2019 16:36:23 +0000.
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
 * Class Punicao
 * 
 * @property int $id_punicao
 * @property string $rg
 * @property string $rg_cadastro
 * @property string $cargo
 * @property string $nome
 * @property \Carbon\Carbon $punicao_data
 * @property \Carbon\Carbon $ultimodia_data
 * @property int $id_gradacao
 * @property int $id_classpunicao
 * @property int $dias
 * @property string $cdopm
 * @property string $opm_abreviatura
 * @property string $digitador
 * @property string $descricao_txt
 * @property int $id_comportamento
 * @property string $procedimento
 * @property int $sjd_ref
 * @property int $sjd_ref_ano
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @package App\Models
 */
class Punicao extends Eloquent
{
    use SoftDeletes;
    
	protected $table = 'punicao';
	protected $primaryKey = 'id_punicao';

	protected $casts = [
		'id_gradacao' => 'int',
		'id_classpunicao' => 'int',
		'dias' => 'int',
		'id_comportamento' => 'int',
		'sjd_ref' => 'int',
		'sjd_ref_ano' => 'int'
	];

	protected $dates = [
		'punicao_data',
		'ultimodia_data'
	];

	protected $fillable = [
		'rg',
		'rg_cadastro',
		'cargo',
		'nome',
		'punicao_data',
		'ultimodia_data',
		'id_gradacao',
		'id_classpunicao',
		'dias',
		'cdopm',
		'opm_abreviatura',
		'digitador',
		'descricao_txt',
		'id_comportamento',
		'procedimento',
		'sjd_ref',
		'sjd_ref_ano'
    ];
    
    //Activitylog
	use LogsActivity;
    protected static $logName = 'punido';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    
    use PresentableTrait;
    protected $presenter = 'App\Presenters\policiais\PunidoPresenter';

    //mutators (para alterar na hora da exibição)
    public function getPunicaoDataAttribute($value)
    {
        return data_br($value);
    }

    //mutator para alterar na hora de salvar no bd
    public function setPunicaoDataAttribute($value)
    {
        $this->attributes['punicao_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getUltimodiaDataAttribute($value)
    {
        return data_br($value);
    }

    //mutator para alterar na hora de salvar no bd
    public function setUltimodiaDataAttribute($value)
    {
        $this->attributes['ultimodia_data'] = data_bd($value);
    }
}
