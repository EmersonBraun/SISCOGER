<div class="box box-info collapsed-box">
<div class="box-header with-border">
    <h3 class="box-title"><?php echo e($titulo); ?>

    <?php if($qtd > 0): ?><span class="badge bg-red"><?php echo e($qtd); ?></span><?php endif; ?>
    </h3>

    <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
    </button>
    
    </div>
</div>
<!-- /.box-header -->
<div class="box-body">
    <div class="table-responsive">
        <?php echo e($slot); ?>

    </div>
    <!-- /.table-responsive -->
</div>
<!-- /.box-body -->

<!-- /.box-footer -->
</div>