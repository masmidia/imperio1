-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.23-55


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema masmidia_centralengenharia
--

CREATE DATABASE IF NOT EXISTS masmidia_centralengenharia;
USE masmidia_centralengenharia;

--
-- Definition of table `tb_banners`
--

DROP TABLE IF EXISTS `tb_banners`;
CREATE TABLE `tb_banners` (
  `idbanner` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `subtitulo` varchar(255) NOT NULL,
  `imagem` varchar(45) NOT NULL,
  `link` varchar(255) NOT NULL,
  `ativo` varchar(3) NOT NULL DEFAULT 'SIM',
  `ordem` int(10) unsigned NOT NULL,
  `url_amigavel` varchar(255) NOT NULL,
  `destino_link` varchar(45) NOT NULL DEFAULT '_self',
  PRIMARY KEY (`idbanner`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_banners`
--

/*!40000 ALTER TABLE `tb_banners` DISABLE KEYS */;
INSERT INTO `tb_banners` (`idbanner`,`titulo`,`subtitulo`,`imagem`,`link`,`ativo`,`ordem`,`url_amigavel`,`destino_link`) VALUES 
 (1,'TERRAPLENAGEM','Desde 1999 construindo com alto padrão de qualidade.','0406201312151292054731.jpg','','SIM',0,'terraplenagem','_self'),
 (2,'teste','Sempre prestando o melhor serviço','0406201312161335098749.jpg','','SIM',0,'teste','_self'),
 (3,'testando','teste subtitulo','0406201312181353026154.jpg','','SIM',0,'testando','_self');
/*!40000 ALTER TABLE `tb_banners` ENABLE KEYS */;


--
-- Definition of table `tb_categoria_locacao`
--

DROP TABLE IF EXISTS `tb_categoria_locacao`;
CREATE TABLE `tb_categoria_locacao` (
  `idcategorialocacao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `ativo` varchar(3) NOT NULL DEFAULT 'SIM',
  `ordem` int(10) unsigned NOT NULL,
  `url_amigavel` varchar(255) NOT NULL,
  PRIMARY KEY (`idcategorialocacao`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_categoria_locacao`
--

/*!40000 ALTER TABLE `tb_categoria_locacao` DISABLE KEYS */;
INSERT INTO `tb_categoria_locacao` (`idcategorialocacao`,`titulo`,`ativo`,`ordem`,`url_amigavel`) VALUES 
 (1,'CAMINHÕES','SIM',0,'caminhoes'),
 (2,'TRATORES','SIM',0,'tratores'),
 (3,'MINI CARREGADEIRA','SIM',0,'mini-carregadeira');
/*!40000 ALTER TABLE `tb_categoria_locacao` ENABLE KEYS */;


--
-- Definition of table `tb_clientes`
--

DROP TABLE IF EXISTS `tb_clientes`;
CREATE TABLE `tb_clientes` (
  `idcliente` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(80) NOT NULL,
  `imagem` varchar(45) NOT NULL DEFAULT 'sem_imagem.jpg',
  `link` varchar(255) NOT NULL,
  `ativo` varchar(3) NOT NULL DEFAULT 'SIM',
  `ordem` int(10) unsigned NOT NULL,
  `url_amigavel` varchar(255) NOT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_clientes`
--

/*!40000 ALTER TABLE `tb_clientes` DISABLE KEYS */;
INSERT INTO `tb_clientes` (`idcliente`,`titulo`,`imagem`,`link`,`ativo`,`ordem`,`url_amigavel`) VALUES 
 (1,'Tecnisa','0306201311501234495446.jpg','http://www.tecnisa.com.br','SIM',0,'tecnisa'),
 (2,'xavier','0306201311531282648546.jpg','http://www.xavierengenharia.com.br/','SIM',0,'xavier'),
 (3,'provia','0306201311541227333608.jpg','http://www.provia.pt/','SIM',0,'provia'),
 (4,'Metron','0306201311551355051540.gif','http://www.metronengenharia.com.br/','SIM',0,'metron'),
 (5,'cristal','0306201311551284527959.jpg','','SIM',0,'cristal'),
 (6,'hr','0306201311571133645812.gif','','SIM',0,'hr');
/*!40000 ALTER TABLE `tb_clientes` ENABLE KEYS */;


--
-- Definition of table `tb_configuracoes`
--

DROP TABLE IF EXISTS `tb_configuracoes`;
CREATE TABLE `tb_configuracoes` (
  `idconfiguracao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title_google` varchar(255) NOT NULL,
  `description_google` longtext NOT NULL,
  `keywords_google` longtext NOT NULL,
  `ativo` varchar(3) NOT NULL DEFAULT 'SIM',
  `ordem` int(10) unsigned NOT NULL,
  `url_amigavel` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `telefone1` varchar(255) NOT NULL,
  `telefone2` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  PRIMARY KEY (`idconfiguracao`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_configuracoes`
--

/*!40000 ALTER TABLE `tb_configuracoes` DISABLE KEYS */;
INSERT INTO `tb_configuracoes` (`idconfiguracao`,`title_google`,`description_google`,`keywords_google`,`ativo`,`ordem`,`url_amigavel`,`endereco`,`telefone1`,`telefone2`,`email`,`latitude`,`longitude`) VALUES 
 (1,'Terraplanagem, Asfalto, Engenharia Civil, Enhenharia de Telecomunicações, Engenharia Elétrica e Infra-Estrutura em Brasília-DF','Atuando no ramo de Engenharia Elétrica, Civil, Telecomunicações, Mecânica, Terraplenagem, Pavimentação e Drenagem Tecnológica, primando pela competência aliada à competitividade.Com usina de asfalto instalada em Brasília atendemos a toda região, colocando à disposição tecnologia e eficiência na prestação desse serviços. Procuramos oferecer o melhor atendimento do mercado e contando com a sua confiança, efetuando conosco seu orçamento para as obras de pavimentação e compra de CBUQ.','Central Engenharia, empresa engenharia, empresas engenharia, empresas engenharia civil, empresa engenharia civil, engenharia civil empresas, empresas engenharia eletrica, empresa engenharia eletrica, empresa terraplanagem, empresas terraplanagem, maquinas terraplanagem, construtora terraplanagem, construtora, construtoras, pavimentacao asfaltica, empresas terraplenagem, maquinas para terraplenagem, maquinas terraplenagem, equipamentos para terraplenagem, equipamentos terraplenagem, terraplenagem, Engenharia Elétrica, Civil, Telecomunicações, Mecânica, Terraplenagem, Pavimentação e Drenagem Tecnológica, Asfalto, Emborrachado, Fresagem, Sinalização Viária, Pavimentação Brasília, Escavação, Carga, Transporte e Compactação','SIM',0,'terraplanagem-asfalto-engenharia-civil-enhenharia-de-telecomunicacoes-engenharia-eletrica-e-infraestrutura-em-brasiliadf','Rua Bolandeira, 202, centro, Barreiras-BA','(77) 3611-1411','(61) 9999-9999','david@masmidia.com.br','-12.963471','-38.429029');
/*!40000 ALTER TABLE `tb_configuracoes` ENABLE KEYS */;


--
-- Definition of table `tb_empresa`
--

DROP TABLE IF EXISTS `tb_empresa`;
CREATE TABLE `tb_empresa` (
  `idempresa` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descricao` longtext NOT NULL,
  `title_google` varchar(255) NOT NULL,
  `description_google` varchar(255) NOT NULL,
  `keywords_google` varchar(255) NOT NULL,
  `ativo` varchar(3) NOT NULL DEFAULT 'SIM',
  `ordem` int(10) unsigned NOT NULL,
  `imagem` varchar(45) NOT NULL,
  `tumb_imagem` varchar(45) NOT NULL,
  `url_amigavel` varchar(255) NOT NULL,
  `texto_chamada` varchar(255) NOT NULL,
  PRIMARY KEY (`idempresa`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_empresa`
--

/*!40000 ALTER TABLE `tb_empresa` DISABLE KEYS */;
INSERT INTO `tb_empresa` (`idempresa`,`titulo`,`descricao`,`title_google`,`description_google`,`keywords_google`,`ativo`,`ordem`,`imagem`,`tumb_imagem`,`url_amigavel`,`texto_chamada`) VALUES 
 (1,'A EMPRESA','<h1>\r\n	A EMPRESA</h1>\r\n<p>\r\n	Desde junho de 1999, data em que a CENTRAL ENGENHARIA E CONSTRUTORA LTDA, foi consolidada, as bases de uma empresa que hoje tem significativa presen&ccedil;a no setor de engenharias no Distrito Federal e atuando em todo o Brasil. A CENTRAL ENGENHARIA vem deixando a sua marca, que exprime alto padr&atilde;o de qualidade, sendo esta que caracteriza seu nome para al&eacute;m das fronteiras do Distrito Federal, que busca cada vez mais aperfei&ccedil;oar o trabalho conjunto priorizando a qualidade e seguran&ccedil;a.</p>\r\n<p>\r\n	Desde ent&atilde;o, tem sido conscientizado e demonstrado sua pericia de administra&ccedil;&atilde;o de Engenharias para uma diversa e exigente classe de clientes, sempre cumprindo seus compromissos com seriedade e respeito, tendo entregue diversas obras nestes anos de experi&ecirc;ncia e diversas em andamento.</p>\r\n<p>\r\n	Atuando no ramo de Engenharia El&eacute;trica, Civil, Telecomunica&ccedil;&otilde;es, Mec&acirc;nica, Terraplenagem, Pavimenta&ccedil;&atilde;o e Drenagem Tecnol&oacute;gica, primando pela compet&ecirc;ncia aliada &agrave; competitividade.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<h1>\r\n	ASFALTO</h1>\r\n<p>\r\n	Com usina de asfalto instalada em Bras&iacute;lia atendemos a toda regi&atilde;o, colocando &agrave; disposi&ccedil;&atilde;o tecnologia e efici&ecirc;ncia na presta&ccedil;&atilde;o desse servi&ccedil;os.</p>\r\n<p>\r\n	Procuramos oferecer o melhor atendimento do mercado e contando com a sua confian&ccedil;a, efetuando conosco seu or&ccedil;amento para as obras de pavimenta&ccedil;&atilde;o e compra de CBUQ.</p>\r\n<h2>\r\n	Atividades:</h2>\r\n<ul>\r\n	<li>\r\n		Projetos&nbsp;</li>\r\n	<li>\r\n		Terraplanagem (Escava&ccedil;&atilde;o, Carga, Transporte e Compacta&ccedil;&atilde;o)</li>\r\n	<li>\r\n		Pavimenta&ccedil;&atilde;o CBUQ&nbsp;</li>\r\n	<li>\r\n		Pavimenta&ccedil;&atilde;o TSS&nbsp;</li>\r\n	<li>\r\n		Pavimenta&ccedil;&atilde;o TSD&nbsp;</li>\r\n	<li>\r\n		Pavimenta&ccedil;&atilde;o TST</li>\r\n	<li>\r\n		Pavimenta&ccedil;&atilde;o com Micro Revestimento&nbsp;</li>\r\n	<li>\r\n		Pavimenta&ccedil;&atilde;o com Lama Asf&aacute;ltica&nbsp;</li>\r\n	<li>\r\n		Asfalto Emborrachado</li>\r\n	<li>\r\n		Fresagem&nbsp;</li>\r\n	<li>\r\n		Sinaliza&ccedil;&atilde;o Vi&aacute;ria</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<h1>\r\n	ENGENHARIA CIVIL</h1>\r\n<p>\r\n	Uma organiza&ccedil;&atilde;o ligada a todo tipo de atividade na constru&ccedil;&atilde;o civil, tendo como objetivo, satisfazer as necessidades dos seus clientes, com plena qualidade, agilidade e seguran&ccedil;a; garantindo total satisfa&ccedil;&atilde;o em rela&ccedil;&atilde;o aos nossos servi&ccedil;os. Contamos com uma excelente equipe de trabalho, um grupo de pessoas totalmente qualificadas e treinadas para dar suporte e assist&ecirc;ncia.</p>\r\n<h2>\r\n	Atividades:</h2>\r\n<ul>\r\n	<li>\r\n		Projetos&nbsp;</li>\r\n	<li>\r\n		Edifica&ccedil;&otilde;es&nbsp;</li>\r\n	<li>\r\n		Impermeabiliza&ccedil;&otilde;es&nbsp;</li>\r\n	<li>\r\n		Funda&ccedil;&otilde;es</li>\r\n	<li>\r\n		Concretagem</li>\r\n	<li>\r\n		Formas</li>\r\n	<li>\r\n		Pisos de alta resist&ecirc;ncia</li>\r\n	<li>\r\n		Pinturas especiais</li>\r\n	<li>\r\n		Constru&ccedil;&otilde;es pesadas</li>\r\n	<li>\r\n		Divis&oacute;rias</li>\r\n	<li>\r\n		Hidrosaitaria</li>\r\n	<li>\r\n		Estrutura met&aacute;lica / espacial</li>\r\n</ul>\r\n<h1>\r\n	ENGENHARIA DE TELECOMUNICA&Ccedil;&Otilde;ES</h1>\r\n<p>\r\n	Atuamos em telecomunica&ccedil;&otilde;es trazendo inova&ccedil;&otilde;es tecnol&oacute;gicas e novos conceitos de comunica&ccedil;&otilde;es, levando solu&ccedil;&otilde;es que agreguem valor, melhoria de comunica&ccedil;&atilde;o e redu&ccedil;&atilde;o de custos aos nossos clientes.&nbsp;</p>\r\n<h2>\r\n	Atividades:</h2>\r\n<ul>\r\n	<li>\r\n		Projetos&nbsp;</li>\r\n	<li>\r\n		Sistema de Seguran&ccedil;a Eletr&ocirc;nica - CFTV Digital</li>\r\n	<li>\r\n		Automa&ccedil;&atilde;o Industrial&nbsp;</li>\r\n	<li>\r\n		Voz sobre IP&nbsp;</li>\r\n	<li>\r\n		Certifica&ccedil;&atilde;o de rede L&oacute;gica</li>\r\n	<li>\r\n		Salas de TI - Teleconfer&ecirc;ncia</li>\r\n	<li>\r\n		Sistemas Wireless&nbsp;</li>\r\n	<li>\r\n		Rede de Telefonia&nbsp;</li>\r\n	<li>\r\n		Instala&ccedil;&otilde;es Telef&ocirc;nicas&nbsp;</li>\r\n	<li>\r\n		Montagem de Central Telef&ocirc;nica&nbsp;</li>\r\n	<li>\r\n		Cabeamento em Fibra &Oacute;ptica&nbsp;</li>\r\n	<li>\r\n		Instala&ccedil;&otilde;es de Ativos</li>\r\n</ul>\r\n<h1>\r\n	ENGENHARIA EL&Eacute;TRICA</h1>\r\n<p>\r\n	A nossa for&ccedil;a nas &aacute;reas em que atuamos da Engenharia El&eacute;trica, encontra-se em especial no pessoal especializado no desenvolvimento de projetos e sistemas e em sua implementa&ccedil;&atilde;o, bem como na estreita integra&ccedil;&atilde;o com nossos clientes. A combina&ccedil;&atilde;o de conhecimentos t&eacute;cnicos e de neg&oacute;cios &eacute; o alicerce para o processo que nos leva a obter sucesso,atendendo aos requisitos mais rigorosos de mercado. Possuindo ampla experi&ecirc;ncia em instala&ccedil;&atilde;o de ilumina&ccedil;&atilde;o profissional com apresenta&ccedil;&atilde;o de projeto luminot&eacute;cnico, medi&ccedil;&otilde;es do &iacute;ndice de ilumin&acirc;ncia de ambientes com lux&iacute;metro, manuten&ccedil;&atilde;o em ilumina&ccedil;&atilde;o p&uacute;blica e privada.&nbsp;</p>\r\n<h2>\r\n	Atividades:</h2>\r\n<ul>\r\n	<li>\r\n		Projetos&nbsp;</li>\r\n	<li>\r\n		SPDA (Proje&ccedil;&atilde;o Atmosf&eacute;rica)&nbsp;</li>\r\n	<li>\r\n		Constru&ccedil;&atilde;o de Rede Estabilizada&nbsp;</li>\r\n	<li>\r\n		Constru&ccedil;&atilde;o de Rede Via No-Break&nbsp;</li>\r\n	<li>\r\n		Aterramentos Especiais&nbsp;</li>\r\n	<li>\r\n		Instala&ccedil;&otilde;es Prediais&nbsp;</li>\r\n	<li>\r\n		Ilumina&ccedil;&atilde;o Publica&nbsp;</li>\r\n	<li>\r\n		Subesta&ccedil;&otilde;es</li>\r\n	<li>\r\n		Manuten&ccedil;&atilde;o El&eacute;trica Predial&nbsp;</li>\r\n	<li>\r\n		Linha Media e Baixa Tens&atilde;o&nbsp;</li>\r\n	<li>\r\n		Montagem Eletromec&acirc;nica&nbsp;</li>\r\n	<li>\r\n		Sistema de Prote&ccedil;&atilde;o e Combate a Inc&ecirc;ndio</li>\r\n	<li>\r\n		Instala&ccedil;&atilde;o de Banco de Capacitores</li>\r\n	<li>\r\n		Analise de Grandezas El&eacute;tricas&nbsp;</li>\r\n	<li>\r\n		Grupo de Geradores&nbsp;</li>\r\n	<li>\r\n		Rede de Alta, Media e baixa tens&atilde;o&nbsp;</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<h1>\r\n	INFRA-ESTRUTURA</h1>\r\n<p>\r\n	Contamos com equipamentos de primeira linha aplicados em obras acompanhadas por profissionais especializados, tudo nos padro&otilde;es da Engenharia Civil, Engenharia El&eacute;trica, Engenharia de telecomunica&ccedil;&otilde;es e asfalto.</p>\r\n<h2>\r\n	Atividades:</h2>\r\n<ul>\r\n	<li>\r\n		Projetos</li>\r\n	<li>\r\n		Estrutura de concreto protendido &quot;Pontes e Viadutos Rodovir&aacute;rios&quot;&nbsp;</li>\r\n	<li>\r\n		MND</li>\r\n	<li>\r\n		Tunnel Liner</li>\r\n	<li>\r\n		Saneamento B&aacute;sico</li>\r\n	<li>\r\n		Drenagem Pluvial&nbsp;</li>\r\n	<li>\r\n		Drenagem&nbsp;</li>\r\n	<li>\r\n		Urbaniza&ccedil;&atilde;o&nbsp;</li>\r\n	<li>\r\n		Paisagismo</li>\r\n</ul>','','','','SIM',0,'','','a-empresa','Contando um BREVE historico da CENTRAL para que o leitor tenha um pequeno conhecimento do surgimento da empresa'),
 (2,'ATUAÇÃO','<h1>\r\n	Atua&ccedil;&atilde;o</h1>\r\n<p>\r\n	Texto de Atua&ccedil;&atilde;o&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sit amet est augue, quis facilisis augue. Morbi non turpis felis, vel accumsan purus. Ut et nulla velit. Nam sit amet massa id magna cursus molestie sit amet et velit. Phasellus dapibus est quis dolor bibendum et malesuada ipsum lacinia. Phasellus quis lorem nec risus ullamcorper rutrum ut sed massa. In egestas, lacus ac consectetur cursus, ligula metus facilisis tellus, ac posuere nibh lacus quis lectus. Etiam suscipit dapibus magna quis laoreet. Cras ut mattis risus. Nunc tortor velit, pharetra non euismod non, volutpat at sapien. Suspendisse volutpat lobortis metus, ut ultrices odio sollicitudin pretium.</p>\r\n<p>\r\n	Proin interdum rutrum urna, sit amet volutpat lectus egestas quis. Phasellus ultricies tempus pharetra. Ut nisl sapien, aliquet a rutrum consequat, euismod eget odio. Ut tellus odio, tincidunt ac dignissim ac, placerat ac nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc ultricies felis vel est aliquet non rhoncus leo rhon</p>','','','','SIM',0,'','','atuacao','bContando um BREVE historico da CENTRAL para que o leitor tenha um pequeno conhecimento do surgimento da empresa'),
 (3,'SUSTENTABILIDADE','<h1>\r\n	Sustentabilidade</h1>\r\n<p>\r\n	Texto de Sustentabilidade Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sit amet est augue, quis facilisis augue. Morbi non turpis felis, vel accumsan purus. Ut et nulla velit. Nam sit amet massa id magna cursus molestie sit amet et velit. Phasellus dapibus est quis dolor bibendum et malesuada ipsum lacinia. Phasellus quis lorem nec risus ullamcorper rutrum ut sed massa. In egestas, lacus ac consectetur cursus, ligula metus facilisis tellus, ac posuere nibh lacus quis lectus. Etiam suscipit dapibus magna quis laoreet. Cras ut mattis risus. Nunc tortor velit, pharetra non euismod non, volutpat at sapien. Suspendisse volutpat lobortis metus, ut ultrices odio sollicitudin pretium.</p>\r\n<p>\r\n	Proin interdum rutrum urna, sit amet volutpat lectus egestas quis. Phasellus ultricies tempus pharetra. Ut nisl sapien, aliquet a rutrum consequat, euismod eget odio. Ut tellus odio, tincidunt ac dignissim ac, placerat ac nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc ultricies felis vel est aliquet non rhoncus leo rhon</p>','','','','SIM',0,'','','sustentabilidade','cContando um BREVE historico da CENTRAL para que o leitor tenha um pequeno conhecimento do surgimento da empresa');
/*!40000 ALTER TABLE `tb_empresa` ENABLE KEYS */;


--
-- Definition of table `tb_galerias_obras`
--

DROP TABLE IF EXISTS `tb_galerias_obras`;
CREATE TABLE `tb_galerias_obras` (
  `idgaleriasobras` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_obra` int(10) unsigned NOT NULL,
  `imagem` varchar(45) NOT NULL,
  `ativo` varchar(3) NOT NULL DEFAULT 'SIM',
  `ordem` int(10) unsigned NOT NULL,
  `url_amigavel` varchar(255) NOT NULL,
  PRIMARY KEY (`idgaleriasobras`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_galerias_obras`
--

/*!40000 ALTER TABLE `tb_galerias_obras` DISABLE KEYS */;
INSERT INTO `tb_galerias_obras` (`idgaleriasobras`,`id_obra`,`imagem`,`ativo`,`ordem`,`url_amigavel`) VALUES 
 (6,2,'0306201309379636144642.jpg','SIM',0,''),
 (7,2,'0306201309373052365618.jpg','SIM',0,''),
 (8,2,'0306201309372320198623.jpg','SIM',0,''),
 (9,2,'0306201309377285962320.jpg','SIM',0,''),
 (10,2,'0306201309385936554012.jpg','SIM',0,''),
 (11,1,'0306201309403206697251.jpg','SIM',0,''),
 (12,1,'0306201309409550846839.jpg','SIM',0,''),
 (13,1,'0306201309403259413929.jpg','SIM',0,''),
 (14,1,'0306201309404870809850.jpg','SIM',0,''),
 (15,1,'0306201309411744875063.jpg','SIM',0,'');
/*!40000 ALTER TABLE `tb_galerias_obras` ENABLE KEYS */;


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
 (1,159),
 (1,160),
 (1,161),
 (1,162),
 (1,163),
 (1,164),
 (1,165),
 (1,166),
 (1,167),
 (1,168),
 (1,169),
 (1,170),
 (1,171),
 (1,172),
 (1,173),
 (1,174),
 (1,175),
 (1,176),
 (1,177),
 (1,178),
 (1,179),
 (1,180),
 (1,181),
 (1,182),
 (1,183),
 (1,184),
 (1,185),
 (1,186),
 (1,187),
 (1,188),
 (1,189),
 (1,190),
 (1,191),
 (1,192),
 (1,193),
 (1,194),
 (1,195),
 (1,196),
 (1,197),
 (1,198),
 (1,199),
 (1,200),
 (1,201),
 (1,202),
 (1,203),
 (1,204),
 (1,205),
 (1,206),
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
-- Definition of table `tb_locacao`
--

DROP TABLE IF EXISTS `tb_locacao`;
CREATE TABLE `tb_locacao` (
  `idlocacao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(80) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `imagem` varchar(45) NOT NULL DEFAULT 'sem_imagem.jpg',
  `id_categorialocacao` int(10) unsigned NOT NULL,
  `ativo` varchar(3) NOT NULL DEFAULT 'SIM',
  `ordem` int(10) unsigned NOT NULL,
  `url_amigavel` varchar(255) NOT NULL,
  PRIMARY KEY (`idlocacao`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_locacao`
--

/*!40000 ALTER TABLE `tb_locacao` DISABLE KEYS */;
INSERT INTO `tb_locacao` (`idlocacao`,`titulo`,`descricao`,`imagem`,`id_categorialocacao`,`ativo`,`ordem`,`url_amigavel`) VALUES 
 (1,'Mercedez Benz Actros','Ideal para carga em extrapesados','0306201309089276795585.jpg',1,'SIM',0,'mercedez-benz-actros'),
 (2,'Mercedez Benz Actros II','Ideal para carga em extrapesados II','0306201309106264175553.jpg',1,'SIM',0,'mercedez-benz-actros-ii'),
 (3,'Minicarregadeira','Descrição breve da locacao','0306201309301892566900.jpg',3,'SIM',0,'minicarregadeira'),
 (4,'Minicarregadeira 2','Descrição breve da locacao','0306201309316014449749.jpg',3,'SIM',0,'minicarregadeira-2'),
 (5,'Trator 2','Descrição breve da locacao','0306201309272562298621.gif',2,'SIM',0,'trator-2');
/*!40000 ALTER TABLE `tb_locacao` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=803 DEFAULT CHARSET=utf8;

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
 (704,'EXCLUSÃO DO LOGIN 11, NOME: Andr?, Email: marcio@tekan.com.br','DELETE FROM tb_logins WHERE idlogin = \'11\'','2011-12-15','17:58:10',0),
 (705,'ALTERAÇÃO DO CLIENTE ','','2013-06-01','16:05:27',2),
 (706,'ALTERAÇÃO DO CLIENTE ','','2013-06-01','16:05:39',2),
 (707,'CADASTRO DO CLIENTE ','','2013-06-01','16:20:04',2),
 (708,'CADASTRO DO CLIENTE ','','2013-06-01','17:31:39',2),
 (709,'CADASTRO DO CLIENTE ','','2013-06-01','17:33:29',2),
 (710,'CADASTRO DO CLIENTE ','','2013-06-01','17:33:51',2),
 (711,'CADASTRO DO CLIENTE ','','2013-06-01','17:34:24',2),
 (712,'CADASTRO DO CLIENTE ','','2013-06-01','17:34:53',2),
 (713,'CADASTRO DO CLIENTE ','','2013-06-01','17:48:57',2),
 (714,'CADASTRO DO CLIENTE ','','2013-06-01','17:49:07',2),
 (715,'CADASTRO DO CLIENTE ','','2013-06-01','17:49:18',2),
 (716,'CADASTRO DO CLIENTE ','','2013-06-01','18:01:18',2),
 (717,'CADASTRO DO CLIENTE ','','2013-06-01','18:03:07',2),
 (718,'CADASTRO DO CLIENTE ','','2013-06-01','18:03:37',2),
 (719,'CADASTRO DO CLIENTE ','','2013-06-01','18:04:47',2),
 (720,'CADASTRO DO CLIENTE ','','2013-06-01','18:05:19',2),
 (721,'CADASTRO DO CLIENTE ','','2013-06-01','18:45:12',2),
 (722,'CADASTRO DO CLIENTE ','','2013-06-01','19:05:45',2),
 (723,'ALTERAÇÃO DO CLIENTE ','','2013-06-01','19:18:43',2),
 (724,'ALTERAÇÃO DO CLIENTE ','','2013-06-01','19:19:02',2),
 (725,'CADASTRO DO CLIENTE ','','2013-06-03','23:47:27',2),
 (726,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','23:48:26',2),
 (727,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','23:50:29',2),
 (728,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','23:50:45',2),
 (729,'CADASTRO DO CLIENTE ','','2013-06-03','23:53:47',2),
 (730,'CADASTRO DO CLIENTE ','','2013-06-03','23:54:40',2),
 (731,'CADASTRO DO CLIENTE ','','2013-06-03','23:55:17',2),
 (732,'CADASTRO DO CLIENTE ','','2013-06-03','23:55:56',2),
 (733,'CADASTRO DO CLIENTE ','','2013-06-03','23:57:06',2),
 (734,'CADASTRO DO CLIENTE ','','2013-06-04','00:15:17',2),
 (735,'CADASTRO DO CLIENTE ','','2013-06-04','00:16:26',2),
 (736,'CADASTRO DO CLIENTE ','','2013-06-04','00:18:01',2),
 (737,'ALTERAÇÃO DO CLIENTE ','','2013-06-04','00:28:11',2),
 (738,'ALTERAÇÃO DO CLIENTE ','','2013-06-04','00:29:18',2),
 (739,'ALTERAÇÃO DO CLIENTE ','','2013-06-04','00:34:33',2),
 (740,'ALTERAÇÃO DO CLIENTE ','','2013-06-04','00:34:56',2),
 (741,'ALTERAÇÃO DO CLIENTE ','','2013-06-04','00:42:20',2),
 (742,'ALTERAÇÃO DO CLIENTE ','','2013-06-04','00:48:25',2),
 (743,'ALTERAÇÃO DO CLIENTE ','','2013-06-04','00:48:36',2),
 (744,'ALTERAÇÃO DO CLIENTE ','','2013-06-04','01:01:55',2),
 (745,'ALTERAÇÃO DO CLIENTE ','','2013-06-04','01:02:23',2),
 (746,'ALTERAÇÃO DO CLIENTE ','','2013-06-04','01:05:52',2),
 (747,'ALTERAÇÃO DO CLIENTE ','','2013-06-04','01:06:37',2),
 (748,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','20:56:36',3),
 (749,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:03:11',3),
 (750,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:05:09',3),
 (751,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:05:17',3),
 (752,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:05:24',3),
 (753,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:08:59',3),
 (754,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:10:46',3),
 (755,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:19:10',3),
 (756,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:21:43',3),
 (757,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:24:12',3),
 (758,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:24:19',3),
 (759,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:26:27',3),
 (760,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:27:26',3),
 (761,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:30:31',3),
 (762,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:31:57',3),
 (763,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:34:49',3),
 (764,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:39:20',3),
 (765,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:45:13',3),
 (766,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:47:47',3),
 (767,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:48:16',3),
 (768,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:49:08',3),
 (769,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:49:31',3),
 (770,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:50:57',3),
 (771,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:53:11',3),
 (772,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:53:15',3),
 (773,'ALTERAÇÃO DO CLIENTE ','','2013-06-03','21:53:19',3),
 (774,'ALTERAÇÃO DO CLIENTE ','','2013-06-05','18:33:43',3),
 (775,'ALTERAÇÃO DO CLIENTE ','','2013-06-05','18:34:06',3),
 (776,'ALTERAÇÃO DO CLIENTE ','','2013-06-05','18:34:39',3),
 (777,'ALTERAÇÃO DO CLIENTE ','','2013-06-05','18:35:25',3),
 (778,'ALTERAÇÃO DO CLIENTE ','','2013-06-05','18:35:46',3),
 (779,'ALTERAÇÃO DO CLIENTE ','','2013-06-05','18:39:40',3),
 (780,'ALTERAÇÃO DO CLIENTE ','','2013-06-05','18:39:56',3),
 (781,'ALTERAÇÃO DO CLIENTE ','','2013-06-05','18:40:14',3),
 (782,'ALTERAÇÃO DO CLIENTE ','','2013-06-05','18:40:30',3),
 (783,'ALTERAÇÃO DO CLIENTE ','','2013-06-05','19:48:05',3),
 (784,'ALTERAÇÃO DO CLIENTE ','','2013-06-05','19:48:26',3),
 (785,'ALTERAÇÃO DO CLIENTE ','','2013-06-05','19:48:33',3),
 (786,'ALTERAÇÃO DO CLIENTE ','','2013-06-05','19:48:42',3),
 (787,'ALTERAÇÃO DO CLIENTE ','','2013-06-05','19:49:05',3),
 (788,'ALTERAÇÃO DO CLIENTE ','','2013-06-05','19:49:26',3),
 (789,'ALTERAÇÃO DO CLIENTE ','','2013-06-05','19:49:57',3),
 (790,'ALTERAÇÃO DO CLIENTE ','','2013-06-05','19:50:12',3),
 (791,'ALTERAÇÃO DO CLIENTE ','','2013-06-05','19:50:31',3),
 (792,'ALTERAÇÃO DO CLIENTE ','','2013-06-05','19:50:57',3),
 (793,'ALTERAÇÃO DO CLIENTE ','','2013-06-05','19:51:16',3),
 (794,'ALTERAÇÃO DO CLIENTE ','','2013-06-05','20:10:50',3),
 (795,'ALTERAÇÃO DO CLIENTE ','','2013-06-07','18:35:21',3),
 (796,'ALTERAÇÃO DO CLIENTE ','','2013-06-07','18:37:25',3),
 (797,'ALTERAÇÃO DO CLIENTE ','','2013-06-07','18:38:09',3),
 (798,'ALTERAÇÃO DO CLIENTE ','','2013-06-07','18:39:15',3),
 (799,'CADASTRO DO CLIENTE ','','2013-06-07','18:40:00',3),
 (800,'ALTERAÇÃO DO CLIENTE ','','2013-06-07','19:03:48',3),
 (801,'ALTERAÇÃO DO CLIENTE ','','2013-06-07','19:12:04',3),
 (802,'ALTERAÇÃO DO CLIENTE ','','2013-06-07','19:12:51',3);
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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_modulos_paginas`
--

/*!40000 ALTER TABLE `tb_modulos_paginas` DISABLE KEYS */;
INSERT INTO `tb_modulos_paginas` (`idmodulopagina`,`nome`,`icone_imagem`,`ativo`,`url_amigavel`) VALUES 
 (1,'Grupos',NULL,'SIM',''),
 (2,'Logins',NULL,'SIM',''),
 (28,'Configurações do Site',NULL,'SIM',''),
 (29,'Empresa',NULL,'SIM',''),
 (30,'Parceiros',NULL,'SIM',''),
 (31,'Categoria Locação',NULL,'SIM',''),
 (32,'Locação',NULL,'SIM',''),
 (33,'Obras',NULL,'SIM',''),
 (34,'Clientes',NULL,'SIM',''),
 (35,'Banners',NULL,'SIM','');
/*!40000 ALTER TABLE `tb_modulos_paginas` ENABLE KEYS */;


--
-- Definition of table `tb_obras`
--

DROP TABLE IF EXISTS `tb_obras`;
CREATE TABLE `tb_obras` (
  `idobra` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(80) NOT NULL,
  `imagem` varchar(45) NOT NULL DEFAULT 'sem_imagem.jpg',
  `descricao` longtext NOT NULL,
  `cidade` varchar(80) NOT NULL,
  `estado` varchar(80) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `andamento` int(10) unsigned NOT NULL,
  `latitude` varchar(45) NOT NULL,
  `longitude` varchar(45) NOT NULL,
  `ativo` varchar(3) NOT NULL DEFAULT 'SIM',
  `ordem` int(10) unsigned NOT NULL,
  `url_amigavel` varchar(255) NOT NULL,
  `title_google` varchar(255) NOT NULL,
  `keywords_google` longtext NOT NULL,
  `description_google` longtext NOT NULL,
  PRIMARY KEY (`idobra`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_obras`
--

/*!40000 ALTER TABLE `tb_obras` DISABLE KEYS */;
INSERT INTO `tb_obras` (`idobra`,`titulo`,`imagem`,`descricao`,`cidade`,`estado`,`uf`,`andamento`,`latitude`,`longitude`,`ativo`,`ordem`,`url_amigavel`,`title_google`,`keywords_google`,`description_google`) VALUES 
 (1,'Obra 1','0306201309455181126329.jpg','Breve descriçao da obra','Asa Sul','Brasília','DF',75,'-14.408749','-54.042208','SIM',0,'obra-1','','',''),
 (2,'Obra 2','0306201309342766199281.jpg','Breve descricao','Asa Norte','Brasília','DF',10,'-15.784944','-47.89758','SIM',0,'obra-2','','','');
/*!40000 ALTER TABLE `tb_obras` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=207 DEFAULT CHARSET=utf8;

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
 (158,'/admin/login/ativa_desativa.php',NULL,'Ativar e desativar','NAO',NULL,2,''),
 (159,'/admin/info-pagina/altera.php',NULL,'Alterar','NAO',NULL,28,''),
 (160,'/admin/info-pagina/cadastra.php',NULL,'Cadastrar','SIM',NULL,28,''),
 (161,'/admin/info-pagina/exclui.php',NULL,'Excluir','NAO',NULL,28,''),
 (162,'/admin/info-pagina/lista.php',NULL,'Listar','SIM',NULL,28,''),
 (163,'/admin/info-pagina/envia_imagens.php',NULL,'Envia imagens','NAO',NULL,28,''),
 (164,'/admin/info-pagina/ativa_desativa.php',NULL,'Ativar e desativar','NAO',NULL,28,''),
 (165,'/admin/empresa/altera.php',NULL,'Alterar','NAO',NULL,29,''),
 (166,'/admin/empresa/cadastra.php',NULL,'Cadastrar','NAO',NULL,29,''),
 (167,'/admin/empresa/exclui.php',NULL,'Excluir','NAO',NULL,29,''),
 (168,'/admin/empresa/lista.php',NULL,'Listar','SIM',NULL,29,''),
 (169,'/admin/empresa/envia_imagens.php',NULL,'Envia imagens','NAO',NULL,29,''),
 (170,'/admin/empresa/ativa_desativa.php',NULL,'Ativar e desativar','NAO',NULL,29,''),
 (171,'/admin/parceiros/altera.php',NULL,'Alterar','NAO',NULL,30,''),
 (172,'/admin/parceiros/cadastra.php',NULL,'Cadastrar','SIM',NULL,30,''),
 (173,'/admin/parceiros/exclui.php',NULL,'Excluir','NAO',NULL,30,''),
 (174,'/admin/parceiros/lista.php',NULL,'Listar','SIM',NULL,30,''),
 (175,'/admin/parceiros/envia_imagens.php',NULL,'Envia imagens','NAO',NULL,30,''),
 (176,'/admin/parceiros/ativa_desativa.php',NULL,'Ativar e desativar','NAO',NULL,30,''),
 (177,'/admin/categoria-locacao/altera.php',NULL,'Alterar','NAO',NULL,31,''),
 (178,'/admin/categoria-locacao/cadastra.php',NULL,'Cadastrar','SIM',NULL,31,''),
 (179,'/admin/categoria-locacao/exclui.php',NULL,'Excluir','NAO',NULL,31,''),
 (180,'/admin/categoria-locacao/lista.php',NULL,'Listar','SIM',NULL,31,''),
 (181,'/admin/categoria-locacao/envia_imagens.php',NULL,'Envia imagens','NAO',NULL,31,''),
 (182,'/admin/categoria-locacao/ativa_desativa.php',NULL,'Ativar e desativar','NAO',NULL,31,''),
 (183,'/admin/locacao/altera.php',NULL,'Alterar','NAO',NULL,32,''),
 (184,'/admin/locacao/cadastra.php',NULL,'Cadastrar','SIM',NULL,32,''),
 (185,'/admin/locacao/exclui.php',NULL,'Excluir','NAO',NULL,32,''),
 (186,'/admin/locacao/lista.php',NULL,'Listar','SIM',NULL,32,''),
 (187,'/admin/locacao/envia_imagens.php',NULL,'Envia imagens','NAO',NULL,32,''),
 (188,'/admin/locacao/ativa_desativa.php',NULL,'Ativar e desativar','NAO',NULL,32,''),
 (189,'/admin/obras/altera.php',NULL,'Alterar','NAO',NULL,33,''),
 (190,'/admin/obras/cadastra.php',NULL,'Cadastrar','SIM',NULL,33,''),
 (191,'/admin/obras/exclui.php',NULL,'Excluir','NAO',NULL,33,''),
 (192,'/admin/obras/lista.php',NULL,'Listar','SIM',NULL,33,''),
 (193,'/admin/obras/envia_imagens.php',NULL,'Envia imagens','NAO',NULL,33,''),
 (194,'/admin/obras/ativa_desativa.php',NULL,'Ativar e desativar','NAO',NULL,33,''),
 (195,'/admin/clientes/altera.php',NULL,'Alterar','NAO',NULL,34,''),
 (196,'/admin/clientes/cadastra.php',NULL,'Cadastrar','SIM',NULL,34,''),
 (197,'/admin/clientes/exclui.php',NULL,'Excluir','NAO',NULL,34,''),
 (198,'/admin/clientes/lista.php',NULL,'Listar','SIM',NULL,34,''),
 (199,'/admin/clientes/envia_imagens.php',NULL,'Envia imagens','NAO',NULL,34,''),
 (200,'/admin/clientes/ativa_desativa.php',NULL,'Ativar e desativar','NAO',NULL,34,''),
 (201,'/admin/banners/altera.php',NULL,'Alterar','NAO',NULL,35,''),
 (202,'/admin/banners/cadastra.php',NULL,'Cadastrar','SIM',NULL,35,''),
 (203,'/admin/banners/exclui.php',NULL,'Excluir','NAO',NULL,35,''),
 (204,'/admin/banners/lista.php',NULL,'Listar','SIM',NULL,35,''),
 (205,'/admin/banners/envia_imagens.php',NULL,'Envia imagens','NAO',NULL,35,''),
 (206,'/admin/banners/ativa_desativa.php',NULL,'Ativar e desativar','NAO',NULL,35,'');
/*!40000 ALTER TABLE `tb_paginas` ENABLE KEYS */;


--
-- Definition of table `tb_parceiros`
--

DROP TABLE IF EXISTS `tb_parceiros`;
CREATE TABLE `tb_parceiros` (
  `idparceiro` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(80) NOT NULL,
  `imagem` varchar(45) NOT NULL DEFAULT 'sem_imagem.jpg',
  `descricao` varchar(255) NOT NULL,
  `ativo` varchar(3) NOT NULL DEFAULT 'SIM',
  `ordem` int(10) unsigned NOT NULL,
  `url_amigavel` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`idparceiro`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_parceiros`
--

/*!40000 ALTER TABLE `tb_parceiros` DISABLE KEYS */;
INSERT INTO `tb_parceiros` (`idparceiro`,`titulo`,`imagem`,`descricao`,`ativo`,`ordem`,`url_amigavel`,`url`) VALUES 
 (1,'Parceiros Voluntarios','0306201309218056594812.gif','Parceiro voluntário na construção civil','SIM',0,'parceiros-voluntarios',''),
 (2,'Parceiro 2','0306201309474993559978.jpg','Descrição do parceiro','SIM',0,'parceiro-2','http://www.google.com.br'),
 (3,'Parceiro 3','0306201309485717538843.jpg','Descrição breve do parceiro','SIM',0,'parceiro-3',''),
 (4,'Kagiva','0306201309491606254672.jpg','Descrição breve do parceiro','SIM',0,'kagiva','http://www.google.com.br'),
 (5,'ecopetec','0706201307127078303140.jpg','equipe ecopetec','SIM',0,'ecopetec',''),
 (6,'Facility clean','0706201307125271663496.jpg','Facility clean','SIM',0,'facility-clean','');
/*!40000 ALTER TABLE `tb_parceiros` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
