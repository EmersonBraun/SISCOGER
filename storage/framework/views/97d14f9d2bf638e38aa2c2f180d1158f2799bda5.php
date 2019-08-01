<div class="row">
    <div class="col-xs-12">
        <div class="box collapsed-box">
            <div class="box-header">
                <h2 class="box-title">Afastamentos
                &emsp;<i class="fa fa-info-circle text-info" data-toggle="tooltip" data-placement="bottom" title="O campo poderá ser suprimido nos casos de certidão da Ficha Disciplinar Individual do militar estadual."></i>
                <?php if(count($afastamentos) > 0): ?> <span class="badge bg-red"><?php echo e(count($afastamentos)); ?></span> <?php endif; ?></h2>
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
                            <?php $__empty_1 = true; $__currentLoopData = $afastamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $af): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <?php echo e($af['DESC_INCIDENTE']); ?>, 
                                    <b>De <?php echo e(data_br($af['DT_INIC'])); ?> a <?php echo e(data_br($af['DT_FIM'])); ?>

                                    (<?php echo e($af['UNITS']); ?> Dias)</b>     
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td>Não há registros.</td></tr>
                            <?php endif; ?>
                            </tbody>
                    </table>   
                </div> 
            </div>   
        </div>
    </div>     
</div>