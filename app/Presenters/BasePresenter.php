<?php
namespace App\Presenters;

use Laracasts\Presenter\Presenter;
use App\Repositories\OPMRepository;

class BasePresenter extends Presenter {
    
    public function andamento()
    {
        return array_get(config('sistema.andamento','Não Há'), $this->id_andamento);
    }

    public function andamentocoger()
    {
        return array_get(config('sistema.andamento','Não Há'), $this->id_andamentocoger);
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


    public function cargoENome()
    {
        return $this->cargo.' '.special_ucwords($this->nome);
    }

    public function prioridade()
    {
        if($this->prioridade)
        {
            return 'Sim';
        }
        else 
        {
            return 'Não';
        }
    }  
}
