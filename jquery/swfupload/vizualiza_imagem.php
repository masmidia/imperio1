<?php
require_once("../../class/Includes.class.php");
require_once("../../class/Util.class.php");
require_once("../../class/Imagem.class.php");
require_once("../../class/Dao.class.php");

$obj_dao = new Dao();

//	BUSCO AS IMAGENS
$sql ="SELECT * FROM $_GET[nome_tabela] WHERE $_GET[nome_chave_estrangeira] = '$_GET[id]'";
$result = $obj_dao->executaSQL($sql);



//	VERIFICO SE E PARA EXCLUIR
if(isset($_POST[id_exc]))
{
	$qtd_campos = mysql_num_fields($result);

	for($i = 0; $i< $qtd_campos; $i++)
	{
		$campo = mysql_fetch_field($result, $i);
		$chave_primaria = $campo->name;
		break;
	}
	
	
	$sql ="DELETE FROM $_GET[nome_tabela] WHERE $chave_primaria = '$_POST[id_exc]'";
	$obj_dao->executaSQL($sql);
	

	Util::deleta_arquivo("../../uploads/", $_POST[nome_imagem]);
	
	
	
	
	
	//	BUSCO AS IMAGENS NOVAMENTE
	$sql ="SELECT * FROM $_GET[nome_tabela] WHERE $_GET[nome_chave_estrangeira] = '$_GET[id]'";
	$result = $obj_dao->executaSQL($sql);
}



?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>


<style>
	.vizulaiza_imagens{float:left; solid 1px; margin:0px 0px 0px 10px; }
</style>

<body>




<?php

if(mysql_num_rows($result) == 0)
{
	echo "<h1>Nenhum registro encontrado</h1>";
}
else
{
	echo "<h1>Imagens encontradas</h1>";
	
	
	
	
	while($row = mysql_fetch_array($result))
	{
		?>
        	<div class="vizulaiza_imagens">
                <form method="post" action="" onsubmit="if (confirm('Deseja realmente EXCLUIR')) {return true;} else {return false}">
                    <img src="<?php echo Util::caminho_projeto(); ?>/uploads/tumb_<?php echo $row[$_GET[nome_campo]] ?>" /> 
                    <input type="hidden" name="id_exc" value="<?php echo $row[0]; ?>">
                    <input type="hidden" name="nome_imagem" value="<?php echo $row[$_GET[nome_campo]] ?>">
                    <div align="center">
                    <input type="image" src="<?php echo Util::caminho_projeto(); ?>/admin/img/deletar.jpg"  border="0" style="border-style:none;" title="Excluir">
                    </div>
                </form>
            </div>       
        <?php
		
	}	
}

?>



</body>
</html>













