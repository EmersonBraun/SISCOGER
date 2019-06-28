<?php 
/*************************************************
incluir nos controller para usar as funções existentes
*************************************************/

//variáveis necessárias para o opm_select >> compact('opms','selected','firstGroup')
include(base_path('app/includes/opms.php'));

/*************************************************
incluir nas views para usar funções javascript
*************************************************/
//para o uso do data table, use id='example1'
//@include('vendor.adminlte.includes.tabelas')

//para o uso do select2, use class='select2'
//@include('vendor.adminlte.includes.select2')

//helpers criados - foram incluidos no composer.json da raiz do sistema
/*
"autoload": {
        "classmap": [
            "database/seeds",
            "database/factories"
        ],
        "psr-4": {
            "App\\": "app/"
        },
        "files": [
            "app/Helpers/special_ucwords.php",
            "app/Helpers/corta_zeros.php",
            "app/Helpers/completa_zeros.php",
            "app/Helpers/sistema.php",
            "app/Helpers/tira_acentos.php",
            "app/Helpers/limpa_formatacao.php",
            "app/Helpers/opm.php",
            "app/Helpers/dif_dias.php",
            "app/Helpers/pm.php"
        ]
    }
*/