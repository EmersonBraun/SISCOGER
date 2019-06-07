<?php

namespace App\Models\Sjd\Administracao;

use Reliese\Database\Eloquent\Model as Eloquent;
// para não apagar diretamente, inserir data em "deleted_at"
use Illuminate\Database\Eloquent\SoftDeletes;
class Sjd extends Eloquent
{
    use SoftDeletes;

    protected $table = 'sjds';
    protected $primaryKey = 'id_sjd';
    
    protected $casts = [
		'id_sjd' => 'int',
        'cred' => 'int',
        'ead_conclusao' => 'int',
        'cert' => 'int'
	];

	protected $dates = [
        'assuncao_data',
        'saida_data',
        'ead_inicio_data',
        'ead_fim_data',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
	protected $fillable = [
        'id_sjd',
        'rg',
        'cpf',
        'telefone_secao',
        'email',
        'assuncao_data',
        'saida_data',
        'cdopm',
        'secao',
        'cred',
        'ead_inicio_data',
        'ead_fim_data',
        'ead_conclusao',
        'cert',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    //mutators (para alterar na hora da exibição)
    public function getEadInicioDataAttribute($value)
    {
        if($value == '0000-00-00' || $value == null)
        {
            return '';
        }
        else
        {
            return date( 'd/m/Y' , strtotime($value));
        }
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setEadInicioDataAttribute($value)
    {
        $this->attributes['ead_inicio_data'] = data_bd($value);
    }

    //mutators (para alterar na hora da exibição)
    public function getEadFimDataAttribute($value)
    {
        if($value == '0000-00-00' || $value == null)
        {
            return '';
        }
        else
        {
            return date( 'd/m/Y' , strtotime($value));
        }
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setEadFimDataAttribute($value)
    {
        $this->attributes['ead_fim_data'] = data_bd($value);
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setRgAttribute($value)
    {
        $val_limpo = preg_replace("/[^0-9]/", "", $value);
        $this->attributes['rg'] = $val_limpo;
    }

    //mutators (para alterar na hora de salvar no banco)
    public function setCpfAttribute($value)
    {
        $val_limpo = preg_replace("/[^0-9]/", "", $value);
        $this->attributes['cpf'] = $val_limpo;
    }

    public function scopeEad_fora_prazo($query)
	{
        $today = date('Y-m-d');
		return $query->where('ead_fim_data','>',$today)
				->where('ead_conclusao','<>',1);
	}

}
