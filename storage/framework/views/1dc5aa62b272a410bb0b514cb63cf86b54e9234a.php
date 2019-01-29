<?php $__env->startSection('title_postfix', '| Busca Ofendido'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class='fa fa-user-plus'></i> Busca Ofendido</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Busca Ofendido</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class=''>
    <h4 style="padding-left: 3%"><b>Buscar por:</b></h4>
    <?php echo e(Form::open(array('route' => array('busca.pm')))); ?>

    <div class="col-md-12 form-group">
        <div class="col-md-6">
            <?php echo Form::label('ofendido[rg]', 'RG'); ?>

            <?php echo Form::text('ofendido[rg]', '', array('class' => 'form-control', 'id' => 'rg')); ?>

        </div>
        <div class="col-md-6">
            <?php echo Form::label('ofendido[nome]', 'Nome'); ?>

            <?php echo Form::text('ofendido[nome]', '', array('class' => 'form-control','id' => 'nome')); ?>

        </div>
    </div>

    <?php echo Form::close(); ?>

    <div id="tabela">

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
$('#rg').keydown(function()
{
var rg = $(this).val();
    
    if(rg.length >= 2)
    {
        $.ajax({
            type: "POST",
            url: '/siscoger/busca/getofrg/' + rg,
            data: {"_token": "<?php echo e(csrf_token()); ?>", "rg": rg},
             
            success:function(data){
                $('#tabela').empty();
                $('#tabela').html(data);
            }
        });
    }
    else
    {
        $('#tabela').html("");
    }
 
});

$('#nome').keydown(function()
{
var nome = $(this).val();
    
    if(nome.length >= 2)
    {
        $.ajax({
            type: "POST",
            url: '/siscoger/busca/getofnome/' + nome,
            data: {"_token": "<?php echo e(csrf_token()); ?>", "nome": nome},
             
            success:function(data){
                $('#tabela').empty();
                $('#tabela').html(data);
             
            }
        });
    }
    else
    {
        $('#tabela').html("");
    }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>