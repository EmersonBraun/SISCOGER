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
 * Class Preso
 * 
 * @property int $id_preso
 * @property string $rg
 * @property string $nome
 * @property string $cargo
 * @property string $cdopm_quandopreso
 * @property string $cdopm_prisao
 * @property string $localreclusao
 * @property string $local
 * @property string $processo
 * @property string $natureza
 * @property string $complemento
 * @property string $numeromandado
 * @property int $id_presotipo
 * @property string $origem_proc
 * @property int $origem_sjd_ref
 * @property int $origem_sjd_ref_ano
 * @property string $origem_opm
 * @property \Carbon\Carbon $inicio_data
 * @property \Carbon\Carbon $fim_data
 * @property string $vara
 * @property string $comarca
 * @property string $obs_txt
 *
 * @package App\Models
 */
class PresoOutro extends Eloquent
{
    use SoftDeletes;

	protected $table = 'preso_outros';
	protected $primaryKey = 'id_preso_outros';
	public $timestamps = true;

	protected $casts = [
		'id_presotipo' => 'int',
	];

	protected $dates = [
		'inicio_data',
		'fim_data'
	];

	protected $fillable = [
		'rg',
		'nome',
		'uf',
		'ocupacao',
		'cdopm_prisao',
		'localreclusao',
		'local',
		'processo',
		'complemento',
		'numeromandado',
		'id_presotipo',
		'vara',
		'comarca',
		'inicio_data',
		'fim_data',
		'obs_txt'
    ];
    
    //Activitylog
	use LogsActivity;
    protected static $logName = 'preso_outro';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    
    use PresentableTrait;
    protected $presenter = 'App\Presenters\policiais\PresoPresenter';

    //mutators (para alterar na hora da exibição)
    public function getInicioDataAttribute($value)
    {
        if($value == '0000-00-00' || $value == null) return '';
        else return date( 'd/m/Y' , strtotime($value));
    }

    //mutator para alterar na hora de salvar no bd
    public function setInicioDataAttribute($value)
    {
        $this->attributes['inicio_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getFimDataAttribute($value)
    {
        if($value == '0000-00-00' || $value == null) return '';
        else return date( 'd/m/Y' , strtotime($value));
    }

    //mutator para alterar na hora de salvar no bd
    public function setFimDataAttribute($value)
    {
        $this->attributes['fim_data'] = data_bd($value);
    }
}
