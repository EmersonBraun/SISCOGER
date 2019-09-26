<?php

namespace App\Http\Controllers\Administracao\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use Spatie\Permission\Models\Role;
use App\Models\rhparana\Policial;

use App\Services\MailService;
use App\Services\LogService;
use App\Services\BlockUserService;

class UserController extends Controller
{
    protected $user;
    protected $role;
    protected $pm;

    protected $mail;
    protected $block;
    protected $log;
    
    public function __construct(
        User $user,
        Role $role,
        Policial $pm,
        MailService $mail,
        LogService $log,
        BlockUserService $block
    ) {
        $this->middleware('auth');
        $this->user = $user;
        $this->role = $role;
        $this->pm = $pm;
        $this->mail = $mail;
        $this->log = $log;
        $this->block = $block;
    }

    public function index()
    {
        $users =  $this->user->all();        
        return view('administracao.usuarios.index',compact('users'));
    }

    public function create()
    {
        $roles =$this->role->all();
        return view('administracao.usuarios.create', compact('roles'));
    }

    public function store(User $user, Request $request)
    {
        $this->validate($request, [
            'rg'=>'required|unique:users|min:6',
            'roles' =>'required'
        ]);
        
        $pm = $this->pm->where('rg',$request->rg)->first();
        
        if (!$pm) 
        {
            toast()->warning('esse RG não existe no Meta4!', 'ERRO!');
            return redirect()->route('user.index');
        }
        
        $create = $this->createUser($pm, $request);
        
        if($create) {
            $roles = $request['roles'];
            if ($roles) $this->assignRoles($roles, $user);
    
            toast()->success('adicionado com sucesso!', 'Usuário');
            return redirect()->route('user.index');
        }

    }

    public function createUser($pm, $request)
    {
        $user = [
            'rg' => $request->rg,
            'nome' => $pm['NOME'],
            'email' => $pm['EMAIL_META4'],
            'classe' => $pm['CLASSE'],
            'cargo' => $pm['CARGO'], //graduação
            'quadro' => $pm['QUADRO'],
            'subquadro' => $pm['SUBQUADRO'],
            'opm_descricao' => $pm['OPM_DESCRICAO'], //nome unidade
            'cdopm' => $pm['CDOPM'], //código da unidade
            'password' => bcrypt($request->rg)//atribuir senha provisória
        ];

        $create = $this->user->create($user);
        if($create) return true;
        return false;
    }

    public function assignRoles($roles, $user) 
    {
        foreach ($roles as $role) {
            $role_r = $this->role->where('id', '=', $role)->firstOrFail();  
            //Atribuindo papel ao usuário    
            $user->assignRole($role_r); 
        }
    }

    public function edit($id)
    {
        $user = $this->user->findOrFail($id);
        $roles = $this->role->get(); 

        return view('administracao.usuarios.edit', compact('user', 'roles')); 
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'rg'=>'required',
            'email'=>'required|email|unique:users,email,'.$id
        ]);
        
        $user = $this->user->findOrFail($id);
        $input = $request->only(['rg', 'email']); //Recupere os campos rg, email
        $update = $user->fill($input)->save();
        
        if($update) {
            if (isset($request['roles'])) $user->roles()->sync($request['roles']);  //If one or more role is selected associate user to roles                 
            else  $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
    
            toast()->success('atualizado com sucesso!', 'Usuário');
            return redirect()->route('user.index');
        }
    }

    public function destroy($id)
    {
        $destroy = $this->user->findOrFail($id)->delete();
        if($destroy) {
            toast()->success('apagado com sucesso!', 'Usuário');
            return redirect()->route('user.index');
        }
    }

    
    //bloquear usuário
    public function block($id)
    {
        $block = $this->block->block($id);
        if($block) 
        {
            toast()->success('bloqueado!', 'Usuário');
            return redirect()->back();
        }

        toast()->warning('Não pode ser bloqueado!', 'Usuário Administrador');
        return redirect()->back();
    }

    public function unblock($id)
    {
        $unblock = $this->block->unblock($id);

        if($unblock) {
            toast()->success('desbloqueado!', 'Usuário');
            return redirect()->back();
        }
    }

    public function sendMail($id,$resend=false)
    {
        $user = $this->user->findOrFail($id);
        $action = ($resend) ? 'resend' : 'send';
        $send = $this->mail->wellcome($user,$action);
        if($send !== 'ok') dd($send);

        if($resend) {
            toast()->success($user->email, 'Email reenviado');
            return redirect()->route('user.index');
        }
        return true;
    }

    public function manual()
    {
        return 'manual do usuario';
    }
}
