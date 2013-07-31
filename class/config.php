<?php
//error_reporting(0);

/*	================================================================================================	*/
/*	DEFINE O CAMINHO COMPLETO DO PROJETO ARMAZENANDO NUMA SESSAO	*/
/*	================================================================================================	*/
$pasta_projeto = "/clientes/imperio";


/*	================================================================================================	*/
/*	CONFIGURACOES DO BANCO DE DADOS	*/
/*	================================================================================================	*/


/*$host_banco 	= "localhost";
$nome_banco 	= "masmidia_centralengenharia";
$usuario_banco 	= "masmidia_user";
$senha_banco 	= "masmidia102030";*/


$host_banco 	= "localhost";
$nome_banco 	= "masmidia_imperio";
$usuario_banco 	= "masmidia_user";
$senha_banco 	= "masmidia102030";




/*	================================================================================================	*/
/*	VARIAVEIS */
/*	================================================================================================	*/
define('PASTA_PROJETO', $pasta_projeto);
define('HOST_BANCO', $host_banco);
define('NOME_BANCO', $nome_banco);
define('USUARIO_BANCO', $usuario_banco);
define('SENHA_BANCO', $senha_banco);



define('COPYRIGHT', "Copyright HomewebBrasil www.homewebbrasil.com.br");
define('EMAIL_GOOGLE_ANALYTICS', "capital.tekan@gmail.com");
define('SENHA_GOOGLE_ANALYTICS', "capital1010");
define('ID_GOOGLE_ANALYTICS', "60596765");




?>