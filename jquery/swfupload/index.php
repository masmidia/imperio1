<?php
require_once("../../class/Include.class.php");
require_once("../../class/Util.class.php");
require_once("../../class/Imagem.class.php");
require_once("../../class/Dao.class.php");
require_once("../../class/Upload.class.php");





//	VERIFICO SE PS PARAMENTROS FORAM PASSADOS CORRETAMENTE
if(empty($_GET[id]) or empty($_GET[nome_tabela]) or empty($_GET[nome_campo]) or empty($_GET[nome_chave_estrangeira]) or empty($_GET[tamanho_imagem]) or empty($_GET[tamanho_tumb]) )
{
	Util::script_msg("Atenção Administrador, passe os paramentos corretamente");
	exit();
}



?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>






<?php
$obj_dao = new Dao();
//	BUSCO A QUANTIDADE DE IMAGEM CADASTRADA
$sql = "SELECT COUNT(*) AS total FROM $_GET[nome_tabela] WHERE $_GET[nome_chave_estrangeira] = '$_GET[id]'";
$row = mysql_fetch_array($obj_dao->executaSQL($sql));

//	VERIFICO A QUANTIDADE DE IMAGENS QUE O USUARIO PODE ENVIAR
$qtd_max_imgs = $_GET[qtd_max_imgs]- $row[total];




//	VERIFICO SE FOI EXCEDIDO A QUANTIDADE
if($qtd_max_imgs >= 1)
{
	echo "<h1>Selecione os arquivos desejados</h1>";
	$obj_upload= new Upload();
	$obj_upload->exibe_html_upload($_GET[tamanho_max_arquivo], "*.jpg; *.jpeg; *.bmp; *.png", $qtd_max_imgs, $_GET[id], $_GET[nome_tabela], $_GET[nome_campo], $_GET[nome_chave_estrangeira], $_GET[tamanho_imagem], $_GET[tamanho_tumb]);
}
else
{
	echo "<h1>Limite de imagens alcançado, caso deseje enviar apague alguma imagem.</h1>";	
}

?>






</body>
</html>