<?php

namespace App\Http\Controllers\FDI;

use App\Http\Controllers\Controller;
use App\Repositories\PM\PolicialRepository;
use GuzzleHttp\Client;

class FDIListController extends Controller
{
    protected $repository;

    public function __construct(PolicialRepository $repository)
	{
        $this->repository = $repository;
    }

    public function dadosGerais($rg) //informações gerais
    {
        $data = $this->repository->get($rg);
        return response()->json($data); 
    }
    
    public function dadosAdicionais($rg) //Informações adicionais
    {
        $data = $this->repository->adicionais($rg);
        return response()->json($data);
    }
    
    public function comportamento($rg) //comportamento
    {
        $pm = $this->repository->get($rg);
        $data = $this->repository->comportamentoAtual($pm);
        return response()->json($data);
    }
    
    public function preso($rg) //verificar se está preso
    {
        $data = $this->repository->preso($rg);
        return response()->json($data);
    }
    
    public function suspenso($rg) //Verifica se esta suspenso.
    {
        $data = $this->repository->suspenso($rg);
        return response()->json($data);
    }

    public function excluido($rg) //Verifica se esta excluido. 
    {
        $data = $this->repository->excluido($rg);
        return response()->json($data);
    }

    public function subJudice($rg) //SUB JUDICE
    {
        $data = $this->repository->subjudice($rg);
        return response()->json($data);
    }

    public function denunciaCivil($rg) //Consulta das denuncias civis
    {
        $data = $this->repository->denunciaCivil($rg);
        return response()->json($data);
    }
    
    public function prisoes($rg) //prisões
    {
        $data = $this->repository->prisoes($rg);
        return response()->json($data);
    }

    public function restricoes($rg) 
    {
        $data = $this->repository->restricoes($rg);
        return response()->json($data);
    }

    public function afastamentos($rg) 
    {
        $data = $this->repository->afastamentos($rg);
        return response()->json($data);
    }

    public function dependentes($rg) 
    {
        $data = $this->repository->dependentes($rg);
        return response()->json($data);
    }

    public function sai($rg) 
    {
        $data = $this->repository->sai($rg);
        return response()->json($data);
    }
    public function objetos($rg) 
    {
        $data = $this->repository->objetos($rg);
        return response()->json($data);
    }

    public function membros($rg) 
    {
        $data = $this->repository->membros($rg);
        return response()->json($data);
    }

    public function comportamentos($rg) 
    {
        $data = $this->repository->comportamentos($rg);
        return response()->json($data);
    }

    public function elogios($rg) 
    {
        $data = $this->repository->elogios($rg);
        return response()->json($data);
    }

    public function punicoes($rg) 
    {
        $data = $this->repository->punicoes($rg);
        return response()->json($data);
    }

    public function tramitacao($rg) 
    {
        $data = $this->repository->tramitacao($rg);
        return response()->json($data);
    }

    public function tramitacaoopm($rg) 
    {
        $data = $this->repository->tramitacaoopm($rg);
        return response()->json($data);
    }

    public function apresentacoes($rg) 
    {
        $data = $this->repository->apresentacoes($rg);
        return response()->json($data);
    }

    public function procOutros($rg) 
    {
        $data = $this->repository->proc_outros($rg);
        return response()->json($data);
    }

    public function log($rg) 
    {
        $data = $this->repository->log($rg);
        return response()->json($data);
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
            ], $response['status_code']);
        } 

        return response()->json([
            $response['lista']
        ], 200);
    }
    
}

