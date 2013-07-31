<?php
require_once("../../class/Include.class.php");
require_once("../trava.php");
$obj_dao = new Dao();
$caminho_projeto = Util::caminho_projeto();





//	VERIFICO SE PS PARAMENTROS FORAM PASSADOS CORRETAMENTE
if(empty($_GET[id]) or empty($_GET[nome_tabela]) or empty($_GET[nome_campo]) or empty($_GET[nome_chave_estrangeira]) or empty($_GET[tamanho_imagem]) or empty($_GET[tamanho_tumb]) )
{
	Util::script_msg("Atenção Administrador, passe os paramentos corretamente");
	exit();
}



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

    <link rel="stylesheet" href="../css/style.css" type="text/css" media="all"/>
    <?php require_once("../includes/head.php"); ?>


<script language="javascript"> 
	$(document).ready(function() {
	  $("#form-dados").ketchup();
	});
</script> 


<style>
	.vizulaiza_imagens{float:left; solid 1px; margin:10px 0px 0px 10px; width:<?php echo $_GET[tamanho_tumb] ?>px; min-height:<?php echo $_GET[tamanho_tumb] + 10 ?>px;}
</style>



</head>



<body>


<!-- ============================= CONTAINER =================================== -->
<div id="container">
	
    
    <!-- ============================= CONTAINER LATERAL =================================== -->
    <?php require_once("../includes/lateral.php") ?>
    <!-- ============================= CONTAINER LATERAL =================================== -->
    
    
    <!-- ============================= CONTAINER CONTEUDO =================================== -->
    <div id="container-conteudo">
    	
        <!-- ============================= CONTAINER CONTEUDO TOPO =================================== -->
        <?php require_once("../includes/topo.php") ?>
        <!-- ============================= CONTAINER CONTEUDO TOPO =================================== -->
        
        
        
        
        
        <!-- ============================= CONTAINER CONTEUDO HOLDER =================================== -->
        <div id="container-conteudo-holder">
        	
            <div class="titulo-pags">
            	Cadastro
            </div>
             <div class="holder-erro">
                <ul>
                    <?php echo $msn ?>
                </ul>
            </div>
            
            
            
            
            
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
								
								<div align="center">
								<input type="image" src="<?php echo Util::caminho_projeto(); ?>/admin/imgs/cancel.png"  border="0" style="border-style:none;" title="Excluir">
								</div>
								
								<img src="<?php echo Util::caminho_projeto(); ?>/uploads/tumb_<?php echo $row[$_GET[nome_campo]] ?>" /> 
								<input type="hidden" name="id_exc" value="<?php echo $row[0]; ?>">
								<input type="hidden" name="nome_imagem" value="<?php echo $row[$_GET[nome_campo]] ?>">
								
							</form>
						</div>       
					<?php
					
				}	
			}
			
			?>
            
            
            
         	<div style="padding:30px 0px 10px 0px; clear:both;">
            <p>Clique para selecionar as imagens desejadas</p>
            </div>
            <?php
            //	CRIO O BOTAO DE ENVIO DAS IMAGENS
            $obj_upload= new Upload();
            $obj_upload->exibe_html_upload($_GET[tamanho_max_arquivo], "*.jpg; *.jpeg; *.bmp; *.png", $_GET[qtd_max_imgs], $_GET[id], $_GET[nome_tabela], $_GET[nome_campo], $_GET[nome_chave_estrangeira], $_GET[tamanho_imagem], $_GET[tamanho_tumb]);
            ?>
            
            
            
        
</div>
        <!-- ============================= CONTAINER CONTEUDO HOLDER =================================== -->
        
    	
    
    
    
    </div>
    <!-- ============================= CONTAINER CONTEUDO =================================== -->


</div>
<!-- ============================= CONTAINER =================================== -->


</body>
</html>