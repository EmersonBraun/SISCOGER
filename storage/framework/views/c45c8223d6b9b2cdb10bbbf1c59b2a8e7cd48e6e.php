<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-line-chart "></i>
        <span>Relatórios</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
         
        <li class="">
            <a href="<?php echo e(route('home')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Pendências</span>
            </a>
        </li>
        
        
        <li class="">
            <a href="<?php echo e(route('pendencias.gerais')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Pendências - Geral</span>
            </a>
        </li>
        
        
        <li class="">
            <a href="<?php echo e(route('pendencias.prioritarios')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Processos Prioritários</span>
            </a>
        </li>
        
        
        <li class="">
            <a href="<?php echo e(route('pendencias.sobrestamentos')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Sobrestamentos</span>
            </a>
        </li>
        
        
        <li class="">
            <a href="<?php echo e(route('pendencias.processos')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Processos</span>
            </a>
        </li>
        
       
        <li class="">
            <a href="<?php echo e(route('pendencias.postograd')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Postos/Graduações</span>
            </a>
        </li>
        
        
        <li class="">
            <a href="<?php echo e(route('pendencias.encarregados')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Encarregados</span>
            </a>
        </li>
        
        
        <li class="">
            <a href="<?php echo e(route('pendencias.defensores')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Defensores</span>
            </a>
        </li>
        
        
        <li class="">
            <a href="<?php echo e(route('pendencias.ofendidos')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Ofendidos</span>
            </a>
        </li>
        
    </ul>
</li>