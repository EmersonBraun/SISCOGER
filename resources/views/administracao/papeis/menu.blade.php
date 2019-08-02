<section class="content-header">
    <h1><i class="fa fa-key"></i> Gerenciamento de papéis</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Gerenciamento de papéis</li>
    </ol>
    <br>
    <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
        @if(hasPermissionTo('listar-usuarios'))   
        <div class='btn-group col-md-4 col-xs-12 '>
            <a href="{{ route('user.index') }}" class="btn btn-default btn-block">Usuários</a>
        </div>
        @endif
        @if(hasPermissionTo('listar-permissoes')) 
        <div class='btn-group col-md-4 col-xs-12 '>
            <a href="{{ route('permission.index') }}" class="btn btn-default btn-block">Permissões</a>
        </div>
        @endif
        @if(hasPermissionTo('criar-papeis'))            
        <div class='btn-group col-md-4 col-xs-12 '>
            <a href="{{ route('role.create') }}" class="btn btn-success btn-block">
                <i class="fa fa-plus "></i> Adicionar papeis</a>
        </div>
        @endif
    <div>
</section>