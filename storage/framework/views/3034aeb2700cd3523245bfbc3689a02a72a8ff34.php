<div class="tab-pane" id="prisoes">
    <table class="table table-striped">
        <tbody> 
        <?php $__empty_1 = true; $__currentLoopData = $prisoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prisoes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr> 
                <td><b>Inicio</b>: <?php echo e(data_br($prisoes['inicio_data'])); ?> <b>Fim</b>: <?php echo e(data_br($prisoes['fim_data'])); ?> (<?php echo e($prisoes['comarca']); ?>-<?php echo e($prisoes['vara']); ?>) </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?> 
            <tr> 
                <td>Não há registros. </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <?php if(hasPermissionTo('criar-prisoes')): ?>
    <button type="button" class="btn btn-primary btn-block">
        <i class="fa fa-plus"></i>Adicionar prisão
    </button>
    <?php endif; ?>
</div>