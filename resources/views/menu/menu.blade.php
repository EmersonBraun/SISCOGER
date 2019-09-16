
<li ><div class="row " style="background-color: white"></div></li>
@if(hasAnyPermission([
    'listar-adl',
    'listar-cd',
    'listar-cj',
    'listar-fatd',
    'listar-pad',
    'listar-apfd',
    'listar-desercao',
    'listar-exclusao',
    'listar-ipm',
    'listar-iso',
    'listar-it',
    'listar-proc-outros',
    'listar-recurso',
    'listar-exclusao'
]))
<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-balance-scale "></i><span>Processos e Procedimentos</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
    @if(hasAnyPermission([
        'listar-adl',
        'listar-cd',
        'listar-cj',
        'listar-fatd',
        'listar-pad'
    ]))
    <li class="treeview">
        <a href="#"><i class="fa fa-fw fa-file-text-o "></i><span>Processos</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu"> 
            @if(hasPermissionTo('listar-adl'))  
            <li class=""><a href="{{ route('adl.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>ADL</span></a></li>
            @endif    
            @if(hasPermissionTo('listar-cd'))  
            <li class=""><a href="{{ route('cd.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>CD</span></a></li>
            @endif  
            @if(hasPermissionTo('listar-cj'))  
            <li class=""><a href="{{ route('cj.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>CJ</span></a></li>
            @endif  
            @if(hasPermissionTo('listar-fatd'))  
            <li class=""><a href="{{ route('fatd.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>FATD</span></a></li>
            @endif  
            @if(hasPermissionTo('listar-pad'))  
            <li class=""><a href="{{ route('pad.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>PAD</span></a></li>
            @endif  
        </ul>
    </li>
    @endif
    @if(hasAnyPermission([
        'listar-apfd',
        'listar-desercao',
        'listar-exclusao',
        'listar-ipm',
        'listar-iso',
        'listar-it',
        'listar-proc-outros',
        'listar-recursos',
        'listar-sindicancia'
    ]))
    <li class="treeview">
        <a href="#">
            <i class="fa fa-fw fa-file-text "></i><span>Procedimentos</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
            @if(hasPermissionTo('listar-apfd'))  
            <li class=""><a href="{{ route('apfd.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>APFD</span></a></li>
            @endif  
            @if(hasPermissionTo('listar-desercao'))  
            <li class=""><a href="{{ route('desercao.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Deserção</span></a></li>
            @endif  
            @if(hasPermissionTo('listar-exclusao'))  
            <li class=""><a href="{{ route('exclusao.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Exclusão</span></a></li>
            @endif  
            @if(hasPermissionTo('listar-ipm'))  
            <li class=""><a href="{{ route('ipm.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>IPM</span></a></li>
            @endif  
            @if(hasPermissionTo('listar-iso'))  
            <li class=""><a href="{{ route('iso.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>ISO</span></a></li>
            @endif  
            @if(hasPermissionTo('listar-it'))  
            <li class=""><a href="{{ route('it.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>IT</span></a></li>
            @endif  
            @if(hasPermissionTo('listar-proc-outros'))  
            <li class=""><a href="{{ route('procoutro.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Proced. Outros</span></a></li>
            @endif   
            @if(hasPermissionTo('listar-recursos'))
            <li class=""><a href="{{ route('recurso.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Recursos</span></a></li>
            @endif  
            @if(hasPermissionTo('listar-sindicancia'))
            <li class=""><a href="{{ route('sindicancia.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Sindicância</span></a></li>
            @endif
        </ul>
    </li> 
    @endif 
    </ul>
</li>
@endif 

@if(hasAnyPermission([
        'listar-nota-coger',
        'listar-apresentacoes',
        'listar-locais',
        'criar-apresentacao',
        'listar-dados-unidade'
    ]))
