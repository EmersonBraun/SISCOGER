<?php
 
namespace App\Http\Controllers\Administracao;
use App\Http\Controllers\Controller;
use Auth;

//Importa laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Repositories\administracao\PermissionRepository;
use App\Repositories\administracao\RoleRepository;

use Session;

use Illuminate\Http\Request;
 
class PermissionController extends Controller
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
       
        $permissions = $this->permission->all();
        return view('administracao.permissoes.index',compact('permissions'));
    }

    public function treeview()
    {
        $permissions = $this->permission->treeview();
        return view('administracao.permissoes.treeview',compact('permissions'));
    }
 
    public function create()
    {
        $roles = $this->role->all(); //pega todos os papeis
        return view('administracao.permissoes.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);
        
        $name = $request['name'];
        $roles = $request['roles'];

        $create = $this->permission->create([$name]);
        
        if($create) {
            $this->permission->cleanCache();

            if (!empty($roles)) { //Se uma ou mais funções forem selecionadas
                $this->givePermission($roles, $name);
                $this->permission->cleanCache();
            }

            toast()->success(''.$name.' adicionadas!', 'Permissões');
            return redirect()->route('permission.index');
        }

        toast()->warning('Erro ao adicionar!', 'Permissões');
        return redirect()->route('permission.index');
    }
 
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('administracao.permissoes.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'=>'required',
        ]);
            
        $permission = $this->permission->findOrFail($id);
        $input = $request->all();
        $update = $permission->fill($input)->save();

        if($update) {
            $this->permission->cleanCache();
            toast()->success(''. $permission->name.' atualizada!', 'Permissões');
            return redirect()->route('permission.index');
        }

        toast()->warning('Erro ao atualizar!', 'Permissões');
        return redirect()->route('permission.index');
    }
 
    public function destroy($id)
    {
        $destroy = $this->permission->findAndDelete($id);
        
        if($destroy) {
            toast()->success('apagadas com sucesso!', 'Permissões');
            return redirect()->route('permission.index');
        }

        toast()->warning('Erro ao apagar!', 'Permissões');
        return redirect()->route('permission.index');
    }

    public function givePermission($roles, $name) 
    {
        foreach ($roles as $role) {
            $r = $this->role->firstOrFail($role); //Corresponder função de entrada ao registro db

            $permission = $this->permission->getByName($name); //Combinar entrada //permissão para registro de db
            $r->givePermissionTo($permission);
        }
    }
}