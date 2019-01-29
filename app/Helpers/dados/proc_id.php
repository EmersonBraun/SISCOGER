<?php
use Illuminate\Support\Facades\DB;
//para trazer dados o procedimento com base no procedimento e id
if (! function_exists('proc_id')) 
{
	function proc_id($proc,$id,$dado)
	{

        switch ($proc) 
        {
            case 'ipm':
                $id_procedimento = 'id_ipm';
                break;
            case 'sindicancia':
                $id_procedimento = 'id_sindicancia';
                break;
            case 'cd':
                $id_procedimento = 'id_cd';
                break;
            case 'cj':
                $id_procedimento = 'id_cj';
                break;
            case 'apfd':
                $id_procedimento = 'id_apfd';
                break;
            case 'fatd':
                $id_procedimento = 'id_fatd';
                break;
            case 'iso':
                $id_procedimento = 'id_iso';
                break;
            case 'desercao':
                $id_procedimento = 'id_desercao';
                break;
            case 'it':
                $id_procedimento = 'id_it';
                break;
            case 'adl':
                $id_procedimento = 'id_adl';
                break;
            case 'pad':
                $id_procedimento = 'id_pad';
                break;
            case 'sai':
                $id_procedimento = 'id_sai';
                break;
            case 'proc_outros':
                $id_procedimento = 'id_proc_outros';
                break;

        }

        $procedimento = DB::table($proc)->where($id_procedimento,'=',$id)->first();
        
        $procedimento = (object) $procedimento;
        $return = '';
        if($procedimento != '' && $procedimento != NULL)
        {
            switch ($dado) 
            {
                case 'ref':
                    $return = $procedimento->sjd_ref; 
                    break;

                case 'ano':
                    $return = $procedimento->sjd_ref_ano; 
                    break;
                
                case 'andamento':
                    $return = sistema('andamento',$procedimento->id_andamento); 
                    break;

                case 'andamentocoger':
                    $return = sistema('andamentocoger',$procedimento->id_andamentocoger); 
                    break;

                case 'fato_data':
                    $return = data_br($procedimento->fato_data); 
                    break;

                case 'abertura_data':
                    $return = data_br($procedimento->abertura_data); 
                    break;

                case 'sintese_txt':
                    $return = $procedimento->sintese_txt; 
                    break;

                case 'opm':
                    $return = opm($procedimento->cdopm); 
                    break;

            }
        }
        else
        {
            $return = 'Não Encontrado';
        }
        
        return $return;
		 
	}
}