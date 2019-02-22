<div class="tab-pane" id="restricoes">
    <table class="table table-striped">
        <tbody> 
        <?php $__empty_1 = true; $__currentLoopData = $restricoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
            <?php if($rest["arma_bl"]): ?><td><b>Restricao de porte de arma de fogo.</b></td><?php endif; ?>
            <?php if($rest["fardamento_bl"]): ?><td><b>Restricao de uso de fardamento.</b></td><?php endif; ?>
            <td> <b>Inicio</b>: <?php echo e(data_br($rest["inicio_data"])); ?> / 
            <b>Fim</b>:
            <?php if($rest["retirada_data"]=="0000-00-00" && $rest["fim_data"]=="0000-00-00"): ?>
            <b>Vigente</b></td>
            <?php else: ?>
            <?php echo e(data_br($rest["retirada_data"])); ?></td>
            <?php endif; ?>
            <?php if(!($rest["retirada_data"]!="0000-00-00" and $rest["retirada_data"]!="")): ?> 
            <td><button type="button" class="btn btn-default pull-right">
                    <i class="fa fa-minus"></i>Retirar restricao
                </button></td>
            <?php endif; ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td> Não há registros.</td>
            </tr> 
        <?php endif; ?>
        <tr>
            <td>
                <button type="button" class="btn btn-primary btn-block">
                    <i class="fa fa-plus"></i>Adicionar Restrição
                </button>
            </td>
        </tr>
        </tbody>
    </table>
</div>