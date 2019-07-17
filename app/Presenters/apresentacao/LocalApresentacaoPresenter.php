<?php
namespace App\Presenters\apresentacao;

use Laracasts\Presenter\Presenter;
use App\Repositories\OPMRepository;

class LocalApresentacaoPresenter extends Presenter {
    
    public function tiponotacomparecimento()
    {
        return array_get(config('sistema.tiponotacomparecimento','Não Há'), $this->id_tiponotacomparecimento);
    }

    public function pm()
    {
        return OPMRepository::abreviatura($this->rg);
    }

    public function nota_file()
    {
        if($this->libelo_file)
        {
            return "<a href=".route('notacoger.download',$this->id_notacomparecimento)."><i class='fa fa fa-download' style='color: green'></i></a>";
        }
        else
        {
            return "<i class='fa fa fa-ban' style='color: red'></i>"; 
        }
    }


}
/*
protected $fillable = [
		'localdeapresentacao',
		'id_municipio',
		'bairro',
		'uf',
		'logradouro',
		'numero',
		'complemento',
		'cep',
		'telefone',
		'id_genero'
    ];
    */