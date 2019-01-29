<?php $__env->startSection('title', 'História'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">   
  <h1>História SISCOGER</h1>
  <button type="button" class="btn btn-primary" data-toggle="modal" onclick="$('#myModal').modal('show')"><i class="fa fa-plus"></i> Adicionar história</button>
  <ol class="breadcrumb">
  <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">História SISCOGER</li>
  </ol>
  <br>
</section>
  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="">
    <ul class="timeline">
        <li class="time-label">
            <span class="bg-red">
                <?php echo e($anoatual); ?>

            </span>
        </li>
    <?php $__empty_1 = true; $__currentLoopData = $historias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php if($anoatual < $h['ano']): ?>
    <li class="time-label">
        <span class="bg-red">
           <?php echo e($anoatual = $h['ano']); ?>

        </span>
    </li>
    <?php endif; ?>

    <li>
        <i class="fa fa-calendar bg-blue"></i>
        <div class="timeline-item">   
            <h3 class="timeline-header"><?php echo e($h['titulo']); ?></h3>        
            <div class="timeline-body">
                <?php echo e($h['conteudo']); ?>

            </div>
            <div class="timeline-footer">
                <small class="text-muted"><i class="fa fa-calendar"></i> <?php echo e(data_br($h['data'])); ?></small>
                <?php if($h['rodape']): ?> <?php echo e($h['rodape']); ?> <?php endif; ?>
                <span>
                    <a class="btn btn-primary btn-xs" onclick="openModal('m-<?php echo e($h['id_historia']); ?>')">Editar</a>
                    <a class="btn btn-danger btn-xs" onclick="apagarHistoria(<?php echo e($h['id_historia']); ?>)">Apagar</a>
                </span> 
            </div>
        </div>
    </li>
    
    <?php echo $__env->make('vendor.historia.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <li>Não há histórias</li> 
    <?php endif; ?>
    </ul>
</section> 


<?php echo $__env->make('vendor.historia.create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
//$(document).ready(function($){
function openModal(id) 
{
    $('#'+id).modal('show');
}
function apagarHistoria(id)
{
    //endereço do servidor
    var url = window.location.origin;
    //token
    var _token = $('input[name="_token"]').val();

    $.confirm({
        icon: 'fa fa-warning',
        title: 'História',
        content: 'Tem certeza que quer apagar?',
        buttons: {
            Sim: {
                text: 'Sim', // With spaces and symbols
                action: function () {
                    $.ajax({
                        url: url+"/siscoger/historia/"+id+"/remover",
                        method: "DELETE",
                        data: {
                        _token: _token,
                        'id': id
                        },
                        success: function(){
                            $.alert('Apagado');
                            window.location.reload();
                        }
                    });      
                }
            },
            Não: {
                text: 'Não', // With spaces and symbols
                action: function () {
                    $.alert('Cancelado');
                }
            }
        }
        });
}
//});
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>