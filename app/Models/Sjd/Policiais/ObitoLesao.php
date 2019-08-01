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
 * Class Falecimento
 * 
 * @property int $id_falecimento
 * @property string $rg
 * @property string $cargo
 * @property string $nome
 * @property \Carbon\Carbon $data
 * @property int $id_municipio
 * @property string $endereco
 * @property string $endereco_numero
 * @property string $cdopm
 * @property int $bou_ano
 * @property string $bou_numero
 * @property int $id_situacao
 * @property string $resultado
 * @property string $descricao_txt
 *
 * @package App\Models
 */
class ObitoLesao extends Eloquent
{
    use SoftDeletes;

    //Activitylog
	use LogsActivity;
    protected static $logName = 'falecimento';
    protected static $logAttributes = ['*'];
	protected static $logOnlyDirty = true;

	protected $table = 'falecimento';
	protected $primaryKey = 'id_falecimento';
	public $timestamps = false;

	protected $casts = [
		'id_municipio' => 'int',
		'bou_ano' => 'int',
		'id_situacao' => 'int'
	];

	protected $dates = [
		'data'
	];

	protected $fillable = [
		'rg',
		'cargo',
		'nome',
		'data',
		'id_municipio',
		'endereco',
		'endereco_numero',
		'cdopm',
		'bou_ano',
		'bou_numero',
		'id_situacao',
		'resultado',
		'descricao_txt'
    ];
    
    use PresentableTrait;
    protected $presenter = 'App\Presenters\policiais\ObitoLesaoPresenter';

    //mutators (para alterar na hora da exibição)
    public function getDataAttribute($value)
    {
        if($value == '0000-00-00' || $value == null) return '';
        else return date( 'd/m/Y' , strtotime($value));
    }

    //mutator para alterar na hora de salvar no bd
    public function setDataAttribute($value)
    {
        $this->attributes['data'] = data_bd($value);
    }
}
