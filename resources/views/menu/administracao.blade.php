<li class="treeview">
    <a href="#">
    <i class="fa fa-fw fa-gears "></i>
    <span>Administração</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
    </a>
    <ul class="treeview-menu">
        
        <li class="active">
            <a href="{{route('users.index')}}">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Usuários</span>
            </a>
        </li>
        {{--@hasrole('admin-coger')--}}
        <li class="">
            <a href="{{route('roles.index')}}">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Papéis</span>
            </a>
        </li>
        
        <li class="">
            <a href="{{route('permissions.index')}}">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Permissões</span>
            </a>
        </li>
        {{--@endhasrole --}}
        <li class="">
            <a href="{{route('terms.index')}}">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Termos de compromisso</span>
            </a>
        </li>
       
        <li class="">
            <a href="{{route('unidades.index')}}">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Unidades</span>
            </a>
        </li>
        
        <li class="">
            <a href="{{route('feriados.index')}}">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Feriados</span>
            </a>
        </li>
        
        <li class="">
            <a href="{{route('mail.sent')}}">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>E-mails agendados</span>
            </a>
        </li>
      
    </ul>
</li>
