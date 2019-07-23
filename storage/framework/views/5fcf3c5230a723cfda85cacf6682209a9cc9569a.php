
<li ><div class="row " style="background-color: white"></div></li>
<?php if(auth()->check() && auth()->user()->hasAnyRole('admin')): ?>
<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-balance-scale "></i><span>Processos e Procedimentos</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
    <?php if(auth()->check() && auth()->user()->hasAnyRole('admin')): ?>
    <li class="treeview">
        <a href="#"><i class="fa fa-fw fa-file-text-o "></i><span>Processos</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">     
            <?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>
            <li class=""><a href="<?php echo e(route('adl.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>ADL</span></a></li>
            <li class=""><a href="<?php echo e(route('cd.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>CD</span></a></li>
            <li class=""><a href="<?php echo e(route('cj.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>CJ</span></a></li>
            <li class=""><a href="<?php echo e(route('fatd.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>FATD</span></a></li>
            <li class=""><a href="<?php echo e(route('pad.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>PAD</span></a></li>
            <?php endif; ?>
        </ul>
    </li>
    <?php endif; ?>
    <?php if(auth()->check() && auth()->user()->hasAnyRole('admin')): ?>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-fw fa-file-text "></i><span>Procedimentos</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
            <li class=""><a href="<?php echo e(route('apfd.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>APFD</span></a></li>
            <li class=""><a href="<?php echo e(route('desercao.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Deserção</span></a></li>
            <li class=""><a href="<?php echo e(route('exclusao.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Exclusão</span></a></li>
            <li class=""><a href="<?php echo e(route('ipm.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>IPM</span></a></li>
            <li class=""><a href="<?php echo e(route('iso.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>ISO</span></a></li>
            <li class=""><a href="<?php echo e(route('it.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>IT</span></a></li>
            <li class=""><a href="<?php echo e(route('procoutros.index')); ?>">
<i class="fa fa-fw fa-circle-o "></i>
<span>Proced. Outros</span></a></li>
            <li class=""><a href="<?php echo e(route('recurso.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Recursos</span></a></li>
            <li class=""><a href="<?php echo e(route('sindicancia.index')); ?>">
<i class="fa fa-fw fa-circle-o "></i><span>Sindicância</span></a></li>
        </ul>
    </li> 
    <?php endif; ?> 
    </ul>
</li>
<?php endif; ?> 

<?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>
<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-legal "></i><span>Apresentação em Juízo</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        
        <li class=""><a href="<?php echo e(route('notacoger.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Notas COGER</span></a></li>
        <li class=""><a href="<?php echo e(route('apresentacao.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Lista apresentações</span></a></li>
        <li class=""><a href="<?php echo e(route('apresentacao.buscar')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Buscar Apresentação</span></a></li>
        <li class=""><a href="<?php echo e(route('locais.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Locais</span></a></li>
        <li class=""><a href="<?php echo e(route('excel.create')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>inserir via Excel</span></a></li>
        <li class=""><a href="<?php echo e(route('memorando.create')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Gerar Memorando</span></a></li>
        <li class=""><a href="<?php echo e(route('unidades.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Dados Unidade</span></a></li>
    </ul>
</li>
<?php endif; ?>

