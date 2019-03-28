<!-- =========== GERAIS ========== -->
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('public/vendor/adminlte/vendor/jquery/dist/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/vendor/plugins/bootstrap/js/bootstrap.bundle.js')); ?>"></script>
<script src="<?php echo e(asset('public/vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/vendor/plugins/jQueryUI/jquery-ui.min.js')); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- toaster -->
<script src="<?php echo e(asset('public/vendor/plugins/toastr/toastr.js')); ?>"></script>
<!-- =========== /GERAIS ========== -->
<!-- =========== FORM ========== -->
<!-- InputMask 
<script src="<?php echo e(asset('public/vendor/plugins/input-mask/jquery.inputmask.js')); ?>"></script>
<script src="<?php echo e(asset('public/vendor/plugins/input-mask/jquery.inputmask.date.extensions.js')); ?>"></script>
<script src="<?php echo e(asset('public/vendor/plugins/input-mask/jquery.inputmask.extensions.js')); ?>"></script>-->
<!-- InputMask -->
<script src="<?php echo e(asset('public/vendor/plugins/mask/dist/jquery.mask.js')); ?>"></script>
<!-- file upload 
<script src="<?php echo e(asset('public/vendor/plugins/File-Upload/js/vendor/jquery.ui.widget.js')); ?>"></script>
<script src="<?php echo e(asset('public/vendor/plugins/File-Upload/js/jquery.fileupload.js')); ?>"></script>-->
<!-- =========== /FORM ========== -->
<!-- =========== INDEX ========== -->

<!-- funções criadas -->
<script src="<?php echo e(asset('public/js/funcoes.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/ajax.js')); ?>"></script>
<!-- para mascarar os inputs adionar apenas as classes abaixo -->
<script type="text/javascript">
$(document).ready(function($){
  $('.numero').mask('00000000');
  $('.cnh').mask('000000000000000');
  $('.placa').mask('AAA-9999');
  $('.despacho').mask('00000/0000',{reverse: true});
  $('.date').mask('00/00/0000');
  $('.time').mask('00:00:00');
  $('.date_time').mask('00/00/0000 00:00:00');
  $('.cep').mask('00000-000');
  $('.fone').mask('0000-0000');
  $('.fone_com_ddd').mask('(00) 0000-0000');
  $('.celular').mask('(00) 00000-0000');
  $('.mixed').mask('AAA 000-S0S');
  $('.rg').mask("#.##0-0", {reverse: true});
  $('.cpf').mask('000.000.000-00', {reverse: true});
  $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
  $('.dinheiro').mask('000.000.000.000.000,00', {reverse: true});
  $('.dinheiro2').mask("#.##0,00", {reverse: true});
  $('.ip').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
    translation: {
      'Z': {
        pattern: /[0-9]/, optional: true
      }
    }
  });
  $('.ip_address').mask('099.099.099.099');
  $('.porcento').mask('##0,00%', {reverse: true});
  $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
  $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
  $('.fallback').mask("00r00r0000", {
      translation: {
        'r': {
          pattern: /[\/]/,
          fallback: '/'
        },
        placeholder: "__/__/____"
      }
    });
  $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});
});
</script>
<!-- Easy Autocomplete -->
<script src="<?php echo e(asset('public/vendor/plugins/EasyAutocomplete/jquery.easy-autocomplete.min.js')); ?>"></script>

