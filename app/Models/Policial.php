<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Policial extends Model
{
    public function scopeGet($rg)
	{
		//busca primeiro nos ATIVOS
        $pm = DB::connection('rhparana')
            ->table('policial')
            ->where('rg','=', $rg)
            ->first();

        //caso não encontre busca nos INATIVOS
        if(is_null($pm))
        {
            $inativo = DB::connection('rhparana')
            ->table('inativos')
            ->where('CBR_NUM_RG','=', $rg)
            ->first();

            //caso não encontre nos inativos busca na RESERVA
            if (is_null($inativo)) 
            {
                $reserva = DB::connection('rhparana')
                ->table('RESERVA')
                ->where('UserRG','=', $rg)
                ->first();

                //Caso não encontre NÃO HÁ DADOS
                if (is_null($reserva)) 
                {
                    //cria objeto com dados vazios
                    $pm = (object) [
                        'CARGO' => 'Não encontrado',
                        'QUADRO' => 'Não encontrado',
                        'SUBQUADRO' => 'Não encontrado',
                        'NOME' => 'Não encontrado',
                        'RG' => 'Não encontrado',
                        'OPM_DESCRICAO' => '-',
                        'NASCIMENTO' => 'Não encontrado',
                        'ADMISSAO_REAL' => 'Não encontrado',
                        'CIDADE' => 'Não encontrado',
                        'EMAIL_META4' => '-',
                        'SEXO' => 'Não encontrado',
                        'STATUS' => "Não encontrado - Buscado em Ativo, Inativo e Reserva",
                        ];
                } 
                else 
                {
                    //cria objeto com dados do reserva
                    $pm = (object) [
                        'CARGO' => $reserva['posto'],
                        'QUADRO' => $reserva['quadro'],
                        'SUBQUADRO' => $reserva['subquadro'],
                        'NOME' => $reserva['nome'],
                        'RG' => $reserva['UserRG'],
                        'OPM_DESCRICAO' => '-',
                        'NASCIMENTO' => '-',
                        'ADMISSAO_REAL' => $reserva['data'],
                        'CIDADE' => '-',
                        'EMAIL_META4' => '-',
                        'SEXO' => '-',
                        'STATUS' => "Reserva",
                        'SITUACAO' => "Normal",
                        ];
                }     
            } 
            else 
            {
                //cria objeto com dados do inativo
                $pm = (object) [
                'CARGO' => $inativo['cargo'],
                'QUADRO' => $inativo['QUADRO'],
                'SUBQUADRO' => 'RR',
                'NOME' => $inativo['NOME'],
                'RG' => $inativo['CBR_NUM_RG'],
                'OPM_DESCRICAO' => '-',
                'NASCIMENTO' => $inativo['DT_NASC'],
                'ADMISSAO_REAL' => $inativo['DT_INI_RH'],
                'CIDADE' => $inativo['END_CIDADE'],
                'EMAIL_META4' => '-',
                'SEXO' => $inativo['SEXO'],
                'END_RUA' => $inativo['END_LOGRADOURO'],
                'END_NUM' => $inativo['END_NUMERO'],
                'END_COMPL' => $inativo['END_COMPL'],
                'END_BAIRRO' => $inativo['END_BAIRRO'],
                'END_CIDADE' => $inativo['END_CIDADE'],
                'END_CEP' => $inativo['END_CEP'],
                'FONE' => $inativo['FONE'],
                'STATUS' => "Inativo",
                'SITUACAO' => "Normal",
                ];
            }        
        }
        else
        {
            //força ser objeto
            $pm = (object) $pm;
            //coloca o status e situacao
            $pm->STATUS = 'Ativo';
            $pm->SITUACAO = 'Normal';
        }
        //Idade
        $pm->IDADE = idade($pm->NASCIMENTO);

        return $pm;
    }
}
