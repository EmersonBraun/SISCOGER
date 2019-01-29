<li class="treeview">
    <a href="#">
    <i class="fa fa-fw fa-search "></i>
    <span>Busca</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
    </a>
    <ul class="treeview-menu">
        
        <li class="">
            <a href="<?php echo e(route('busca.pm')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>PM</span>
            </a>
        </li>
        
        <li class="">
            <a href="<?php echo e(route('busca.ofendido')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Ofendido</span>
            </a>
        </li>
        
        <li class="">
            <a href="<?php echo e(route('busca.envolvido')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>envolvido</span>
            </a>
        </li>
        
        <li class="">
            <a href="<?php echo e(route('busca.documentacao')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Documentacão</span>
            </a>
        </li>
        
        <li class="">
            <a href="<?php echo e(route('busca.tramitacao')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Tramitação COGER</span>
            </a>
        </li>
        
    </ul>
</li>