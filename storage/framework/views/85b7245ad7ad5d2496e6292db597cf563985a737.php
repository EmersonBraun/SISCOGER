<div class="tab-pane" id="outras_denuncias">
    <table class="table table-striped">
        <tbody> 
        <?php $__empty_1 = true; $__currentLoopData = $denunciaCivil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $denunciaCivil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><a href="#">Deserção N°<?php echo e($denunciaCivil['id_denunciacivil']); ?></a></td>
                <td>Processo crime: <b><?php echo e($denunciaCivil['processocrime']); ?></b></td>
                <td>Julgamento:  <b> <?php if($denunciaCivil['julgamento']): ?> <?php echo e($denunciaCivil['julgamento']); ?> <?php else: ?> Não cadastrado <?php endif; ?></b> </td>
                <td>Trânsito em julgado:  <b> <?php if($denunciaCivil['transitojulgado_bl']): ?> Sim <?php else: ?> Não <?php endif; ?></b> </td>  
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td>Nada encontrado</td>
            </tr>
        <?php endif; ?> 
        <tr>
            <td>
                <button type="button" class="btn btn-primary btn-block">
                    <i class="fa fa-plus"></i>Adicionar denúncia
                </button>
            </td>
        </tr>
        </tbody>
    </table> 
</div>