<?php
require_once("../../class/Includes.class.php");
require_once("../../class/Util.class.php");
require_once("../../class/Imagem.class.php");
require_once("../../class/Dao.class.php");


#	 NA PROXIMA ALTERACAO COLOCAR TODAS AS OPCOES DE TRATAMENTO DE IMAGEM


function trata_imagem($caminho, $arquivo, $tamanho_imagem, $tamaho_tumb)
{
	//	CARREGO A IMAGEM 
	$image = new Imagem();
	$image->load("$caminho/$arquivo");
	//	CRIO A IMAGEM
	$image->redimension_pela_proporcao($tamanho_imagem);
	$image->save("$caminho/$arquivo");
	//	CRIO O TUMB
	$image->redimension_pela_proporcao($tamaho_tumb);
	$image->save("$caminho/tumb_$arquivo");
}




//$nome_arquivo = Util::upload_arquivo("uploads/", $_FILES['uploadfile']);
$nome_arquivo = Util::upload_arquivo("../../uploads/", $_FILES['uploadfile']);



//	VERIFICO SE E PARA ARMAZENAR EM ALGUMA TABELA
if(!empty($_GET[id]) and !empty($_GET[nome_tabela]) and !empty($_GET[nome_campo]) and !empty($_GET[nome_chave_estrangeira]) and !empty($_GET[tamanho_imagem]) )
{
	//	TRATO A IMAGEM
	trata_imagem("../../uploads", $nome_arquivo, $_GET[tamanho_imagem], $_GET[tamanho_tumb]);
	
	
	
	
	$obj_dao = new Dao();
	$sql = "INSERT INTO $_GET[nome_tabela] ($_GET[nome_chave_estrangeira], $_GET[nome_campo]) VALUES ('$_GET[id]', '$nome_arquivo')";
	$obj_dao->executaSQL($sql);
	
}











/*
$uploaddir = '../../uploads/'; 
$file = $uploaddir . basename($_FILES['uploadfile']['name']); 
//$file = $uploaddir . strtolower(date("dmYhi") . rand(1111, 1111111111) . '.' . pathinfo($_FILES['uploadfile']['name'], PATHINFO_EXTENSION););
$size=$_FILES['uploadfile']['size'];



/*
if($size>1048576)
{
	echo "error file size > 1 MB";
	unlink($_FILES['uploadfile']['tmp_name']);
	exit;
}



if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) { 
  echo "success"; 
} else {
	echo "error ".$_FILES['uploadfile']['error']." --- ".$_FILES['uploadfile']['tmp_name']." %%% ".$file."($size)";
}
*/
?>