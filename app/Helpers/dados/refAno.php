<?php
use Illuminate\Support\Facades\DB;

if (! function_exists('refAno')) 
{
	function refAno($name,$id, $separado=false)
	{
        $proc = DB::table($name)->where('id_'.$name,'=',$id)->first();
        if(!$proc) return 'Não Há';
        if($separado) {
            return [
                'ref' => $proc['sjd_ref'],
                'ano' => $proc['sjd_ref_ano']
            ];
        }
        return $proc['sjd_ref'].'/'.$proc['sjd_ref_ano'];	 
	}
}