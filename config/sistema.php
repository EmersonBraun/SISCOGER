<?php
/*
* dados que existiam em tabelas do sistema antigo foram transcritas neste documento para auxiliar na compatibilidade
* outros dados para uso geral podem ser inseridos para auxiliar
*/
return [
    // show_error - false = para tratar os erros, true =para mostrar os erros nas requisições
    'show_error' => false,
    //quantidade de dias que decidirem que é o tempo máximo em dias que o usuário pode ficar sem acessar o sistema*/
    'tempo_inatividade' => 40,

    //versão do sistema
    'versao' => '1.0-alfa',

    //desenvolvedores - para quem estiver lá na frente saber quem já mexeu no código
    'desenvolvedores' =>
    [
        '1' => 'Sd Braun'
    ],

    //Super usuários do sistema
    'super-users' =>
    [
        'user' => '53091156',//Major Heitor
        'user' => '77590021',//Cap Todisco
        'user' => '103804957',//Sd Braun
    ],

    //diretório padrão de arquivos
    'diretorio' => 'storage/arquivo',

    //cores default (para gráficos, etc)
    'default_colors' => 
    [
        '#3366CC',
        '#DC3912',
        '#FF9900',
        '#109618',
        '#990099',
        '#3B3EAC',
        '#0099C6',
        '#DD4477',
        '#66AA00',
        '#B82E2E',
        '#316395',
        '#994499',
        '#22AA99',
        '#AAAA11',
        '#6633CC',
        '#E67300',
        '#8B0707',
        '#329262',
        '#5574A6',
        '#3B3EAC'
    ],

    /*
     * POSTO . busca pelo nome que tem na coluna "CARGO" do RHPARANA como exemplo
     * $posto = array_get(config('sistema.posto'), $pm->CARGO);
     * para poder devolver o id e fazer comparativos de superioridade.
     */

    // ---- INFORMAÇÕES USUÁRIO -------
    
    'posto' => 
    [
        'CELAGREG' => '0',
        'CEL' => '1',
        'TENCEL' => '2',
        'MAJ' => '3',
        'CAP' => '4',
        '1TEN' => '5',
        '2TEN' => '6',
        'ASPOF' => '7',
        'ALUNO' => '8',
        'ALUNO3A' => '9',
        'ALUNO2A' => '10',
        'ALUNO1A' => '11',
        'SUBTEN' => '12',
        '1SGT' => '13',
        '2SGT' => '14',
        '3SGT' => '15',
        'CABO' => '16',
        'SD1C' => '17',
        'SD2C' => '18',
        'NULL' => '99'
    ],

    'postos' => 
    [
        'CELAGREG' => 'CELAGREG',
        'CEL' => 'CEL',
        'TENCEL' => 'TENCEL',
        'MAJ' => 'MAJ',
        'CAP' => 'CAP',
        '1TEN' => '1TEN',
        '2TEN' => '2TEN',
        'ASPOF' => 'ASPOF',
        'ALUNO' => 'ALUNO',
        'ALUNO3A' => 'ALUNO3A',
        'ALUNO2A' => 'ALUNO2A',
        'ALUNO1A' => 'ALUNO1A',
        'SUBTEN' => 'SUBTEN',
        '1SGT' => '1SGT',
        '2SGT' => '2SGT',
        '3SGT' => '3SGT',
        'CABO' => 'CABO',
        'SD1C' => 'SD1C',
        'SD2C' => 'SD2C',
        'NULL' => 'Nâo encontrado'
    ],

    'quadros' => 
    [
        'QPMG1' => 'QPMG1', 
        'QPMG2' => 'QPMG2', 
        'QOPM' => 'QOPM',
        'QOBM' => 'QOBM',
        'QEOPM' => 'QEOPM',
        'QOS' => 'QOS',
        'PM' => 'PM',
        'BM' => 'BM',
        'NULL' => 'Nâo encontrado'
    ],
    
    'classPunicao' =>
    [
        "1" => "Leve",
        "2" => "Média",
        "3" => "Grave"
    ],

    'gradacao' =>
    [
        "1" => "Advertência", 
        "2" => "Impedimento Disciplinar", 
        "3" => "Repreensão", 
        "4" => "Detenção", 
        "5" => "Prisão",
    ],

    'genero' =>
    [
        "1" => "masculino",
        "2" => "feminino"
    ],

    'comportamento' =>
    [
        "1" => "Excepcional",
        "2" => "Ótimo",
        "3" => "Bom",
        "4" => "Insuficiente",
        "5" => "Mau",
        "0" => "Não se Aplica"
    ],

    // ---- TIPOS DE PROCEDIMENTOS -----------------------------------------------------------------
    
    'procedimentosTipos' =>
    [
        "ADL" => "Apuração Disciplinar de Licenciamento",
        "APFD" => "Auto de Prisão em Flagrante Delito",
        "CD" => "Conselho de Disciplina",
        "CJ" => "Conselho de Justificação",
        "DESERCAO" => "Deserção",
        "FATD" => "Formulário de Apuração de Transgressão Disciplinar",
        "IPM" => "Inquérito Policial Militar",
        "IT" => "Inquérito Técnico",
        "ISO" => "Inquérito Sanitário de Origem",
        "SINDICANCIA" => "Sindicância",
        "SAI" => "Investigação Policial",
        "PROCOUTROS" => "Procedimento Outros",
        "PAD" => "Processo Administrativo"
    ],

    'pocedimentosOpcoes' =>
    [
        "",
        "ipm",
        "sindicancia",
        "cd",
        "cj",
        "apfdc",
        "apfdm",
        "fatd",
        "iso",
        "desercao",
        "it",
        "adl",
        "pad",
        "sai",
        "proc_outros"
    ],
    
    'procedimentos' => 
    [
        "ipm",
        "sindicancia",
        "cd",
        "cj",
        "apfd",
        "fatd",
        "iso",
        "desercao",
        "it",
        "adl",
        "pad",
        "sai",
        "proc_outros"
    ],

    'procSituacao' =>
    [
        '' => 'Indiciado',
        'adl' => 'Acusado',
        'ipm' => 'Indiciado',
        'cj' => 'Justificante',
        'cd' => 'Acusado',
        'sindicancia' => 'Sindicado',
        'fatd' => 'Acusado',
        'iso' => 'Paciente',
        'desercao' => 'Desertor',
        'apfd' => 'Acusado',
        'it' => 'Condutor',
        'sai' => 'Denunciado',
        'proc_outros' => 'Envolvido'
    ],

    'procTiposAcusados' =>
    [
        'Acusado',
        'Condutor',
        'Denunciado',
        'Desertor',
        'Envolvido',
        'Indiciado',
        'Justificante',
        'Paciente',
        'Sindicado'
    ],
    
    // ---- ANDAMENTO -----------------------------------------------------------------------------

    /*
    *$andamento = array_get(config('sistema.andamento'), $proc->id_andamento);
    */

    'andamento' =>
    [
        "" => "NÃO HÁ",
        "0" => "NÃO HÁ",
        "1" => "ANDAMENTO",
        "2" => "CONCLUÍDO",
        "3" => "SOBRESTADO",
        "4" => "ANDAMENTO",
        "5" => "CONCLUÍDO",
        "6" => "ANDAMENTO",
        "7" => "CONCLUÍDO",
        "8" => "SOBRESTADO",
        "9" => "ANDAMENTO",
        "10" => "CONCLUÍDO",
        "11" => "SOBRESTADO",
        "12" => "ANDAMENTO",
        "13" => "CONCLUÍDO",
        "14" => "SOBRESTADO",
        "15" => "ANDAMENTO",
        "16" => "CONCLUÍDO",
        "17" => "SOBRESTADO",
        "18" => "ANDAMENTO",
        "19" => "CONCLUÍDO",
        "20" => "SOBRESTADO",
        "21" => "ANDAMENTO",
        "22" => "CONCLUÍDO",
        "23" => "SOBRESTADO",
        "24" => "ANDAMENTO",
        "25" => "CONCLUIDO",
        "26" => "ABERTURA",
        "27" => "ARQUIVO",
        "28" => "FATD",
        "29" => "SINDICÂNCIA",
        "30" => "IPM",
        "31" => "CD",
        "32" => "ADL",
        "33" => "CJ"
    ],

    'andamentoUnico' =>
    [
        "" => "Todos",
        "ANDAMENTO" => "ANDAMENTO",
        "CONCLUÍDO" => "CONCLUÍDO",
        "SOBRESTADO" => "SOBRESTADO",
        "ABERTURA" => "ABERTURA",
        "ARQUIVO" => "ARQUIVO",
        "FATD" => "FATD",
        "SINDICÂNCIA" => "SINDICÂNCIA",
        "IPM" => "IPM",
        "CD" => "CD",
        "ADL" => "ADL",
        "CJ" => "CJ",
        "ANÁLISE DO CMT" => "ANÁLISE DO CMT"
    ],

    'andamentoFATD' =>
    [
        "1" => "ANDAMENTO",
        "2" => "CONCLUÍDO",
        "3" => "SOBRESTADO"
    ],

    'andamentoIPM' =>
    [
        ""  => "SELECIONE",
        "4" => "ANDAMENTO",
        "5" => "CONCLUÍDO"
    ],

    'andamentoSindicancia' =>
    [
        ""  => "SELECIONE",
        "6" => "ANDAMENTO",
        "7" => "CONCLUÍDO",
        "8" => "SOBRESTADO"
    ],

    'andamentoCD' =>
    [
        ""  => "SELECIONE",
        "9" => "ANDAMENTO",
        "10" => "CONCLUÍDO",
        "11" => "SOBRESTADO"
    ],

    'andamentoCJ' =>
    [
        ""  => "SELECIONE",
        "12" => "ANDAMENTO",
        "13" => "CONCLUÍDO",
        "14" => "SOBRESTADO"
    ],

    'andamentoADL' =>
    [
        ""  => "SELECIONE",
        "15" => "ANDAMENTO",
        "16" => "CONCLUÍDO",
        "17" => "SOBRESTADO"
    ],

    'andamentoISO' =>
    [
        ""  => "SELECIONE",
        "18" => "ANDAMENTO",
        "19" => "CONCLUÍDO",
        "20" => "SOBRESTADO"
    ],

    'andamentoIT' =>
    [
        ""  => "SELECIONE",
        "21" => "ANDAMENTO",
        "22" => "CONCLUÍDO",
        "23" => "SOBRESTADO"
    ],

    'andamentoPAD' =>
    [
        ""  => "SELECIONE",
        "24" => "ANDAMENTO",
        "25" => "CONCLUIDO"
    ],

    'andamentoSAI' =>
    [
        ""  => "SELECIONE",
        "26" => "ABERTURA",
        "27" => "ARQUIVO",
        "28" => "FATD",
        "29" => "SINDICÂNCIA",
        "30" => "IPM",
        "31" => "CD",
        "32" => "ADL",
        "33" => "CJ"
    ],

    // ---- ANDAMENTO COGER -----------------------------------------------------------------------
    
    /*
    *$andamentocoger = array_get(config('sistema.andamentocoger'), $proc->id_andamentocoger);
    */
    
    'andamentocoger' =>
    [
        "0" => "NÃO HÁ",
        "1" => "DECIDIDO",
        "2" => "RECONSIDERAÇÃO DE ATO",
        "3" => "TJPR",
        "4" => "TJPR/RECURSO DISC.",
        "5" => "GOVERNADOR P/ DECRETO",
        "6" => "ARQUIVADO",
        "19" => "VAJME",
        "8" => "DECIDIDA CG",
        "9" => "VAJME",
        "10" => "VAJME/PGE",
        "11" => "ARQUIVADA",
        "12" => "ARQUIVADA VAJME",
        "18" => "DECIDIDO CG",
        "14" => "DECIDIDO CG",
        "15" => "RECONSIDERAÇÃO DE ATO",
        "16" => "RECURSO DISCIPLINAR",
        "17" => "ARQUIVADO",
        "20" => "ARQUIVADO VAJME",
        "21" => "DECIDIDO",
        "22" => "RECONSIDERAÇÃO DE ATO",
        "23" => "TJPR",
        "24" => "TJPR/RECURSO DISC.",
        "25" => "GOVERNADOR P/ DECRETO",
        "26" => "ARQUIVADO",
        "27" => "RECONSIDERAÇÃO DE ATO",
        "28" => "TJPR",
        "29" => "TJPR/RECURSO DISC.",
        "30" => "GOVERNADOR PARA DECRETO",
        "31" => "ARQUIVADO",
        "32" => "DECIDIGO CG",
        "33" => "VAJME",
        "34" => "VAJME/PGE",
        "35" => "PGE",
        "36" => "ARQUIVADO",
        "37" => "RECURSO DISC.",
        "38" => "RECURSO DISC.",
        "39" => "SOLUCIONADO",
        "40" => "ARQUIVADO",
        "41" => "VAJME",
        "42" => "ARQUIVADO VAJME",
        "43" => "VAJME",
        "44" => "ARQUIVADO VAJME",
        "45" => "JUSTICA COMUM",
        "46" => "ARQUIVADO/JUST. COMUM",
        "47" => "COGER",
        "48" => "COGER",
        "49" => "COGER",
        "50" => "COGER",
        "51" => "COGER",
        "52" => "COGER",
        "53" => "COGER",
        "54" => "COGER",
        "55" => "COGER",
        "56" => "COGER",
        "57" => "JUSTICA COMUM",
        "58" => "ARQ. JUST. COMUM",
        "59" => "JUSTICA COMUM",
        "60" => "ARQUIVADO/JUST. COMUM",
        "61" => "COMISSAO PROCESSANTE",
        "62" => "COM. PROC. PERMANENTE",
        "63" => "COM. PROC. PERMANENTE",
        "64" => "COM. PROC. PERMANENTE",
        "65" => "COM. PROCESSANTE",
        "66" => "COM. PROCESSANTE",
        "67" => "COM. PROCESSANTE",
        "68" => "CPP",
        "69" => "CPO",
        "70" => "COMISSAO MERITO",
        "71" => "VAJME",
        "72" => "COGER",
        "73" => "CEF",
        "74" => "ARQUIVO",
        "75" => "OUTRO",
        "76" => "JUNTA MÉDICA",
        "77" => "SEÇÃO IT",
        "78" => "DER",
        "79" => "SESP",
        "80" => "ANÁLISE",
        "81" => "ARQUIVO",
        "82" => "CAI",
        "83" => "CHEFE SAI",
        "84" => "SUB CHEFE SAI",
        "85" => "SARGENTEAÇÃO",
        "86" => "OPERAÇÕES",
        "87" => "PESQUISA",
        "88" => "UNIDADE",
        "89" => "Poder Judiciário",
        "90" => "Ministério Público",
        "91" => "Delegacia de Polícia",
        "92" => "Inteligência",
        "93" => "DILIGÊNCIAS"
    ],

    'andamentocogerFATD' =>
    [
        "14" => "DECIDIDO CG",
        "15" => "RECONSIDERAÇÃO DE ATO",
        "16" => "RECURSO DISCIPLINAR",
        "17" => "ARQUIVADO",
        "49" => "COGER",
        "61" => "COMISSAO PROCESSANTE",
        "71" => "VAJME"
    ],

    'andamentocogerIPM' =>
    [
        ""  => "SELECIONE",
        "18" => "DECIDIDO CG",
        "19" => "VAJME",
        "20" => "ARQUIVADO VAJME",
        "45" => "JUSTICA COMUM",
        "46" => "ARQUIVADO/JUST. COMUM",
        "47" => "COGER"
    ],

    'andamentocogerSindicancia' =>
    [
        ""  => "SELECIONE",
        "8" => "DECIDIDA CG",
        "9" => "VAJME",
        "10" => "VAJME/PGE",
        "11" => "ARQUIVADA",
        "12" => "ARQUIVADA VAJME",
        "48" => "COGER",
        "57" => "JUSTICA COMUM",
        "58" => "ARQ. JUST. COMUM",
        "68" => "CPP",
        "69" => "CPO",
        "70" => "COMISSAO MERITO"
    ],

    'andamentocogerCD' =>
    [
        ""  => "SELECIONE",
        "21" => "DECIDIDO",
        "22" => "RECONSIDERAÇÃO DE ATO",
        "23" => "TJPR",
        "24" => "TJPR/RECURSO DISC.",
        "25" => "GOVERNADOR P/ DECRETO",
        "26" => "ARQUIVADO",
        "37" => "RECURSO DISC.",
        "54" => "COGER",
        "62" => "COM. PROC. PERMANENTE",
        "66" => "COM. PROCESSANTE"
    ],

    'andamentocogerCJ' =>
    [
        ""  => "SELECIONE",
        "27" => "RECONSIDERAÇÃO DE ATO",
        "28" => "TJPR",
        "29" => "TJPR/RECURSO DISC.",
        "30" => "GOVERNADOR PARA DECRETO",
        "31" => "ARQUIVADO",
        "53" => "COGER",
        "63" => "COM. PROC. PERMANENTE",
        "67" => "COM. PROCESSANTE"
    ],

    'andamentocogerADL' =>
    [
        ""  => "SELECIONE",
        "1" => "DECIDIDO",
        "2" => "RECONSIDERAÇÃO DE ATO",
        "3" => "TJPR",
        "4" => "TJPR/RECURSO DISC.",
        "5" => "GOVERNADOR P/ DECRETO",
        "6" => "ARQUIVADO",
        "38" => "RECURSO DISC.",
        "55" => "COGER",
        "64" => "COM. PROC. PERMANENTE",
        "65" => "COM. PROCESSANTE",
    ],

    'andamentocogerISO' =>
    [
        ""  => "SELECIONE",
        "39" => "SOLUCIONADO",
        "40" => "ARQUIVADO",
        "56" => "COGER",
        "76" => "JUNTA MÉDICA"
    ],

    'andamentocogerIT' =>
    [
        ""  => "SELECIONE",
        "32" => "DECIDIGO CG",
        "33" => "VAJME",
        "34" => "VAJME/PGE",
        "35" => "PGE",
        "36" => "ARQUIVADO",
        "52" => "COGER",
        "77" => "SEÇÃO IT",
        "78" => "DER",
        "79" => "SESP",
        "93" => "DILIGÊNCIAS"
    ],

    'andamentocogerPAD' =>
    [
        ""  => "SELECIONE",
        "72" => "COGER",
        "73" => "CEF",
        "74" => "ARQUIVO",
        "75" => "OUTRO"
    ],

    'andamentocogerSAI' =>
    [
        ""  => "SELECIONE",
        "80" => "ANÁLISE",
        "81" => "ARQUIVO",
        "82" => "CAI",
        "83" => "CHEFE SAI",
        "84" => "SUB CHEFE SAI",
        "85" => "SARGENTEAÇÃO",
        "86" => "OPERAÇÕES",
        "87" => "PESQUISA",
        "88" => "UNIDADE",
        "89" => "Poder Judiciário",
        "90" => "Ministério Público",
        "91" => "Delegacia de Polícia",
        "92" => "Inteligência"
    ],

    'adamentocogerDesercao' => 
    [
        ""  => "SELECIONE",
        "41" => "VAJME",
        "42" => "ARQUIVADO VAJME",
        "50" => "COGER"
    ],

    'andamentocogerAPFD' => 
    [
        ""  => "SELECIONE",
        "43" => "VAJME",
        "44" => "ARQUIVADO VAJME",
        "51" => "COGER",
        "59" => "JUSTICA COMUM",
        "60" => "ARQUIVADO/JUST. COMUM"
    ],

    // ---- RESULTADO -----------------------------------------------------------------------

    'resultado' => 
    [
        "1" => "Punido",
        "2" => "Absolvido",
        "3" => "Excluído",
        "4" => "Punido",
        "5" => "Absolvido",
        "6" => "Excluído",
        "7" => "Punido",
        "8" => "Absolvido",
        "9" => "Excluído",
        "10" => "Punido",
        "11" => "Absolvido",
        "12" => "FATD",
        "13" => "Conselho Just.",
        "14" => "Conselho Disc.",
        "15" => "Arquivamento",
        "16" => "IPM",
        "17" => "Sindicancia",
        "18" => "Nao ha indicios",
        "19" => "Indicios Crime",
        "20" => "ADL",
        "21" => "Indicios Transgressao",
        "22" => "Ind. Crime Transg.",
        "23" => "Outra medida",
        "24" => "Perda objeto",
        "25" => "Prescricao",
        "26" => "Perda objeto",
        "27" => "Prescricao",
        "28" => "Perda objeto",
        "29" => "Prescricao",
        "30" => "Ind. Crime",
        "31" => "Ind. Crime/FATD",
        "32" => "At. Origem",
        "33" => "Outros",
        "34" => "CPP",
        "35" => "CPO",
        "36" => "COM. MERITO",
        "37" => "Anulado"
    ],

    'resultadoFATD' =>
    [
        "1" => "Punido",
        "2" => "Absolvido",
        "23" => "Outra medida",
        "37" => "Anulado"
    ],

    'resultadoCJ' =>
    [
        "3" => "Excluído",
        "4" => "Punido",
        "5" => "Absolvido",
        "26" => "Perda objeto",
        "27" => "Prescricao"
    ],

    'resultadoCD' =>
    [
        "6" => "Excluído",
        "7" => "Punido",
        "8" => "Absolvido",
        "24" => "Perda objeto",
        "25" => "Prescricao"
    ],

    'resultadoADL' =>
    [
        "9" => "Excluído",
        "10" => "Punido",
        "11" => "Absolvido",
        "28" => "Perda objeto",
        "29" => "Prescricao"
    ],

    'resultadoSindicancia' =>
    [
        "12" => "FATD",
        "13" => "Conselho Just.",
        "14" => "Conselho Disc.",
        "15" => "Arquivamento",
        "16" => "IPM",
        "17" => "Sindicancia",
        "20" => "ADL",
        "30" => "Ind. Crime",
        "31" => "Ind. Crime/FATD",
        "32" => "At. Origem",
        "33" => "Outros",
        "34" => "CPP",
        "35" => "CPO",
        "36" => "COM. MERITO"
    ],

    'resultadoIPM' =>
    [
        "18" => "Nao ha indicios",
        "19" => "Indicios Crime", 
        "21" => "Indicios Transgressao",
        "22" => "Ind. Crime Transg."
    ],
   
    // ---- FATD -----------------------------------------------------------------------

    'motivoFATD' =>
    [
        ""  => "SELECIONE",
        "Falta ao serviço" => "Falta ao serviço",
		"Atraso ao serviço" => "Atraso ao serviço",
		"Não prestar sinais de respeito" => "Não prestar sinais de respeito",
		"Desrespeito a superior, par ou subordinado" => "Desrespeito a superior, par ou subordinado",
		"Transgressões relativas ao atendimento de ocorrência" => "Transgressões relativas ao atendimento de ocorrência",
		"Sair de sua área de responsabilidade quando em serviço" => "Sair de sua área de responsabilidade quando em serviço",
		"Realizar viagens/deslocamentos fora de seu município sem autorização do comando" => "Realizar viagens/deslocamentos fora de seu município sem autorização do comando",
		"Falta de asseio pessoal" => "Falta de asseio pessoal",
		"Portar-se de maneira inconveniente" => "Portar-se de maneira inconveniente",
		"Extravio de material" => "Extravio de material",
        "Falta em audiência" => "Falta em audiência",
		"Desidia Processual" => "Desidia Processual",
		"Pratica Crime Militar" => "Pratica Crime Militar",
		"Pratica Crime Comum" => "Pratica Crime Comum",
		"Desrespeito a outras normativas" => "Desrespeito a outras normativas",
		"Outro" => "Outro"
    ],

    'situacaoOCOR' =>
    [	
        "0"  => "SELECIONE",				
		"1" => "Em serviço ou atendimento de ocorrência",
		"2" => "Fora de serviço ou outras circunstâncias",
    ],

    'tipoBoletim' =>
    [
        ""  => "SELECIONE",	
        "BG" => "BG",
        "BI" => "BI",
        "BR" => "BR"
    ],
    
    // ---- IPM -------------------------------------------------------------------------------------

    'crime' =>
    [
        "Homicidio" => "Homicidio",
        "Lesao Corporal" => "Lesao Corporal",
        "Extravio de arma" => "Extravio de arma",
        "Furto de arma" => "Furto de arma",
        "Roubo de arma" => "Roubo de arma",
        "Extravio de municao" => "Extravio de Munição",
        "Concussao" => "Concussão (Art. 305)",
        "Peculato" => "Peculato (Art. 303)",
        "Corrupcao passiva" => "Corrupção passiva (Art. 308)",
        "Contrabando ou descaminho" => "Contrabando ou descaminho",
        "Uso de documento falso" => "Uso de documento falso (Art. 315)",
        "Falsidade ideologica" => "Falsidade ideológica",
        "Fuga de Preso" => "Fuga de preso",
        "Prevaricacao" => "Prevaricação (Art. 319)",
        "Violacao do sigilo funcional" => "Violação do sigilo funcional",
        "Deserção" => "Deserção",
        "Violencia contra superior" => "Violencia contra superior (Art. 157)",
        "Violencia contra militar de sv" => "Violencia contra militar de serviço (Art. 158)",
        "Desrespeito a superior" => "Desrespeito a superior (Art. 160)",
        "Recusa de obediencia" => "Recusa de obediencia (Art. 163)",
        "Abandono de posto" => "Abandono de posto (Art. 195)",
        "Embriaguez em servico" => "Embriaguez em serviço (Art. 202)",
        "Desacato a superior" => "Desacato a superior (Art. 298)",
        "Desacato a militar" => "Desacato a militar (Art. 299)",
        "Furto" => "Furto",
        "Roubo" => "Roubo",
        "Dano" => "Dano",
        "Instigamento ao suicidio" => "Instigamento ao suicidio",
        "Abuso de autoridade" => "Abuso de autoridade",
        "Auferir vantagem indevida" => "Auferir vantagem indevida",
        "Outros" => "Outros (especificar)",
    ],

    'tentado' =>
    [
        "" =>"Selecione",
        "Tentado" => "Tentado",
        "Consumado" => "Consumado",
    ],
    // ---- INQUERITO TECNICO -----------------------------------------------------------------------
    
    'causaAcidente' =>
    [
        "1" => "Pessoais",
        "2" => "Técnicas",
        "3" => "Caso fortuito",
        "4" => "Força Maior",
        "5" => "Indefinido"
    ],

    'objetoProcedimento' =>
    [
        "1" => "arma",
        "2" => "munição",
        "3" => "outros",
        "4" => "semovente",
        "5" => "viatura"
    ],

    'tipoAcidente' =>
    [
        '-' => '-',
		'nao identificado' => 'Não identificado',
		'abalroamento lateral' => 'Abalroamento lateral',
		'abalroamento transversal' => 'Abalroamento transversal',
		'atropelamento' => 'Atropelamento',
		'atropelamento de animal' => 'Atropelamento de animal',
		'capotamento' => 'Capotamento',
		'colisao frontal' => 'Colisão frontal',
		'colisao traseira' => 'Colisão traseira',
		'choque' => 'Choque',
		'engavetamento' => 'Engavetamento',
		'incendio' => 'Incêndio',
		'queda de passageiro' => 'Queda de passageiro',
		'queda de objeto' => 'Queda de objeto',
		'queda de moto' => 'Queda de moto',
		'queda de veiculo' => 'Queda de veículo',
		'tombamento' => 'Tombamento',
		'acidente complexo' => 'Acidente complexo',
		'nao identificado' => 'Não identificado'
    ],

    'avarias' =>
    [
        '' => 'Selecione',
		'Pequena Monta' => 'Pequena Monta',
		'Media Monta' => 'Media Monta',
		'Grande Monta' => 'Grande Monta'
    ],

    'situacaoviatura' =>
    [
        "nao informado" => "Não informado",
        "consertada com onus" => "Consertada com ônus",
        "consertada sem onus" => "Consertada sem ônus",
        "inservivel" => "Inservível",
        "aguarda conserto" => "Aguarda conserto"
    ],

    // ---- CONSELHO ---------------------------------------------------------------------------------------------------------
    
    'decorrenciaConselho' =>
    [
        "1" => "Condenação",
        "2" => "Homicídio",
        "3" => "Concussão",
        "4" => "Corrupção passiva",
        "5" => "Peculato",
        "6" => "Roubo",
        "7" => "Prevaricação",
        "8" => "Mau comportamento",
        "9" => "Vínculo empregatício",
        "10" => "Estelionato",
        "11" => "Deserção",
        "12" => "Crimes contra a dignidade sexual",
        "13" => "Outros (especifique)",
        "14" => "Auferir vantagem indevida",
        "15" => "Tortura",
        "16" => "Abuso de autoridade",
        "17" => "Contrabando/Descaminho",
        "18" => "Uso/Posse Substância Entorpecente",
        "19" => "Furto",
        "20" => "Associação e/ou Tráfico de Entorpecentes",
        "21" => "Omissão ou não preencher requisitos no Edital de Inclusão",
        "22" => "Crimes de Falsidade Documental / Fé Pública",
        "23" => "Associação Criminosa",
        "24" => "Porte Ilegal Arma de Fogo",
        "25" => "Disparo de Arma de Fogo"
    ],
    
    'motivoConselho' =>
    [
        "1" => "Mau comportamento, nova falta grave",
        "2" => "Acusado oficialmente de",
        "3" => "Afastado preventivamente por se tornar incompatível com o cargo ou função",
        "4" => "Incapacidade para o exercício da atribuição institucional",
        "5" => "Condenado por crime doloso - pena privativa de liberdade superior a 2 anos",
        "6" => "Reprovado em estágio probatório ou avaliação de desempenho",
        "7" => "Considerado inapto no período de formação",
        "8" => "Integrar partido político ou associação contrária à lei"
    ],

    'situacaoConselho' =>
    [
        "1" => "Em serviço ou atendimento de Ocorrência",
        "2" => "Fora do Serviço ou outras circunstâncias"
    ],

    // ---- Desercao --------------------------------------------------------------------------------------------------
    'termo_exclusao' => 
    [
        '' => 'Escolha',
        'Exclusao' => 'Exclusão',
        'Agregacao' => 'Agregação'
    ],

    'termo_captura' => 
    [
        '' => 'Escolha',
        'Captura' => 'Captura',
        'Apresentacao espontanea' => 'Apresentaçãoo Espontânea'
    ],

    'pericia' => 
    [
        '' => 'Escolha',
        'Sim' => 'Sim',
        'Nao' => 'Não'
    ],

    'termo_inclusao' => 
    [
        '' => 'Escolha',
        'Inclusao' => 'Inclusão',
        'Reversao' => 'Reversão'
    ],


    // ---- APRESENTAÇÃO ---------------------------------------------------------------------------------------

    'apresentacaoClassificacaoSigilo' =>
    [
        "1" => "Publico",
        "2" => "Usuário Siscoger",
        "3" => "Reservado - SDJ/Pares/Superiores",
        "4" => "Reservado - Somente o próprio",
        "5" => "Reservado - SJD/Próprio"
    ],

    'apresentacaoCondicao' =>
    [
        "1" => "Testemunha",
        "2" => "Juiz Militar - Conselho Permanente",
        "3" => "Juiz Militar - Conselho Especial",
        "4" => "Réu",
        "5" => "Testemunha de Defesa",
        "6" => "Testemunha da Denúncia",
        "7" => "Testemunha de Acusação",
        "8" => "Testemunha do Juízo",
        "9" => "Outro",
        "10" => "Não informado"
    ],

    'apresentacaoNotificacao' =>
    [
       "1" => "Pendente",
       "2" => "Notificado",
       "3" => "Não notificado" 
    ],

    'apresentacaoSituacao' =>
    [
        "1"   => "Prevista",
        "2"   => "Compareceu/Realizada",
        "3"   => "Compareceu/Cancelada",
        "4"   => "Compareceu/Redesignada",
        "5"   => "Não compareceu",
        "6"   => "Não compareceu/Justificado",
        "7"   => "Redesignada",
        "8"   => "Substituído (Cons. VAJME)",
        "9"   => "Ag. Publicação",
        "10"  => "Apagada"
    ],

    'apresentacaoTipoProcesso' =>
    [
        "1" => "Ação Penal",
        "2" => "Ação Civil",
        "3" => "Não informado",
        "4" => "Não se aplica",
        "5" => "PM-IPM",
        "6" => "PM-Sindicância",
        "7" => "PM-FATD",
        "8" => "PM-Inquérito Técnico",
        "9" => "PM-CJ",
        "10" => "PM-CD",
        "11" => "PM-ADL",
        "12" => "PM-ISO",
        "13" => "PM-PAD",
        "14" => "PM-Outro ",
        "15" => "Poder Judiciário ",
        "16" => "Inquérito Policial",
        "17" => "VAJME"
    ],

    'tipoNotaComparecimento' =>
    [
        '1' => 'Apresentação em Juízo/Delegacias',
        '2' => 'VAJME - Conselho Especial',
        '3' => 'VAJME - Conselho Permanente',
        '4' => 'VAJME - Audiências'
    ],

    // ---- TIPO DE PRESO -------------------------------------------------------------------------------

    'presoTipo' => 
    [
        "1" => "FLAGRANTE",
        "2" => "PREVENTIVA",
        "3" => "TEMPORÁRIA",
        "4" => "CONDENAÇÃO",
        "5" => "MENAGEM",
        "6" => "DESERCAO"
    ],

    // ---- RESTRICOES -------------------------------------------------------------------------------
    'origemRestricao' =>
    [
        '' => 'Selecione',
        'Laudo medico' => 'Laudo m&eacute;dico',
        'Disciplinar/Criminal' => 'Sit. Disciplinar/Criminal',
        'Disparo' => 'Disparo Imprudente/Negligente',
        'Sob efeito alcool' => 'Porte sob efeito de alcool ou outra subst.',
        'Condenacao Punicao Disciplinar' => 'Condenaçãoo ou Punição Disciplinar',
        'Inapto Psicologico' => 'Inapto Avaliaçãoo Psicológica'
    ],

    // ---- RESPONSABILIDADE CíVIL ------------------------------------------------------------------------

    'respCivil' =>
    [
        "0" => "Indefinida Culpa",
        "1" => "Civil",
        "2" => "Militar",
        "3" => "Ente estatal",
        "4" => "PJ - Direito privado",
        "5" => "Terceiro"
    ],

    'tipo_penal_novo' => 
    [
        '' => 'Selecione',
        'Homicidio' => 'Homicidio',
        'Lesao Corporal' => 'Lesao Corporal',
        'Extravio de arma' => 'Extravio de arma',
        'Furto de arma' => 'Furto de arma',
        'Roubo de arma' => 'Roubo de arma',
        'Extravio de municao' => 'Extravio de Munição',
        'Concussao' => 'Concussão (Art. 305)',
        'Peculato' => 'Peculato (Art. 303)',
        'Corrupcao passiva' => 'Corrupção passiva (Art. 308)',
        'Contrabando ou descaminho' => 'Contrabando ou descaminho',
        'Uso de documento falso' => 'Uso de documento falso (Art. 315)',
        'Falsidade ideologica' => 'Falsidade ideológica',
        'Fuga de Preso' => 'Fuga de preso',
        'Prevaricacao' => 'Prevaricação (Art. 319)',
        'Violacao do sigilo funcional' => 'Violação do sigilo funcional',
        'Deserção' => 'Deserção',
        'Violencia contra superior' => 'Violencia contra superior (Art. 157)',
        'Violencia contra militar de sv' => 'Violencia contra militar de serviço (Art. 158)',
        'Desrespeito a superior' => 'Desrespeito a superior (Art. 160)',
        'Recusa de obediencia' => 'Recusa de obediencia (Art. 163)',
        'Abandono de posto' => 'Abandono de posto (Art. 195)',
        'Embriaguez em servico' => 'Embriaguez em serviço (Art. 202)',
        'Desacato a superior' => 'Desacato a superior (Art. 298)',
        'Desacato a militar' => 'Desacato a militar (Art. 299)',
        'Furto' => 'Furto',
        'Roubo' => 'Roubo',
        'Dano' => 'Dano',
        'Instigamento ao suicidio' => 'Instigamento ao suicidio',
        'Abuso de autoridade' => 'Abuso de autoridade',
        'Auferir vantagem indevida' => 'Auferir vantagem indevida',
        'Outros' => 'Outros (especificar)',
    ],
    
    //subformulário envolvido
    'envolvidoFatd' =>
    [
        'Selecione',
        'Punido', 
        'Absolvido', 
        'Outra Medida',
        'Anulado'
    ],

    'envolvidoAdl' =>
    [
        'Selecione',
        'Excluído',
        'Punido',
        'Absolvido',
        'Perda objeto',
        'Prescricao',
        'Reintegrado/Reinserido'
    ],

    'envolvidoSai' => 
    [
        'Selecione',
        'Denunciado',
        'Elogiado',
        'Envolvido',
        'Testemunha',
        'Vítima'
    ],

    //subformulário ofendido
    'ofendido' => '',
    'ofendidoIt' => 'Condutor Civil',
    'ofendidoPad' => 'Envolvido',
    'ofendidoSai' => '',
    'ofendidoProc_outros' => '',

    'ofendidoSexo' => [
        '' => 'Escolha',
        'M' => 'Masculino',
        'F' => 'Feminino'
    ],

    'ofendidoResultado' => [
        'Selecione',
        'Sem lesao',
        'Obito',
        'Lesao corporal'
    ],

    'escolaridade' => [
        '',
        'Analfabeto',
        'Fundamental Incompleto',
        'Fundamental Completo',
        'Médio Incompleto',
        'Médio completo',
        'Superior incompleto',
        'Superior completo',
        'Pos - graduado',
        'Mestrado',
        'Doutorado'
    ],

    'ofendidoSituacao' => [
        '',
        'Vítima',
        'Testemunha',
        'Denunciante'
    ],

    // sobrestamento
    'motivoSobrestamento' => [
        '' => '',
        'Férias Acusado' => 'Férias Acusado',
        'Férias Comissão' => 'Férias Comissão',
        'Incidente de Insanidade' => 'Incidente de Insanidade',
        'Substituição' => 'Substituição',
        'Laudos/Perícia' => 'Laudos/Perícia',
        'Deslinde Criminal' => 'Deslinde Criminal',
        'Outros' => 'Outros'
    ],

    // ---- Prisões -----------------------------------------------------------------

    'presotipo' => [
        '1' => 'Flagrante',
        '2' => 'Preventiva',
        '3' => 'Temporária',
        '4' => 'Condenação',
        '5' => 'Menagem',
        '6' => 'Deserção',
    ],

    //nome das tabelas que tinham no sistema antigo e 
    //foram susbstituidos pelos arrays contidos neste arquivo
    //e alguns que eram reduntantes também e foram excluídos
    
    'tabelasAntigas' =>
    [
        "1" => "andamento",
        "2" => "andamentocoger",
        "3" => "apresentacaoclassificacaosigilo",
        "4" => "apresentacaocondicao",
        "5" => "apresentacaonotificacao",
        "6" => "apresentacaosituacao",
        "7" => "apresentacaotipoprocesso",
        "8" => "causa_acidente",
        "9" => "classpunicao",
        "10" => "comportamento",
        "11" => "decorrenciaconselho",
        "12" => "envolvido_bkp",
        "13" => "fatd_andamento",
        "14" => "fatdbkp",
        "15" => "genero",
        "16" => "gradacao",
        "17" => "motivoconselho",
        "18" => "movimento_bkp",
        "19" => "objetoprocedimento",
        "20" => "policial_email",
        "21" => "posto",
        "22" => "presotipo",
        "23" => "procedimentos_tipos",
        "24" => "resp_civil",
        "25" => "resultado",
        "26" => "sindicanciateste",
        "27" => "situacao",
        "28" => "situacaoconselho",
        "29" => "sobrestamento_bkp",
        "30" => "tipo_acidente",
        "31" => "tiponotacomparecimento",
        "32" => "viaturaenvolvida"
    ],
];