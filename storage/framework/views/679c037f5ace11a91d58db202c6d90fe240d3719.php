<div class="tab-pane" id="objeto">
    <h4 class="text-center text-bold">Marcado em procedimentos como Acusado, Indiciado, Sindicado ou Paciente</h4>
    <table class="table table-striped">
        <tbody> 
            <tr>
                <th>Proc.</th>
                <th>CDOPM</th>
                <th>Situação</th>
                <th>Andamento</th>
                <th>Ações</th>
            </tr>
        <?php $__empty_1 = true; $__currentLoopData = $objetos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e(strtoupper($o['procedimento'])); ?> <?php echo e($o['sjd_ref']); ?> / <?php echo e($o['sjd_ref_ano']); ?></td>
            <td><?php echo e($o['cdopm']); ?></td>
            <td><?php echo e($o['situacao']); ?> <?php if(!is_null($o['rg_sustituto'])): ?> Substituído <?php endif; ?></td>
            <td><?php echo e($o['id_andamento']); ?></td>
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