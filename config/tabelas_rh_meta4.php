<?php
/*
* dados que existiam em tabelas do sistema antigo foram transcritas neste documento para auxiliar na compatibilidade
* outros dados para uso geral podem ser inseridos para auxiliar
*/
return [


    /*
    * Os dados existentes nas tabelas do RHPARANA
    *
    */
    
    'tabelasRhparana' =>[
        'AUSENCIA' => [ 
            '0' => 'NOME',
            '1' => 'CODIGO',
            '2' => 'RG',
            '3' => 'OPM_META4',
            '4' => 'OPM_DESCRICAO',
            '5' => 'COD_INCIDENTE',
            '6' => 'DESC_INCIDENTE',
            '7' => 'UNITS',
            '8' => 'DT_INIC',
            '9' => 'DT_FIM',
            ],

        'benetti' => [
            '0' => 'META4',
            '1' => 'codigo',
        ],

        'BPGD' => [
            '0' => 'UNIDADE',
            '1' => 'CODUNIDADE',
            '2' => 'DATAPRACA',
            '3' => 'NOME',
            '4' => 'RG',
            '5' => 'LOCAL',
            '6' => 'MUNICIPIO',
            '7' => 'POSTOGRAD',
            '8' => 'FUNCAO',
            '9' => 'ANIVERSARIO',
            '10' => 'SEXO', 
        ],

        'CIVIL' => [
            '0' => 'rg',
            '1' => 'nome',
            '2' => 'cdopm',
            '3' => 'funcao',
        ],

        'CONTATORESERVA' => [
            '0' => 'RG',
            '1' => 'FONE',
            '2' => 'EMAIL',
            '3' => 'ATUALIZACAO_DATA',
        ],

        'COPEL_BAIRRO' => [
            '0' => 'UF',
            '1' => 'CDMUNICIPIO',
            '2' => 'CDBAIRRO',
            '3' => 'NOME',
            '4' => 'cdopm',
            '5' => 'cdopmtran',
            '6' => 'cdopmcb',
            '7' => 'cdopmbprv',
            '8' => 'cdopmflorestal',
            '9' => 'cdopmpc', 
        ],

        'COPEL_LOGRADOURO' => [
            '0' => 'UF',
            '1' => 'CDMUNICIPIO',
            '2' => 'CDLOGRADOURO',
            '3' => 'CDTIPOLOGRADOURO_OLD',
            '4' => 'CDTITULOLOGRADOURO_OLD',
            '5' => 'NOME_OLD',
            '6' => 'CDTIPOLOGRADOURO',
            '7' => 'CDTITULOLOGRADOURO',
            '8' => 'NOME',
            '9' => 'CDLOGRADOUROINICIO',
            '10' => 'CDLOGRADOUROFIM',
            '11' => 'SISTEMA_COPEL',
            '12' => 'GID',
        ],

        'COPEL_MUNICIPIO' => [
            '0' => 'UF',
            '1' => 'CDMUNICIPIO',
            '2' => 'NOME',
            '3' => 'NOMEMETA4',
            '4' => 'LAT',
            '5' => 'LNG',
            '6' => 'POPULACAO', 

        ],

        'COPEL_TRECHO_LOGRADOURO' => [
            '0' => 'CDLOGRADOURO',
            '1' => 'CDTRECHO',
            '2' => 'NUMINICIAL',
            '3' => 'NUMFINAL',
            '4' => 'STARTX',
            '5' => 'STARTY',
            '6' => 'ENDX',
            '7' => 'ENDY',
            '8' => 'COMPRIMENTOTRECHO',
            '9' => 'cod_local_trlog',
            '10' => 'UF',
            '11' => 'CDMUNICIPIO',
            '12' => 'CDLOGINICIO',
            '13' => 'CDLOGFIM',
            '14' => 'CDBAIRRO',
            '15' => 'gid', 

        ],

        'CPP_INATIVOS' => [
            '0' => 'UserRG',
            '1' => 'NOME',
            '2' => 'graduacao',
            '3' => 'reserva_data', 

        ],

        'DEPENDENTES_ATIVA' => [
            '0' => 'rg',
            '1' => 'nome',
            '2' => 'sexo',
            '3' => 'data_nasc',
            '4' => 'irpf',
            '5' => 'parentesco',
            '6' => 'dt_ini',
            '7' => 'dt_fim',
        ],

        'DEPENDENTES_INATIVO' => [
            '0' => 'rg',
            '1' => 'nome',
            '2' => 'sexo',
            '3' => 'data_nasc',
            '4' => 'irpf',
            '5' => 'parentesco',
            '6' => 'dt_ini',
            '7' => 'dt_fim', 
        ],

        'EFETIVO_PMPR' => [
            '0' => 'STD_ID_HR',
            '1' => 'STD_OR_HR_PERIOD',
            '2' => 'STD_DT_START',
            '3' => 'STD_N_FIRST_NAME',
            '4' => 'CBR_NUM_RG',
            '5' => 'CBR_ID_FUNC_GRUOP',
            '6' => 'SUS_ID_WORK_CENTER',
            '7' => 'STD_WORK_LOCBRA',
            '8' => 'STD_ID_SUB_GEO_DIV',
            '9' => 'STD_N_SUB_GEO_DIV',
            '10' => 'SCO_ID_WORK_UNIT',
            '11' => 'STD_N_WORK_UNITBRA',
            '12' => 'STD_ID_JOB_CODE',
            '13' => 'CBR_ID_CLASS_ORDER',
            '14' => 'CBR_ID_CLASS',
            '15' => 'CBR_ID_REFERENCE',
            '16' => 'CBR_ID_FUNC',
            '17' => 'CBR_NM_FUNCBRA',
            '18' => 'STD_DT_BIRTH',
            '19' => 'STD_ID_GENDER',
            '20' => 'STD_N_GENDERBRA',
            '21' => 'STD_EMAIL', 
        ],

        'EFETIVO_PRACAS' => [
            '0' => 'UserRG',
            '1' => 'nome',
            '2' => 'graduacao',
            '3' => 'quadro',
            '4' => 'subquadro',
            '5' => 'inclusao_data',
            '6' => 'opm',
            '7' => 'referencia',
            '8' => 'cdopm', 
        ],

        'efetivo1' => [
            '0' => 'STD_ID_HR',
            '1' => 'STD_OR_HR_PERIOD',
            '2' => 'STD_DT_START',
            '3' => 'STD_N_FIRST_NAME',
            '4' => 'CBR_NUM_RG',
            '5' => 'CPF',
            '6' => 'CBR_ID_FUNC_GRUOP',
            '7' => 'STD_DT_BIRTH',
            '8' => 'STD_ID_GENDER',
            '9' => 'STD_N_GENDERBRA',
            '10' => 'CBR_DT_START_REAL',
            '11' => 'STD_EMAIL',
            '12' => 'CBR_NAME_MATHER',
            '13' => 'CBR_NAME_FATHER',
            '14' => 'SBR_NUM_TIT',
            '15' => 'SBR_ZONA',
            '16' => 'SBR_SECAO',
            '17' => 'STD_ID_GEO_DIV', 
        ],

        'efetivo2' => [
            '0' => 'STD_ID_HR',
            '1' => 'STD_OR_HR_PERIOD',
            '2' => 'STD_DT_START',
            '3' => 'STD_N_FIRST_NAME',
            '4' => 'CBR_NUM_RG',
            '5' => 'CPF',
            '6' => 'CBR_ID_FUNC_GRUOP',
            '7' => 'STD_DT_BIRTH',
            '8' => 'STD_ID_GENDER',
            '9' => 'STD_N_GENDERBRA',
            '10' => 'CBR_DT_START_REAL',
            '11' => 'STD_EMAIL',
            '12' => 'CBR_NAME_MATHER',
            '13' => 'CBR_NAME_FATHER',
            '14' => 'SBR_NUM_TIT',
            '15' => 'SBR_ZONA',
            '16' => 'SBR_SECAO',
            '17' => 'STD_ID_GEO_DIV', 
        ],

        'fotos' => [
            '0' => 'rg', 
        ],

        'FUNC_PRIV' => [
            '0' => 'STD_ID_HR',
            '1' => 'STD_OR_HR_PERIOD_NUMBER',
            '2' => 'DT_START',
            '3' => 'DT_END',
            '4' => 'CBR_ID_FUNC_PRIV',
            '5' => 'CBR_ID_FORM_ACT',
            '6' => 'SCO_ID_REA_CHANG', 
        ],

        'funcional' => [
            '0' => 'cif',
            '1' => 'nome',
            '2' => 'rg',
            '3' => 'data',
            '4' => 'sit_pm',
            '5' => 'motivo',
            '6' => 'cargo',
            '7' => 'sit_funcional',
            '8' => 'rg_alterante',
            '9' => 'boletim',
            '10' => 'data_fim', 
        ],

        'FUNCOES_PRIVATIVAS' => [
            '0' => 'CBR_ID_FUNC_PRIV',
            '1' => 'DT_START',
            '2' => 'DT_END',
            '3' => 'CBR_ID_FUNC',
            '4' => 'STD_ID_JOB_CODE',
            '5' => 'CBR_ID_CLASS_ORDER',
            '6' => 'CBR_ID_CLASS',
            '7' => 'STD_ID_WORK_UNIT',
            '8' => 'CBR_ID_FORM_ACT',
            '9' => 'CBR_Q_VACANCY',
            '10' => 'CBR_COMMENT', 
        ],

        'HPM_ATIVA' => [
            '0' => 'RG',
            '1' => 'CARGO',
            '2' => 'QUADRO',
            '3' => 'NOME',
            '4' => 'DATA_INCLUSAO',
            '5' => 'DATA_NASCIMENTO',
            '6' => 'CIDADE',
            '7' => 'SEXO',
            '8' => 'LOCAL_TRABALHO',
            '9' => 'UNIDADE', 
        ],

        'HPM_DEPENDENTES_ATIVA' => [
            '0' => 'RG',
            '1' => 'NOME',
            '2' => 'DATA_NASCIMENTO',
            '3' => 'SEXO',
            '4' => 'PARENTESCO',
            '5' => 'IRPF',
            '6' => 'DT_INI',
            '7' => 'DT_FIM', 
        ],

        'HPM_DEPENDENTES_INATIVO' => [
            '0' => 'RG',
            '1' => 'NOME',
            '2' => 'DATA_NASCIMENTO',
            '3' => 'SEXO',
            '4' => 'PARENTESCO',
            '5' => 'IRPF',
            '6' => 'DT_INI',
            '7' => 'DT_FIM', 
        ],

        'HPM_INATIVOS' => [
            '0' => 'RG',
            '1' => 'NOME',
            '2' => 'DATA_NASCIMENTO',
            '3' => 'CIDADE',
            '4' => 'SEXO',
            '5' => 'BAIRRO', 
        ],

        'INATIVOS' => [
            '0' => 'STD_ID_HR',
            '1' => 'STD_OR_RH_PERIOD',
            '2' => 'DT_INI_RH',
            '3' => 'ID_TIPO_RH',
            '4' => 'N_TIPO_RH',
            '5' => 'CBR_NUM_RG',
            '6' => 'NOME',
            '7' => 'DT_NASC',
            '8' => 'SEXO',
            '9' => 'cargo',
            '10' => 'POSTO',
            '11' => 'N_RUA',
            '12' => 'N_TIPO_LOCAL_END',
            '13' => 'QUADRO',
            '14' => 'ORD_FONE',
            '15' => 'N_TIPO_LOCAL_FONE',
            '16' => 'N_TIPO_LINHA',
            '17' => 'FONE',
            '18' => 'END_LOGRADOURO',
            '19' => 'END_NUMERO',
            '20' => 'END_COMPL',
            '21' => 'END_BAIRRO',
            '22' => 'END_CIDADE',
            '23' => 'END_CEP', 
        ],

        'OPM_IMP_META4' => [
            '0' => 'UNIDADE_META4',
            '1' => 'DESCRICAO_META4',
            '2' => 'ID_PAI',
            '3' => 'DESCRICAO_PAI',
            '4' => 'UNIDADE_PMPR',
            '5' => 'CD_LOCAL_TRABALHO',
            '6' => 'LOCAL_TRABALHO',
            '7' => 'DATA_INICIO',
            '8' => 'DATA_FIM',
            '9' => 'LOGRADOURO',
            '10' => 'BAIRRO',
            '11' => 'MUNICIPIO',
            '12' => 'CEP',
            '13' => 'DDD',
            '14' => 'TELEFONE', 
        ],

        'opmPMPR' => [
            '0' => 'META4',
            '1' => 'NOME_META4',
            '2' => 'CODIGO',
            '3' => 'DESCRICAO',
            '4' => 'ABREVIATURA',
            '5' => 'TIPO',
            '6' => 'MUNICIPIO',
            '7' => 'CDMUNICIPIO',
            '8' => 'TITULO',
            '9' => 'CODIGOBASE',
            '10' => 'CODIGONOVO',
            '11' => 'TELEFONE', 
                    ],

        'pm_cm' => [
            '0' => 'ID_META4',
            '1' => 'STD_OR_HR_PERIOD',
            '2' => 'secao',
            '3' => 'uf',
            '4' => 'DATA_ADMISSAO',
            '5' => 'NOME',
            '6' => 'RG',
            '7' => 'CLASSE',
            '8' => 'NASCIMENTO',
            '9' => 'ID_SEXO',
            '10' => 'SEXO',
            '11' => 'ADMISSAO_REAL',
            '12' => 'EMAIL_META4',
            '13' => 'FUNCAO',
            '14' => 'CARGO',
            '15' => 'QUADRO',
            '16' => 'SUBQUADRO',
            '17' => 'PROMOCAO',
            '18' => 'REFERENCIA',
            '19' => 'BAIRRO',
            '20' => 'CIDADE',
            '21' => 'OPM_DESCRICAO',
            '22' => 'OPM_META4',
            '23' => 'CDOPM',
            '24' => 'nome_mae',
            '25' => 'nome_pai',
            '26' => 'numero_titulo',
            '27' => 'zona', 
        ],

        'pm_cpf' => [
            '0' => 'ID_META4',
            '1' => 'STD_OR_HR_PERIOD',
            '2' => 'DATA_ADMISSAO',
            '3' => 'NOME',
            '4' => 'RG',
            '5' => 'CLASSE',
            '6' => 'NASCIMENTO',
            '7' => 'ID_SEXO',
            '8' => 'SEXO',
            '9' => 'ADMISSAO_REAL',
            '10' => 'EMAIL_META4',
            '11' => 'FUNCAO',
            '12' => 'CARGO',
            '13' => 'QUADRO',
            '14' => 'SUBQUADRO',
            '15' => 'PROMOCAO',
            '16' => 'REFERENCIA',
            '17' => 'BAIRRO',
            '18' => 'CIDADE',
            '19' => 'OPM_DESCRICAO',
            '20' => 'OPM_META4',
            '21' => 'CDOPM',
            '22' => 'cpf', 
        ],

        'PM4_ATIVA' => [
            '0' => 'RG',
            '1' => 'NOME',
            '2' => 'UNIDADE',
            '3' => 'POST_GRAD',
        ],

        'POLICIAL' => [
            '0' => 'ID_META4',
            '1' => 'STD_OR_HR_PERIOD',
            '2' => 'DATA_ADMISSAO',
            '3' => 'NOME',
            '4' => 'RG',
            '5' => 'CLASSE',
            '6' => 'NASCIMENTO',
            '7' => 'ID_SEXO',
            '8' => 'SEXO',
            '9' => 'ADMISSAO_REAL',
            '10' => 'EMAIL_META4',
            '11' => 'FUNCAO',
            '12' => 'CARGO',
            '13' => 'QUADRO',
            '14' => 'SUBQUADRO',
            '15' => 'PROMOCAO',
            '16' => 'REFERENCIA',
            '17' => 'BAIRRO',
            '18' => 'CIDADE',
            '19' => 'OPM_DESCRICAO',
            '20' => 'OPM_META4',
            '21' => 'CDOPM', 
        ],

        'posto' => [
            '0' => 'codigo',
            '1' => 'descricao', 
        ],

        'RESERVA' => [
            '0' => 'UserRG',
            '1' => 'nome',
            '2' => 'posto',
            '3' => 'quadro',
            '4' => 'subquadro',
            '5' => 'data',
            '6' => 'id',
        ],

        'tabela_cpf_pm' => [
            '0' => 'ID_META4',
            '1' => 'STD_OR_HR_PERIOD',
            '2' => 'DATA_ADMISSAO',
            '3' => 'NOME',
            '4' => 'RG',
            '5' => 'CLASSE',
            '6' => 'NASCIMENTO',
            '7' => 'ID_SEXO',
            '8' => 'SEXO',
            '9' => 'ADMISSAO_REAL',
            '10' => 'EMAIL_META4',
            '11' => 'FUNCAO',
            '12' => 'CARGO',
            '13' => 'QUADRO',
            '14' => 'SUBQUADRO',
            '15' => 'PROMOCAO',
            '16' => 'REFERENCIA',
            '17' => 'BAIRRO',
            '18' => 'CIDADE',
            '19' => 'OPM_DESCRICAO',
            '20' => 'OPM_META4',
            '21' => 'CDOPM',
            '22' => 'cpf',
            '23' => 'flag',
        ],

    ],

    /*
    * Os dados existentes nas tabelas do META4
    *
    */
    
    'tabelasMeta4' =>[

        'AUSENCIA' => [ 
            '0' => 'NOME',
            '1' => 'CODIGO',
            '2' => 'RG',
            '3' => 'OPM_META4',
            '4' => 'OPM_DESCRICAO',
            '5' => 'COD_INCIDENTE',
            '6' => 'DESC_INCIDENTE',
            '7' => 'UNITS',
            '8' => 'DT_INIC',
            '9' => 'DT_FIM',
            ],

        'CARGO' => [
            '0' => 'STD_ID_HR',
            '1' => 'STD_OR_HR_PERIOD',
            '2' => 'DT_START',
            '3' => 'STD_ID_JOB_CODE',
            '4' => 'CBR_ID_CLASS_ORDER',
            '5' => 'CBR_ID_CLASS',
            '6' => 'CBR_DT_START_REAL',
            '7' => 'CBR_ID_REFERENCE',
            ],

        'FUNCAO' => [ 
            '0' => 'STD_ID_HR',
            '1' => 'STD_OR_HR_PERIOD',
            '2' => 'DT_START_FUNCAO',
            '3' => 'CBR_ID_FUNC',
            '4' => 'DATA_REAL',
            '5' => 'CBR_NM_FUNCBRA',
            ],

        'LOCAL' => [ 
            '0' => 'STD_ID_HR',
            '1' => 'STD_OR_HR_PERIOD',
            '2' => 'SUS_ID_WORK_CENTER',
            '3' => 'STD_WORK_LOCBRA',
            '4' => 'STD_ID_SUB_GEO_DIV',
            '5' => 'STD_N_SUB_GEO_DIV',
            '6' => 'SCO_ID_WORK_UNIT',
            '7' => 'DT_START_REAL',
            '8' => 'STD_N_WORK_UNITBRA',
            ],

        'PESSOA' => [ 
            '0' => 'STD_ID_HR',
            '1' => 'STD_OR_HR_PERIOD',
            '2' => 'SDT_DT_START',
            '3' => 'STD_N_FIRST_NAME',
            '4' => 'CBR_NUM_RG',
            '5' => 'CBR_ID_FUNC_GRUOP',
            '6' => 'STD_DT_BIRTH',
            '7' => 'STD_ID_GENDER',
            '8' => 'STD_N_GENDERBRA',
            '9' => 'CBR_DT_START_REAL',
            '10' => 'STD_EMAIL',
            ],
        
    ],

    /*
    * Os dados existentes nas tabelas do PASS
    *
    */

    'candidato_documento' => [ 
        '0' => 'candidato_id',
        '1' => 'documento_id'
    ],
    
    'concurso' => 
    [ '0' => 'rg',
        '1' => 'senha',
        '2' => 'direito'
    ], 

    'dep_concurso' => [ 
        '0' => 'UserRG',
        '1' => 'UserSenha',
        '2' => 'direitos'
    ], 

    'LOG_ACESSOS' => [ 
        '0' => 'rg',
        '1' => 'GrupoID',
        '2' => 'ip',
        '3' => 'datahora'
    ],

    'LOG_QUERY' => [ 
        '0' => 'rg',
        '1' => 'grupoID',
        '2' => 'ip',
        '3' => 'datahora',
        '4' => 'query'
    ],

    'movimentos' => [ 
        '0' => 'opmorigem',
        '1' => 'opmdestino',
        '2' => 'rg',
        '3' => 'nome',
        '4' => 'data'
    ],

    'opm' => [ 
        '0' => 'CODIGO',
        '1' => 'CDMUNICIPIO',
        '2' => 'ABREVIATURA',
        '3' => 'DESCRICAO',
        '4' => 'ENDERECO',
        '5' => 'BAIRRO',
        '6' => 'Col007',
        '7' => 'CEP',
        '8' => 'Col009',
        '9' => 'ACI',
        '10' => 'CINE',
        '11' => 'COMUNITARIO',
        '12' => 'OPMSIGLA'
    ], 

    'PPDireitos' => [ 
        '0' => 'DireitoID',
        '1' => 'Descricao'
    ],

    'PPGrupoDireito' => [ 
        '0' => 'GrupoID',
        '1' => 'DireitoID'
    ],

    'PPGrupos' => [ 
        '0' => 'GrupoID',
        '1' => 'Descricao',
        '2' => 'OPM',
        '3' => 'administrador',
        '4' => 'reservado',
        '5' => 'url'
    ],

    'PPProjetoGrupo' => [ 
        '0' => 'GrupoID',
        '1' => 'SistemaID',
        '2' => 'ProjetoID'
    ],

    'PPProjetos' => [ 
        '0' => 'SistemaID',
        '1' => 'ProjetoID',
        '2' => 'Project',
        '3' => 'Major',
        '4' => 'Minor',
        '5' => 'Revision'
    ],

    'PPSistemas' => [ 
        '0' => 'SistemaID',
        '1' => 'Descricao'
    ],

    'PPUserDireitosGrupo' => [ 
        '0' => 'DireitoId',
        '1' => 'Descricao'
    ],

    'PPUsuarioGrupo' => [ 
        '0' => 'GrupoID',
        '1' => 'UserID',
        '2' => 'acessos',
        '3' => 'direitos'
    ],

    'PPUsuarios' => [ 
        '0' => 'UserID',
        '1' => 'UserRG',
        '2' => 'UserCPF',
        '3' => 'UserNome',
        '4' => 'UserOPM',
        '5' => 'UserLogin',
        '6' => 'UserEMail',
        '7' => 'UserExpresso',
        '8' => 'UserNivel',
        '9' => 'Obs',
        '10' => 'UserSenha',
        '11' => 'NIVELADM',
        '12' => 'senha',
        '13' => 'fone',
        '14' => 'ultimo_acesso',
        '15' => 'UserOPMWork',
        '16' => 'opm_trabalho',
        '17' => 'opm_meta4'
    ],

    'seg_aplicacoes' => [ 
        '0' => 'aplicacaoid',
        '1' => 'Descricao'
    ],

    'seg_grupos' => [ 
        '0' => 'grupoid',
        '1' => 'descricao'
    ],

    'seg_grupos_aplicacoes' => [ 
        '0' => 'grupoid',
        '1' => 'aplicacaoid'
    ],

    'seg_niveladm' => [ 
        '0' => 'codigo',
        '1' => 'descricao',
        '2' => 'nivel'
    ],

    'seg_usuario_permissao_grupo' => [ 
        '0' => 'usuarioid',
        '1' => 'grupoid'
    ],

    'seg_usuarios_grupos' => [ 
        '0' => 'usuarioid',
        '1' => 'grupoid'
    ], 

    'vtestebossoni' => [ 
        '0' => 'UserID',
        '1' => 'UserRG',
        '2' => 'UserCPF',
        '3' => 'UserNome',
        '4' => 'UserOPM',
        '5' => 'UserLogin',
        '6' => 'UserEMail',
        '7' => 'UserExpresso',
        '8' => 'UserNivel',
        '9' => 'Obs',
        '10' => 'UserSenha',
        '11' => 'NIVELADM',
        '12' => 'senha',
        '13' => 'fone',
        '14' => 'ultimo_acesso',
        '15' => 'UserOPMWork',
        '16' => 'opm_trabalho',
        '17' => 'opm_meta4'
    ], 

];