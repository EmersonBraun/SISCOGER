CREATE TABLE `localdeapresentacao` (
  `id_localdeapresentacao` bigint(20) NOT NULL AUTO_INCREMENT,
  `localdeapresentacao` varchar(255) NOT NULL DEFAULT '',
  `id_municipio` int(11) NOT NULL DEFAULT '82362',
  `bairro` varchar(100) NOT NULL DEFAULT '',
  `uf` char(2) NOT NULL DEFAULT 'PR',
  `logradouro` varchar(100) NOT NULL DEFAULT '',
  `numero` varchar(20) NOT NULL DEFAULT '',
  `complemento` varchar(60) NOT NULL DEFAULT '',
  `cep` char(8) NOT NULL DEFAULT '00000000',
  `telefone` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_localdeapresentacao`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
