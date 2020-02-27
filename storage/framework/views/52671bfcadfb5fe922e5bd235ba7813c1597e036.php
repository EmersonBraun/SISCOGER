<?php $__env->startSection('title', 'adl'); ?>

<?php $__env->startSection('content_header'); ?>
<?php echo $__env->make('procedimentos.adl.list.menu', ['title' => 'Consultas','page' => 'lista'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Apuração Disciplinar de Licenciamento</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1 col-md-1'>N°/Ano</th>
                            <th class='col-xs-1 col-md-1'>OPM</th>
                            <th class='col-xs-8 col-md-8'>Sintese</th>
                            <th class='col-xs-2 col-md-2'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="display: none"><?php echo e($registro->id_adl); ?></td>
                            <?php if($registro->sjd_ref != ''): ?>
                            <td><?php echo e($registro->sjd_ref); ?>/<?php echo e($registro->sjd_ref_ano); ?></td>
                            <?php else: ?>
                            <td><?php echo e($registro->id_adl); ?></td>
                            <?php endif; ?>
                            <td><?php echo e($registro->present()->opm); ?></td>
                            <td><?php echo e($registro->sintese_txt); ?></td>
                            <td>
                                <span>
                                    <?php if(hasPermissionTo('ver-adl')): ?>
                                    <a class="btn btn-default2"
                                        href="<?php echo e(route('adl.show',['ref' => $registro->sjd_ref, 'ano' => $registro->sjd_ref_ano])); ?>"><i
                                            class="fa fa-fw fa-eye "></i></a>
                                    <?php endif; ?>
                                    <?php if(hasPermissionTo('editar-adl')): ?>
                                    <a class="btn btn-info"
                                        href="<?php echo e(route('adl.edit',['ref' => $registro->sjd_ref, 'ano' => $registro->sjd_ref_ano])); ?>"><i
                                            class="fa fa-fw fa-edit "></i></a>
                                    <?php endif; ?>
                                    <?php if(hasPermissionTo('apagar-adl')): ?>
                                    <a class="btn btn-danger" href="<?php echo e(route('adl.destroy',$registro['id_adl'])); ?>"
                                        onclick="return  confirm('Tem certeza que quer apagar o ADL?')"><i
                                            class="fa fa-fw fa-trash-o "></i></a>
                                    <?php endif; ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
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