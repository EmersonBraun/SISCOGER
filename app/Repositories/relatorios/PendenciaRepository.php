<?php

namespace App\Repositories\relatorios;

use Cache;
use DB;
use App\Models\Sjd\Relatorios\Pendencia;

class PendenciaRepository
{
    protected $model;
    protected $expiration = 60 * 24; 
 
	public function __construct(Pendencia $model)
	{
		$this->model = $model;
    }

    public function cleanCache()
	{
        Cache::tags('pendencias')->flush();
    }

    public function gerais()
	{
        $pendencias = Cache::tags('pendencias')->remember('total_pendencias_gerais', $this->expiration, function(){
            return $this->model->select('pendencias.*',DB::raw ('(fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))->get();
        });

        return $pendencias;
    }

    public function cg()
	{
        $cg = Cache::tags('pendencias')->remember('pendencias:cg', $this->expiration, function(){
            return 
            $this->model->select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',0)
            ->first();
        });

        return $cg;
    }
    
    public function em()
	{
        $em = Cache::tags('pendencias')->remember('pendencias:em', $this->expiration, function(){
            return 
            $this->model->select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',1)
            ->first();
        });

        return $em;
    }

    public function crpm1()
    {
        $crpm1 = Cache::tags('pendencias')->remember('c1_pendencias', $this->expiration, function(){
            return 
            $this->model->select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',2)
            ->first();
        });

        return $crpm1;
    }

    public function crpm2()
    {
        $crpm2 = Cache::tags('pendencias')->remember('c2_pendencias', $this->expiration, function(){
            return 
            $this->model->select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',3)
            ->first();
        });

        return $crpm2;
    }

    public function crpm3()
    {
        $crpm3 = Cache::tags('pendencias')->remember('c3_pendencias', $this->expiration, function(){
            return 
            $this->model->select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',4)
            ->first();
        });

        return $crpm3;
    }

    public function crpm4()
    {
        $crpm4 = Cache::tags('pendencias')->remember('c4_pendencias', $this->expiration, function(){
            return 
            $this->model->select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',5)
            ->first();
        });

        return $crpm4;
    }

    public function crpm5()
    {
        $crpm5 = Cache::tags('pendencias')->remember('c5_pendencias', $this->expiration, function(){
            return 
            $this->model->select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',6)
            ->first();
        });

        return $crpm5;
    }

    public function crpm6()
    {
        $crpm6 = Cache::tags('pendencias')->remember('c6_pendencias', $this->expiration, function(){
            return 
            $this->model->select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',7)
            ->first();
        });

        return $crpm6; 
    }

    public function ccb()
    {
        $ccb = Cache::tags('pendencias')->remember('ccb_pendencias', $this->expiration, function(){
            return 
            $this->model->select(DB::raw ('
            IFNULL(sum(comportamento),0) comportamento, IFNULL(sum(fatd_punicao),0) fatd_punicao,IFNULL(sum(fatd_prazo),0) fatd_prazo, 
            IFNULL(sum(fatd_abertura),0) fatd_abertura, IFNULL(sum(ipm_prazo),0) ipm_prazo, IFNULL(sum(ipm_abertura),0) ipm_abertura, 
            IFNULL(sum(sindicancia_prazo),0) sindicancia_prazo, IFNULL(sum(sindicancia_abertura ),0) sindicancia_abertura,
            (fatd_punicao+fatd_prazo+fatd_abertura+ipm_prazo+ipm_abertura+sindicancia_prazo+sindicancia_abertura) AS total'))
            ->where('cdopm','like',9)
            ->first();
        });

        return $ccb;
    }

    public function total()
    {
        $result = [
            'cg' => $this->cg()->total,
            'em' => $this->em()->total,
            'crpm1' => $this->crpm1()->total,
            'crpm2' => $this->crpm2()->total,
            'crpm3' => $this->crpm3()->total,
            'crpm4' => $this->crpm4()->total,
            'crpm5' => $this->crpm5()->total,
            'crpm6' => $this->crpm6()->total,
            'ccb' => $this->ccb()->total,
        ];

        return $result;
    }

    public function fatd_punicao()
    {
        $result = [
            'cg' => $this->cg()->fatd_punicao,
            'em' => $this->em()->fatd_punicao,
            'crpm1' => $this->crpm1()->fatd_punicao,
            'crpm2' => $this->crpm2()->fatd_punicao,
            'crpm3' => $this->crpm3()->fatd_punicao,
            'crpm4' => $this->crpm4()->fatd_punicao,
            'crpm5' => $this->crpm5()->fatd_punicao,
            'crpm6' => $this->crpm6()->fatd_punicao,
            'ccb' => $this->ccb()->fatd_punicao,
        ];

        return $result;
    }

    public function fatd_prazo()
    {
        $result = [
            'cg' => $this->cg()->fatd_prazo,
            'em' => $this->em()->fatd_prazo,
            'crpm1' => $this->crpm1()->fatd_prazo,
            'crpm2' => $this->crpm2()->fatd_prazo,
            'crpm3' => $this->crpm3()->fatd_prazo,
            'crpm4' => $this->crpm4()->fatd_prazo,
            'crpm5' => $this->crpm5()->fatd_prazo,
            'crpm6' => $this->crpm6()->fatd_prazo,
            'ccb' => $this->ccb()->fatd_prazo,
        ];

        return $result;
    }

    public function fatd_abertura()
    {
        $result = [
            'cg' => $this->cg()->fatd_abertura,
            'em' => $this->em()->fatd_abertura,
            'crpm1' => $this->crpm1()->fatd_abertura,
            'crpm2' => $this->crpm2()->fatd_abertura,
            'crpm3' => $this->crpm3()->fatd_abertura,
            'crpm4' => $this->crpm4()->fatd_abertura,
            'crpm5' => $this->crpm5()->fatd_abertura,
            'crpm6' => $this->crpm6()->fatd_abertura,
            'ccb' => $this->ccb()->fatd_abertura,
        ];

        return $result;
    }

    public function ipm_prazo()
    {
        $result = [
            'cg' => $this->cg()->ipm_prazo,
            'em' => $this->em()->ipm_prazo,
            'crpm1' => $this->crpm1()->ipm_prazo,
            'crpm2' => $this->crpm2()->ipm_prazo,
            'crpm3' => $this->crpm3()->ipm_prazo,
            'crpm4' => $this->crpm4()->ipm_prazo,
            'crpm5' => $this->crpm5()->ipm_prazo,
            'crpm6' => $this->crpm6()->ipm_prazo,
            'ccb' => $this->ccb()->ipm_prazo,
        ];

        return $result;
    }

    public function ipm_abertura()
    {
        $result = [
            'cg' => $this->cg()->ipm_abertura,
            'em' => $this->em()->ipm_abertura,
            'crpm1' => $this->crpm1()->ipm_abertura,
            'crpm2' => $this->crpm2()->ipm_abertura,
            'crpm3' => $this->crpm3()->ipm_abertura,
            'crpm4' => $this->crpm4()->ipm_abertura,
            'crpm5' => $this->crpm5()->ipm_abertura,
            'crpm6' => $this->crpm6()->ipm_abertura,
            'ccb' => $this->ccb()->ipm_abertura,
        ];

        return $result;
    }

    public function sindicancia_prazo()
    {
        $result = [
            'cg' => $this->cg()->sindicancia_prazo,
            'em' => $this->em()->sindicancia_prazo,
            'crpm1' => $this->crpm1()->sindicancia_prazo,
            'crpm2' => $this->crpm2()->sindicancia_prazo,
            'crpm3' => $this->crpm3()->sindicancia_prazo,
            'crpm4' => $this->crpm4()->sindicancia_prazo,
            'crpm5' => $this->crpm5()->sindicancia_prazo,
            'crpm6' => $this->crpm6()->sindicancia_prazo,
            'ccb' => $this->ccb()->sindicancia_prazo,
        ];

        return $result;
    }

    public function sindicancia_abertura()
    {
        $result = [
            'cg' => $this->cg()->sindicancia_abertura,
            'em' => $this->em()->sindicancia_abertura,
            'crpm1' => $this->crpm1()->sindicancia_abertura,
            'crpm2' => $this->crpm2()->sindicancia_abertura,
            'crpm3' => $this->crpm3()->sindicancia_abertura,
            'crpm4' => $this->crpm4()->sindicancia_abertura,
            'crpm5' => $this->crpm5()->sindicancia_abertura,
            'crpm6' => $this->crpm6()->sindicancia_abertura,
            'ccb' => $this->ccb()->sindicancia_abertura,
        ];

        return $result;
    }

    public function cd_prazo()
    {
        $result = [
            'cg' => $this->cg()->cd_prazo,
            'em' => $this->em()->cd_prazo,
            'crpm1' => $this->crpm1()->cd_prazo,
            'crpm2' => $this->crpm2()->cd_prazo,
            'crpm3' => $this->crpm3()->cd_prazo,
            'crpm4' => $this->crpm4()->cd_prazo,
            'crpm5' => $this->crpm5()->cd_prazo,
            'crpm6' => $this->crpm6()->cd_prazo,
            'ccb' => $this->ccb()->cd_prazo,
        ];

        return $result;
    }

    public function cd_abertura()
    {
        $result = [
            'cg' => $this->cg()->cd_abertura,
            'em' => $this->em()->cd_abertura,
            'crpm1' => $this->crpm1()->cd_abertura,
            'crpm2' => $this->crpm2()->cd_abertura,
            'crpm3' => $this->crpm3()->cd_abertura,
            'crpm4' => $this->crpm4()->cd_abertura,
            'crpm5' => $this->crpm5()->cd_abertura,
            'crpm6' => $this->crpm6()->cd_abertura,
            'ccb' => $this->ccb()->cd_abertura,
        ];

        return $result;
    }
     
}