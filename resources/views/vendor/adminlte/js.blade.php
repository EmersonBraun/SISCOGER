<!-- =========== GERAIS ========== -->
<!-- Bootstrap 4 -->
<script src="{{ asset('public/vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
{{-- <script src="{{ asset('public/vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script> --}}
<script src="{{ asset('public/vendor/plugins/bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('public/vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/vendor/plugins/jQueryUI/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button)
</script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
// Setup - add a text input to each footer cell
$('#datable tfoot th').each( function () {
    var title = $(this).text();
    $(this).html( '<input type="text" style="max-width:100px" placeholder="'+title+'" />' );
} );

// DataTable
var table =  $('#datable').DataTable({
    'ajax' : false,
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false,
    "order": [[ 0, "desc" ]],

        "language": {
        "sEmptyTable":   "Nenhum registro encontrado",
        "sProcessing":   "A processar...",
        "sLengthMenu":   "Mostrar _MENU_ registos",
        "sZeroRecords":  "Não foram encontrados resultados",
        "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registos",
        "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registos",
        "sInfoFiltered": "(filtrado de _MAX_ registos no total)",
        "sInfoPostFix":  "",
        "sSearch":       "Procurar:",
        "sUrl":          "",
        "oPaginate": {
            "sFirst":    "Primeiro",
            "sPrevious": "Anterior",
            "sNext":     "Seguinte",
            "sLast":     "Último"
        },
        "oAria": {
            "sSortAscending":  ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
        }
        }
    });

// Apply the search
table.columns().every( function () {
    var that = this;

    $( 'input', this.footer() ).on( 'keyup change', function () {
        if ( that.search() !== this.value ) {
            that
                .search( this.value )
                .draw();
        }
    } );
} );  
</script>
<!-- toaster -->
<script src="{{ asset('public/vendor/plugins/toastr/toastr.js') }}"></script>
<!-- =========== /GERAIS ========== -->
<!-- =========== FORM ========== -->
<!-- InputMask 
{{-- <script src="{{ asset('public/vendor/plugins/input-mask/jquery.inputmask.js') }}"></script> --}}
{{-- <script src="{{ asset('public/vendor/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script> --}}
{{-- <script src="{{ asset('public/vendor/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>--> --}}
{{-- <!-- InputMask --> --}}
{{-- <script src="{{ asset('public/vendor/plugins/mask/dist/jquery.mask.js') }}"></script> --}}
{{-- <!-- file upload  --}}
{{-- <script src="{{ asset('public/vendor/plugins/File-Upload/js/vendor/jquery.ui.widget.js') }}"></script> --}}
{{-- <script src="{{ asset('public/vendor/plugins/File-Upload/js/jquery.fileupload.js') }}"></script>--> --}}
{{-- <!-- =========== /FORM ========== --> --}}
{{-- <!-- =========== INDEX ========== --> --}}

{{-- <!-- funções criadas --> --}}
<script src="{{ asset('public/js/funcoes.js') }}"></script>
<script src="{{ asset('public/js/ajax.js') }}"></script> -->
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
{{-- <script src="{{ asset('public/vendor/plugins/EasyAutocomplete/jquery.easy-autocomplete.min.js') }}"></script> --}}