<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-legal "></i><span>Apresentação em Juízo</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        {{-- <li class=""><a href="{{ route('mail.sent')}}"><i class="fa fa-fw fa-circle-o "></i><span>Emails Agendados</span></a></li> --}}
        @if(hasPermissionTo('listar-nota-coger'))
        <li class=""><a href="{{ route('notacoger.index',date('Y'))}}"><i class="fa fa-fw fa-circle-o "></i><span>Notas COGER</span></a></li>
        @endif
        @if(hasPermissionTo('listar-apresentacao'))
        <li class=""><a href="{{ route('apresentacao.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Lista apresentações</span></a></li>
        @endif
        @if(hasPermissionTo('listar-apresentacao'))
        <li class=""><a href="{{ route('apresentacao.buscar')}}"><i class="fa fa-fw fa-circle-o "></i><span>Buscar Apresentação</span></a></li>
        @endif
        @if(hasPermissionTo('listar-locais'))
        <li class=""><a href="{{ route('local.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Locais</span></a></li>
        @endif
        @if(hasPermissionTo('criar-apresentacao'))
        <li class=""><a href="{{ route('excel.create')}}"><i class="fa fa-fw fa-circle-o "></i><span>inserir via Excel</span></a></li>
        @endif
        @if(hasPermissionTo('criar-apresentacao'))
        <li class=""><a href="{{ route('memorando.create')}}"><i class="fa fa-fw fa-circle-o "></i><span>Gerar Memorando</span></a></li>
        @endif
        @if(hasPermissionTo('listar-dados-unidade'))
        <li class=""><a href="{{ route('unidade.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Dados Unidade</span></a></li>
        @endif
    </ul>
</li>
@endif

<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-line-chart "></i><span>Relatórios</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        <li class=""><a href="{{ route('home')}}"><i class="fa fa-fw fa-circle-o "></i><span>Pendências</span></a></li>       
        @if(hasPermissionTo('listar-relatorio-geral'))
        <li class=""><a href="{{ route('pendencia.gerais')}}"><i class="fa fa-fw fa-circle-o "></i><span>Pendências - Geral</span></a></li>  
        @endif
        @if(hasPermissionTo('listar-prioritarios'))
        <li class=""><a href="{{ route('relatorio.prioritarios','adl')}}"><i class="fa fa-fw fa-circle-o "></i><span>Processos Prioritários</span></a></li>
        @endif
        @if(hasPermissionTo('listar-relatorio-sobrestamentos'))
        <li class=""><a href="{{ route('relatorio.sobrestamento','adl')}}"><i class="fa fa-fw fa-circle-o "></i><span>Sobrestamentos</span></a></li>
        @endif
        @if(hasPermissionTo('listar-relatorio-processos'))
        <li class=""><a href="{{ route('processo.search')}}"><i class="fa fa-fw fa-circle-o "></i><span>Processos</span></a></li>
        @endif
        @if(hasPermissionTo('listar-relatorio-postograd'))
        <li class=""><a href="{{ route('postograd.search')}}"><i class="fa fa-fw fa-circle-o "></i><span>Postos/Graduações</span></a></li>
        @endif
        @if(hasPermissionTo('listar-relatorio-encarregados'))
        <li class=""><a href="{{ route('relatorio.encarregado.search')}}"><i class="fa fa-fw fa-circle-o "></i><span>Encarregados</span></a></li>
        @endif
        @if(hasPermissionTo('listar-relatorio-defensores'))
        <li class=""><a href="{{ route('relatorio.defensor')}}"><i class="fa fa-fw fa-circle-o "></i><span>Defensores</span></a></li>
        @endif
        @if(hasPermissionTo('listar-relatorio-ofendidos'))
        <li class=""><a href="{{ route('relatorio.ofendido.search')}}"><i class="fa fa-fw fa-circle-o "></i><span>Ofendidos</span></a></li>
        @endif
        <li class=""><a href="{{ route('relatorio.protocolo')}}"><i class="fa fa-fw fa-circle-o "></i><span>E-Protocolo</span></a></li>
    </ul>
</li>


@if(hasAnyPermission([
        'listar-correicao-ordinaria',
        'listar-correicao-extraordinaria'
    ]))
<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-folder "></i><span>Correições</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        @if(hasPermissionTo('listar-correicao-ordinaria'))
        <li class=""><a href="{{ route('correicao.ordinaria.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Ordinária</span></a></li>
        @endif
        @if(hasPermissionTo('listar-correicao-extraordinaria'))
        <li class=""><a href="{{ route('correicao.extraordinaria.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Extraordinária</span></a></li>
        @endif
    </ul>
</li>
@endif

@if(hasAnyPermission([
        'busca-pm',
        'buscar-ofendido',
        'buscar-envolvido',
        'buscar-documentacao',
        'buscar-tramitacao-coger'
    ]))
