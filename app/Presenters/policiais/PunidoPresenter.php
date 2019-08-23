<?php
namespace App\Presenters\policiais;

use Laracasts\Presenter\Presenter;

class PunidoPresenter extends Presenter {
    
    public function gradacao()
    {
        return array_get(config('sistema.gradacao','Não Há'), $this->id_gradacao);
    }

    public function classpunicao()
    {
        return array_get(config('sistema.classPunicao','Não Há'), $this->id_classpunicao);
    }

    public function comportamento()
    {
        return array_get(config('sistema.comportamento','Não Há'), $this->id_comportamento);
    }
}
/*
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
*/
