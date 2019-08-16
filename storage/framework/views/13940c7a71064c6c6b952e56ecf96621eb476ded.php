<div class="tab-pane" id="apresentacoes">
    <table class="table table-striped">
        <tbody> 
            <tr>
                <th>N° Apres.</th>
                <th>OPM</th>
                <th>N° OF</th>
                <th>Pessoa</th>
                <th>Tipo</th>
                <th>Autos</th>
                <th>Condição</th>
                <th>Local</th>
                <th>Data/hora</th>
                <th>Situação</th>
            </tr>
        <?php $__empty_1 = true; $__currentLoopData = $apresentacoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($a['sjd_ref']); ?> / <?php echo e($a['sjd_ref_ano']); ?></td>
            <td>
            <?php if(!empty($a['opmsigla'])): ?> <?php echo e($a['opmsigla']); ?> <?php else: ?> <?php echo e($a['pessoa_unidade_lotacao_sigla']); ?> <?php endif; ?>
            </td>
            <td><?php echo e($a['documento_de_origem']); ?></td>
            <td><?php echo e($a['pessoa_posto']); ?> <?php echo e($a['pessoa_quadro']); ?> special_ucwords(<?php echo e($a['pessoa_nome']); ?>)</td>
            <td><?php echo e(sistema('apresentacaoTipoProcesso',$a['id_apresentacaotipoprocesso'])); ?></td>
            <td><?php echo e($a['autos_numero']); ?></td>
            <td><?php echo e(sistema('apresentacaoCondicao',$a['id_apresentacaocondicao'])); ?></td>
            <td><?php echo e($a['comparecimento_local_txt']); ?></td>
            <td><?php echo e(date( 'd/m/Y H:i' , strtotime($a['comparecimento_dh']))); ?></td>
            <td><?php echo e(sistema('apresentacaoSituacao',$a['id_apresentacaosituacao'])); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?> 
            <tr>
                <td> Não há registros.</td>
            </tr> 
        <?php endif; ?>
        </tbody>
    </table>
    <?php if(hasPermissionTo('criar-apresentacao')): ?>
    <button type="button" class="btn btn-primary btn-block">
        <i class="fa fa-plus"></i>Adicionar Apresentação
    </button>
    <?php endif; ?>
</div>