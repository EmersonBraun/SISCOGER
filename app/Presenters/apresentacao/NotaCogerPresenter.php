<?php
namespace App\Presenters\apresentacao;

use Laracasts\Presenter\Presenter;
use App\Repositories\OPMRepository;

class NotaCogerPresenter extends Presenter {
    
    public function tiponotacomparecimento()
    {
        return sistema('tipoNotaComparecimento',$this->id_tiponotacomparecimento);
    }

    public function pm()
    {
        return OPMRepository::abreviatura($this->rg);
    }

    public function notaFile()
    {
        if($this->nota_file)
        {
            // return "<a href=".route('notacoger.download',$this->id_notacomparecimento)."><i class='fa fa fa-download' style='color: green'></i></a>";
            return 'teste';
        }
        else
        {
            return "<i class='fa fa fa-ban' style='color: red'></i> Não há arquivo"; 
        }
    }
}
/*
protected $fillable = [
		'sjd_ref',
		'sjd_ref_ano',
		'expedicao_data',
		'id_tiponotacomparecimento',
		'observacao_txt',
		'autoridade_rg',
		'autoridade_cargo',
		'autoridade_quadro',
		'autoridade_nome',
		'autoridade_funcao',
		'planilha_file',
		'planilha_nome',
		'nota_file',
		'rg',
		'criacao_dh',
		'status'
	];
    */