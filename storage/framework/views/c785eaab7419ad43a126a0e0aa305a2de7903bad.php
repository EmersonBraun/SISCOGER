<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="box">
            <div class="box-header">
                <h2 class="box-title">Envolvidos</h2>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button> 
                </div>             
            </div>
            <div class="box-body">
                    <div class="col-lg-4 col-md-4 col-xs-4">   
                        <b>Situação</b>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-4">   
                        <b>Posto/Graduação Nome RG</b>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-4">   
                        <b>Resultado</b>
                    </div>
                <?php $__empty_1 = true; $__currentLoopData = $envolvidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php if($e->nome != ''): ?>
                        <div class="col-lg-4 col-md-4 col-xs-4">   
                            <?php echo e($e->situacao); ?>

                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-4">   
                            <?php echo e($e->cargo); ?> <?php echo e(special_ucwords($e->nome)); ?> - <a href="<?php echo e(route('fdi.show',$e->rg)); ?>" target="_blank"><?php echo e($e->rg); ?></a>
                        </div> 
                        <div class="col-lg-4 col-md-4 col-xs-4">
                        <?php if( in_array($e->situacao, config('sistema.procTiposAcusados')) ): ?>
                            <?php echo e($e->resultado); ?>

                        <?php else: ?>
                            Não se aplica
                        <?php endif; ?>
                        </div>   
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <b>Não há</b>
                    </div> 
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>