

<?php $__env->startSection('title', 'Sindicância - lista'); ?>

<?php $__env->startSection('content_header'); ?>
    <?php echo $__env->make('procedimentos.sindicancia.list.menu', ['title' => 'Consulta','page' => 'lista'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de SINDICÂNCIA</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class='col-xs-2 col-md-2'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>OPM</th>
                            <th class='col-xs-6 col-md-6'>Sintese</th>
                            <th class='col-xs-2 col-md-2'>Ações</th>     
                        </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($registro['sjd_ref']); ?>/<?php echo e($registro['sjd_ref_ano']); ?></td>
                        <td><?php echo e(opm($registro['cdopm'])); ?></td>
                        <td><?php echo e($registro['sintese_txt']); ?></td>
                        <td>
                            <span>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ver-sindicancia')): ?>
                                    <a class="btn btn-default" href="<?php echo e(route('sindicancia.show',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])); ?>"><i class="fa fa-fw fa-eye "></i></a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('editar-sindicancia')): ?>
                                    <a class="btn btn-info" href="<?php echo e(route('sindicancia.edit',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])); ?>"><i class="fa fa-fw fa-edit "></i></a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('apagar-sindicancia')): ?>
                                    <a class="btn btn-danger"  href="<?php echo e(route('sindicancia.destroy',$registro['id_sindicancia'])); ?>" onclick="confirmApagar('SINDICÂNCIA',$registro['sjd_ref'],$registro['sjd_ref_ano'])"><i class="fa fa-fw fa-trash-o "></i></a>
                                <?php endif; ?>
                            </span>
                        </td>   
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>N°/Ano</th>
                            <th>OPM</th>
                            <th>Sintese</th>
                            <th>Ações</th> 
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>