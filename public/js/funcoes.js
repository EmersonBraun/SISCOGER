//função para campo de busca envia rg e retorn nome e posto
function completaDados(rg,nome,posto)
{
    //endereço do servidor
    var url = window.location.origin;
    //token
    var _token = $('input[name="_token"]').val();
    
    $.ajax({
        url: url+"/siscoger/busca/completadados",
        method: "POST",
        data: {
        _token: _token,
        'rg': rg
        },
        success: function(result){
            
            if(result != '')
            {
                $('#'+nome).val(result.NOME);
                $('#'+posto).val(result.CARGO);
            }
            else
            {
                $('#'+nome).val('Não encontrado');
                $('#'+posto).val('Não encontrado');
            }
        }
    });
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

function removerArquivo(content){
    //endereço do servidor
    var url = window.location.origin;
    //token
    var _token = $('input[name="_token"]').val();

    //conteúdo enviado (proced-nome)
    var res = content.name;
    var divide = res.split('-');

    //separar em variáveis
    proced = divide[0];
    nome = divide[1];

    //pegar o id
    var str = divide[2];
    var id = str.replace(/[^\d]+/g,'');
    
    //extenção
    var exte = str.split('.');
    var ext = exte[1];

    $.confirm({
        icon: 'fa fa-warning',
        title: 'Remover o arquivo',
        content: 'Tem certeza que quer remover?',
        //type: 'red',
        typeAnimated: true,
        buttons: {
            confirmar: function () {

                $.ajax({
                    url: url+"/siscoger/upload/remover",
                    method: "POST",
                    type: "json",
                    data: {
                    _token: _token,
                    'proced': proced,
                    'id': id,
                    'nome': nome,
                    'ext': ext
                    },
                    success: function(data){
                        //$.alert(data.objeto);
                        $("#remove-"+nome).hide();
                        $("#add-"+nome).show();  
                        $.alert('Apagado!');
                        window.location.reload(true);
                    }
                });

            },
            cancelar: function () {

                $.alert('Canceledo!');

            },
        }
    }); 
    
}

// Confirmar apagar procedimento
function removerProcedimento(proced, ref, ano){

    $.confirm({
        icon: 'fa fa-warning',
        title: 'Apagar '+proced+' '+ref+'/'+ano,
        content: 'Tem certeza que quer remover?',
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
        // $.each(Zopm, function(key, value)){
        //     if (item != '0'){
        //         object.splice(index, 1);
        //     }else{
        //         break;
        //     }
        //     console.log(Zopm);
        // });
        //if (opmRetorno=="") return "0";
        
    }
}





