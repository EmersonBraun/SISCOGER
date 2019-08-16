<div class="tab-pane" id="fdi">
    <?php if(hasPermissionTo('ver-mudanca-comportamento')): ?>
    <table class="table table-striped">
        <h4 class="text-center text-bold">Mudanças de Comportamento</h4>
        <tbody>
            <tr>
                <th><b>Data:</b></th>
                <th><b>Novo comportamento:</b></th>
                <th><b>Sintese:</b></th>
                <th><b>Publicacao:</b></th>
            </tr>
            <?php $__empty_1 = true; $__currentLoopData = $comportamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e(data_br($c['data'])); ?></td>
                <td><?php echo e($c['comportamento']); ?></td>
                <td><?php echo e($c['motivo_txt']); ?></td>
                <td><?php echo e($c['publicacao']); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td> Não há mudanças de comportamento.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php endif; ?>
    <?php if(hasPermissionTo('criar-mudanca-comportamento')): ?>
    <button type="button" class="btn btn-primary btn-block">
        <i class="fa fa-plus"></i>Adicionar mudança de comportamento
    </button>
    <?php endif; ?>
    <?php if(hasPermissionTo('ver-elogios')): ?>
    <table class="table table-striped">
        <h4 class="text-center text-bold">Elogios</h4>
        <tbody>
            <tr>
                <th><b>Data:</b></th>
                <th><b>OPM:</b></th>
                <th><b>Sintese:</b></th>
            </tr>
            <?php $__empty_1 = true; $__currentLoopData = $elogios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e(data_br($e['elogio_data'])); ?></td>
                <td><?php echo e($e['opm_abreviatura']); ?></td>
                <td><?php echo e($e['descricao_txt']); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td> Não há elogios.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php endif; ?>
    <?php if(hasPermissionTo('criar-elogio')): ?>
    <button type="button" class="btn btn-primary btn-block">
        <i class="fa fa-plus"></i>Adicionar elogio
    </button>
    <?php endif; ?>
</div>