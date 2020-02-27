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
    protected $repository;

    protected $mail;
    protected $block;
    protected $log;
    
    public function __construct(
        User $user,
        UserRepository $repository
    ) {
        $this->user = $user;
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

        $store = $this->user->findOrFail($id)->update(['termos' => $request->termos]);
        $this->repository->clearCache();
        toast()->success('Atualizado!', 'Termo!');
        return redirect()->route('user.newpass',$id);
    }

}
