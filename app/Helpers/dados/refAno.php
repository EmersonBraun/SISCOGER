<?php
use Illuminate\Support\Facades\DB;

if (! function_exists('refAno')) 
{
	function refAno($name,$id)
	{
        $proc = DB::table($name)->where('id_'.$name,'=',$id)->first();
        if(!$proc) return 'Não Há';
        return $proc['sjd_ref'].'/'.$proc['sjd_ref_ano'];	 
	}
}