<div class="tab-pane active" id="denuncias">
    <table class="table table-striped">
        <tbody>      
            <?php $__empty_1 = true; $__currentLoopData = $subJudice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subJudice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php if($subJudice['id_ipm'] != 0): ?> 
                    <tr>
                        <td>
                        <a href="<?php echo e(route('ipm.show',['ref' => proc_id('ipm',$subJudice['id_ipm'],'ref'),'ano' => proc_id('ipm',$subJudice['id_ipm'],'ano')])); ?>">
                        IPM N°<?php echo e(proc_id('ipm',$subJudice['id_ipm'],'ref')); ?>/<?php echo e(proc_id('ipm',$subJudice['id_ipm'],'ano')); ?></a>
                        </td>
                <?php elseif($subJudice['id_apfd'] != 0): ?>
                    <tr>
                        <td>
                        <a href="<?php echo e(route('apfd.show',['ref' => proc_id('apfd',$subJudice['id_apfd'],'ref'),'ano' => proc_id('apfd',$subJudice['id_apfd'],'ano')])); ?>">
                        APFD N°<?php echo e(proc_id('apfd',$subJudice['id_apfd'],'ref')); ?>/<?php echo e(proc_id('apfd',$subJudice['id_apfd'],'ano')); ?>

                        </a>
                        </td>
                <?php elseif($subJudice['id_desercao'] != 0): ?> 
                    <tr>
                        <td>
                        <a href="<?php echo e(route('desercao.show',['ref' => proc_id('desercao',$subJudice['id_desercao'],'ref'),'ano' => proc_id('desercao',$subJudice['id_desercao'],'ano')])); ?>">
                        Deserção N°<?php echo e(proc_id('desercao',$subJudice['id_desercao'],'ref')); ?>/<?php echo e(proc_id('desercao',$subJudice['id_desercao'],'ano')); ?>

                        </a>
                        </td>
                <?php endif; ?>     
                        <td>Processo crime: <b><?php echo e($subJudice['ipm_processocrime']); ?></b></td>
                        <td>Julgamento:  <b> <?php if($subJudice['ipm_julgamento']): ?> <?php echo e($subJudice['ipm_processocrime']); ?> <?php else: ?> Não cadastrado <?php endif; ?></b> </td>
                        <td>Trânsito em julgado:  <b> <?php if($subJudice['ipm_julgamento'] == "Condenado"): ?> Sim <?php else: ?> Não <?php endif; ?></b>  </td>
                    </tr>                 
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td>Nada encontrado</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>