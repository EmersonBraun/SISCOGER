<!-- =========== GERAIS ========== -->
<!-- Bootstrap 4 -->
<script src="{{ asset('public/vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('public/vendor/plugins/bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('public/vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https:////cdn.datatables.net/plug-ins/1.10.19/features/searchHighlight/dataTables.searchHighlight.css">

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.19/features/searchHighlight/dataTables.searchHighlight.min.js"></script>
<script src="https://bartaz.github.io/sandbox.js/jquery.highlight.js"></script>


<script type="text/javascript">
$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#datable tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" style="max-width:100px" placeholder="'+title+'" />' );
    } );

    var lang = {
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
        },
        'buttons': {
            'copy': 'Copiar',
            'print': 'Imprimir',
            'copyTitle': 'Adicionado à área de transferência',
            'copyKeys': 'Pressione <i> ctrl </i> ou <i> \u2318 </i> + <i>C</i> para copiar os dados da tabela para a área de transferência. <br> <br> Para cancelar, clique nesta mensagem ou pressione Esc.',
            'copySuccess': {
                _: '%d linhas copiadas',
                1: '1 linha copiada'
            }
        }
    };

    var config = {
        'ajax' : false,
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        "language": lang,
        "order": [[ 0, "desc" ]],
        "dom": 'Bflrtip',
        "buttons": [
            'copy', 'excel', 'pdf', 'print'
        ],
        'searchHighlight': true
    };

    // DataTable
    var table =  $('#datable').DataTable(config);

    // Apply the search
    table.columns().every( function () {
        var that = this;

        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that.search( this.value ).draw();
            }
        } );
    } ); 
});
</script>
<!-- toaster -->
<script src="{{ asset('public/vendor/plugins/toastr/toastr.js') }}"></script>
<script src="{{ asset('public/vendor/plugins/mask/dist/jquery.mask.js') }}"></script>

<!--funções criadas -->
<script src="{{ asset('public/js/funcoes.js') }}"></script>
<script src="{{ asset('public/js/ajax.js') }}"></script> 
<!-- para mascarar os inputs adionar apenas as classes abaixo -->
<script>
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

