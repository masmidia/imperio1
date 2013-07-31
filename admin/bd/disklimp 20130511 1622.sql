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
-- Create schema disklimp
--

-- CREATE DATABASE IF NOT EXISTS disklimp;
-- USE disklimp;

--
-- Definition of table `tb_categoria_servicos`
--

DROP TABLE IF EXISTS `tb_categoria_servicos`;
CREATE TABLE `tb_categoria_servicos` (
  `idcategoriaservico` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL DEFAULT 'disklimpeza.jpg',
  `title_google` varchar(255) NOT NULL,
  `keywords_google` varchar(255) NOT NULL,
  `description_google` varchar(255) NOT NULL,
  `url_amigavel` varchar(255) NOT NULL,
  `ativo` varchar(3) NOT NULL DEFAULT 'SIM',
  `ordem` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idcategoriaservico`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_categoria_servicos`
--

/*!40000 ALTER TABLE `tb_categoria_servicos` DISABLE KEYS */;
INSERT INTO `tb_categoria_servicos` (`idcategoriaservico`,`titulo`,`imagem`,`title_google`,`keywords_google`,`description_google`,`url_amigavel`,`ativo`,`ordem`) VALUES 
 (1,'Administração de Condomínios','1005201311391277913522.jpg','Administração de Condomínios','Administração de Condomínios','Administração de Condomínios','administracao-de-condominios','SIM',0),
 (2,'Jardinagem','1005201311401229714805.jpg','Jardinagem','Jardinagem','Jardinagem','jardinagem','SIM',0),
 (3,'Dedetização','1005201311431210583117.jpg','Dedetização','Dedetização','Dedetização','dedetizacao','SIM',0),
 (4,'Limpeza em Geral','1005201311441259137645.jpg','Limpeza em Geral','Limpeza em Geral','Limpeza em Geral','limpeza-em-geral','SIM',0),
 (5,'Diarista','1005201311451224842930.jpg','Diarista','Diarista','Diarista','diarista','SIM',0),
 (8,'Aluguel de Equipamentos','1005201311471308504152.jpg','Aluguel de Equipamentos','Aluguel de Equipamentos','Aluguel de Equipamentos','aluguel-de-equipamentos','SIM',0),
 (9,'Limpeza de Calhas','1105201306371234750900.jpg','Limpeza de Calhas','Limpeza de Calhas','Limpeza de Calhas','limpeza-de-calhas','SIM',0);
/*!40000 ALTER TABLE `tb_categoria_servicos` ENABLE KEYS */;


--
-- Definition of table `tb_categorias_produtos`
--

DROP TABLE IF EXISTS `tb_categorias_produtos`;
CREATE TABLE `tb_categorias_produtos` (
  `idcategoriaproduto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(80) NOT NULL,
  `imagem` varchar(45) NOT NULL,
  `ativo` varchar(3) NOT NULL DEFAULT 'SIM',
  `ordem` int(10) unsigned NOT NULL,
  `title_google` varchar(255) NOT NULL,
  `keywords_google` varchar(255) NOT NULL,
  `description_google` varchar(255) NOT NULL,
  `url_amigavel` varchar(255) NOT NULL,
  PRIMARY KEY (`idcategoriaproduto`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_categorias_produtos`
--

/*!40000 ALTER TABLE `tb_categorias_produtos` DISABLE KEYS */;
INSERT INTO `tb_categorias_produtos` (`idcategoriaproduto`,`titulo`,`imagem`,`ativo`,`ordem`,`title_google`,`keywords_google`,`description_google`,`url_amigavel`) VALUES 
 (1,'Kits Completos','1005201312131343921039.jpg','SIM',0,'Kits Completos','Kits, Completos','Kits Completos de produtos','kits-completos'),
 (2,'Pás e Vassouras','1005201312131198248333.jpg','SIM',0,'Pás e Vassouras','Pás, Vassouras','Pás e Vassouras produtos.','pas-e-vassouras'),
 (3,'Carros Funcionais','1005201312141266983735.jpg','SIM',0,'Carros Funcionais','Carros, Funcionais','Carros Funcionais produtos','carros-funcionais'),
 (4,'Lavadora de Pisos','1005201312141197199146.jpg','SIM',0,'Lavadora de Pisos','Lavadora, Pisos','Lavadora de Pisos produtos.','lavadora-de-pisos'),
 (5,'Carrinhos','1005201312141162940925.jpg','SIM',0,'Carrinhos','Carrinhos','Carrinhos produtos.','carrinhos'),
 (6,'Produtos de Limpeza','1105201303241307281621.jpg','SIM',0,'Produtos de Limpeza','Produtos de Limpeza','Produtos de Limpeza','produtos-de-limpeza');
/*!40000 ALTER TABLE `tb_categorias_produtos` ENABLE KEYS */;


--
-- Definition of table `tb_configuracoes`
--

DROP TABLE IF EXISTS `tb_configuracoes`;
CREATE TABLE `tb_configuracoes` (
  `idconfiguracao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title_google` varchar(255) NOT NULL,
  `description_google` varchar(255) NOT NULL,
  `keywords_google` varchar(255) NOT NULL,
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
 (1,'Produtos de qualidade para residências, estabelecimentoscomerciais e industriais.','Produtos de qualidade para residências, estabelecimentoscomerciais e industriais.','Produtos de qualidade para residências, estabelecimentoscomerciais e industriais.','SIM',0,'produtos-de-qualidade-para-residencias-estabelecimentoscomerciais-e-industriais','Av Bandeiras Q 100, s/n Lt 19 VL Brasília Aparecida de Goiânia, Goiás 74905-180','(62)3611-9903','(62)3611-9912','david@masmidia.com.br','-16.740809','-49.261877');
/*!40000 ALTER TABLE `tb_configuracoes` ENABLE KEYS */;


--
-- Definition of table `tb_dicas`
--

DROP TABLE IF EXISTS `tb_dicas`;
CREATE TABLE `tb_dicas` (
  `iddica` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL DEFAULT 'dica.jpg',
  `descricao` longtext NOT NULL,
  `title_google` varchar(255) NOT NULL,
  `keywords_google` varchar(255) NOT NULL,
  `description_google` varchar(255) NOT NULL,
  `url_amigavel` varchar(255) NOT NULL,
  `ativo` varchar(3) NOT NULL DEFAULT 'SIM',
  `ordem` int(10) unsigned NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`iddica`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_dicas`
--

/*!40000 ALTER TABLE `tb_dicas` DISABLE KEYS */;
INSERT INTO `tb_dicas` (`iddica`,`titulo`,`imagem`,`descricao`,`title_google`,`keywords_google`,`description_google`,`url_amigavel`,`ativo`,`ordem`,`data`) VALUES 
 (1,'Saiba como limpar seu tapete da melhor forma','1105201301401363591006.jpg','<p>\r\n	Cursus lundium dictumst lectus hac habitasse scelerisque placerat, adipiscing ultrices, dis aliquam sagittis. Mattis augue magna nascetur vut, nascetur et dictumst odio porttitor in! A lorem arcu? In, hac in odio odio elit in, porta in tempor aliquet habitasse nisi sit aenean. Penatibus aliquam? Egestas porttitor enim dis est, est! Cursus adipiscing mattis mauris hac ridiculus ac tincidunt pulvinar tristique sed integer elementum duis integer. Et est mauris, risus. Ac, dapibus montes, natoque non sagittis a porttitor porta amet, cursus, urna? Enim eu nunc! Et mid sed, urna! Quis non, tincidunt dignissim sociis tincidunt sagittis porttitor purus adipiscing elit! Vut! Diam porttitor phasellus lorem dapibus placerat a adipiscing, aenean in! Dapibus pid tincidunt lorem sit lundium pellentesque a ultrices urna.</p>','Saiba como limpar seu tapete da melhor forma','Saiba como limpar seu tapete da melhor forma','Saiba como limpar seu tapete da melhor forma','saiba-como-limpar-seu-tapete-da-melhor-forma','SIM',0,'2013-05-11'),
 (2,'Truques de limpeza para facilitar sua rotina','dica.jpg','<p>\r\n	&Agrave;s vezes, 24 horas parecem pouco para dar conta de tantos afazeres dom&eacute;sticos. Ainda bem que existem alguns segredinhos espertos que nos ajudam a economizar tempo e combater o estresse. &Eacute; por isso que a especialista em organiza&ccedil;&atilde;o do lar&nbsp;<strong>Sueli Rutkowski</strong>&nbsp;faz tanto sucesso no Programa Eliana, do SBT. Autora do livro &quot;Dicas Incr&iacute;veis - Truques e Segredos para Facilitar seu Dia a Dia&quot; (Ed. Master Pop), ela revela maneiras pr&aacute;ticas e inteligentes de tornar mais f&aacute;ceis as tarefas de uma dona de casa.<br />\r\n	<br />\r\n	<strong>Arm&aacute;rio sequinho</strong><br />\r\n	Acabe com o mofo no arm&aacute;rio preparando pedrinhas de absor&ccedil;&atilde;o. Fa&ccedil;a assim: em um recipiente, misture 1 x&iacute;cara de gesso em p&oacute;, &frac12; x&iacute;cara de &aacute;gua e 1 colher (sopa) da ess&ecirc;ncia de sua prefer&ecirc;ncia. Misture os ingredientes, coloque a mistura em forminhas de acetato (aquelas de fazer bombons) e desenforme quando estiver bem seca. Ponha as pedrinhas no arm&aacute;rio, em um recipiente aberto. Substitua-as quando estiverem &uacute;midas ou a cada 90 dias, no m&aacute;ximo.<br />\r\n	<br />\r\n	<strong>Casa mais cheirosa</strong><br />\r\n	Essa &eacute; para quem tem abajur com l&acirc;mpada amarela: desligue o aparelho e pulverize sua ess&ecirc;ncia preferida na l&acirc;mpada. Quando o abajur estiver aceso, a l&acirc;mpada quente come&ccedil;a a exalar o aroma escolhido, perfumando rapidinho todo o ambiente.<br />\r\n	<br />\r\n	<strong>Computador limpo</strong><br />\r\n	Limpe o mouse, o teclado e o gabinete do computador com uma esponja nova umedecida em vinagre branco. Em seguida, passe um pano seco. Importante: s&oacute; use esse (ou qualquer produto, mesmo natural) depois de fazer um teste em uma &aacute;rea pequena.<br />\r\n	<br />\r\n	<strong>Objetos sem ferrugem&nbsp;</strong><br />\r\n	Aplique refrigerante &agrave; base de cola sobre a ferrugem e friccione bem o local com um peda&ccedil;o de papel-alum&iacute;nio. Finalize com um pano limpo. Procure manter a &aacute;rea sempre seca.<br />\r\n	<br />\r\n	<strong>Faxina mais r&aacute;pida</strong><br />\r\n	Envolva uma vassoura com uma meia de seda velha e passe no piso empoeirado. A poeira adere &agrave; meia sem espalhar o p&oacute;. Use a meia nas m&atilde;os tamb&eacute;m para limpar os m&oacute;veis: voc&ecirc; far&aacute; a limpeza mais r&aacute;pido!</p>','Truques de limpeza para facilitar sua rotina','Truques de limpeza para facilitar sua rotina','Truques de limpeza para facilitar sua rotina','truques-de-limpeza-para-facilitar-sua-rotina','SIM',0,'0000-00-00'),
 (3,'Dicas de como limpar a casa de forma rápida e eficiente','1105201303521247797307.jpg','<p>\r\n	A maioria das pessoas admira uma casa limpa e organizada, certo? Mas para muitos parece imposs&iacute;vel conseguir manter a organiza&ccedil;&atilde;o. &Eacute; por isso que servem os planos. Com um planejamento simples com os cuidados com a casa e outras tarefas de rotina, todos podem conhecer os benef&iacute;cios de uma casa arrumada gastando pouco tempo e energia. Sim, voc&ecirc; tamb&eacute;m pode!&nbsp;&nbsp;Aqui est&atilde;o algumas dicas para facilitar na hora da limpeza da casa. Se voc&ecirc; disp&otilde;e de uma empregada, essas dicas ajudar&atilde;o muito:</p>','Dicas de como limpar a casa de forma rápida e eficiente','Dicas de como limpar a casa de forma rápida e eficiente','Dicas de como limpar a casa de forma rápida e eficiente','dicas-de-como-limpar-a-casa-de-forma-rapida-e-eficiente','SIM',0,'2013-05-11');
/*!40000 ALTER TABLE `tb_dicas` ENABLE KEYS */;


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
  PRIMARY KEY (`idempresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_empresa`
--

/*!40000 ALTER TABLE `tb_empresa` DISABLE KEYS */;
INSERT INTO `tb_empresa` (`idempresa`,`titulo`,`descricao`,`title_google`,`description_google`,`keywords_google`,`ativo`,`ordem`,`imagem`,`tumb_imagem`,`url_amigavel`) VALUES 
 (1,'NOSSA HISTÓRIA','<p>\r\n	<img alt=\"Disk Limp\" src=\"/uploads/ckfinder/userfiles/images/img_descricao_empresa01.jpg\" style=\"float: left; margin-right: 10px; width: 324px; height: 124px;\" /> A Disk Limp iniciou suas atividades em 1999 , era o come&ccedil;o de uma trajet&oacute;ria de sucesso, marcada pela expans&atilde;o da produ&ccedil;&atilde;o, fortalecimento da marca como sin&ocirc;nimo de qualidade e lan&ccedil;amentos de pro- dutos inovadores. Os nosso sucesso foram obtidos por meio de uma filosofia de trabalho que busca a inova&ccedil;&atilde;o como forma de atender as expectativas dos consumidores e pela cren&ccedil;a de que os nossos colaboradores e parceiros comerciais s&atilde;o elementos de import&acirc;ncia fundamental para garantir que a empresa atinja as suas metas e objetivos.</p>\r\n<p>\r\n	<img alt=\"Disk Limp\" src=\"/uploads/ckfinder/userfiles/images/img_descricao_empresa02.jpg\" style=\"float: right; margin-left: 10px; width: 355px; height: 161px;\" /> A Disk Limp &eacute; uma empresa no segmento de limpeza profissional e conserva&ccedil;&atilde;o que atua no mercado de facilities, ou seja, uma empresa voltada para melhoramento da qualidade de vida focada nos servi&ccedil;os dom&eacute;sticos e empresariais de alta qualidade. A marca vem de encontro a uma necessidade real e crescente de empresas e pessoas que possuem cada vez menos tempo e disposi&ccedil;&atilde;o para determinadas tarefas e usam a terceiriza&ccedil;&atilde;o como forma de resolu&ccedil;&atilde;o de seus problemas. N&oacute;s possu&iacute;mos uma estrutura completa que d&aacute; suporte a todos os clientes e conta com especialistas da &aacute;rea. A atua&ccedil;&atilde;o no mercado tem se diversificado a medida que empresa cresce, se fortalece e desenvolve no territ&oacute;rio nacional.</p>\r\n<p>\r\n	Nossas equipes s&atilde;o treinadas e altamente qualificadas preparadas para executar todo o trabalho com equipamentos e produtos de uso profissionais. Al&eacute;m disso, os produtos utilizados s&atilde;o amigos do ambiente e n&atilde;o abrasivos, o que garante toda a originalidade das superf&iacute;cies. A Disk Limp proporciona conforto e seguran&ccedil;a de ter um servi&ccedil;o r&aacute;pido, de alta qualidade e eficiente, a um pre&ccedil;o acess&iacute;vel. Utilizando produtos n&atilde;o abrasivos e biodegrad&aacute;veis, que por sua efic&aacute;cia dispensam o uso excessivo de &aacute;gua, normalmente praticados por profissionais pouco qualificados. Da mesma forma os equipamentos s&atilde;o modernos e sofisticados com baixo consumo de energia. A limpeza &eacute; realizada de forma minuciosa com rodutos espec&iacute;ficos para cada tipo de ambiente, para preser va&ccedil;&atilde;o e conserva&ccedil;&atilde;o.Por isso, em todos estes anos de atividade, a Disklimp esteve presente na vida dos brasileiros de diversas maneiras:</p>\r\n<ul>\r\n	<li>\r\n		Gerando empregos diretos e indiretos;</li>\r\n	<li>\r\n		Contribuindo para o desenvolvimento econ&ocirc;mico da regiao onde est&aacute; instalada;</li>\r\n	<li>\r\n		Oferecendo produtos de qualidade para resid&ecirc;ncias, estabelecimentos comerciais e industriais.</li>\r\n</ul>','Nossa História','A Disk Limp iniciou suas atividades em 1999 , era o começo de uma trajetória de sucesso, marcada pela expansão da produção, fortalecimento da marca como sinônimo de qualidade e lançamentos de pro- dutos inovadores.','Nossa, História','SIM',0,'1105201306311204561698.jpg','tumb_1005201312061164920694.jpg','nossa-historia');
/*!40000 ALTER TABLE `tb_empresa` ENABLE KEYS */;


--
-- Definition of table `tb_galerias_produtos`
--

DROP TABLE IF EXISTS `tb_galerias_produtos`;
CREATE TABLE `tb_galerias_produtos` (
  `idgaleriaproduto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `imagem` varchar(255) NOT NULL,
  `ativo` varchar(3) NOT NULL DEFAULT 'SIM',
  `ordem` int(10) unsigned NOT NULL,
  `url_amigavel` varchar(255) NOT NULL,
  `id_produto` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idgaleriaproduto`),
  KEY `FK_tb_galerias_produtos_1` (`id_produto`),
  CONSTRAINT `FK_tb_galerias_produtos_1` FOREIGN KEY (`id_produto`) REFERENCES `tb_produtos` (`idproduto`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_galerias_produtos`
--

/*!40000 ALTER TABLE `tb_galerias_produtos` DISABLE KEYS */;
INSERT INTO `tb_galerias_produtos` (`idgaleriaproduto`,`imagem`,`ativo`,`ordem`,`url_amigavel`,`id_produto`) VALUES 
 (9,'0905201311551378635428.jpg','SIM',0,'',1),
 (10,'0905201311551296570795.jpg','SIM',0,'',1),
 (11,'0905201311551222060305.jpg','SIM',0,'',1),
 (12,'0905201311551242250303.jpg','SIM',0,'',1),
 (13,'0905201311551214816356.jpg','SIM',0,'',1),
 (14,'0905201311591362085651.jpg','SIM',0,'',5),
 (15,'0905201311591141601383.jpg','SIM',0,'',5),
 (17,'0905201311591328867494.jpg','SIM',0,'',5),
 (18,'0905201311591211002791.jpg','SIM',0,'',5),
 (19,'1005201312011396234392.jpg','SIM',0,'',5);
/*!40000 ALTER TABLE `tb_galerias_produtos` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

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
  `url_amigavel` varchar(255) NOT NULL,
  PRIMARY KEY (`id_grupologin`,`id_pagina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_grupos_logins_tb_paginas`
--

/*!40000 ALTER TABLE `tb_grupos_logins_tb_paginas` DISABLE KEYS */;
INSERT INTO `tb_grupos_logins_tb_paginas` (`id_grupologin`,`id_pagina`,`url_amigavel`) VALUES 
 (1,148,''),
 (1,149,''),
 (1,150,''),
 (1,151,''),
 (1,152,''),
 (1,153,''),
 (1,154,''),
 (1,155,''),
 (1,156,''),
 (1,157,''),
 (1,158,''),
 (1,159,''),
 (1,160,''),
 (1,161,''),
 (1,162,''),
 (1,163,''),
 (1,164,''),
 (1,165,''),
 (1,166,''),
 (1,167,''),
 (1,168,''),
 (1,169,''),
 (1,170,''),
 (1,171,''),
 (1,172,''),
 (1,173,''),
 (1,174,''),
 (1,175,''),
 (1,176,''),
 (1,177,''),
 (1,178,''),
 (1,179,''),
 (1,180,''),
 (1,181,''),
 (1,182,''),
 (1,183,''),
 (1,184,''),
 (1,185,''),
 (1,186,''),
 (1,187,''),
 (1,188,''),
 (1,189,''),
 (1,190,''),
 (1,191,''),
 (1,192,''),
 (1,193,''),
 (1,194,''),
 (1,195,''),
 (1,196,''),
 (1,197,''),
 (1,198,''),
 (1,199,''),
 (1,200,''),
 (1,201,''),
 (1,202,''),
 (10,148,''),
 (10,149,''),
 (10,150,''),
 (10,151,''),
 (10,152,''),
 (10,153,''),
 (10,154,''),
 (10,155,''),
 (10,156,''),
 (10,157,''),
 (10,158,'');
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
  `url_amigavel` varchar(255) NOT NULL,
  PRIMARY KEY (`idlogin`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_logins`
--

/*!40000 ALTER TABLE `tb_logins` DISABLE KEYS */;
INSERT INTO `tb_logins` (`idlogin`,`nome`,`senha`,`ativo`,`id_grupologin`,`email`,`url_amigavel`) VALUES 
 (1,'Marcio André da Silva','e10adc3949ba59abbe56e057f20f883e','SIM',1,'marciomas@gmail.com',''),
 (2,'David Leandro dos Santos','e10adc3949ba59abbe56e057f20f883e','SIM',1,'design.davidleandro@gmail.com',''),
 (3,'Angela','e10adc3949ba59abbe56e057f20f883e','SIM',1,'atendimento.sites@homewebbrasil.com.br',''),
 (4,'Mas Midia','e10adc3949ba59abbe56e057f20f883e','SIM',1,'contato@masmdiaia.com.br','');
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
  `url_amigavel` varchar(255) NOT NULL,
  PRIMARY KEY (`idloglogin`)
) ENGINE=InnoDB AUTO_INCREMENT=829 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_logs_logins`
--

/*!40000 ALTER TABLE `tb_logs_logins` DISABLE KEYS */;
INSERT INTO `tb_logs_logins` (`idloglogin`,`operacao`,`consulta_sql`,`data`,`hora`,`id_login`,`url_amigavel`) VALUES 
 (705,'CADASTRO DO CLIENTE ','','2013-05-04','01:02:38',2,''),
 (706,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','01:04:09',2,''),
 (707,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','12:54:31',2,''),
 (708,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','12:58:02',2,''),
 (709,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','12:59:30',2,''),
 (710,'CADASTRO DO CLIENTE ','','2013-05-04','13:26:36',2,''),
 (711,'CADASTRO DO CLIENTE ','','2013-05-04','13:29:41',2,''),
 (712,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','13:31:16',2,''),
 (713,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','13:33:13',2,''),
 (714,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','14:11:46',2,''),
 (715,'CADASTRO DO CLIENTE ','','2013-05-04','14:13:33',2,''),
 (716,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','14:18:12',2,''),
 (717,'CADASTRO DO CLIENTE ','','2013-05-04','14:25:07',2,''),
 (718,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','14:29:06',2,''),
 (719,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','14:31:55',2,''),
 (720,'CADASTRO DO CLIENTE ','','2013-05-04','14:55:23',2,''),
 (721,'CADASTRO DO CLIENTE ','','2013-05-04','15:00:06',2,''),
 (722,'CADASTRO DO CLIENTE ','','2013-05-04','15:00:37',2,''),
 (723,'CADASTRO DO CLIENTE ','','2013-05-04','15:01:23',2,''),
 (724,'CADASTRO DO CLIENTE ','','2013-05-04','15:03:20',2,''),
 (725,'CADASTRO DO CLIENTE ','','2013-05-04','15:18:58',2,''),
 (726,'CADASTRO DO CLIENTE ','','2013-05-04','15:19:31',2,''),
 (727,'CADASTRO DO CLIENTE ','','2013-05-04','15:27:45',2,''),
 (728,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','15:34:20',2,''),
 (729,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','15:37:34',2,''),
 (730,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','15:38:53',2,''),
 (731,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','15:43:08',2,''),
 (732,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','15:43:28',2,''),
 (733,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','15:43:42',2,''),
 (734,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','15:48:59',2,''),
 (735,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','15:49:10',2,''),
 (736,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','15:49:21',2,''),
 (737,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','15:49:34',2,''),
 (738,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','15:49:45',2,''),
 (739,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','15:50:06',2,''),
 (740,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','15:51:17',2,''),
 (741,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','15:51:55',2,''),
 (742,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','15:52:08',2,''),
 (743,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','15:52:23',2,''),
 (744,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','15:52:36',2,''),
 (745,'CADASTRO DO CLIENTE ','','2013-05-04','18:00:04',2,''),
 (746,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','18:01:01',2,''),
 (747,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','18:02:34',2,''),
 (748,'CADASTRO DO CLIENTE ','','2013-05-04','19:36:39',2,''),
 (749,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','19:37:31',2,''),
 (750,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','19:38:27',2,''),
 (751,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','19:40:21',2,''),
 (752,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','19:42:33',2,''),
 (753,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','19:43:01',2,''),
 (754,'CADASTRO DO CLIENTE ','','2013-05-04','19:45:10',2,''),
 (755,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','19:45:51',2,''),
 (756,'ALTERAÇÃO DO CLIENTE ','','2013-05-04','19:57:54',2,''),
 (757,'CADASTRO DO CLIENTE ','','2013-05-07','23:53:34',2,''),
 (758,'CADASTRO DO CLIENTE ','','2013-05-08','00:08:44',2,''),
 (759,'CADASTRO DO CLIENTE ','','2013-05-08','00:09:58',2,''),
 (760,'CADASTRO DO CLIENTE ','','2013-05-09','23:25:41',2,''),
 (761,'CADASTRO DO CLIENTE ','','2013-05-09','23:27:17',2,''),
 (762,'ALTERAÇÃO DO CLIENTE ','','2013-05-09','23:27:58',2,''),
 (763,'ALTERAÇÃO DO CLIENTE ','','2013-05-09','23:29:17',2,''),
 (764,'CADASTRO DO CLIENTE ','','2013-05-09','23:31:17',2,''),
 (765,'EXCLUSÃO DO LOGIN 3, NOME: , Email: ','DELETE FROM tb_produtos WHERE idproduto = \'3\'','2013-05-09','23:33:02',2,''),
 (766,'CADASTRO DO CLIENTE ','','2013-05-09','23:34:36',2,''),
 (767,'ALTERAÇÃO DO CLIENTE ','','2013-05-09','23:36:52',2,''),
 (768,'ALTERAÇÃO DO CLIENTE ','','2013-05-09','23:37:40',2,''),
 (769,'ALTERAÇÃO DO CLIENTE ','','2013-05-09','23:38:38',2,''),
 (770,'CADASTRO DO CLIENTE ','','2013-05-09','23:39:43',2,''),
 (771,'ALTERAÇÃO DO CLIENTE ','','2013-05-09','23:40:24',2,''),
 (772,'ALTERAÇÃO DO CLIENTE ','','2013-05-09','23:42:42',2,''),
 (773,'ALTERAÇÃO DO CLIENTE ','','2013-05-09','23:44:22',2,''),
 (774,'ALTERAÇÃO DO CLIENTE ','','2013-05-09','23:46:22',2,''),
 (775,'ALTERAÇÃO DO CLIENTE ','','2013-05-10','00:06:03',2,''),
 (776,'ALTERAÇÃO DO CLIENTE ','','2013-05-10','00:13:22',2,''),
 (777,'ALTERAÇÃO DO CLIENTE ','','2013-05-10','00:13:43',2,''),
 (778,'ALTERAÇÃO DO CLIENTE ','','2013-05-10','00:14:03',2,''),
 (779,'ALTERAÇÃO DO CLIENTE ','','2013-05-10','00:14:22',2,''),
 (780,'ALTERAÇÃO DO CLIENTE ','','2013-05-10','00:14:41',2,''),
 (781,'ALTERAÇÃO DO CLIENTE ','','2013-05-10','00:21:49',2,''),
 (782,'ALTERAÇÃO DO CLIENTE ','','2013-05-10','00:23:30',2,''),
 (783,'ALTERAÇÃO DO CLIENTE ','','2013-05-10','00:24:21',2,''),
 (784,'ALTERAÇÃO DO CLIENTE ','','2013-05-10','23:11:35',2,''),
 (785,'CADASTRO DO CLIENTE ','','2013-05-10','23:23:29',2,''),
 (786,'ALTERAÇÃO DO CLIENTE ','','2013-05-10','23:39:59',2,''),
 (787,'CADASTRO DO CLIENTE ','','2013-05-10','23:40:52',2,''),
 (788,'CADASTRO DO CLIENTE ','','2013-05-10','23:43:12',2,''),
 (789,'CADASTRO DO CLIENTE ','','2013-05-10','23:44:33',2,''),
 (790,'CADASTRO DO CLIENTE ','','2013-05-10','23:45:25',2,''),
 (791,'CADASTRO DO CLIENTE ','','2013-05-10','23:46:51',2,''),
 (792,'CADASTRO DO CLIENTE ','','2013-05-10','23:47:01',2,''),
 (793,'CADASTRO DO CLIENTE ','','2013-05-10','23:47:13',2,''),
 (794,'CADASTRO DO CLIENTE ','','2013-05-11','00:57:50',2,''),
 (795,'ALTERAÇÃO DO CLIENTE ','','2013-05-11','01:00:27',2,''),
 (796,'ALTERAÇÃO DO CLIENTE ','','2013-05-11','01:01:30',2,''),
 (797,'CADASTRO DO CLIENTE ','','2013-05-11','01:07:32',2,''),
 (798,'CADASTRO DO CLIENTE ','','2013-05-11','01:08:35',2,''),
 (799,'ALTERAÇÃO DO CLIENTE ','','2013-05-11','01:12:48',2,''),
 (800,'ALTERAÇÃO DO CLIENTE ','','2013-05-11','01:14:28',2,''),
 (801,'ALTERAÇÃO DO CLIENTE ','','2013-05-11','01:14:48',2,''),
 (802,'CADASTRO DO CLIENTE ','','2013-05-11','13:40:22',2,''),
 (803,'CADASTRO DO CLIENTE ','','2013-05-11','13:42:02',2,''),
 (804,'CADASTRO DO CLIENTE ','','2013-05-11','15:21:05',2,''),
 (805,'ALTERAÇÃO DO CLIENTE ','','2013-05-11','15:24:27',2,''),
 (806,'ALTERAÇÃO DO CLIENTE ','','2013-05-11','15:24:47',2,''),
 (807,'ALTERAÇÃO DO CLIENTE ','','2013-05-11','15:25:22',2,''),
 (808,'CADASTRO DO CLIENTE ','','2013-05-11','15:52:22',2,''),
 (809,'ALTERAÇÃO DO CLIENTE ','','2013-05-11','18:08:54',2,''),
 (810,'ALTERAÇÃO DO CLIENTE ','','2013-05-11','18:09:11',2,''),
 (811,'ALTERAÇÃO DO CLIENTE ','','2013-05-11','18:10:11',2,''),
 (812,'ALTERAÇÃO DO CLIENTE ','','2013-05-11','18:12:20',2,''),
 (813,'ALTERAÇÃO DO CLIENTE ','','2013-05-11','18:16:47',2,''),
 (814,'ALTERAÇÃO DO CLIENTE ','','2013-05-11','18:16:57',2,''),
 (815,'ALTERAÇÃO DO CLIENTE ','','2013-05-11','18:21:47',2,''),
 (816,'ALTERAÇÃO DO CLIENTE ','','2013-05-11','18:21:59',2,''),
 (817,'ALTERAÇÃO DO CLIENTE ','','2013-05-11','18:24:24',2,''),
 (818,'ALTERAÇÃO DO CLIENTE ','','2013-05-11','18:24:54',2,''),
 (819,'ALTERAÇÃO DO CLIENTE ','','2013-05-11','18:31:19',2,''),
 (820,'CADASTRO DO CLIENTE ','','2013-05-11','18:32:39',2,''),
 (821,'ALTERAÇÃO DO CLIENTE ','','2013-05-11','18:33:17',2,''),
 (822,'EXCLUSÃO DO LOGIN 7, NOME: , Email: ','DELETE FROM tb_categorias_produtos WHERE idcategoriaproduto = \'7\'','2013-05-11','18:33:41',2,''),
 (823,'EXCLUSÃO DO LOGIN 7, NOME: , Email: ','DELETE FROM tb_categoria_servicos WHERE idcategoriaservico = \'7\'','2013-05-11','18:34:26',2,''),
 (824,'EXCLUSÃO DO LOGIN 6, NOME: , Email: ','DELETE FROM tb_categoria_servicos WHERE idcategoriaservico = \'6\'','2013-05-11','18:34:41',2,''),
 (825,'CADASTRO DO CLIENTE ','','2013-05-11','18:36:32',2,''),
 (826,'ALTERAÇÃO DO CLIENTE ','','2013-05-11','18:37:24',2,''),
 (827,'ALTERAÇÃO DO CLIENTE ','','2013-05-11','18:38:09',2,''),
 (828,'ALTERAÇÃO DO CLIENTE ','','2013-05-11','18:38:25',2,'');
/*!40000 ALTER TABLE `tb_logs_logins` ENABLE KEYS */;


--
-- Definition of table `tb_marcas_produtos`
--

DROP TABLE IF EXISTS `tb_marcas_produtos`;
CREATE TABLE `tb_marcas_produtos` (
  `idmarcaproduto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(80) NOT NULL,
  `imagem` varchar(45) NOT NULL,
  `title_google` varchar(255) NOT NULL,
  `keywords_google` varchar(255) NOT NULL,
  `description_google` varchar(255) NOT NULL,
  `ativo` varchar(3) NOT NULL DEFAULT 'SIM',
  `ordem` int(10) unsigned NOT NULL,
  `tumb_imagem` varchar(45) NOT NULL,
  `url_amigavel` varchar(255) NOT NULL,
  PRIMARY KEY (`idmarcaproduto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_marcas_produtos`
--

/*!40000 ALTER TABLE `tb_marcas_produtos` DISABLE KEYS */;
INSERT INTO `tb_marcas_produtos` (`idmarcaproduto`,`titulo`,`imagem`,`title_google`,`keywords_google`,`description_google`,`ativo`,`ordem`,`tumb_imagem`,`url_amigavel`) VALUES 
 (1,'Bombril','1005201312211358436307.jpg','Bombril','Bombril','Bombril','SIM',2,'tumb_0405201303431358792118.jpg','bombril'),
 (2,'detergente ype','1005201312231140835021.jpg','detergente ype','detergente ype','detergente ype','SIM',1,'tumb_0405201303431408505313.jpg','detergente-ype'),
 (3,'OMO','1005201312241228692989.jpg','OMO','OMO','OMO','SIM',0,'tumb_0405201303431291917881.jpg','omo');
/*!40000 ALTER TABLE `tb_marcas_produtos` ENABLE KEYS */;


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
 (28,'Texto Empresa',NULL,'SIM',''),
 (29,'Categorias Produtos',NULL,'SIM',''),
 (30,'Marcas Produtos',NULL,'SIM',''),
 (31,'Produtos',NULL,'SIM',''),
 (32,'Categorias Serviços',NULL,'SIM',''),
 (33,'Configuração Geral Site',NULL,'SIM',''),
 (34,'Serviços',NULL,'SIM',''),
 (35,'Dicas',NULL,'SIM','');
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
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8;

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
 (159,'/admin/empresa/altera.php',NULL,'Alterar','NAO',NULL,28,''),
 (160,'/admin/empresa/cadastra.php',NULL,'Cadastrar','NAO',NULL,28,''),
 (161,'/admin/empresa/exclui.php',NULL,'Excluir','NAO',NULL,28,''),
 (162,'/admin/empresa/lista.php',NULL,'Listar','SIM',NULL,28,''),
 (163,'/admin/empresa/envia_imagens.php',NULL,'Envia imagens','NAO',NULL,28,''),
 (164,'/admin/empresa/ativa_desativa.php',NULL,'Ativar e desativar','NAO',NULL,28,''),
 (165,'/admin/categorias-produtos/altera.php',NULL,'Alterar','NAO',NULL,29,''),
 (166,'/admin/categorias-produtos/cadastra.php',NULL,'Cadastrar','SIM',NULL,29,''),
 (167,'/admin/categorias-produtos/exclui.php',NULL,'Excluir','NAO',NULL,29,''),
 (168,'/admin/categorias-produtos/lista.php',NULL,'Listar','SIM',NULL,29,''),
 (169,'/admin/categorias-produtos/envia_imagens.php',NULL,'Envia imagens','NAO',NULL,29,''),
 (170,'/admin/categorias-produtos/ativa_desativa.php',NULL,'Ativar e desativar','NAO',NULL,29,''),
 (171,'/admin/marcas-produtos/altera.php',NULL,'Alterar','NAO',NULL,30,''),
 (172,'/admin/marcas-produtos/cadastra.php',NULL,'Cadastrar','SIM',NULL,30,''),
 (173,'/admin/marcas-produtos/exclui.php',NULL,'Excluir','NAO',NULL,30,''),
 (174,'/admin/marcas-produtos/lista.php',NULL,'Listar','SIM',NULL,30,''),
 (175,'/admin/marcas-produtos/envia_imagens.php',NULL,'Envia imagens','NAO',NULL,30,''),
 (176,'/admin/marcas-produtos/ativa_desativa.php',NULL,'Ativar e desativar','NAO',NULL,30,''),
 (177,'/admin/produtos/altera.php',NULL,'Alterar','NAO',NULL,31,''),
 (178,'/admin/produtos/cadastra.php',NULL,'Cadastrar','SIM',NULL,31,''),
 (179,'/admin/produtos/exclui.php',NULL,'Excluir','NAO',NULL,31,''),
 (180,'/admin/produtos/lista.php',NULL,'Listar','SIM',NULL,31,''),
 (181,'/admin/produtos/envia_imagens.php',NULL,'Envia imagens','NAO',NULL,31,''),
 (182,'/admin/produtos/ativa_desativa.php',NULL,'Ativar e desativar','NAO',NULL,31,''),
 (183,'/admin/categorias-servicos/altera.php',NULL,'Alterar','NAO',NULL,32,''),
 (184,'/admin/categorias-servicos/cadastra.php',NULL,'Cadastrar','SIM',NULL,32,''),
 (185,'/admin/categorias-servicos/exclui.php',NULL,'Excluir','NAO',NULL,32,''),
 (186,'/admin/categorias-servicos/lista.php',NULL,'Listar','SIM',NULL,32,''),
 (187,'/admin/categorias-servicos/envia_imagens.php',NULL,'Envia imagens','NAO',NULL,32,''),
 (188,'/admin/categorias-servicos/ativa_desativa.php',NULL,'Ativar e desativar','NAO',NULL,32,''),
 (189,'/admin/info-pagina/altera.php',NULL,'Alterar','NAO',NULL,33,''),
 (190,'/admin/info-pagina/lista.php',NULL,'Listar','SIM',NULL,33,''),
 (191,'/admin/servicos/altera.php',NULL,'Alterar','NAO',NULL,34,''),
 (192,'/admin/servicos/cadastra.php',NULL,'Cadastrar','SIM',NULL,34,''),
 (193,'/admin/servicos/exclui.php',NULL,'Excluir','NAO',NULL,34,''),
 (194,'/admin/servicos/lista.php',NULL,'Listar','SIM',NULL,34,''),
 (195,'/admin/servicos/envia_imagens.php',NULL,'Envia imagens','NAO',NULL,34,''),
 (196,'/admin/servicos/ativa_desativa.php',NULL,'Ativar e desativar','NAO',NULL,34,''),
 (197,'/admin/dicas/altera.php',NULL,'Alterar','NAO',NULL,35,''),
 (198,'/admin/dicas/cadastra.php',NULL,'Cadastrar','SIM',NULL,35,''),
 (199,'/admin/dicas/exclui.php',NULL,'Excluir','NAO',NULL,35,''),
 (200,'/admin/dicas/lista.php',NULL,'Listar','SIM',NULL,35,''),
 (201,'/admin/dicas/envia_imagens.php',NULL,'Envia imagens','NAO',NULL,35,''),
 (202,'/admin/dicas/ativa_desativa.php',NULL,'Ativar e desativar','NAO',NULL,35,'');
/*!40000 ALTER TABLE `tb_paginas` ENABLE KEYS */;


--
-- Definition of table `tb_produtos`
--

DROP TABLE IF EXISTS `tb_produtos`;
CREATE TABLE `tb_produtos` (
  `idproduto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `id_marcaproduto` int(10) unsigned NOT NULL,
  `id_categoriaproduto` int(10) unsigned NOT NULL,
  `imagem` varchar(45) NOT NULL DEFAULT 'produto.jpg',
  `preco` double NOT NULL,
  `descricao` longtext NOT NULL,
  `title_google` varchar(255) NOT NULL,
  `keywords_google` varchar(255) NOT NULL,
  `description_google` varchar(255) NOT NULL,
  `ativo` varchar(3) NOT NULL DEFAULT 'SIM',
  `ordem` int(10) unsigned NOT NULL,
  `url_amigavel` varchar(255) NOT NULL,
  PRIMARY KEY (`idproduto`),
  KEY `FK_tb_produtos_1` (`id_categoriaproduto`),
  KEY `FK_tb_produtos_2` (`id_marcaproduto`),
  CONSTRAINT `FK_tb_produtos_1` FOREIGN KEY (`id_categoriaproduto`) REFERENCES `tb_categorias_produtos` (`idcategoriaproduto`),
  CONSTRAINT `FK_tb_produtos_2` FOREIGN KEY (`id_marcaproduto`) REFERENCES `tb_marcas_produtos` (`idmarcaproduto`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_produtos`
--

/*!40000 ALTER TABLE `tb_produtos` DISABLE KEYS */;
INSERT INTO `tb_produtos` (`idproduto`,`titulo`,`id_marcaproduto`,`id_categoriaproduto`,`imagem`,`preco`,`descricao`,`title_google`,`keywords_google`,`description_google`,`ativo`,`ordem`,`url_amigavel`) VALUES 
 (1,'Enceradeira Lavadora Pisos Frios',1,5,'0905201311371125854462.jpg',10,'','Enceradeira Lavadora Pisos Frios','Enceradeira Lavadora Pisos Frios','Enceradeira Lavadora Pisos Frios','SIM',0,'enceradeira-lavadora-pisos-frios'),
 (2,'Carro Funcional HEALTH System 1',2,3,'0905201311361341968640.jpg',50,'','Enceradeira Lavadora Pisos Frios','Enceradeira Lavadora Pisos Frios','Enceradeira Lavadora Pisos Frios','SIM',2,'carro-funcional-health-system-1'),
 (4,'Carro Arrumadeira Bolonha',1,3,'0905201311381261254264.jpg',59,'','Carro Arrumadeira Bolonha','Carro Arrumadeira Bolonha','Carro Arrumadeira Bolonha','SIM',0,'carro-arrumadeira-bolonha'),
 (5,'Balde Espremedor Doblô 30 Litros',1,2,'0905201311461286817922.jpg',130,'','Balde Espremedor Doblô 30 Litros','Balde Espremedor Doblô 30 Litros','Balde Espremedor Doblô 30 Litros','SIM',0,'balde-espremedor-doblo-30-litros');
/*!40000 ALTER TABLE `tb_produtos` ENABLE KEYS */;


--
-- Definition of table `tb_servicos`
--

DROP TABLE IF EXISTS `tb_servicos`;
CREATE TABLE `tb_servicos` (
  `idservico` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL DEFAULT 'servico.jpg',
  `title_google` varchar(255) NOT NULL,
  `keywords_google` varchar(255) NOT NULL,
  `description_google` varchar(255) NOT NULL,
  `url_amigavel` varchar(255) NOT NULL,
  `ativo` varchar(3) NOT NULL DEFAULT 'SIM',
  `ordem` int(10) unsigned NOT NULL,
  `id_categoriaservico` int(10) unsigned NOT NULL,
  `descricao` longtext NOT NULL,
  PRIMARY KEY (`idservico`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_servicos`
--

/*!40000 ALTER TABLE `tb_servicos` DISABLE KEYS */;
INSERT INTO `tb_servicos` (`idservico`,`titulo`,`imagem`,`title_google`,`keywords_google`,`description_google`,`url_amigavel`,`ativo`,`ordem`,`id_categoriaservico`,`descricao`) VALUES 
 (1,'RECEPCIONISTA/APOIO ADM. E OPERACIONAL','1105201312571137924669.jpg','RECEPCIONISTA/APOIO ADM. E OPERACIONAL','RECEPCIONISTA/APOIO ADM. E OPERACIONAL','RECEPCIONISTA/APOIO ADM. E OPERACIONAL','recepcionistaapoio-adm-e-operacional','SIM',0,1,'<p>\r\n	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived &nbsp;not only five centuries, but also the leap into electronic types etting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsm passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>'),
 (2,'PORTARIA / JARDINAGEM / TELEFONISTA / SERV.GERAL','1105201301071189353055.jpg','PORTARIA/JARDINAGEM/TELEFONISTA/SERV.GERAL','PORTARIA/JARDINAGEM/TELEFONISTA/SERV.GERAL','PORTARIA/JARDINAGEM/TELEFONISTA/SERV.GERAL','portaria--jardinagem--telefonista--servgeral','SIM',0,1,'<p>\r\n	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsumhas been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic types etting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>'),
 (3,'Teste','1105201301081381390684.jpg','Teste','Teste','Teste','teste','SIM',0,1,'<p>\r\n	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived &nbsp;not only five centuries, but also the leap into electronic types etting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsm passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>');
/*!40000 ALTER TABLE `tb_servicos` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;