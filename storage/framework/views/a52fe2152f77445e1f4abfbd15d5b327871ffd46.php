<div class="col-md-6 col-xs-12">
    <div class="box box-info collapsed-box">
    <div class="box-header with-border">
        <h3 class="box-title">SINDICÂNCIA - PRAZOS
        <?php if($tsindicancia_prazos > 0): ?><span class="badge bg-red"><?php echo e($tsindicancia_prazos); ?></span><?php endif; ?>
        </h3>

        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
        <table class="table no-margin">
            <thead>
                <tr>
                    <th>Sindicância ref/ano</th>
                    <th>Situação</th>
                </tr>
            </thead>
            <?php $__empty_1 = true; $__currentLoopData = $sindicancia_prazos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sindicancia_prazo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            
            <tr>
                <td><?php echo e($sindicancia_prazo['sjd_ref']); ?> / <?php echo e($sindicancia_prazo['sjd_ref_ano']); ?></td>
                <td><span class='label label-danger'>está fora do prazo regulamentar. </span></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan='3'>Nenhuma Pendência</td> 
            </tr>
            <?php endif; ?>
            </tbody>
        </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
        <a href="" class="btn btn-sm btn-info btn-flat pull-left">Ação 1</a>
        <a href="" class="btn btn-sm btn-default btn-flat pull-right">Ação 2</a>
    </div>
    <!-- /.box-footer -->
    </div>
</div>