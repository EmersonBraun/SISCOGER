<?php
//Aqui fica a parte de lógica dos controllers, para não ficar enchendo de atribuições erradas
namespace App\Services;


class ICOService 
{
	public function __construct()
	{
    }

    public function nome($nome)
    {
        return special_ucwords($nome);
    } 

    public function posto($cargo)
    {
        $cargos = [
            'SD2C' => 'Sd. 2ª Cl',
            'SD1C' => 'Sd.',
            'CABO' => 'Cb.',
            '3SGT' => '3º Sgt.',
            '2SGT' => '2º Sgt.',
            '1SGT' => '1º Sgt.',
            'SUBTEN' => 'Sub. Ten.',
            'ALUNO3A' => 'Cad.',
            'ALUNO2A' => 'Cad.',
            'ALUNO1A' => 'Cad.',
            'ASPOF' => 'Asp. Of.',
            '2TEN' => '2º Ten.',
            '1TEN' => '1º Ten.',
            'CAP' => 'Cap.',
            'MAJ' => 'Maj.',
            'TENCEL' => 'Ten-Cel.',
            'CEL' => 'Cel.',
        ];

        try {
            return $cargos[$cargo];
        } catch (\Throwable $th) {
            //throw $th;
            return $cargos[strtoupper($cargo)];
        }
    }

    public function posto_nivel($nivel)
    {
        $cargo = array_get(config('sistema.posto','Não Há'), $nivel);

        return $this->posto($cargo);
    }

    public function tratamento($cargo)
    {
        return strtoupper($cargo) == 'cel' ? 'Vossa  Excelência' : 'Vossa  Senhoria';
    }

    public function quadro_sub($quadro, $sub)
    {
        // Para praças ex: QPMG 1-0
        $quadrosPraca = ['QPM1','QPMG1','QPM2','QPMG2'];
        if(in_array($quadro, $quadrosPraca)) {
            $q = 'QPMG';
            $s = substr($quadro, -1);

            return "$q $s-$sub";
        }
        // Para quadros com subquadro 
        if($sub !== null && $sub !== 'NA') return "$quadro $sub";
        // para quem só tem quadro Ex. QOPM
        return $quadro;
    }

    public function mes_abr($mes)
    {
        // dd((int)$mes);
        $mesBR = ['','jan','fev','mar','abr','maio','jun','jul','ago','set','out','nov','dez'];
        return $mesBR[(int)$mes];
    }

    public function mes($mes)
    {
        $mesBR = ['','janeiro','fevereiro','março','abril','maio','junho','julho','agosto','setembro','outubro','novembro','dezembro'];
        return $mesBR[(int)$mes];
    }

    public function data($data)
    {
        $data = data_bd($data);
        $dt = explode('-',$data);
        // dd($dt[2]);
        $dia = $dt[2];
        $mes_abr = $this->mes_abr($dt[1]);
        $mes = $this->mes($dt[1]);
        $ano = $dt[0];
        $ano_abr = substr($ano, -2);
        return [
            'dia' => $dia,
            'mes' => $mes,
            'mes_abr' => $mes_abr,
            'ano' => $ano,
            'ano_abr' => $ano_abr
        ];
    }

    public function hora($hora)
    {
        $hr = explode(':',$hora);
        $h = $hr[0];
        $m = $hr[1];
        if((int) $m > 0) return $h."h".$m;
        return $h."h";
    }

    public function cod_notificacao($ref)
    {
        $not = $ref.'00';
        $n_not = $ref.'17';
        $comp_real = $ref.'23';
        $comp_canc = $ref.'30';
        $com_predes = $ref.'46';
        $n_comp = $ref.'52';

        return [
            'base' => number_format($not, 0, '','.'),
            'notificado' => number_format($not, 0, '','.').'-'.date('y'),
            'naonotificado' => number_format($n_not, 0, '','.').'-'.date('y'),
            'realizada' => number_format($comp_real, 0, '','.').'-'.date('y'),
            'cancelada' => number_format($comp_canc, 0, '','.').'-'.date('y'),
            'redesignada' => number_format($com_predes, 0, '','.').'-'.date('y'),
            'naocompareceu' => number_format($n_comp, 0, '','.').'-'.date('y'),
        ];
    }
}

