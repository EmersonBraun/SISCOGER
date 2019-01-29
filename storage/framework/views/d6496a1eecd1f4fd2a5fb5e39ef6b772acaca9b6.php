<li class="treeview">
    <a href="#">
    <i class="fa fa-fw fa-folder "></i>
    <span>Correições</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
    </a>
    <ul class="treeview-menu">
        <?php if(auth()->check() && auth()->user()->hasRole('listar-correicao-ordinaria')): ?>
        <li class="">
            <a href="<?php echo e(route('correicao.index')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Ordinária</span>
            </a>
        </li>
        <?php endif; ?>
        <?php if(auth()->check() && auth()->user()->hasRole('listar-correicao-extraordinaria')): ?>
        <li class="">
            <a href="<?php echo e(route('correicao.extra.index')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Extraordinária</span>
            </a>
        </li>
        <?php endif; ?>
    </ul>
</li>