<?php

namespace App\Http\Controllers\Testes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Sjd\Administracao\Fds as Fds;
use \Carbon\Carbon;

class testeBD extends Controller
{
 
    public function opm()
    {
		$testes = DB::connection('rhparana')
		->table('opmPMPR')
		->orderBy('codigo', 'asc')
		->get();
 		
 		echo "  return [<br>";
        foreach ($testes as $teste) {
			echo "'$teste->CODIGO'";
        	echo " => '$teste->ABREVIATURA', <br>";
        }
        echo "];";
    }

    public function tabelas($conn,$colunas='')
    {

		$tabelas = DB::connection($conn)->table('sysobjects')->select('name')->get();
		
		if ($colunas != '') 
		{
			foreach ($tabelas as $tabela) 
			{

				echo "$tabela->name, </br>";
			}
		} 
		else 
		{
			//dd($tabelas);
			$tab = [];
			
			foreach ($tabelas as $t) 
			{
				//if($i > 120) continue;
				$col = [];
				if(
					isset($t['name']) && 
					substr($t['name'], 0, 3) != 'dt_' && 
					substr($t['name'], 0, 3) != 'sys' &&
					strtoupper(substr($t['name'], 0, 3)) != 'PK_' &&
					strtoupper(substr($t['name'], 0, 3)) != 'TEM' &&
					strtoupper(substr($t['name'], 0, 3)) != 'DF_'
					)
				{
					//dd(substr($t['name'], 0, 2));
					
					$tab[$t['name']] = testeBD::colunas($conn, $t['name']);
				}
				//$i++;
			}
			return $tab;
		}
		
 		

	}
	
	public function tabelas2($conn)
    {
		$tabelas = DB::connection($conn)->table('sysobjects')->select('name')->get();
		
		//dd($tabelas);
		$tab = [];
		
		foreach ($tabelas as $t) 
		{
			//if($i > 120) continue;
			$col = [];
			if(
				isset($t['name']) && 
				substr($t['name'], 0, 3) != 'dt_' && 
				substr($t['name'], 0, 3) != 'sys' &&
				strtoupper(substr($t['name'], 0, 3)) != 'PK_' &&
				strtoupper(substr($t['name'], 0, 3)) != 'TEM' &&
				strtoupper(substr($t['name'], 0, 3)) != 'DF_'
				)
			{
				
				$tab[$t['name']] = $t['name'];
			}
			//$i++;
		
		}
		return $tab;

    }

    public static function colunas($conn, $tabela)
    {
    	//SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS
    	$colunas = DB::connection($conn)
 				->table('INFORMATION_SCHEMA.COLUMNS')
 				->select('COLUMN_NAME', 'ORDINAL_POSITION')
 				->where('TABLE_NAME', '=' ,$tabela)
 				->get();
 				// dd($colunas);
 				$i = 0;

        $col = [];
		foreach ($colunas as $c ) 
		{
			if(isset($c['COLUMN_NAME']))
			{
				$col[$i] = $c['COLUMN_NAME'];
				$i++;
			}
		}
		
		return $col;
    }

    public function colunas2($tabela)
    {
    	//SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS 
    	//WHERE TABLE_SCHEMA = 'banco_de_dados' AND TABLE_NAME = 'tabela'
    	$colunas = DB::connection('sjd')
 				->table($tabela)
 				->get();
 				//dd($colunas);
 				$teste = json_encode($colunas);
 		print_r($teste);exit;	
 		$teste = [];
 		
		  foreach ($colunas as $coluna ) 
		  {
		  	$teste .= (array) $coluna;
		  }		
	}

	public function bd($conn, $tabela, $limite,$c1='',$c2='')
	{
		$meta4 = testeBD::tabelas2('meta4');
		$rhparana = testeBD::tabelas2('rhparana');
		$pass = testeBD::tabelas2('pass');

		if($c1 != '' || $c2 != '')
		{
			 $query = DB::connection($conn)
                    ->table($tabela);
                    $query->where($c1,'=',$c2);
					$query->limit($limite);
                    $res =	$query->get();
		}
		else
		{
			$res = DB::connection($conn)
					->table($tabela)
					->limit($limite)
					->get();
		}
		//para fazer um dump and die
		if($limite == 'dd') dd($res);

		$colunas = array_keys($res[0]);

		return view('ajuda.bd',compact('res','colunas','meta4','rhparana','pass'));
	}
    //SELECT * FROM RHPARANA.opmPMPR where CODIGO like '723%' or CODIGO like '439%';
    public function search($cod, $nome=""){
        $query = DB::connection('rhparana')
        ->table('opmPMPR')
        ->where('CODIGO','like',$cod.'%');
        if($nome) $query->orWhere('ABREVIATURA','like',$nome.'%');
        $dados = $query->get();
 
        return view('ajuda.a28',compact('dados'));
        
    }

    public function qtds(){
        $query = DB::connection('rhparana')
        ->table('policial')
        ->where('cdopm','like','907%')
        ->count();
        dd($query);     
    }

	public function bdgeral()
	{
		$meta4 = testeBD::tabelas2('meta4');
		$rhparana = testeBD::tabelas2('rhparana');
		$pass = testeBD::tabelas2('pass');

		return view('ajuda.bdgeral',compact('meta4','rhparana','pass'));
	}
	
	
	public function fds(Fds $fds)
    {
		
		$date = new Carbon('first day of january 2008');
		// aqui tu só trocas o ano final que tu queres validar
		$end_date = new Carbon('last day of december 2030'); 
		$i = 1;
		while ($date < $end_date) {
			if ($date->isSaturday()) {
				$fds = new Fds;
				$fds->id_fds = $i;
				$fds->data = $date;
				$fds->descr = 'SAB';
				$fds->save();
				$i++;
				//echo $date->format('d/m/Y'). ' é sábado' . PHP_EOL.'<br>';
			}
			if ($date->isSunday()) {
				$fds = new Fds;
				$fds->id_fds = $i;
				$fds->data = $date;
				$fds->descr = 'DOM';
				$fds->save();
				$i++;
				//echo $date->format('d/m/Y'). ' é domingo' . PHP_EOL.'<br>';
			} 
			$date->addDay(1);
		}
	
	}
	
	public function qtd_prc(Fds $fds)
    {
		
		
		$i = 1;
		while ($date < $end_date) {
			if ($date->isSaturday()) {
				$fds = new Fds;
				$fds->id_fds = $i;
				$fds->data = $date;
				$fds->descr = 'SAB';
				$fds->save();
				$i++;
				//echo $date->format('d/m/Y'). ' é sábado' . PHP_EOL.'<br>';
			}
			if ($date->isSunday()) {
				$fds = new Fds;
				$fds->id_fds = $i;
				$fds->data = $date;
				$fds->descr = 'DOM';
				$fds->save();
				$i++;
				//echo $date->format('d/m/Y'). ' é domingo' . PHP_EOL.'<br>';
			} 
			$date->addDay(1);
		}
	
	}
	
}

