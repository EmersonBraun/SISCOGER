<div class="row">
    <div class="col-xs-12">
        <div class="box collapsed-box">
            <div class="box-header">
                <h2 class="box-title">Trâmite OPM/OBM
                &emsp;<i class="fa fa-info-circle text-info" data-toggle="tooltip" data-placement="bottom" title="O campo poderá ser suprimido nos casos de certidão da Ficha Disciplinar Individual do militar estadual."></i>
                <?php if(count($tramitacaoopm) > 0): ?> <span class="badge bg-red"><?php echo e(count($tramitacaoopm)); ?></span> <?php endif; ?></h2> 
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-plus"></i>
                    </button> 
                </div>             
            </div>

            <div class="box-body">

                <div class="col-md-12 col-xs-12">   
                    <table class="table table-striped">
                        <tbody> 
                            <tr>
                                <th>Data</th>
                                <th>Descrição</th>
                                <th>Digitador</th>
                                <th>OM</th>
                            </tr>
                        <?php $__empty_1 = true; $__currentLoopData = $tramitacaoopm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $to): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(data_br($to['data'])); ?></td>
                                <td><?php echo e($to['descricao_txt']); ?></td>
                                <td><?php echo e($to['digitador']); ?></td>
                                <td><?php echo e($to['opm_abreviatura']); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td>Não há trâmite.</td></tr>   
                        <?php endif; ?>
                    </tbody>
                </table>
                <?php if(hasPermissionTo('criar-tramite-opm')): ?>
                <button type="button" class="btn btn-primary btn-block">
                    <i class="fa fa-plus"></i>Adicionar Trâmite OPM
                </button>
                <?php endif; ?>
                </div> 
            </div>   
        </div>
    </div>     
</div>