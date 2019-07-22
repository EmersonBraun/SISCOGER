CREATE TABLE `email` (
  `id_email` bigint(20) NOT NULL AUTO_INCREMENT,
  `contexto_email` varchar(255) DEFAULT NULL,
  `id_contexto_email` varchar(100) DEFAULT NULL,
  `remetente_nome` varchar(160) DEFAULT NULL,
  `remetente_email` varchar(160) DEFAULT NULL,
  `destinatario_nome` varchar(160) DEFAULT NULL,
  `destinatario_email` varchar(160) NOT NULL,
  `assunto` varchar(255) NOT NULL,
  `mensagem_txt` text,
  `formato` varchar(90) DEFAULT 'text/plain',
  `anexos` text,
  `usuario_rg` varchar(160) DEFAULT NULL,
  `dh` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dh_agendamento` timestamp NULL DEFAULT NULL,
  `dh_ult_tentativa_com_erro` timestamp NULL DEFAULT NULL,
  `nr_tentativas_com_erro` int(11) NOT NULL DEFAULT '0',
  `erros` text,
  `prioridade` int(11) DEFAULT '5',
  `dh_envio` timestamp NULL DEFAULT NULL,
  `dh_confirmacao_de_leitura` timestamp NULL DEFAULT NULL,
  `dh_cancelamento` timestamp NULL DEFAULT NULL,
  `usuario_rg_cancelamento` varchar(160) DEFAULT NULL,
  PRIMARY KEY (`id_email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `policial_email` (
  `rg` bigint(20) NOT NULL,
  `email` varchar(160) NOT NULL,
  `usuario_rg` varchar(160) DEFAULT NULL,
  `dh` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rg`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
