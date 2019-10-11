<?php
use Illuminate\Support\Facades\DB;

if (! function_exists('punicao')) 
{
	function punicao($id)
	{

        $punicao = DB::table('punicao')->where('id_punicao','=',$id)->first();
        
        if(!$punicao) $return = 'Não Há';
        else {
            $return = sistema('classPunicao',$punicao['id_classpunicao']);
            $return .= ': '.sistema('gradacao',$punicao['id_gradacao']);
            if(!in_array($punicao['id_gradacao'],[1,3])) $return .= ' '.$punicao['dias'].' dias';
        }
        return $return;
		 
	}
}