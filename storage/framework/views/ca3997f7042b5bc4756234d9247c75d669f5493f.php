<div class="tab-pane" id="membro">
    <h4 class="text-center text-bold">Marcado em procedimentos como Encarregado, Presidente ou Acusador</h4>
    <table class="table table-striped">
        <tbody> 
            <tr>
                <th>Proc.</th>
                <th>CDOPM</th>
                <th>Situação</th>
                <th>Andamento</th>
                <th>Ações</th>
            </tr>
        <?php $__empty_1 = true; $__currentLoopData = $membros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e(strtoupper($m['procedimento'])); ?> <?php echo e($m['sjd_ref']); ?> / <?php echo e($m['sjd_ref_ano']); ?></td>
            <td><?php echo e($m['cdopm']); ?></td>
            <td><?php echo e($m['situacao']); ?> <?php if(!is_null($m['rg_sustituto'])): ?> Substituído <?php endif; ?></td>
            <td><?php echo e($m['id_andamento']); ?></td>
            <td></td> 
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?> 
            <tr>
                <td> Não há registros.</td>
            </tr> 
        <?php endif; ?>
        </tbody>
    </table>
</div>