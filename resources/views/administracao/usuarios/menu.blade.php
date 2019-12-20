<section class="content-header nopadding">
    <h1>{{ $title }}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">{{ $title }}</li>
    </ol>
    <br>
    <div class="row">
        <div class="btn-group col-md-8 col-xs-12 ">
            @if(hasPermissionTo('listar-papeis'))
                <a class="btn @if($page == 'papeis') btn-success @else btn-default @endif col-md-3 col-xs-3" href="{{route('apresentacao.index')}}">Listar Papéis</a>
            @endif
            @if(hasPermissionTo('listar-permissoes'))
                <a class="btn @if($page == 'permissoes') btn-success @else btn-default @endif col-md-3 col-xs-3" href="{{route('permission.index')}}">Listar Permissões</a>
            @endif
            @if(hasPermissionTo('listar-usuarios'))
                <a class="btn @if($page == 'usuarios') btn-success @else btn-default @endif col-md-3 col-xs-3" href="{{route('user.index')}}">Listar Papéis</a>
            @endif
            @if(hasRoleTo('admin'))
                <a class="btn @if($page == 'apagados') btn-success @else btn-default @endif col-md-3 col-xs-3" href="{{route('user.apagados')}}">Listar Usuários Apagados</a>
            @endif
        </div>
        @if(hasRoleTo('admin'))
        <div class="col-md-4 col-xs-12">
            <a class="btn btn-block btn-primary" href="{{route('user.create')}}">
                <i class="fa fa-plus"></i> Adicionar Usuário</a>
        </div>
        @endif
    <div>
</section>