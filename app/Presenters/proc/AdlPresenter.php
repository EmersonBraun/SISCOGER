<?php
namespace App\Presenters\proc;

use Laracasts\Presenter\Presenter;
use App\Repositories\OPMRepository;

class AdlPresenter extends Presenter {
    
    public function andamento()
    {
        return array_get(config('sistema.andamento','Não Há'), $this->id_andamento);
    }

    public function andamentocoger()
    {
        return array_get(config('sistema.andamento','Não Há'), $this->id_andamentocoger);
    }

    public function motivoconselho()
    {
        return array_get(config('sistema.motivoconselho','Não Há'), $this->id_motivoconselho);
    }

    public function decorrenciaconselho()
    {
        return array_get(config('sistema.decorrenciaconselho','Não Há'), $this->id_decorrenciaconselho);
    }

    public function situacaoconselho()
    {
        return array_get(config('sistema.situacaoconselho','Não Há'), $this->id_situacaoconselho);
    }

    public function opm()
    {
        return OPMRepository::abreviatura($this->cdopm);
    }

    public function refAno()
    {
        if($this->sjd_ref == null || $this->sjd_ref == '')
        {
            return $this->id_adl;
        }
        else 
        {
            return $this->sjd_ref.'/'.$this->sjd_ref_ano;
        }
    }

    public function fatoData()
    {
        return $this->fato_data->format('d/m/Y');
    }

    public function prescricaoData()
    {
        return $this->prescricao_data->format('d/m/Y');
    }

    public function portariaData()
    {
        return $this->portaria_data->format('d/m/Y');
    }

    public function cargoENome()
    {
        return $this->cargo.' '.special_ucwords($this->nome);
    }

    public function libeloIcon()
    {
        if($this->libelo_file)
        {
            return "<i class='fa fa fa-check' style='color: green'></i>";
        }
        else
        {
            return "<i class='fa fa fa-times' style='color: red'></i>"; 
        }
    }

    public function parecerIcon()
    {
        if($this->parecer_file)
        {
            return "<i class='fa fa fa-check' style='color: green'></i>";
        }
        else
        {
            return "<i class='fa fa fa-times' style='color: red'></i>";
        }
    }


    public function decisaoIcon()
    {
        if($this->decisao_file)
        {
            return "<i class='fa fa fa-check' style='color: green'></i>";
        }
        else
        {
            return "<i class='fa fa fa-times' style='color: red'></i>";
        }
    }


    public function recAtoIcon()
    {
        if($this->rec_ato_file)
        {
            return "<i class='fa fa fa-check' style='color: green'></i>";
        }
        else
        {
            return "<i class='fa fa fa-times' style='color: red'></i>";
        }
    }

    public function motivo()
    {
        if(sistema('andamento',$this->id_andamento) == 'SOBRESTADO')
        {
            if($this->motivo =='' || $this->motivo =='outros')
            {
                return $this->motivo_outros; 
            }
            else 
            {
                return $this->motivo; 
            }
        }
        else
        {
            return "<span class='label label-success'>Não Sobrest.</span>";
        }
    }


}
/*
protected $fillable = [
		'id_andamento',
		'id_andamentocoger',
		'id_motivoconselho',
		'id_decorrenciaconselho',
		'id_situacaoconselho',
		'outromotivo',
		'cdopm',
		'fato_data',
		'abertura_data',
		'sintese_txt',
		'doc_tipo',
		'doc_numero',
		'portaria_numero',
		'portaria_data',
		'doc_prorrogacao',
		'sjd_ref',
		'sjd_ref_ano',
		'prescricao_data',
		'parecer_comissao',
		'parecer_cmtgeral',
		'exclusao_txt',
		'ac_desempenho_bl',
		'ac_conduta_bl',
		'ac_honra_bl',
		'libelo_file',
		'parecer_file',
		'decisao_file',
		'rec_ato_file',
		'rec_gov_file',
		'tjpr_file',
		'stj_file',
		'prioridade'
    ];
    */