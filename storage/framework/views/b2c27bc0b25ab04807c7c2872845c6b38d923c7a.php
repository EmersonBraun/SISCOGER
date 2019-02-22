<script type="text/javascript">
    //Função para dar opções de autocompletar o nome
    var options = {
    
    url: function(phrase) {
      return "<?php echo route('busca.opcoesnome'); ?>";
    },
    
    getValue: function(element) {
      return element.NOME;
    },

    list: {
        onSelectItemEvent: function() {
            var selectedItemValue = $("#nome").getSelectedItemData().RG;

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
        return element.RG;
    },

    list: {
        onSelectItemEvent: function() {
            var selectedItemValue = $("#rg").getSelectedItemData().NOME;

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