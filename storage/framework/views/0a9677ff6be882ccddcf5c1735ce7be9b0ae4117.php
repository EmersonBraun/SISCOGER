
<li >
    <div class="row " style="background-color: white">
        
    </div>
</li>
<?php if(auth()->check() && auth()->user()->hasAnyRole('admin')): ?>
<li class="treeview">
    <a href="#">
    <i class="fa fa-fw fa-balance-scale "></i>
    <span>Processos e Procedimentos</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    </span>
    </a>
    <ul class="treeview-menu">
    <?php if(auth()->check() && auth()->user()->hasAnyRole('admin')): ?>
        <?php echo $__env->make('vendor.adminlte.menu.processos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <?php if(auth()->check() && auth()->user()->hasAnyRole('admin')): ?>
        <?php echo $__env->make('vendor.adminlte.menu.procedimentos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
    <?php endif; ?> 
    </ul>
</li>
<?php endif; ?> 

<?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>
    <?php echo $__env->make('vendor.adminlte.menu.apresentacao', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<?php if(auth()->check() && auth()->user()->hasAnyRole('admin')): ?>
    <?php echo $__env->make('vendor.adminlte.menu.relatorios', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<?php if(auth()->check() && auth()->user()->hasAnyRole('admin')): ?>
    <?php echo $__env->make('vendor.adminlte.menu.correicoes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<?php if(auth()->check() && auth()->user()->hasAnyRole('admin')): ?>
    <?php echo $__env->make('vendor.adminlte.menu.busca', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<?php if(auth()->check() && auth()->user()->hasAnyRole('admin')): ?>
    <?php echo $__env->make('vendor.adminlte.menu.policiais', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<?php if(auth()->check() && auth()->user()->hasRole('sai')): ?>
    <?php echo $__env->make('vendor.adminlte.menu.sai', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<?php if(auth()->check() && auth()->user()->hasRole('bi')): ?>
    <?php echo $__env->make('vendor.adminlte.menu.bi', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

    <?php echo $__env->make('vendor.adminlte.menu.ajuda', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php if(auth()->check() && auth()->user()->hasAnyRole('admin')): ?>
    <?php echo $__env->make('vendor.adminlte.menu.administracao', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<?php echo $__env->make('vendor.adminlte.menu.historia', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

 <?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>
    <?php echo $__env->make('vendor.adminlte.menu.pendencias', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<?php if(auth()->check() && auth()->user()->hasAnyRole('admin|supervisao')): ?>
    <?php echo $__env->make('vendor.adminlte.menu.logs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

