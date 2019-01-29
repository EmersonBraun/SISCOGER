<?php
//lista de feriados do ano
if (! function_exists('dias_feriados')) 
{
    function dias_feriados($ano = null)
    {
        if(empty($ano))
        {
            $ano = intval(date('Y'));
        }
        $pascoa = easter_date($ano); // Limite de 1970 ou após 2037 da easter_date PHP consulta http://www.php.net/manual/pt_BR/function.easter-date.php
        $dia_pascoa = date('j', $pascoa);
        $mes_pascoa = date('n', $pascoa);
        $ano_pascoa = date('Y', $pascoa);
        $feriados = array(
            // Tatas Fixas dos feriados Nacionail Basileiras
            [date("Y-m-d",mktime(0, 0, 0, 1, 1, $ano)), 'Confraternização Universal'], // Confraternização Universal - Lei nº 662, de 06/04/49
            [date("Y-m-d",mktime(0, 0, 0, 4, 21, $ano)), 'Tiradentes'], // Tiradentes - Lei nº 662, de 06/04/49
            [date("Y-m-d",mktime(0, 0, 0, 5, 1, $ano)), 'Dia do Trabalhador'], // Dia do Trabalhador - Lei nº 662, de 06/04/49
            [date("Y-m-d",mktime(0, 0, 0, 9, 7, $ano)), 'Dia da Independência'], // Dia da Independência - Lei nº 662, de 06/04/49
            [date("Y-m-d",mktime(0, 0, 0, 10, 12, $ano)), 'N. S. Aparecida'], // N. S. Aparecida - Lei nº 6802, de 30/06/80
            [date("Y-m-d",mktime(0, 0, 0, 11, 2, $ano)), 'Todos os santos'], // Todos os santos - Lei nº 662, de 06/04/49
            [date("Y-m-d",mktime(0, 0, 0, 11, 15, $ano)), 'Proclamação da republica'], // Proclamação da republica - Lei nº 662, de 06/04/49
            [date("Y-m-d",mktime(0, 0, 0, 12, 25, $ano)), 'Natal'], // Natal - Lei nº 662, de 06/04/49
            
            // Essas Datas depem diretamente da data de Pascoa
            [date("Y-m-d",mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 48, $ano_pascoa)), '2ºferia Carnaval'], //2ºferia Carnaval
            [date("Y-m-d",mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 47, $ano_pascoa)), '3ºfeira Carnaval'], //3ºferia Carnaval
            [date("Y-m-d",mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 46, $ano_pascoa)), '4ºfeira de cinzas'], //4ºferia Carnaval
            [date("Y-m-d",mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 2, $ano_pascoa)), '6ºfeira Santa'], //6ºfeira Santa
            [date("Y-m-d",mktime(0, 0, 0, $mes_pascoa, $dia_pascoa, $ano_pascoa)), 'Páscoa'], //Pascoa
            [date("Y-m-d",mktime(0, 0, 0, $mes_pascoa, $dia_pascoa + 60, $ano_pascoa)), 'Corpus Christ'], //Corpus Cirist

            //feriados PMPR
            [date("Y-m-d",mktime(0, 0, 0, 8, 10, $ano)), 'Aniversário da PMPR'], // 10 de Agosto - Aniversário da PMPR
            [date("Y-m-d",mktime(0, 0, 0, 6, 15, $ano)), 'Cel. Sarmento'], // Cel. Sarmento

        );
        sort($feriados);
        return $feriados;
    }

}