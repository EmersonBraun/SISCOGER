<div class="col-md-6 col-xs-12">
    <div class="box box-info collapsed-box">
    <div class="box-header with-border">
        <h3 class="box-title">CONSELHOS DE DISCIPLINA - DATA DE ABERTURA
        <?php if($tcd_aberturas > 0): ?><span class="badge bg-red"><?php echo e($tcd_aberturas); ?></span><?php endif; ?>
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
                    <th>CD ref/ano</th>
                    <th>Situação</th>
                </tr>
            </thead>
            <?php $__empty_1 = true; $__currentLoopData = $cd_aberturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cd_abertura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            
            <tr>
                <td><?php echo e($cd_abertura['sjd_ref']); ?> / <?php echo e($cd_abertura['sjd_ref_ano']); ?></td>
                <td><span class='label label-danger'>não tem data de abertura cadastrada. </span></td>
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