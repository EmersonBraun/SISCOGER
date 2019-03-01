<v-box-colapse title="CONSELHOS DE DISCIPLINA - DATA DE ABERTURA" qtd="<?php echo e($tcd_aberturas); ?>">
    <table class="table no-margin">
            <thead>
                <tr>
                    <th>CD ref/ano</th>
                    <th>Situação</th>
                </tr>
            </thead>
            <?php $__empty_1 = true; $__currentLoopData = $cd_aberturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cd_abertura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            
            <tr>
                <td><?php echo e($cd_abertura['sjd_ref']); ?> / <?php echo e($cd_abertura['sjd_ref_ano']); ?></td>
                <td><span class='label label-danger'>não tem data de abertura cadastrada. </span></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan='3'>Nenhuma Pendência</td> 
            </tr>
            <?php endif; ?>
            </tbody>
        </table>
</v-box-colapse>