<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-search "></i><span>Busca</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        @if(hasPermissionTo('buscar-pm'))
        <li class=""><a href="{{ route('busca.pm')}}"><i class="fa fa-fw fa-circle-o "></i><span>PM</span></a></li>
        @endif
        @if(hasPermissionTo('buscar-pm'))
        <li class=""><a href="{{ route('busca.pm')}}"><i class="fa fa-fw fa-circle-o "></i><span>Nominal</span></a></li>
        @endif
        @if(hasPermissionTo('buscar-ofendido'))
        <li class=""><a href="{{ route('busca.ofendido.search')}}"><i class="fa fa-fw fa-circle-o "></i><span>Ofendido</span></a></li>
        @endif
        @if(hasPermissionTo('buscar-envolvido'))
        <li class=""><a href="{{ route('busca.envolvido.search')}}"><i class="fa fa-fw fa-circle-o "></i><span>envolvido</span></a></li>
        @endif
        @if(hasPermissionTo('buscar-documentacao'))
        <li class=""><a href="{{ route('busca.documentacao')}}"><i class="fa fa-fw fa-circle-o "></i><span>Documentacão</span></a></li>
        @endif
        @if(hasPermissionTo('listar-tramitacao'))
        <li class=""><a href="{{ route('busca.tramitacao',date('Y'))}}"><i class="fa fa-fw fa-circle-o "></i><span>Tramitação</span></a></li>
        @endif
        @if(hasPermissionTo('listar-tramitacao-coger'))
        <li class=""><a href="{{ route('busca.tramitacaocoger',date('Y'))}}"><i class="fa fa-fw fa-circle-o "></i><span>Tramitação COGER</span></a></li>
        @endif
    </ul>
</li>
@endif

@if(hasAnyPermission([
        'buscar-pm',
        'listar-medalhas',
        'listar-elogios',
        'listar-excluidos',
        'listar-punidos',
        'listar-reintegrados',
        'listar-denunciados',
        'listar-presos',
        'listar-procedimentos',
        'listar-comportamentos',
        'listar-respondendo',
        'listar-restricoes',
        'listar-suspensos',
        'listar-obitos-lesoes',
        'listar-mortos-feridos'
    ]))
<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-cab "></i><span>Policiais</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        @if(hasPermissionTo('buscar-pm'))
        <li class=""><a href="{{ route('busca.pm')}}"><i class="fa fa-fw fa-circle-o "></i><span>Ficha de Tramitação</span></a></li>
        @endif
        @if(hasPermissionTo('listar-medalhas'))
        <li class=""><a href="{{ route('medalha.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Medalhas</span></a></li>
        @endif
        @if(hasPermissionTo('listar-elogios'))
        <li class=""><a href="{{ route('elogio.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Elogios</span></a></li>
        @endif
        @if(hasPermissionTo('listar-exclusao'))
        <li class=""><a href="{{ route('excluido.conselho')}}"><i class="fa fa-fw fa-circle-o "></i><span>Excluídos</span></a></li>
        @endif
        @if(hasPermissionTo('listar-punidos'))
        <li class=""><a href="{{ route('punido.index','cd')}}"><i class="fa fa-fw fa-circle-o "></i><span>Punidos</span></a></li>
        @endif
        @if(hasPermissionTo('listar-reintegrados'))
        <li class=""><a href="{{ route('reintegrado.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Reintegrados</span></a></li>
        @endif
        @if(hasPermissionTo('listar-denunciados'))
        <li class=""><a href="{{ route('denunciado.denunciados')}}"><i class="fa fa-fw fa-circle-o "></i><span>Denunciados</span></a></li>
        @endif
        @if(hasPermissionTo('listar-presos'))
        <li class=""><a href="{{ route('preso.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Presos PM/BM</span></a></li>
        @endif
        @if(hasPermissionTo('listar-presos-outros'))
        <li class=""><a href="{{ route('presooutro.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Presos Outros</span></a></li>
        @endif
        @if(hasPermissionTo('listar-procedimentos'))
        <li class=""><a href="{{ route('procedimento.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Procedimentos</span></a></li>
        @endif
        @if(hasPermissionTo('listar-comportamentos'))
        <li class=""><a href="{{ route('comportamento.index','SD2C')}}"><i class="fa fa-fw fa-circle-o "></i><span>Comportamento</span></a></li>
        @endif
        @if(hasPermissionTo('listar-respondendo'))
        <li class=""><a href="{{ route('respondendo.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Respondendo</span></a></li>
        @endif
        @if(hasPermissionTo('listar-restricoes'))
        <li class=""><a href="{{ route('restricao.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Restrições</span></a></li>
        @endif
        @if(hasPermissionTo('listar-suspensos'))
        <li class=""><a href="{{ route('suspenso.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Suspensos</span></a></li>
        @endif
        @if(hasPermissionTo('listar-obitos-lesoes'))
        <li class=""><a href="{{ route('obitolesao.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Obitos e Lesões</span></a></li>
        @endif
        {{-- @if(hasPermissionTo('listar-mortos-feridos'))
        <li class=""><a href="{{ route('mortoferido.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Mortos e feridos</span></a></li>
        @endif --}}
    </ul>