<?php if(auth()->check() && auth()->user()->hasAnyRole('admin')): ?>
<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-line-chart "></i><span>Relatórios</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        <li class=""><a href="<?php echo e(route('home')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Pendências</span></a></li>       
        <li class=""><a href="<?php echo e(route('pendencias.gerais')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Pendências - Geral</span></a></li>  
        <li class=""><a href="<?php echo e(route('relatorios.prioritarios','adl')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Processos Prioritários</span></a></li>
        <li class=""><a href="<?php echo e(route('pendencias.sobrestamentos')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Sobrestamentos</span></a></li>
        <li class=""><a href="<?php echo e(route('pendencias.processos')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Processos</span></a></li>
        <li class=""><a href="<?php echo e(route('pendencias.postograd')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Postos/Graduações</span></a></li>
        <li class=""><a href="<?php echo e(route('pendencias.encarregados')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Encarregados</span></a></li>
        <li class=""><a href="<?php echo e(route('pendencias.defensores')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Defensores</span></a></li>
        <li class=""><a href="<?php echo e(route('pendencias.ofendidos')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Ofendidos</span></a></li>
    </ul>
</li>
<?php endif; ?>

<?php if(auth()->check() && auth()->user()->hasAnyRole('admin')): ?>
<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-folder "></i><span>Correições</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        
        <li class=""><a href="<?php echo e(route('correicao.ordinaria.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Ordinária</span></a></li>
        
        
        <li class=""><a href="<?php echo e(route('correicao.extraordinaria.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Extraordinária</span></a></li>
        
    </ul>
</li>
<?php endif; ?>

<?php if(auth()->check() && auth()->user()->hasAnyRole('admin')): ?>
<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-search "></i><span>Busca</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        
        <li class=""><a href="<?php echo e(route('busca.pm')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>PM</span></a></li>
        
        <li class=""><a href="<?php echo e(route('busca.ofendido')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Ofendido</span></a></li>
        
        <li class=""><a href="<?php echo e(route('busca.envolvido')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>envolvido</span></a></li>
        
        <li class=""><a href="<?php echo e(route('busca.documentacao')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Documentacão</span></a></li>
        
        <li class=""><a href="<?php echo e(route('busca.tramitacao')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Tramitação COGER</span></a></li>
        
    </ul>
</li>
<?php endif; ?>

<?php if(auth()->check() && auth()->user()->hasAnyRole('admin')): ?>
<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-cab "></i><span>Policiais</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        <li class=""><a href="<?php echo e(route('busca.pm')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Ficha de Tramitação</span></a></li>
        <li class=""><a href="<?php echo e(route('medalhas.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Medalhas</span></a></li>
        <li class=""><a href="<?php echo e(route('elogios.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Elogios</span></a></li>
        <li class=""><a href="<?php echo e(route('excluidos.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Excluídos</span></a></li>
        <li class=""><a href="<?php echo e(route('punidos.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Punidos</span></a></li>
        <li class=""><a href="<?php echo e(route('reintegrados.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Reintegrados</span></a></li>
        <li class=""><a href="<?php echo e(route('denunciados.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Denunciados</span></a></li>
        <li class=""><a href="<?php echo e(route('presos.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Presos</span></a></li>
        <li class=""><a href="<?php echo e(route('procedimento.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Procedimentos</span></a></li>
        <li class=""><a href="<?php echo e(route('comportamento.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Comportamento</span></a></li>
        <li class=""><a href="<?php echo e(route('respondendo.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Respondendo</span></a></li>
        <li class=""><a href="<?php echo e(route('restricoes.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Restrições</span></a></li>
        <li class=""><a href="<?php echo e(route('suspensos.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Suspensos</span></a></li>
        <li class=""><a href="<?php echo e(route('obitoslesoes.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Obitos e Lesões</span></a></li>
        <li class=""><a href="<?php echo e(route('mortosferidos.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Mortos e feridos</span></a></li>
    </ul>
</li>
<?php endif; ?>

<?php if(auth()->check() && auth()->user()->hasRole('sai')): ?>
<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-cab "></i><span>SAI</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        <li class=""><a href="<?php echo e(route('sai.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Policiais - Investigação</span></a></li>
    </ul>
</li>
<?php endif; ?>

<?php if(auth()->check() && auth()->user()->hasRole('bi')): ?>
<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-cab "></i><span>BI</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        <li class=""><a href="#"><i class="fa fa-fw fa-circle-o "></i><span>Gráfico...</span></a></li>
    </ul>
</li>
<?php endif; ?>

<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-question-circle "></i><span>Ajuda</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        <li class=""><a href="<?php echo e(route('users.manual')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Manual do usuário</span></a></li>
        <li class=""><a href="<?php echo e(route('users.pass',Auth::id())); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Modificar senha</span></a></li>
        <li class=""><a href="<?php echo e(route('it.documentacao')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Documentação para IT</span></a></li>
    </ul>
</li>

<?php if(auth()->check() && auth()->user()->hasAnyRole('admin')): ?>
<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-gears "></i><span>Administração</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        <li class="active"><a href="<?php echo e(route('users.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Usuários</span></a></li>
        
        <li class=""><a href="<?php echo e(route('roles.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Papéis</span></a></li>
        <li class=""><a href="<?php echo e(route('permissions.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Permissões</span></a></li>
        <li class=""><a href="<?php echo e(route('sjd.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Controle SJD</span></a></li>
        
        <li class=""><a href="<?php echo e(route('terms.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Termos de compromisso</span></a></li>
        <li class=""><a href="<?php echo e(route('unidades.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Unidades</span></a></li>
        <li class=""><a href="<?php echo e(route('feriado.index')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Feriados</span></a></li>
        
    </ul>
</li>
<?php endif; ?>

<li class="">
    <a href="<?php echo e(route('historia.ver')); ?>">
        <i class="fa fa-quote-left "></i><span>História SISCOGER</span>
        <span class="pull-right-container"></span>
    </a>
</li>

<?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>
<li class="treeview">
    <a href="#"><i class="fa fa fa-refresh "></i>
        <span>Ver outra OPM</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        <li class=""><a href="<?php echo e(route('trocaropm')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Dashboard</span></a></li>
        <li class=""><a href="<?php echo e(route('pendencias.gerais')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Pendências Gerais</span></a></li>
    </ul>
</li>
<?php endif; ?>

<?php if(auth()->check() && auth()->user()->hasAnyRole('admin|supervisao')): ?>
<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-bug "></i><span>LOGS</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        <li class="treeview"><a href="#"><i class="fa fa-fw fa-bug "></i><span>Processos/Procedimentos</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
            <ul class="treeview-menu">
                <li class=""><a href="<?php echo e(route('log.created','adl')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - ADL</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','apfd')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - APFD</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','cd')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - CD</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','cj')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - CJ</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','desercao')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Deserção</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','exclusao')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Exclusão</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','fatd')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - FATD</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','ipm')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - IPM</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','iso')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - ISO</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','it')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - IT</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','movimento')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Movimento</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','pad')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - PAD</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','procoutros')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Proc. Outros</span></a></li>                            
                <li class=""><a href="<?php echo e(route('log.created','sindicancia')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Sindicância</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','recurso')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Recurso</span></a></li>
            </ul>
        </li>
        <li class="treeview"><a href="#"><i class="fa fa-fw fa-bug "></i><span>Apresentações em juizo</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
            <ul class="treeview-menu">
                <li class=""><a href="<?php echo e(route('log.created','notacoger')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Notas COGER</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','apresentacao')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Apresentação</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','locaisapresentacao')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Locais</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','email')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Email</span></a></li>
            </ul></li>
        <li class="treeview"><a href="#"><i class="fa fa-fw fa-bug "></i><span>Administração</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
            <ul class="treeview-menu">
                <li class=""><a href="<?php echo e(route('log.created','acessos')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Acessos</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','apagados')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Apagado</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','bloqueios')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Bloqueios</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','papeis')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Papeis</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','permissoes')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Permissões</span></a></li> 
                <li class=""><a href="<?php echo e(route('log.created','feriado')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Feriados</span></a></li>  
            </ul>
        </li>
        <li class="treeview"><a href="#"><i class="fa fa-fw fa-bug "></i><span>Policiais</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
            <ul class="treeview-menu">
                <li class=""><a href="<?php echo e(route('log.created','fdi')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - FDI</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','cadastroopmcoger')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Cadastro OPM COGER</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','comportamentopm')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Comportamento PM</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','denunciacivil')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Denuncia Civil</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','elogio')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Elogio</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','reintegrado')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Reintegrado</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','falecimento')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Falecimento</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','preso')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Preso</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','restricao')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Restrição</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','sai')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - SAI</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','suspenso')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Suspenso</span></a></li>
                <li class=""><a href="<?php echo e(route('log.created','tramitacaoopm')); ?>"><i class="fa fa-fw fa-circle-o "></i><span>Log - Tramitação OPM</span></a></li>
            </ul>
        </li>
    </ul>
</li>
<?php endif; ?>

<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-code "></i><span>DEV</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        <li class=""><a href="#"><i class="fa fa-fw fa-circle-o "></i><span>Ligar Debugbar</span></a></li>
    </ul>
</li>

