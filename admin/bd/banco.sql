-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.24-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema engenhariadasaguas
--

--
-- Definition of table `tb_grupos_logins`
--

DROP TABLE IF EXISTS `tb_grupos_logins`;
CREATE TABLE `tb_grupos_logins` (
  `idgrupologin` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `imagem` varchar(45) DEFAULT NULL,
  `exibir_menu` varchar(3) DEFAULT 'SIM',
  `ativo` varchar(3) NOT NULL DEFAULT 'SIM',
  `url_amigavel` varchar(255) NOT NULL,
  PRIMARY KEY (`idgrupologin`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_grupos_logins`
--

/*!40000 ALTER TABLE `tb_grupos_logins` DISABLE KEYS */;
INSERT INTO `tb_grupos_logins` (`idgrupologin`,`nome`,`imagem`,`exibir_menu`,`ativo`,`url_amigavel`) VALUES 
 (1,'Administradores',NULL,'SIM','SIM',''),
 (9,'Contabilidade',NULL,'SIM','SIM','');
/*!40000 ALTER TABLE `tb_grupos_logins` ENABLE KEYS */;


--
-- Definition of table `tb_grupos_logins_tb_paginas`
--

DROP TABLE IF EXISTS `tb_grupos_logins_tb_paginas`;
CREATE TABLE `tb_grupos_logins_tb_paginas` (
  `id_grupologin` int(11) NOT NULL,
  `id_pagina` int(11) NOT NULL,
  PRIMARY KEY (`id_grupologin`,`id_pagina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_grupos_logins_tb_paginas`
--

/*!40000 ALTER TABLE `tb_grupos_logins_tb_paginas` DISABLE KEYS */;
INSERT INTO `tb_grupos_logins_tb_paginas` (`id_grupologin`,`id_pagina`) VALUES 
 (1,148),
 (1,149),
 (1,150),
 (1,151),
 (1,152),
 (1,153),
 (1,154),
 (1,155),
 (1,156),
 (1,157),
 (1,158),
 (10,148),
 (10,149),
 (10,150),
 (10,151),
 (10,152),
 (10,153),
 (10,154),
 (10,155),
 (10,156),
 (10,157),
 (10,158);
/*!40000 ALTER TABLE `tb_grupos_logins_tb_paginas` ENABLE KEYS */;


--
-- Definition of table `tb_logins`
--

DROP TABLE IF EXISTS `tb_logins`;
CREATE TABLE `tb_logins` (
  `idlogin` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `senha` varchar(45) DEFAULT NULL,
  `ativo` varchar(3) DEFAULT 'SIM',
  `id_grupologin` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`idlogin`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_logins`
--

/*!40000 ALTER TABLE `tb_logins` DISABLE KEYS */;
INSERT INTO `tb_logins` (`idlogin`,`nome`,`senha`,`ativo`,`id_grupologin`,`email`) VALUES 
 (1,'Marcio André da Silva','e10adc3949ba59abbe56e057f20f883e','SIM',1,'marciomas@gmail.com'),
 (2,'David Leandro dos Santos','e10adc3949ba59abbe56e057f20f883e','SIM',1,'design.davidleandro@gmail.com'),
 (3,'Angela','e10adc3949ba59abbe56e057f20f883e','SIM',1,'atendimento.sites@homewebbrasil.com.br'),
 (4,'Masmidia ','e10adc3949ba59abbe56e057f20f883e','SIM',1,'contato@masmdiaia.com.br');
/*!40000 ALTER TABLE `tb_logins` ENABLE KEYS */;


--
-- Definition of table `tb_logs_logins`
--

DROP TABLE IF EXISTS `tb_logs_logins`;
CREATE TABLE `tb_logs_logins` (
  `idloglogin` int(11) NOT NULL AUTO_INCREMENT,
  `operacao` longtext,
  `consulta_sql` longtext,
  `data` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `id_login` int(11) NOT NULL,
  PRIMARY KEY (`idloglogin`)
) ENGINE=InnoDB AUTO_INCREMENT=705 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_logs_logins`
--

/*!40000 ALTER TABLE `tb_logs_logins` DISABLE KEYS */;
INSERT INTO `tb_logs_logins` (`idloglogin`,`operacao`,`consulta_sql`,`data`,`hora`,`id_login`) VALUES 
 (687,'CADASTRO DE GRUPO Contabilidade','INSERT INTO	tb_grupos_logins\r\n					(nome)\r\n					VALUES\r\n					(\'Contabilidade\')','2011-12-15','17:25:17',0),
 (688,'CADASTRO DE GRUPO Buscadores','INSERT INTO	tb_grupos_logins\r\n					(nome)\r\n					VALUES\r\n					(\'Buscadores\')','2011-12-15','17:26:33',0),
 (689,'ALTERAÇÃO DE GRUPO 10','UPDATE tb_grupos_logins SET nome = \'Buscadores --1 121 654\' WHERE idgrupologin = \'10\'','2011-12-15','17:41:11',0),
 (690,'ALTERAÇÃO DE GRUPO 10','UPDATE tb_grupos_logins SET nome = \'Buscadores\' WHERE idgrupologin = \'10\'','2011-12-15','17:41:48',0),
 (691,'EXCLUSÃO DO GRUPO COD: 10, NOME: Buscadores','DELETE FROM tb_grupos_logins WHERE idgrupologin = \'10\'','2011-12-15','17:43:27',0),
 (692,'EXCLUSÃO DO GRUPO COD: 10, NOME: ','DELETE FROM tb_grupos_logins WHERE idgrupologin = \'10\'','2011-12-15','17:43:28',0),
 (693,'EXCLUSÃO DO GRUPO COD: 8, NOME: Testando','DELETE FROM tb_grupos_logins WHERE idgrupologin = \'8\'','2011-12-15','17:43:49',0),
 (694,'DESATIVOU O GRUPO 9','UPDATE tb_grupos_logins SET ativo = \'NAO\' WHERE idgrupologin = \'9\'','2011-12-15','17:44:49',0),
 (695,'ATIVOU O GRUPO 9','UPDATE tb_grupos_logins SET ativo = \'SIM\' WHERE idgrupologin = \'9\'','2011-12-15','17:45:08',0),
 (696,'DESATIVOU O GRUPO 9','UPDATE tb_grupos_logins SET ativo = \'NAO\' WHERE idgrupologin = \'9\'','2011-12-15','17:45:12',0),
 (697,'ATIVOU O GRUPO 9','UPDATE tb_grupos_logins SET ativo = \'SIM\' WHERE idgrupologin = \'9\'','2011-12-15','17:45:17',0),
 (698,'CADASTRO DO LOGIN ','INSERT INTO	tb_logins\r\n					(nome, senha, email, id_grupologin)\r\n					VALUES\r\n					(\'\', \'d41d8cd98f00b204e9800998ecf8427e\', \'\', \'\')','2011-12-15','17:51:02',0),
 (699,'CADASTRO DO LOGIN Andr?','INSERT INTO	tb_logins\r\n					(nome, senha, email, id_grupologin)\r\n					VALUES\r\n					(\'André\', \'e10adc3949ba59abbe56e057f20f883e\', \'marcio@tekan.com.br\', \'1\')','2011-12-15','17:51:47',0),
 (700,'DESATIVOU O LOGIN 11','UPDATE tb_logins SET ativo = \'NAO\' WHERE idlogin = \'11\'','2011-12-15','17:55:35',0),
 (701,'ATIVOU O LOGIN 11','UPDATE tb_logins SET ativo = \'SIM\' WHERE idlogin = \'11\'','2011-12-15','17:55:42',0),
 (702,'ALTERAÇÃO DO LOGIN 11','UPDATE tb_logins SET nome = \'André a\', email = \'marcio@tekan.com.br\', id_grupologin = \'9\' WHERE idlogin = \'11\'','2011-12-15','17:57:51',0),
 (703,'EXCLUSÃO DO LOGIN 10, NOME: , Email: ','DELETE FROM tb_logins WHERE idlogin = \'10\'','2011-12-15','17:58:00',0),
 (704,'EXCLUSÃO DO LOGIN 11, NOME: Andr?, Email: marcio@tekan.com.br','DELETE FROM tb_logins WHERE idlogin = \'11\'','2011-12-15','17:58:10',0);
/*!40000 ALTER TABLE `tb_logs_logins` ENABLE KEYS */;


--
-- Definition of table `tb_modulos_paginas`
--

DROP TABLE IF EXISTS `tb_modulos_paginas`;
CREATE TABLE `tb_modulos_paginas` (
  `idmodulopagina` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `icone_imagem` varchar(45) DEFAULT NULL,
  `ativo` char(3) NOT NULL DEFAULT 'SIM',
  `url_amigavel` varchar(255) NOT NULL,
  PRIMARY KEY (`idmodulopagina`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_modulos_paginas`
--

/*!40000 ALTER TABLE `tb_modulos_paginas` DISABLE KEYS */;
INSERT INTO `tb_modulos_paginas` (`idmodulopagina`,`nome`,`icone_imagem`,`ativo`,`url_amigavel`) VALUES 
 (1,'Grupos',NULL,'SIM',''),
 (2,'Logins',NULL,'SIM','');
/*!40000 ALTER TABLE `tb_modulos_paginas` ENABLE KEYS */;


--
-- Definition of table `tb_paginas`
--

DROP TABLE IF EXISTS `tb_paginas`;
CREATE TABLE `tb_paginas` (
  `idpagina` int(11) NOT NULL AUTO_INCREMENT,
  `pagina` varchar(255) DEFAULT NULL,
  `imagem` varchar(45) DEFAULT NULL,
  `label` varchar(45) DEFAULT NULL,
  `exibir_menu` varchar(3) DEFAULT 'SIM',
  `descricao` varchar(255) DEFAULT NULL,
  `id_modulopagina` int(11) NOT NULL,
  `url_amigavel` varchar(255) NOT NULL,
  PRIMARY KEY (`idpagina`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_paginas`
--

/*!40000 ALTER TABLE `tb_paginas` DISABLE KEYS */;
INSERT INTO `tb_paginas` (`idpagina`,`pagina`,`imagem`,`label`,`exibir_menu`,`descricao`,`id_modulopagina`,`url_amigavel`) VALUES 
 (148,'/admin/grupo/altera.php',NULL,'Alterar','NAO',NULL,1,''),
 (149,'/admin/grupo/cadastra.php',NULL,'Cadastrar','SIM',NULL,1,''),
 (150,'/admin/grupo/exclui.php',NULL,'Excluir','NAO',NULL,1,''),
 (151,'/admin/grupo/lista.php',NULL,'Listar','SIM',NULL,1,''),
 (152,'/admin/grupo/permissoes.php',NULL,'Permissões','NAO',NULL,1,''),
 (153,'/admin/grupo/ativa_desativa.php',NULL,'Ativar e desativar','NAO',NULL,1,''),
 (154,'/admin/login/altera.php',NULL,'Alterar','NAO',NULL,2,''),
 (155,'/admin/login/cadastra.php',NULL,'Cadastrar','SIM',NULL,2,''),
 (156,'/admin/login/exclui.php',NULL,'Excluir','NAO',NULL,2,''),
 (157,'/admin/login/lista.php',NULL,'Listar','SIM',NULL,2,''),
 (158,'/admin/login/ativa_desativa.php',NULL,'Ativar e desativar','NAO',NULL,2,'');
/*!40000 ALTER TABLE `tb_paginas` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;