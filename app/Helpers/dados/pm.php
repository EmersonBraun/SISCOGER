<?php
use App\Models\rhparana\Policial;
//para trazer informações com referência o RG
if (! function_exists('pm')) 
{
	function pm($dado,$rg)
	{
       
        $pm = Policial::where('rg','=',$rg)->first();

        $pm = (!$pm || $pm == '') ? '' : (object) $pm;

        if($pm != '')
        {
            switch ($dado) 
            {
                case 'data_admissao':
                    $return = $pm->DATA_ADMISSAO; 
                    break;

                case 'nome':
                    $return = $pm->NOME; 
                    break;

                case 'classe':
                    $return = $pm->CLASSE; 
                    break;

                case 'nascimento':
                    $return = $pm->NASCIMENTO; 
                    break;

                case 'id_sexo':
                    $return = $pm->ID_SEXO; 
                    break;

                case 'sexo':
                    $return = $pm->SEXO; 
                    break;

                case 'admissao_real':
                    $return = $pm->ADMISSAO_REAL; 
                    break;

                case 'email_meta4':
                    $return = $pm->EMAIL_META4; 
                    break;

                case 'funcao':
                    $return = $pm->FUNCAO; 
                    break;

                case 'cargo':
                    $return = $pm->CARGO; 
                    break;

                case 'quadro':
                    $return = $pm->QUADRO; 
                    break;

                case 'subquadro':
                    $return = $pm->SUBQUADRO; 
                    break;

                case 'promocao':
                    $return = $pm->PRMOCAO; 
                    break;

                case 'referencia':
                    $return = $pm->REFERENCIA; 
                    break;

                case 'bairro':
                    $return = $pm->BAIRRO; 
                    break;

                case 'cidade':
                    $return = $pm->CIDADE; 
                    break;

                case 'opm_descricao':
                    $return = $pm->OPM_DESCRICAO; 
                    break;

                case 'opm_meta4':
                    $return = $pm->OPM_META4; 
                    break;

                case 'cdopm':
                    $return = $pm->CDOPM; 
                    break;

                default:
                    $return = $pm->NOME; 
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