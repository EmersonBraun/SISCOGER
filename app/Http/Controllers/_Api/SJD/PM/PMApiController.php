<?php

namespace App\Http\Controllers\_Api\SJD\PM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Ixudra\Curl\Facades\Curl;

class PMApiController extends Controller
{
    public function dados($rg)
    {
        $pm = DB::connection('rhparana')
        ->table('policial')
        ->where('rg','=', $rg)
        ->first();

        if(!$pm) 
        {
            return response()->json([
                'success' => false,
            ], 200);
        } 

        return response()->json([
            'pm' => $pm,
            'posto' => sistema('posto',$pm['CARGO']),
            'success' => true,
        ], 200);

    }

    public function cautelas($rg)
    {
        // $url = 'http://10.147.242.21/api/patrimonios/?action=1&token=ce31be1f4dbb005e0700309890b423f826dcd324&uid='.$rg;
        $url = 'http://10.147.242.21/api/patrimonios/';
        $action = '1';
        $token = 'ce31be1f4dbb005e0700309890b423f826dcd324';

        $urlComplete = $url.'?action='.$action.'&token='.$token.'&uid='.$rg;
    
        $client = new Client();
        $res = $client->request('GET', $urlComplete);
        // echo $res->getStatusCode();// "200"
        // echo $res->getHeader('content-type')[0];// 'application/json; charset=utf8'
        // echo $res->getBody();
        $result = $res->getBody()->getContents();
        // a resposta veio em string transformar em array
        $response = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $result), true );
  
        if($response['status_code'] !== 200) 
        {
            return response()->json([
                'success' => false,
            ], 200);
        } 

        return response()->json([
            $response['lista']
        ], 200);
    }
        

}
