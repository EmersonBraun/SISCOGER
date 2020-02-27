<?php

namespace App\Http\Controllers\Administracao\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;

use App\User;
use Spatie\Permission\Models\Role;
use App\Models\rhparana\Policial;

use App\Services\MailService;
use App\Services\LogService;
use App\Services\BlockUserService;

class PasswordController extends Controller
{
    protected $user;
    
    public function __construct(
        User $user
    ) {
        $this->user = $user;
    }

    
    public function newpass($id) //formulário para atualizar senha
    {
        $user = $this->user->findOrFail($id);
        return view('administracao.usuarios.reset', compact('user'));
    }

    public function passedit($id) //formulário para atualizar senha
    {
        $user = $this->user->findOrFail($id);
        return view('administracao.usuarios.pass', compact('user'));  
    }
    //atualizar a senha
    public function passupdate($id, Request $request)
    { 
        $this->validate($request, [
            'password'=>'required|min:6|confirmed'
        ]);
        
        $data = ['password'=> bcrypt($request->input('password'))];
        $user = $this->user->findOrFail($id);
        $update = $user->update($data); 

        if($update) {
            toast()->success('atualizado com sucesso!', 'Usuário');
            return redirect('home');
        }

        toast()->warning('Não Atualizado!', 'ERRO!');
        return redirect('home');
       
    }

    public function reset($id) //formulário para atualizar senha
    {
        $user = $this->user->findOrFail($id);
        $dados = [
            'block' => 0,
            'termos' => 0,
            'password' => bcrypt($user->rg)
        ];

        $update = $user->update($dados);

        if ($update) return 'ok';  


    }
    
}
