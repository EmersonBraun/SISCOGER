var aguardando=false;

try{
    xmlhttp = new XMLHttpRequest();
}
catch(ee){
    try{
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }catch(e){
        try{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }catch(E){
            xmlhttp = false;
        }
    }
}
//endereço do servidor
var url = window.location.origin;
url += '/siscoger/';
//token
var _token = $('input[name="_token"]').val();
var indice=0;

function addObjectForm (tabela, modulo, unico) {
    /* compatibilidade com já existentes
	* como o campo é montado dinamicamente, fica complicado pegar qual é o número atual para 
	* continuar a atualização, então a solução é saber se o campo obrigatório de inserção está
	* preenchido para saber que se trata de atualização
	*/

	var atualizacao = $("input[name*='sjd_ref']").val();
	console.log(atualizacao);
	if (atualizacao > 0) {
		indice = Math.floor(Math.random() * 65536) - 32768;
	}
    indice++;

    var divAlvo=tabela+"Form";

    $.ajax({
        url: url+'ajax/add/form',
        method: "POST",
        data: 
        {
            _token: _token,
            tabela: tabela,
            indice: indice,
            modulo: modulo,
            unico: unico,
        },
        success: function(texto){
            texto=texto.replace(/\+/g," ");
            texto=unescape(texto);
            var novaDiv=document.createElement('div');
            novaDiv.innerHTML=texto+"\r\n";
            var numeroDiv=indice.toString();
            novaDiv.id=tabela+"Form"+numeroDiv;
            document.getElementById(divAlvo).appendChild(novaDiv);

        }
    });


}

function removerForm (tabela, idNodo) {

	//Define as variáves com o nome da Div a ser excluída
	var pai=document.getElementById(tabela+"Form");
	var filho=document.getElementById(tabela+"Form"+idNodo);
	//Deixa a mensagem processando

	//Pega o Id para excluir por Ajax
	campoIdBanco=tabela+"["+idNodo+"]"+"[id_"+tabela+"]";
	var campoExcluir=document.getElementsByName(campoIdBanco)[0]; //alert(campoIdBanco)
	var idExcluir=campoExcluir.value;

	if (idExcluir!="") {
		filho.innerHTML="<span id=\"aviso\" class=\"aviso\">Excluindo...</span>";
		//Chama o arquivo ajax de Exclusão
		var urlAjax="ajax/remove/"+tabela+"/"+idExcluir;
		//window.alert(urlAjax);

		xmlhttp.open("GET",urlAjax,true);
		//Executada quando o navegador obtiver o código
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4){
			//Lê o texto
			var texto=xmlhttp.responseText
			texto=texto.replace(/\+/g," ")
			texto=unescape(texto)
			    //Remove a Div
                if (filho) {
                    var removido=pai.removeChild(filho);
                }
        	}
		}
	xmlhttp.send(null)
	}
	else {
		if (filho) {
			var removido=pai.removeChild(filho);
		}
	}
}

function ajaxLigacao(indice) {

	//Indice e um numero
	//Esse ajax funciona com o subformulario ligacao/subformulario.inc
	//Para dar feedback ao usuario sobre o procedimento que ele esta linkando
	//
	//Ira pegar os IDs: proc+indice, ref+indice, ano+indice
	// --- proc = procedimento (ex: ipm, apfd, etc).
	// --- ref  = sjd_ref nas tabelas
	// --- ano  = ano nas tabelas
	//
	//Chama o arquivo ajax/ajax.ligacao.php

	// if (aguardando) return false;
	// aguardando=true;
	
	IdCampoAlvo="opm"+indice;
	//Pega as variaveis que ira usar no ajax
    var proc= $("#proc"+indice).val();
    var ref = $("#ref"+indice).val();
    var ano = $("#ano"+indice).val();
 
	//if (!proc || !ref || !ano) { aguardando=false; return false; }

	//Exibe o texto carregando no campo ID opm+indice
	//document.getElementById(IdCampoAlvo).value='...carregando...';
	
    $.ajax({
        url: url+'ajax/ligacao',
        method: "POST",
        data: 
        {
            _token: _token,
            proc: proc,
            ref: ref,
            ano: ano
        },
        success: function(texto){
            
            // var texto=xmlhttp.responseText;
            texto=texto.replace(/\+/g," ");
            texto=unescape(texto);

            //Exibe o texto no opm+indice
            document.getElementById(IdCampoAlvo).value=texto;
            //aguardando=false;
        }
        
    });
}
