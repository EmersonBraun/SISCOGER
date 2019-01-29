<li class="treeview">
    <a href="#">
    <i class="fa fa-fw fa-search "></i>
    <span>Busca</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
    </a>
    <ul class="treeview-menu">
        {{--@hasrole('buscar-pm')--}}
        <li class="">
            <a href="{{route('busca.pm')}}">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>PM</span>
            </a>
        </li>
        {{--@endrole
        @hasrole('buscar-ofendido')--}}
        <li class="">
            <a href="{{route('busca.ofendido')}}">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Ofendido</span>
            </a>
        </li>
        {{--@endrole
        @hasrole('buscar-envolvido')--}}
        <li class="">
            <a href="{{route('busca.envolvido')}}">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>envolvido</span>
            </a>
        </li>
        {{--@endrole
        @hasrole('buscar-documentacao')--}}
        <li class="">
            <a href="{{route('busca.documentacao')}}">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Documentacão</span>
            </a>
        </li>
        {{--@endrole
        @hasrole('buscar-tramitacao-coger')--}}
        <li class="">
            <a href="{{route('busca.tramitacao')}}">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Tramitação COGER</span>
            </a>
        </li>
        {{--@endrole--}}
    </ul>
</li>