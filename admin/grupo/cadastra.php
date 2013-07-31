<?php
require_once("../../class/Include.class.php");
require_once("Grupo_Model.php");
require_once("../trava.php");

$grupo_control = new Grupo_Model();



if(isset($_POST[action]))
{
	$grupo_control->cadastra_grupo($_POST);
	Util::script_msg("Grupo cadastrado com sucesso.");
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <link rel="stylesheet" href="../css/style.css" type="text/css" media="all"/>
    <?php require_once("../includes/head.php"); ?>


<script language="javascript"> 
	$(document).ready(function(){
	  $("#form-grupo").ketchup();
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
                
                
               <?php echo $grupo_control->formulario($_POST); ?>
               
               
               
               
                
                <div class="holder-btns">
                	<input type="hidden" name="action" id="action" value="cadastra" />
                    <input type="image" src="../imgs/btn-cadastrar.jpg" alt="Cadastar" />
                </div>
            </form>
            
            
            
            
            
     	</div>      
            
          
    </div>        
            
            
        
</div>
        <!-- ============================= CONTAINER CONTEUDO HOLDER =================================== -->
        
    	
    
    
    
    </div>
    <!-- ============================= CONTAINER CONTEUDO =================================== -->


</div>
<!-- ============================= CONTAINER =================================== -->


</body>
</html>