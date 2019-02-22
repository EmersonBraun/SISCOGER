<div class="col-md-6 col-xs-12">
    <div class="box box-info collapsed-box">
    <div class="box-header with-border">
        <h3 class="box-title">Transferências
        
        </h3>

        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse">
        <i class="fa fa-plus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove">
        <i class="fa fa-times"></i></button>
        </div>
    </div>

    <div class="box-body">
        <div class="table-responsive">
        <table class="table no-margin">
            <thead>
                <tr>
                    <th>RG</th>
                    <th>Nome</th>
                    <th>OPM Origem</th>
                    <th>OPM Destino</th>
                </tr>
            </thead>
            <tbody>

            <?php $__empty_1 = true; $__currentLoopData = $transferidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transferido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?> 
            <?php if($transferido['opmorigem'] == $unidade || $transferido['opmdestino'] == $unidade): ?>
            <tr>
                <td><?php echo e($transferido['rg']); ?></td>
                <td><?php echo e(special_ucwords($transferido['nome'])); ?></td>
                <td><?php echo e(opm($transferido['opmorigem'])); ?></td>
                <td><?php echo e(opm($transferido['opmdestino'])); ?></td>
            </tr>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan='3'>Nenhuma Transferência</td> 
            </tr>
            <?php endif; ?>
            </tbody>
        </table>
        </div>
        <!-- /.table-responsive -->
    </div>
        
    <div class="box-footer clearfix">
        <a href="" class="btn btn-sm btn-info btn-flat pull-left">Ação 1</a>
        <a href="" class="btn btn-sm btn-default btn-flat pull-right">Ação 2</a>
    </div>
        
    </div>

</div>