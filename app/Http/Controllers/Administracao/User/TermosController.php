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
use App\Repositories\administracao\UserRepository;

class TermosController extends Controller
{
    protected $user;
    protected $role;
    protected $pm;
    protected $repository;

    protected $mail;
    protected $block;
    protected $log;
    
    public function __construct(
        User $user,
        Role $role,
        Policial $pm,
        MailService $mail,
        LogService $log,
        BlockUserService $block,
        UserRepository $repository
    ) {
        $this->user = $user;
        $this->role = $role;
        $this->pm = $pm;
        $this->mail = $mail;
        $this->log = $log;
        $this->block = $block;
        $this->repository = $repository;
    }

    public function termocriar($id)
    {
        $user = $this->user->findOrFail($id);
        return view('administracao.termo_compromisso.create', compact('user','id'));
    }

    public function termosalvar($id, Request $request)
    {
        //Validação
        $this->validate($request, [
            'termos' =>'required'
        ]);

        $user = $this->user->findOrFail($id);
        $user->termos = $request->termos;
        $temosalvo = $user->save();
        if($temosalvo) {
            $this->repository->clearCache();
            toast()->success('Atualizado!', 'Termo!');
            return view('administracao.usuarios.reset', compact('user'));
        }
    }

}
