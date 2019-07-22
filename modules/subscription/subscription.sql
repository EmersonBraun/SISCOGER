CREATE TABLE `subscription` (
  `id_subscription` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `processo_tipo` varchar(100) NOT NULL,
  `processo_id` bigint(20) NOT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `observacao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_subscription`),
  UNIQUE KEY `un_proc_email` (`processo_tipo`,`processo_id`,`email`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
