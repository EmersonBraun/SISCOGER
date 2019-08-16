<div class="tab-pane" id="proc_outros">
    <table class="table table-striped">
        <tbody> 
            <tr>
                <th>N° proc_outros</th>
                <th>Andamento</th>
                <th>Andamento COGER</th>
                <th>Motivo</th>
                <th>Doc. Origem</th>
                <th>Sintese do fato</th>
                <th>Situação</th>
                <th>Resultado</th>
                <th>Digitador</th>
                <th>Ações</th>
            </tr>
        <?php $__empty_1 = true; $__currentLoopData = $proc_outros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($o['sjd_ref']); ?>/<?php echo e($o['sjd_ref_ano']); ?></td>
            <td><?php echo e($o['andamento']); ?></td>
            <td><?php echo e($o['andamentocoger']); ?></td>
            <td><?php echo e($o['motivo_abertura']); ?></td>
            <td><?php echo e($o['doc_origem']); ?></td>
            <td><?php echo e($o['sintese_txt']); ?></td>
            <td><?php echo e($o['situacao']); ?></td>
            <td><?php echo e($o['origem_proc']); ?>-<?php echo e($o['origem_sjd_ref']); ?>/<?php echo e($o['origem_sjd_ref_ano']); ?></td>
            <td><?php echo e($o['digitador']); ?></td>
            <td>Ações </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?> 
            <tr>
                <td> Não há registros.</td>
            </tr> 
        <?php endif; ?>
        </tbody>
    </table>
    <?php if(hasPermissionTo('criar-proc-outros')): ?>
    <button type="button" class="btn btn-primary btn-block">
        <i class="fa fa-plus"></i>Adicionar Procedimento Outros
    </button>
    <?php endif; ?>
</div>