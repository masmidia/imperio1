<?php
require_once("../../class/Include.class.php");
require_once("Grupo_Model.php");
require_once("../trava.php");

$obj_grupo_control = new Grupo_Model();


if(isset($_POST['action']))
{
	$obj_grupo_control->gerenciar_permissoes($_POST);
	Util::script_msg(utf8_decode("Permissões atualizadas com sucesso."));
	Util::script_location("lista.php");
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <link rel="stylesheet" href="../css/style.css" type="text/css" media="all"/>
    <?php require_once("../includes/head.php"); ?>



<!--	====================================================================================================	 -->	
<!--	SELECIONAR TODOS	 -->
<!--	====================================================================================================	 -->
<script>
	$(document).ready(function() {
		$('#btn_selecionar_todos').click(function() {
			if(this.checked == true){
				$("input[type=checkbox]").each(function() { 
					this.checked = true; 
				});
			} else {
				$("input[type=checkbox]").each(function() { 
					this.checked = false; 
				});
			}
		});	
	});
</script>


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
            
            
            
            
            <form action="" name="form-grupo" id="form-grupo" method="post" enctype="multipart/form-data">
                
               
               <a href="javascript:void(0);" title="Selecionar todos">
               	<label><input name="marcar_todos" id="btn_selecionar_todos" type="checkbox" value="" />Selecionar todos</label>
               </a>
               
               	
               
                
               <?php
			    $result = $obj_grupo_control->select_modulos_paginas();
				
				
				
				if(mysql_num_rows($result) == 0)
				{
					echo "<h1>Nenhum resultado cadastrado</h1>";	
				}
				else
				{
				?>
                        	<?php
                            while($row = mysql_fetch_array($result))
                            {
                            ?>
                                 <h2 style="margin-top:15px;"><?php Util::imprime($row[nome]); ?></h2>
                            <?php
								//	BUSCO AS PAGINAS QUE O GRUPO PERTENCE
								$result1 = $obj_grupo_control->select_paginas_modulos($row[idmodulopagina]);
								
								if(mysql_num_rows($result1) == 0)
								{
									echo "<h1>Nenhum resultado cadastrado</h1>";	
								}
								else
								{
									while($row1 = mysql_fetch_array($result1))
                            		{
										if($obj_grupo_control->select_modulos_paginas_permissao($_GET[id], $row1[idpagina]) > 0)
										{
											$checked = 'checked="checked"';
										}
										else
										{
											$checked = '';
										}
								?>
                                		<label><input name="pagina[]" <?php echo $checked; ?> type="checkbox" value="<?php Util::imprime($row1[idpagina]) ?>" /> <?php Util::imprime($row1[label]) ?></label>
                                <?php	
									}
								}
							}
							?>
				<?php	
				}
				?>
               
               
               
                
                <div class="holder-btns">
                	<input type="hidden" name="id_grupologin" id="id_grupologin" value="<?php echo $_GET[id]; ?>" />
                    <input type="hidden" name="action" id="action" value="gerenciar_permissoes" />
                    <input type="image" src="../imgs/btn-cadastrar.jpg" alt="Cadastar" />
                </div>
            </form>
            
            
            
          
            
            
            
        
</div>
        <!-- ============================= CONTAINER CONTEUDO HOLDER =================================== -->
        
    	
    
    
    
    </div>
    <!-- ============================= CONTAINER CONTEUDO =================================== -->


</div>
<!-- ============================= CONTAINER =================================== -->


</body>
</html>