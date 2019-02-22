<div class="tab-pane" id="sai">
    <table class="table table-striped">
        <tbody> 
            <tr>
                <th>N° SAI</th>
                <th>Motivo abertura</th>
                <th>Síntese do fato</th>
                <th>Situação</th>
                <th>Resultado</th>
                <th>Digitaror</th>
                <th>Ações</th>
            </tr>
        <?php $__empty_1 = true; $__currentLoopData = $sai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <?php if($s['sjd_ref'] !== 0 ): ?>
            <td><?php echo e($s['sjd_ref']); ?> / <?php echo e($s['sjd_ref_ano']); ?> </td>
            <?php else: ?>
            <td><?php echo e($s['id_sai']); ?></td> 
            <?php endif; ?>
            <td><?php echo e($s['motivo_principal']); ?> </td>
            <td><?php echo e($s['sintese_txt']); ?> </td>
            <td><?php echo e($s['situacao']); ?> </td>
            <td><?php echo e($s['origem_proc']); ?>-<?php echo e($s['origem_sjd_ref']); ?>/<?php echo e($s['origem_sjd_ref_ano']); ?> </td>
            <td><?php echo e($s['digitador']); ?> </td>
            <td>Ações </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?> 
            <tr>
                <td> Não há registros.</td>
            </tr> 
        <?php endif; ?>
        </tbody>
    </table>
    <button type="button" class="btn btn-primary btn-block">
        <i class="fa fa-plus"></i>Adicionar SAI
    </button>
</div>