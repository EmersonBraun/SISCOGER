<?php $__env->startSection('title_postfix', '| Busca PM/BM'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">
    <h1><i class='fa fa-user'></i> Busca PM/BM</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item active"><a href="#">Busca PM/BM</a></li>
    </ol>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<vue-simple-suggest mode="select">
  </vue-simple-suggest>

<div class=''>
    <h4 style="padding-left: 3%"><b>Buscar por:</b></h4>
    <?php echo e(Form::open(array('route' => array('busca.fdi')))); ?>

    <div class="col-md-12 form-group">
        <div class="col-md-6 form-group <?php if($errors->has('rg')): ?> has-error <?php endif; ?>">
            <?php echo Form::label('rg', 'RG'); ?>

            <?php echo Form::text('rg', '', array('class' => 'form-control numero','placeholder' => 'Busca por rg' , 'onblur' => 'completaCampos($(this).val(),array(nome),array(NOME)' )); ?>

            <?php if($errors->has('rg')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('rg')); ?></strong>
                </span>
            <?php endif; ?>
        </div>
    
        <div class="col-md-6 form-group">
            <?php echo Form::label('nome', 'Nome'); ?>

            <?php echo Form::text('nome', null, array('class' => 'form-control typeahead','placeholder' => 'Busca por nome', 'onfocusout' => 'completarg($(this).val())')); ?>

            <?php if($errors->has('nome')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('nome')); ?></strong>
                </span>
            <?php endif; ?>
        </div>

        <div class="col-md-12 form-group">
            <?php echo Form::submit('Ver', array('class' => 'btn btn-primary btn-block')); ?>

        </div>
    </div>

    <?php echo Form::close(); ?>

    <div id="tabela">

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<!-- Easy Autocomplete -->
<link rel="stylesheet" href="<?php echo e(asset('public/vendor/plugins/EasyAutocomplete/easy-autocomplete.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('public/vendor/plugins/EasyAutocomplete/easy-autocomplete.themes.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php echo $__env->make('vendor.adminlte.includes.vue', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript">
    //Função para dar opções de autocompletar o nome
   var options = {
    
    url: function(phrase) {
      return "<?php echo route('busca.opcoesnome'); ?>";
    },
    
    getValue: function(element) {
      return element.nome+' '+element.situacao;
    },

    list: {
        onSelectItemEvent: function() {
            var selectedItemValue = $("#nome").getSelectedItemData().rg;
            $("#rg").val(selectedItemValue).trigger("change");
        },
        onHideListEvent: function() {
        	$("#rg").val(selectedItemValue).trigger("change");
    	}
    },
    
    ajaxSettings: {
      dataType: "json",
      method: "POST",
      data: {
            "_token": "<?php echo e(csrf_token()); ?>"
        }
    },
    
    preparePostData: function(data) {
      data.phrase = $("#nome").val();
      return data;
    },
    
    requestDelay: 100
    };
    
    $("#nome").easyAutocomplete(options);
    
    //Função para dar opções de autocompletar o rg
    var options = {
    
    url: function(phrase) {
      return "<?php echo route('busca.opcoesrg'); ?>";
    },
    
    getValue: function(element) {
        return element.rg+' '+element.situacao;
    },

    list: {
        onSelectItemEvent: function() {
            var selectedItemValue = $("#rg").getSelectedItemData().nome;

            $("#nome").val(selectedItemValue).trigger("change");
        },
        onHideListEvent: function() {
        	$("#nome").val(selectedItemValue).trigger("change");
    	}
    },
    
    ajaxSettings: {
      dataType: "json",
      method: "POST",
      data: {
            "_token": "<?php echo e(csrf_token()); ?>"
        }
    },
    
    preparePostData: function(data) {
      data.phrase = $("#rg").val();
      return data;
    },
    
    requestDelay: 100
    };
    
    $("#rg").easyAutocomplete(options);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>