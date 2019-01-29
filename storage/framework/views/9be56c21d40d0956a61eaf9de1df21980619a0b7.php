<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-file-text-o "></i>
        <span>Processos</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">     
        <?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>
        <li class="">
            <a href="<?php echo e(route('adl.index')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>ADL</span>
            </a>
        </li>
        <?php endif; ?>
        <?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>
        <?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>
        <li class="">
            <a href="<?php echo e(route('cd.index')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>CD</span>
            </a>
        </li>
        <?php endif; ?>
        <?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>
        <li class="">
            <a href="<?php echo e(route('cj.index')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>CJ</span>
            </a>
        </li>
        <?php endif; ?>
        <li class="">
            <a href="<?php echo e(route('fatd.index')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>FATD</span>
            </a>
        </li>
        <?php endif; ?>
        <?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>
        <li class="">
            <a href="<?php echo e(route('pad.index')); ?>">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>PAD</span>
            </a>
        </li>
        <?php endif; ?>
    </ul>
</li>