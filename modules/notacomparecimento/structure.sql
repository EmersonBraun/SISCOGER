CREATE TABLE `tiponotacomparecimento` (
  `id_tiponotacomparecimento` bigint(20) NOT NULL AUTO_INCREMENT,
  `nomeunico` varchar(160) NOT NULL,
  `tiponotacomparecimento` varchar(160) NOT NULL,
  `ativo` smallint DEFAULT NULL,
  PRIMARY KEY (`id_tiponotacomparecimento`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO `sjd`.`tiponotacomparecimento` (`id_tiponotacomparecimento`,`nomeunico`, `tiponotacomparecimento`, `ativo`) VALUES (1,'NotaApresentacaoJuizo', 'Apresentação em Juízo/Delegacias', '1');
INSERT INTO `sjd`.`tiponotacomparecimento` (`id_tiponotacomparecimento`,`nomeunico`, `tiponotacomparecimento`, `ativo`) VALUES (2,'NotaVajmeConselhoEspecial', 'VAJME - Conselho Especial', '1');
INSERT INTO `sjd`.`tiponotacomparecimento` (`id_tiponotacomparecimento`,`nomeunico`, `tiponotacomparecimento`, `ativo`) VALUES (3,'NotaVajmeConselhoPermanente', 'VAJME - Conselho Permanente', '1');
INSERT INTO `sjd`.`tiponotacomparecimento` (`id_tiponotacomparecimento`,`nomeunico`, `tiponotacomparecimento`, `ativo`) VALUES (4,'NotaVajmeAudiencias', 'VAJME - Audiências', '1');


CREATE TABLE `notacomparecimento` (
  `id_notacomparecimento` bigint(20) NOT NULL AUTO_INCREMENT,
  `sjd_ref` int(11) NOT NULL,
  `sjd_ref_ano` int(11) NOT NULL,
  `expedicao_data` date DEFAULT NULL,
  `id_tiponotacomparecimento` bigint(20) DEFAULT NULL,
  `observacao_txt` text,
  `autoridade_rg` varchar(20) DEFAULT NULL,
  `autoridade_cargo` varchar(80) DEFAULT NULL,
  `autoridade_quadro` varchar(80) DEFAULT NULL,
  `autoridade_nome` varchar(160) DEFAULT NULL,
  `autoridade_funcao` varchar(160) DEFAULT NULL,
  `planilha_file` varchar(255) DEFAULT NULL,
  `planilha_nome` varchar(255) DEFAULT NULL,
  `nota_file` varchar(120) NOT NULL DEFAULT '',
  `rg` varchar(20) DEFAULT NULL,
  `criacao_dh` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(45) DEFAULT 'pendente',
  PRIMARY KEY (`id_notacomparecimento`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `apresentacaotipoprocesso` (
  `id_apresentacaotipoprocesso` bigint(20) NOT NULL AUTO_INCREMENT,
  `apresentacaotipoprocesso` varchar(50) DEFAULT NULL,
  `procedimentointerno` varchar(100) DEFAULT '',
  `ativo` smallint(6) DEFAULT '1',
  `ordem` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id_apresentacaotipoprocesso`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

INSERT INTO `apresentacaotipoprocesso` (`id_apresentacaotipoprocesso`,`apresentacaotipoprocesso`,`procedimentointerno`,`ativo`,`ordem`) VALUES (1,'Ação Penal','',1,0);
INSERT INTO `apresentacaotipoprocesso` (`id_apresentacaotipoprocesso`,`apresentacaotipoprocesso`,`procedimentointerno`,`ativo`,`ordem`) VALUES (2,'Ação Civil','',1,0);
INSERT INTO `apresentacaotipoprocesso` (`id_apresentacaotipoprocesso`,`apresentacaotipoprocesso`,`procedimentointerno`,`ativo`,`ordem`) VALUES (3,'Não informado','',1,1);
INSERT INTO `apresentacaotipoprocesso` (`id_apresentacaotipoprocesso`,`apresentacaotipoprocesso`,`procedimentointerno`,`ativo`,`ordem`) VALUES (4,'Não se aplica','',1,0);
INSERT INTO `apresentacaotipoprocesso` (`id_apresentacaotipoprocesso`,`apresentacaotipoprocesso`,`procedimentointerno`,`ativo`,`ordem`) VALUES (5,'PM-IPM','ipm',1,0);
INSERT INTO `apresentacaotipoprocesso` (`id_apresentacaotipoprocesso`,`apresentacaotipoprocesso`,`procedimentointerno`,`ativo`,`ordem`) VALUES (6,'PM-Sindicância','sindicancia',1,0);
INSERT INTO `apresentacaotipoprocesso` (`id_apresentacaotipoprocesso`,`apresentacaotipoprocesso`,`procedimentointerno`,`ativo`,`ordem`) VALUES (7,'PM-FATD','fatd',1,0);
INSERT INTO `apresentacaotipoprocesso` (`id_apresentacaotipoprocesso`,`apresentacaotipoprocesso`,`procedimentointerno`,`ativo`,`ordem`) VALUES (8,'PM-Inquérito Técnico','it',1,0);
INSERT INTO `apresentacaotipoprocesso` (`id_apresentacaotipoprocesso`,`apresentacaotipoprocesso`,`procedimentointerno`,`ativo`,`ordem`) VALUES (9,'PM-CJ','cj',1,0);
INSERT INTO `apresentacaotipoprocesso` (`id_apresentacaotipoprocesso`,`apresentacaotipoprocesso`,`procedimentointerno`,`ativo`,`ordem`) VALUES (10,'PM-CD','cd',1,0);
INSERT INTO `apresentacaotipoprocesso` (`id_apresentacaotipoprocesso`,`apresentacaotipoprocesso`,`procedimentointerno`,`ativo`,`ordem`) VALUES (11,'PM-ADL','adl',1,0);
INSERT INTO `apresentacaotipoprocesso` (`id_apresentacaotipoprocesso`,`apresentacaotipoprocesso`,`procedimentointerno`,`ativo`,`ordem`) VALUES (12,'PM-ISO','iso',1,0);
INSERT INTO `apresentacaotipoprocesso` (`id_apresentacaotipoprocesso`,`apresentacaotipoprocesso`,`procedimentointerno`,`ativo`,`ordem`) VALUES (13,'PM-PAD','',1,0);
INSERT INTO `apresentacaotipoprocesso` (`id_apresentacaotipoprocesso`,`apresentacaotipoprocesso`,`procedimentointerno`,`ativo`,`ordem`) VALUES (14,'PM-Outro','',1,0);
INSERT INTO `sjd`.`apresentacaotipoprocesso` (`id_apresentacaotipoprocesso`, `apresentacaotipoprocesso`, `procedimentointerno`, `ativo`, `ordem`) VALUES ('15', 'Poder Judiciário', NULL, '1', '0');
INSERT INTO `sjd`.`apresentacaotipoprocesso` (`id_apresentacaotipoprocesso`, `apresentacaotipoprocesso`, `ativo`, `ordem`) VALUES ('16', 'Inquérito Policial', '1', '0');
INSERT INTO `sjd`.`apresentacaotipoprocesso` (`id_apresentacaotipoprocesso`, `apresentacaotipoprocesso`, `ativo`, `ordem`) VALUES ('17', 'VAJME', '1', '0');



CREATE TABLE `apresentacaocondicao` (
  `id_apresentacaocondicao` bigint(20) NOT NULL AUTO_INCREMENT,
  `apresentacaocondicao` varchar(50) DEFAULT NULL,
  `ativo` smallint(6) DEFAULT '1',
  `ordem` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id_apresentacaocondicao`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO `apresentacaocondicao` (`id_apresentacaocondicao`,`apresentacaocondicao`,`ativo`,`ordem`) VALUES (1,'Testemunha',1,0);
INSERT INTO `apresentacaocondicao` (`id_apresentacaocondicao`,`apresentacaocondicao`,`ativo`,`ordem`) VALUES (2,'Juiz Militar - Conselho Permanente',1,0);
INSERT INTO `apresentacaocondicao` (`id_apresentacaocondicao`,`apresentacaocondicao`,`ativo`,`ordem`) VALUES (3,'Juiz Militar - Conselho Especial',1,0);
INSERT INTO `apresentacaocondicao` (`id_apresentacaocondicao`,`apresentacaocondicao`,`ativo`,`ordem`) VALUES (4,'Réu',1,0);
INSERT INTO `apresentacaocondicao` (`id_apresentacaocondicao`,`apresentacaocondicao`,`ativo`,`ordem`) VALUES (5,'Testemunha de Defesa',1,0);
INSERT INTO `apresentacaocondicao` (`id_apresentacaocondicao`,`apresentacaocondicao`,`ativo`,`ordem`) VALUES (6,'Testemunha da Denúncia',1,0);
INSERT INTO `apresentacaocondicao` (`id_apresentacaocondicao`,`apresentacaocondicao`,`ativo`,`ordem`) VALUES (7,'Testemunha de Acusação',1,0);
INSERT INTO `apresentacaocondicao` (`id_apresentacaocondicao`,`apresentacaocondicao`,`ativo`,`ordem`) VALUES (8,'Testemunha do Juízo',1,0);
INSERT INTO `apresentacaocondicao` (`id_apresentacaocondicao`,`apresentacaocondicao`,`ativo`,`ordem`) VALUES (9,'Outro',1,0);
INSERT INTO `sjd`.`apresentacaocondicao` (`id_apresentacaocondicao`, `apresentacaocondicao`, `ativo`, `ordem`) VALUES ('10', 'Não informado', '1', '0');


CREATE TABLE `apresentacaoclassificacaosigilo` (

  `id_apresentacaoclassificacaosigilo` bigint(20) NOT NULL AUTO_INCREMENT,
  `apresentacaoclassificacaosigilo` varchar(50) DEFAULT NULL,
  `ativo` smallint(6) DEFAULT '1',
  `ordem` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id_apresentacaoclassificacaosigilo`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `apresentacaoclassificacaosigilo` (`id_apresentacaoclassificacaosigilo`,`apresentacaoclassificacaosigilo`,`ativo`,`ordem`) VALUES (1,'Publico',1,0);
INSERT INTO `apresentacaoclassificacaosigilo` (`id_apresentacaoclassificacaosigilo`,`apresentacaoclassificacaosigilo`,`ativo`,`ordem`) VALUES (2,'Usuário Siscoger',1,0);
INSERT INTO `apresentacaoclassificacaosigilo` (`id_apresentacaoclassificacaosigilo`,`apresentacaoclassificacaosigilo`,`ativo`,`ordem`) VALUES (3,'Reservado - Pares/Superiores',1,0);
INSERT INTO `apresentacaoclassificacaosigilo` (`id_apresentacaoclassificacaosigilo`,`apresentacaoclassificacaosigilo`,`ativo`,`ordem`) VALUES (4,'Reservado - Somente o próprio',1,0);

CREATE TABLE `apresentacao` (

  `id_apresentacao` bigint(20) NOT NULL AUTO_INCREMENT,

  `sjd_ref` int(11) NOT NULL,
  `sjd_ref_ano` int(11) NOT NULL,
  `cdopm` VARCHAR(20) NULL DEFAULT NULL,

  `chave_de_acesso` varchar(16) DEFAULT NULL,

  `id_notacomparecimento` bigint(20),
  `id_apresentacaoclassificacaosigilo` bigint(20),
`id_apresentacaosituacao` bigint(20),

  `pessoa_rg` varchar(20) NOT NULL,
  `pessoa_posto` varchar(50),
  `pessoa_quadro` varchar(50),
  `pessoa_nome` varchar(160),
  `pessoa_email` varchar(160),
  `pessoa_unidade_lotacao_meta4` varchar(20),
  `pessoa_unidade_lotacao_codigo` varchar(12),
  `pessoa_unidade_lotacao_sigla` varchar(160),
  `pessoa_unidade_lotacao_descricao` varchar(160),
  `pessoa_opm_meta4` varchar(20),
  `pessoa_opm_codigo` varchar(12),
  `pessoa_opm_sigla` varchar(160),
  `pessoa_opm_descricao` varchar(160),

  `documento_de_origem` varchar(100),
  `documento_de_origem_data` date,
  `documento_de_origem_file` VARCHAR(80) NULL,

  `id_apresentacaotipoprocesso` bigint(20),
  `autos_numero` varchar(100),
  `autos_ano` integer DEFAULT NULL,
  `acusados` varchar(255),

  `id_apresentacaocondicao` bigint(20),
  `comparecimento_data` date,
  `comparecimento_hora` time,
  `comparecimento_dh` timestamp NULL DEFAULT NULL,
  `comparecimento_local_txt` text,

  `observacao_txt` text,

  `usuario_rg` varchar(20),
  `criacao_dh` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_apresentacao`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

CREATE TABLE `apresentacaosituacao` (
  `id_apresentacaosituacao` bigint(20) NOT NULL AUTO_INCREMENT,
  `apresentacaosituacao` varchar(50) DEFAULT NULL,
  `apresentacao_concluida` smallint(6) DEFAULT '0',
  `ativo` smallint(6) DEFAULT '1',
  `ordem` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id_apresentacaosituacao`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `apresentacaosituacao` (`id_apresentacaosituacao`,`apresentacaosituacao`,`apresentacao_concluida`,`ativo`,`ordem`) VALUES (1,'Pendente',0,1,0);
INSERT INTO `apresentacaosituacao` (`id_apresentacaosituacao`,`apresentacaosituacao`,`apresentacao_concluida`,`ativo`,`ordem`) VALUES (2,'Notificado',0,1,0);
INSERT INTO `apresentacaosituacao` (`id_apresentacaosituacao`,`apresentacaosituacao`,`apresentacao_concluida`,`ativo`,`ordem`) VALUES (3,'Compareceu',1,1,0);
INSERT INTO `apresentacaosituacao` (`id_apresentacaosituacao`,`apresentacaosituacao`,`apresentacao_concluida`,`ativo`,`ordem`) VALUES (4,'Compareceu/Cancelada',1,1,0);
INSERT INTO `apresentacaosituacao` (`id_apresentacaosituacao`,`apresentacaosituacao`,`apresentacao_concluida`,`ativo`,`ordem`) VALUES (5,'Faltou',1,1,0);
INSERT INTO `apresentacaosituacao` (`id_apresentacaosituacao`,`apresentacaosituacao`,`apresentacao_concluida`,`ativo`,`ordem`) VALUES (6,'Redesignada',1,1,0);
INSERT INTO `apresentacaosituacao` (`id_apresentacaosituacao`, `apresentacaosituacao`, `apresentacao_concluida`, `ativo`, `ordem`) VALUES ('7', 'Temporária', '1', '1', '0');

CREATE TABLE `apresentacao_temp` (
  `id_apresentacao_temp` bigint(20) NOT NULL AUTO_INCREMENT,
  `arquivo` varchar(180) NOT NULL,
  `folha` varchar(150) DEFAULT NULL,
  `linha` bigint(20) DEFAULT NULL,
  `erros_txt` text,
  `divergencia_rg` smallint(6) DEFAULT '0',
  `divergencia_nome` smallint(6) DEFAULT '0',
  `divergencia_opm` smallint(6) DEFAULT '0',
  `sjd_ref` int(11) DEFAULT NULL,
  `sjd_ref_ano` int(11) DEFAULT NULL,
  `cdopm` varchar(20) DEFAULT NULL,
  `id_notacomparecimento` bigint(20) DEFAULT NULL,
  `id_apresentacaoclassificacaosigilo` bigint(20) DEFAULT NULL,
  `id_apresentacaosituacao` bigint(20) DEFAULT NULL,
  `planilha_rg` varchar(20) DEFAULT NULL,
  `planilha_nome` varchar(160) DEFAULT NULL,
  `planilha_opm_sigla` varchar(160) DEFAULT NULL,
  `planilha_dia_comp` varchar(150) DEFAULT NULL,
  `planilha_horario_comp` varchar(150) DEFAULT NULL,
  `pessoa_rg` varchar(20) DEFAULT NULL,
  `pessoa_posto` varchar(50) DEFAULT NULL,
  `pessoa_quadro` varchar(50) DEFAULT NULL,
  `pessoa_nome` varchar(160) DEFAULT NULL,
  `pessoa_email` varchar(160) DEFAULT NULL,
  `pessoa_unidade_lotacao_meta4` varchar(20) DEFAULT NULL,
  `pessoa_unidade_lotacao_codigo` varchar(12) DEFAULT NULL,
  `pessoa_unidade_lotacao_sigla` varchar(160) DEFAULT NULL,
  `pessoa_unidade_lotacao_descricao` varchar(160) DEFAULT NULL,
  `pessoa_opm_meta4` varchar(20) DEFAULT NULL,
  `pessoa_opm_codigo` varchar(12) DEFAULT NULL,
  `pessoa_opm_sigla` varchar(160) DEFAULT NULL,
  `pessoa_opm_descricao` varchar(160) DEFAULT NULL,
  `documento_de_origem` varchar(100) DEFAULT NULL,
  `documento_de_origem_data` date DEFAULT NULL,
  `documento_de_origem_file` varchar(80) DEFAULT NULL,
  `id_apresentacaotipoprocesso` bigint(20) DEFAULT NULL,
  `autos_numero` varchar(100) DEFAULT NULL,
  `autos_ano` int(11) DEFAULT NULL,
  `acusados` varchar(255) DEFAULT NULL,
  `id_apresentacaocondicao` bigint(20) DEFAULT NULL,
  `comparecimento_data` date DEFAULT NULL,
  `comparecimento_hora` time DEFAULT NULL,
  `comparecimento_dh` timestamp NULL DEFAULT NULL,
  `comparecimento_local_txt` text,
  `observacao_txt` text,
  `usuario_rg` varchar(20) DEFAULT NULL,
  `criacao_dh` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_apresentacao_temp`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

CREATE TABLE `apresentacaomassificado` (
  `id_apresentacaomassificado` bigint(20) NOT NULL AUTO_INCREMENT,
  `cdopm` varchar(20) DEFAULT NULL,
  `nome_original_do_arquivo` varchar(160) DEFAULT NULL,
  `datahora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nome_do_arquivo` varchar(160) DEFAULT NULL,
  `nome_da_folha` varchar(160) DEFAULT NULL,
  `qtde_registros` int(11) DEFAULT NULL,
  `qtde_registros_inconsistentes` int(11) DEFAULT NULL,
  `situacao` smallint(6) DEFAULT '0',
  `usuario_rg` varchar(20) DEFAULT NULL,
  `id_notacomparecimento` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_apresentacaomassificado`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

CREATE TABLE `historicocontrolado` (
  `id_historicocontrolado` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario_rg` varchar(20) DEFAULT NULL,
  `usuario_nome` varchar(140) DEFAULT NULL,
  `usuario_nivel` smallint(6) DEFAULT NULL,
  `dh` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(20) DEFAULT NULL,
  `tabela` varchar(160) DEFAULT NULL,
  `id_tabela` bigint(20) DEFAULT NULL,
  `campo` varchar(160) DEFAULT NULL,
  `valor_antigo` text,
  `valor_novo` text,
  PRIMARY KEY (`id_historicocontrolado`),
  KEY `tabela_id_tabela` (`tabela`,`id_tabela`)
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;
