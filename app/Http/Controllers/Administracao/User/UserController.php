<?php

namespace App\Http\Controllers\Administracao\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use Spatie\Permission\Models\Role;
use App\Repositories\PM\PolicialRepository;
use App\Services\MailService;
use App\Services\LogService;
use App\Services\BlockUserService;

class UserController extends Controller
{
    protected $user;
    protected $role;
    protected $pm;
    protected $rg;

    protected $mail;
    protected $block;
    protected $log;
    
    public function __construct(
        User $user,
        Role $role,
        PolicialRepository $pm,
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

    public function apagados()
    {
        $users =  $this->user->onlyTrashed();        
        return view('administracao.usuarios.apagados',compact('users'));
    }

    public function create()
    {
        $roles = $this->role->all();
        return view('administracao.usuarios.create', compact('roles'));
    }

    public function store(User $user, Request $request)
    {
        $this->validate($request, [
            'rg'=>'required|unique:users|min:6',
            'nome'=>'required',
            'roles' =>'required'
        ]);

        $this->rg = $request->rg;
        
        $pm = $this->pm->get($this->rg);
        $data = $this->validateDate($pm);
        if($data['msg']){
            $msg = $data['msg'];
            toast()->warning($msg, 'Meta4 faltando dados!');
            return redirect()->route('user.index');
        }
        $user = $data['pm'];
        $create = $this->user->create($user);
        
        if($create) {
            $roles = $request['roles'];
            if ($roles) $this->assignRoles($roles, $create->id);
    
            toast()->success('adicionado com sucesso!', 'Usuário');
            return redirect()->route('user.index');
        }

        toast()->warning('Não adicionado!', 'ERRO!');
        return redirect()->route('user.index');

    }

    public function validateDate($pm) 
    {
        $validated = ['msg' => [], 'data' => []];
        if(!$pm){
            array_push($validated['msg'],'esse RG não existe no Meta4!');
            return $validated;
        }
        $nome = isset($pm['NOME']) ? $pm['NOME']: $pm['nome'];
        if(!$nome) array_push($validated['msg'],'NOME');
        $email = isset($pm['EMAIL_META4']) ? $pm['EMAIL_META4']: $pm['email_meta4'];
        if(!$email) array_push($validated['msg'],'EMAIL');
        $classe = isset($pm['CLASSE']) ? $pm['CLASSE']: $pm['classe'];
        if(!$classe) $classe = 'PM';
        $cargo = isset($pm['CARGO']) ? $pm['CARGO']: $pm['cargo']; //graduação
        if(!$cargo) array_push($validated['msg'],'CARGO');
        $quadro = isset($pm['QUADRO']) ? $pm['QUADRO']: $pm['quadro'];
        if(!$quadro) $quadro = '';
        $subquadro = isset($pm['SUBQUADRO']) ? $pm['SUBQUADRO']: $pm['subquadro'];
        if(!$subquadro) $subquadro = '';
        $opm_descricao = isset($pm['OPM_DESCRICAO']) ? $pm['OPM_DESCRICAO']: $pm['opm_descricao']; //nome unidade
        if(!$opm_descricao) $opm_descricao = '';
        $cdopm = isset($pm['CDOPM']) ? $pm['CDOPM']: $pm['cdopm']; //código da unidade
        if(!$cdopm) array_push($validated['msg'],'CDOPM');

        if($validated['msg']){
            $validated['msg'] = implode(',',$validated['msg']);
            return $validated;
        } else {
            $validated['pm'] = [
                'rg' => $this->rg,
                'nome' => $nome,
                'email' => $email,
                'classe' => $classe,
                'cargo' => $cargo, //graduação
                'quadro' => $quadro,
                'subquadro' => $subquadro,
                'opm_descricao' => $opm_descricao, //nome unidade
                'cdopm' => $cdopm, //código da unidade
                'password' => bcrypt($this->rg)//atribuir senha provisória
            ];
            return $validated;
        }
    }

    public function assignRoles($roles, $id) 
    {
        $user = $this->user->findOrFail($id);
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

        toast()->warning('Não Atualizado!', 'ERRO!');
        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        $destroy = $this->user->findOrFail($id)->delete();
        if($destroy) {
            toast()->success('apagado com sucesso!', 'Usuário');
            return redirect()->route('user.index');
        }

        toast()->warning('Não Apagado!', 'ERRO!');
        return redirect()->route('user.index');
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

        toast()->warning('Não desbloqueado!', 'ERRO!');
        return redirect()->route('user.index');
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
        return view('administracao.usuarios.manual');
    }
}
