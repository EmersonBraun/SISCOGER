<?php
 
namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\administracao\PermissionRepository;
use App\Repositories\administracao\RoleRepository;

class RoleController extends Controller
{
    protected $permission;
    protected $role;
    public function __construct(
        PermissionRepository $permission,
        RoleRepository $role
    )
    {
        $this->middleware('auth');
        $this->permission = $permission;
        $this->role = $role;
    }

     public function index()
    {
        $roles = $this->role->all();
        return view('administracao.papeis.index',compact('roles'));
    }
 
    public function create()
    {
        $permissions = $this->permission->treeview();//Pegar todas as permissões em árvore
        
        return view('administracao.papeis.create', compact('permissions'));
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|unique:roles|max:10']
        );
        $dados = $request->except(['permissions']);
        $create = $this->role->create($dados);

        if($create) {
            $this->role->clearCache();
            if($request['permissions']) $this->savePermissions($request['permissions'],$request->name);

            toast()->success(''. $request->name.' adicionadas!', 'Papéis');
            return redirect()->route('role.index');
        }

        toast()->warning('Erro ao adicionar', 'Papéis');
        return redirect()->route('role.index');
    }


    public function edit( $id)
    {
        $role = $this->role->findOrFail($id);
        $permissions = $this->permission->treeview();//Pegar todas as permissões em árvore
        // dd($permissions);
        return view('administracao.papeis.edit', compact('role', 'permissions'));
    }
 
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'=>'required|max:50|unique:roles,name,'.$id,
        ]);

        $role = $this->role->findOrFail($id);//Obter papel com o ID fornecido
        $input = $request->except(['permissions']);

        $update = $role->fill($input)->save();
        
        if($update) {
            $this->role->clearCache();

            $this->revokePermission($role);
            if($request['permissions']) $this->savePermissions($request['permissions'], $role->name);
            toast()->success(''. $role->name.' atualizadas!', 'Papéis');
            return redirect()->route('role.index');
        }

        toast()->warning('Problema em atualizar!', 'Papéis');
        return redirect()->route('role.index');
    }

    public function destroy($id)
    {
        $destroy = $this->role->findAndDelete($id);

        if($destroy) {
            $this->role->clearCache();
            toast()->success('apagados!', 'Papéis');
            return redirect()->route('role.index');
        }

        toast()->warning('Problema em apagar!', 'Papéis');
        return redirect()->route('role.index');
    }

    public function savePermissions($permissions, $name) {
        foreach ($permissions as $permission) {
            $p = $this->pemission->firstOrFail($permission); 

            $role = $this->role->where('name', $name)->first(); 
            $role->givePermissionTo($p);
        }
    }

    public function revokePermission($role) {
        $p_all = $this->pemission->all();//Pega todas as permissões

        foreach ($p_all as $p) {
            $role->revokePermissionTo($p); //Remover todas as permissões associadas à função
        }
    }
}