</li>
@endif

@if(hasPermissionTo('listar-sai'))
<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-cab "></i><span>SAI</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        <li class=""><a href="{{ route('sai.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Policiais - Investigação</span></a></li>
    </ul>
</li>
@endif

@if(hasPermissionTo('bi'))
<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-chart-bar"></i><span>BI</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        <li class=""><a href="#"><i class="fa fa-fw fa-circle-o "></i><span>Gráfico...</span></a></li>
    </ul>
</li>
@endif

<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-question-circle "></i><span>Ajuda</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        <li class=""><a href="{{ route('user.manual')}}"><i class="fa fa-fw fa-circle-o "></i><span>Manual do usuário</span></a></li>
        <li class=""><a href="{{ route('user.pass',Auth::id())}}"><i class="fa fa-fw fa-circle-o "></i><span>Modificar senha</span></a></li>
        <li class=""><a href="{{ route('it.documentacao')}}"><i class="fa fa-fw fa-circle-o "></i><span>Documentação para IT</span></a></li>
    </ul>
</li>

@if(hasAnyPermission([
        'listar-usuarios',
        'listar-papeis',
        'listar-permissoes',
        'listar-sjds',
        'listar-termos',
        'listar-dados-unidade',
        'listar-feriados'
    ]))
<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-gears "></i><span>Administração</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        @if(hasPermissionTo('listar-usuarios'))
        <li class="active"><a href="{{ route('user.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Usuários</span></a></li>
        @endif
        @if(hasPermissionTo('listar-papeis'))
        <li class=""><a href="{{ route('role.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Papéis</span></a></li>
        @endif
        @if(hasPermissionTo('listar-permissoes'))
        <li class=""><a href="{{ route('permission.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Permissões</span></a></li>
        @endif
        @if(hasPermissionTo('listar-sjds'))
        <li class=""><a href="{{ route('sjd.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Controle SJD</span></a></li>
        @endif
        @if(hasPermissionTo('listar-termos'))
        <li class=""><a href="{{ route('term.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Termos de compromisso</span></a></li>
        @endif
        @if(hasPermissionTo('listar-dados-unidade'))
        <li class=""><a href="{{ route('unidade.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Unidades</span></a></li>
        @endif
        @if(hasPermissionTo('listar-feriados'))
        <li class=""><a href="{{ route('feriado.index')}}"><i class="fa fa-fw fa-circle-o "></i><span>Feriados</span></a></li>
        @endif
        {{-- <li class=""><a href="{{ route('mail.sent')}}"><i class="fa fa-fw fa-circle-o "></i><span>E-mails agendados</span></a></li> --}}
    </ul>
</li>
@endif

@if(hasPermissionTo('listar-historias'))
<li class="">
    <a href="{{ route('historia.ver')}}">
        <i class="fa fa-quote-left "></i><span>História SISCOGER</span>
        <span class="pull-right-container"></span>
    </a>
</li>
@endif

@if(hasPermissionTo('listar-pendencia-outras-unidades'))
<li class="treeview">
    <a href="#"><i class="fa fa fa-refresh "></i>
        <span>Ver outra OPM</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        <li class=""><a href="{{ route('pendencia.trocaropm')}}"><i class="fa fa-fw fa-circle-o "></i><span>Dashboard</span></a></li>
        @if(hasPermissionTo('listar-pendencia-outras-unidades'))
        <li class=""><a href="{{ route('pendencia.gerais')}}"><i class="fa fa-fw fa-circle-o "></i><span>Pendências Gerais</span></a></li>
        @endif
    </ul>
</li>
@endif

@if(hasPermissionTo('listar-logs'))
<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-bug "></i><span>LOGS</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        <li class="treeview"><a href="#"><i class="fa fa-fw fa-bug "></i><span>Processos/Procedimentos</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
            <ul class="treeview-menu">
                <li class=""><a href="{{ route('log.created','adl')}}"><i class="fa fa-fw fa-circle-o "></i><span>ADL</span></a></li>
                <li class=""><a href="{{ route('log.created','apfd')}}"><i class="fa fa-fw fa-circle-o "></i><span>APFD</span></a></li>
                <li class=""><a href="{{ route('log.created','cd')}}"><i class="fa fa-fw fa-circle-o "></i><span>CD</span></a></li>
                <li class=""><a href="{{ route('log.created','cj')}}"><i class="fa fa-fw fa-circle-o "></i><span>CJ</span></a></li>
                <li class=""><a href="{{ route('log.created','desercao')}}"><i class="fa fa-fw fa-circle-o "></i><span>Deserção</span></a></li>
                <li class=""><a href="{{ route('log.created','exclusao')}}"><i class="fa fa-fw fa-circle-o "></i><span>Exclusão</span></a></li>
                <li class=""><a href="{{ route('log.created','fatd')}}"><i class="fa fa-fw fa-circle-o "></i><span>FATD</span></a></li>
                <li class=""><a href="{{ route('log.created','ipm')}}"><i class="fa fa-fw fa-circle-o "></i><span>IPM</span></a></li>
                <li class=""><a href="{{ route('log.created','iso')}}"><i class="fa fa-fw fa-circle-o "></i><span>ISO</span></a></li>
                <li class=""><a href="{{ route('log.created','it')}}"><i class="fa fa-fw fa-circle-o "></i><span>IT</span></a></li>
                <li class=""><a href="{{ route('log.created','movimento')}}"><i class="fa fa-fw fa-circle-o "></i><span>Movimento</span></a></li>
                <li class=""><a href="{{ route('log.created','pad')}}"><i class="fa fa-fw fa-circle-o "></i><span>PAD</span></a></li>
                <li class=""><a href="{{ route('log.created','procoutros')}}"><i class="fa fa-fw fa-circle-o "></i><span>Proc. Outros</span></a></li>                            
                <li class=""><a href="{{ route('log.created','sindicancia')}}"><i class="fa fa-fw fa-circle-o "></i><span>Sindicância</span></a></li>
                <li class=""><a href="{{ route('log.created','recurso')}}"><i class="fa fa-fw fa-circle-o "></i><span>Recurso</span></a></li>
            </ul>
        </li>
        <li class="treeview"><a href="#"><i class="fa fa-fw fa-bug "></i><span>Apresentações em juizo</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
            <ul class="treeview-menu">
                <li class=""><a href="{{ route('log.created','notacoger')}}"><i class="fa fa-fw fa-circle-o "></i><span>Notas COGER</span></a></li>
                <li class=""><a href="{{ route('log.created','apresentacao')}}"><i class="fa fa-fw fa-circle-o "></i><span>Apresentação</span></a></li>
                <li class=""><a href="{{ route('log.created','locaisapresentacao')}}"><i class="fa fa-fw fa-circle-o "></i><span>Locais</span></a></li>
                <li class=""><a href="{{ route('log.created','email')}}"><i class="fa fa-fw fa-circle-o "></i><span>Email</span></a></li>
            </ul></li>
        <li class="treeview"><a href="#"><i class="fa fa-fw fa-bug "></i><span>Administração</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
            <ul class="treeview-menu">
                <li class=""><a href="{{ route('log.created','acessos')}}"><i class="fa fa-fw fa-circle-o "></i><span>Acessos</span></a></li>
                <li class=""><a href="{{ route('log.created','apagados')}}"><i class="fa fa-fw fa-circle-o "></i><span>Apagado</span></a></li>
                <li class=""><a href="{{ route('log.created','bloqueios')}}"><i class="fa fa-fw fa-circle-o "></i><span>Bloqueios</span></a></li>
                <li class=""><a href="{{ route('log.created','papeis')}}"><i class="fa fa-fw fa-circle-o "></i><span>Papeis</span></a></li>
                <li class=""><a href="{{ route('log.created','permissoes')}}"><i class="fa fa-fw fa-circle-o "></i><span>Permissões</span></a></li> 
                <li class=""><a href="{{ route('log.created','cadastroopmcoger')}}"><i class="fa fa-fw fa-circle-o "></i><span>Cadastro OPM COGER</span></a></li>
                <li class=""><a href="{{ route('log.created','feriado')}}"><i class="fa fa-fw fa-circle-o "></i><span>Feriados</span></a></li> 
                <li class=""><a href="{{ route('log.created','fileupload')}}"><i class="fa fa-fw fa-circle-o "></i><span>Upload de Arquivos</span></a></li> 
            </ul>
        </li>
        
        <li class="treeview">
                <a href="#">
                    <i class="fa fa-fw fa-bug "></i><span>Policiais</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="#"><i class="fa fa-fw fa-bug"></i><span>FDI</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu"> 
                            <li class=""><a href="{{ route('log.created','fdi')}}"><i class="fa fa-fw fa-circle-o "></i><span>Acesso FDI</span></a></li>
                            <li class=""><a href="{{ route('log.created','protocolo')}}"><i class="fa fa-fw fa-circle-o "></i><span>Protocolo</span></a></li>
                            <li class=""><a href="{{ route('log.created','comportamentopm')}}"><i class="fa fa-fw fa-circle-o "></i><span>Comportamento PM</span></a></li>
                            <li class=""><a href="{{ route('log.created','denunciacivil')}}"><i class="fa fa-fw fa-circle-o "></i><span>Denuncia Civil</span></a></li>
                            <li class=""><a href="{{ route('log.created','elogio')}}"><i class="fa fa-fw fa-circle-o "></i><span>Elogio</span></a></li>
                            <li class=""><a href="{{ route('log.created','restricao')}}"><i class="fa fa-fw fa-circle-o "></i><span>Restrição</span></a></li>
                            <li class=""><a href="{{ route('log.created','punicao')}}"><i class="fa fa-fw fa-circle-o "></i><span>Punição</span></a></li>
                            <li class=""><a href="{{ route('log.created','tramitacaoopm')}}"><i class="fa fa-fw fa-circle-o "></i><span>Tramitação OPM</span></a></li>
                            <li class=""><a href="{{ route('log.created','tramitacao')}}"><i class="fa fa-fw fa-circle-o "></i><span>Tramitação COGER</span></a></li>
                            <li class=""><a href="{{ route('log.created','medalha')}}"><i class="fa fa-fw fa-circle-o "></i><span>Medalha</span></a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-fw fa-bug"></i><span>Geral</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class=""><a href="{{ route('log.created','reintegrado')}}"><i class="fa fa-fw fa-circle-o "></i><span>Reintegrado</span></a></li>
                            <li class=""><a href="{{ route('log.created','falecimento')}}"><i class="fa fa-fw fa-circle-o "></i><span>Óbitos e lesões</span></a></li>
                            <li class=""><a href="{{ route('log.created','preso')}}"><i class="fa fa-fw fa-circle-o "></i><span>Preso</span></a></li>
                            <li class=""><a href="{{ route('log.created','sai')}}"><i class="fa fa-fw fa-circle-o "></i><span>SAI</span></a></li>
                            <li class=""><a href="{{ route('log.created','suspenso')}}"><i class="fa fa-fw fa-circle-o "></i><span>Suspenso</span></a></li>
                        </ul>
                    </li> 
                </ul>
            </li>
    </ul>
</li>
@endif

<li class="">
    <a href="{{ route('link.index')}}">
        <i class="fa fa-link "></i><span>Links Úteis</span>
        <span class="pull-right-container"></span>
    </a>
</li>

<li class="">
    <a href="{{ route('arquivamento.local','coger')}}">
        <i class="fa fa-archive "></i><span>Arquivamento</span>
        <span class="pull-right-container"></span>
    </a>
</li>
{{-- <li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-code "></i><span>DEV</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        <li class=""><a href="#"><i class="fa fa-fw fa-circle-o "></i><span>Ligar Debugbar</span></a></li>
    </ul>
</li> --}}

