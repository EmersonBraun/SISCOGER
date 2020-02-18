<?php
namespace App\Presenters\proc;

// use Laracasts\Presenter\Presenter;
use App\Presenters\BasePresenter;

class SindicanciaPresenter extends BasePresenter {
    
    public function refAno()
    {
        if($this->sjd_ref == null || $this->sjd_ref == '')
        {
            return $this->id_sobrestamento;
        }
        else 
        {
            return $this->sjd_ref.'/'.$this->sjd_ref_ano;
        }
    }

    public function createdAt()
    {
        return $this->created_at->format('d/m/Y');
    }

    public function dusobrestado()
    {
        if(!$this->dusobrestado) {
            return "<span class='label label-success'>0</span>";
        } 
        return "<span class='label label-info'>$this->dusobrestado'</span>";
    }

    public function motivo()
    {
        if ( sistema('andamento',$this->id_andamento) == 'SOBRESTADO') {
            if (!$this->motivo || $this->motivo =='outros') {
                if($this->motivo_outros) return $this->motivo_outros;
                return "Não definido";
            }
            return $this->motivo;
        }
        return "<span class='label label-success'>Não Sobrest.</span>";
    }

    public function statusPriorityColor()
    {
            $labels = [
                '4'  => 'primary',
                '3'  => 'success',
                '2'  => 'warning',
                '1'  => 'danger'
            ];

            return $labels[$this->prioridade];
    }

}
/*
protected $fillable = [
		'id_andamentocoger',
		'id_andamento',
		'sjd_ref',
		'sjd_ref_ano',
		'fato_data',
		'abertura_data',
		'sintese_txt',
		'cdopm',
		'doc_tipo',
		'doc_numero',
		'doc_origem_txt',
		'portaria_numero',
		'portaria_data',
		'sol_cmt_file',
		'sol_cmt_data',
		'sol_cmtgeral_file',
		'sol_cmtgeral_data',
		'opm_meta4',
		'relatorio_file',
		'relatorio_data',
		'prioridade'
    ];
    */