//função para campo de busca envia rg e retorn nome e posto
function completaDados(rg,nome,posto, quadro='')
{
    //endereço do servidor
    let url = window.location.origin;
    //token
    let _token = $('input[name="_token"]').val();
    
    $.ajax({
        url: url+"/siscoger/busca/completadados",
        method: "POST",
        data: {
        _token: _token,
        'rg': $(rg).val()
        },
        success: function(result){
            if(result != '')
            {
                $(nome).val(result.NOME);
                $(posto).val(result.CARGO);
                $(quadro).val(result.QUADRO);
            }
            else
            {
                $(nome).val('Não encontrado');
                $(posto).val('Não encontrado');
                $(quadro).val('Não encontrado');
            }
        }
    });
}


// para alterar opções do formulário
function toogleOpt(opt,toogle){
    if(opt == toogle[0]){
        $('#'+toogle[0]).show();
        $('#'+toogle[1]).hide();
    }
    if(opt == toogle[1]){
        $('#'+toogle[1]).show();
        $('#'+toogle[0]).hide();
    }
}

//toogle dos cards
function expandirTudo(){
    $( ".box" ).removeClass( "collapsed-box" );
    $( ".box-body" ).show();
    $( ".fa-plus" ).removeClass( "fa-plus" ).addClass( "fa-minus" );
}
function recolherTudo(){
    $( ".box" ).addClass( "collapsed-box" );
    $( ".box-body" ).hide();
    $( ".fa-minus" ).removeClass( "fa-minus" ).addClass( "fa-plus" );
}

// Confirmar apagar GERAL
function confirmar(mensagem){

    $.confirm({
        icon: 'fa fa-warning',
        title: mensagem,
        content: 'Tem certeza que quer apagar?',
        //type: 'red',
        typeAnimated: true,
        buttons: {
            confirmar: function () {

                $.alert('apagado!');
            },
            cancelar: function () {

                $.alert('Canceledo!');

            },
        }
    });   
}

function corta_zeros(codigo){
	console.log(codigo);
    var opmRetorno = 0;
    if(codigo == "0000000000") {
        return "0";
    }else{
        var i = codigo.length;
        while (i--) {
            if(codigo.charAt(i) != 0){
                opmRetorno += codigo.charAt(i);
            }else{
                break;
            }
        console.log(opmRetorno);
        }        
    }
}

function mudaTab(id)
{
    $('.a').removeClass('active');
    $('.'+id).addClass('active');
    $('.tab-pane').removeClass('show');
    $('.tab-pane').removeClass('active');
    $('#'+id).addClass('active');
    $('#'+id).addClass('show');
}

$(document).ready(function () {
    // inicialição do datatable
    $('#datable tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control" placeholder="'+title+'" />' );
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

    // input mask
    // $('.numero').mask('00000000');
    // $('.cnh').mask('000000000000000');
    // $('.placa').mask('AAA-9999');
    // $('.despacho').mask('00000/0000',{reverse: true});
    // $('.date').mask('00/00/0000');
    // $('.time').mask('00:00:00');
    // $('.date_time').mask('00/00/0000 00:00:00');
    // $('.cep').mask('00000-000');
    // $('.fone').mask('0000-0000');
    // $('.fone_com_ddd').mask('(00) 0000-0000');
    // $('.celular').mask('(00) 00000-0000');
    // $('.mixed').mask('AAA 000-S0S');
    // $('.rg').mask("#.##0-0", {reverse: true});
    // $('.cpf').mask('000.000.000-00', {reverse: true});
    // $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    // $('.dinheiro').mask('000.000.000.000.000,00', {reverse: true});
    // $('.dinheiro2').mask("#.##0,00", {reverse: true});
    // $('.ip').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
    //     translation: {
    //     'Z': {
    //         pattern: /[0-9]/, optional: true
    //     }
    //     }
    // });
    // $('.ip_address').mask('099.099.099.099');
    // $('.porcento').mask('##0,00%', {reverse: true});
    // $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
    // $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
    // $('.fallback').mask("00r00r0000", {
    //     translation: {
    //         'r': {
    //         pattern: /[\/]/,
    //         fallback: '/'
    //         },
    //         placeholder: "__/__/____"
    //     }
    //     });
    // $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});
});





