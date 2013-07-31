<?php
require_once("../../class/Include.class.php");
require_once("Grupo_Model.php");
require_once("../trava.php");

$obj_grupo_control = new Grupo_Model();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<link rel="stylesheet" href="../css/style.css" type="text/css" media="all"/>
    <?php require_once("../includes/head.php"); ?>
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
            	GRUPOS DE LOGIN
            </div>
            
            <?php
			
			$result = $obj_grupo_control->select();
			
			
			
			if(mysql_num_rows($result) == 0)
			{
				echo "<h1>Nenhum resultado cadastrado</h1>";	
			}
			else
			{
			?>
            
            <form action="" method="post" name="form_listagem" id="form_listagem" enctype="multipart/form-data">
                <div class="tabela-holder">
                
                    <table cellpadding="2" cellspacing="3"> 
                        <thead> 
                            <tr> 
                                <th width="446">NOME</th>
                                <th width="41">PERMISSÕES</th>
                                <th width="41">EXIBIR</th> 
                                <th width="37">EDITAR</th> 
                                <th width="52">DELETAR</th>                             
                            </tr> 
                        </thead> 
                        <tbody> 
                           <?php
                           while($row = mysql_fetch_array($result))
                           {
                           ?>
                            <tr> 
                                <td class="titulo-componente-tabela">
									<?php Util::imprime($row['nome']); ?>
                                </td>
                                <td align="center">
                                	<a href="permissoes.php?id=<?php echo $row[0] ?>" title="Gerenciar permissões">
                                    	<img src="../imgs/permissoes.jpg" alt="Gerenciar permissões"  />
                                    </a>
                                </td> 
                                <td align="center">
                                	<?php
									if($row['ativo'] == 'NAO')
									{
										$titulo = "Desativar";
									}
									else
									{
										$titulo = "Ativar";
									}
									?>
                                
                                	<a href="ativa_desativa.php?action=ativar_desativar&id=<?php Util::imprime($row['idgrupologin']); ?>&ativo=<?php Util::imprime($row['ativo']); ?>" title="<?php Util::imprime($titulo); ?>" >
	                                    <img src="../imgs/Comment-<?php echo ($row['ativo'] == "SIM" ? 'remove':'add') ?>-64.jpg" alt="<?php Util::imprime($titulo); ?>" />
                                    </a>
                                </td> 
                                
                                <td align="center">
                                    <a href="altera.php?action=alterar&id=<?php Util::imprime($row['idgrupologin']); ?>" title="Editar">
                                        <img src="../imgs/Comment-edit-64.jpg" alt="Editar" />
                                    </a>
                                </td> 
                                
                                <td align="center">
                                	<a href="exclui.php?id=<?php Util::imprime($row['idgrupologin']); ?>" title="Deletar">
                                    	<img src="../imgs/Comment-delete-64.jpg" alt="Deletar" />
                                    </a>
                                </td> 
                            </tr>
                            <?php
                           }
                            ?>
                        </tbody> 
                    </table> 
              </div>
                
                <div class="tabela-fundo">
                    &nbsp;
                </div>
            
            </form>
            <?php
			}
			?>
            
	  </div>
        <!-- ============================= CONTAINER CONTEUDO HOLDER =================================== -->
        
    </div>
    <!-- ============================= CONTAINER CONTEUDO =================================== -->
</div>
<!-- ============================= CONTAINER =================================== -->


</body>
</html>