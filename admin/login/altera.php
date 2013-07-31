<?php
require_once("../../class/Include.class.php");
require_once("Login_Model.php");
require_once("../trava.php");

$obj_control = new Login_Model();


if(isset($_POST[action]))
{
	$obj_control->altera($_POST);
	Util::script_msg("Login alterado com sucesso.");
	Util::script_location("lista.php");
}




$_POST = $obj_control->select($_GET[id]);


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
            	Alterar
            </div>
             <div class="holder-erro">
                <ul>
                    <?php echo $msn ?>
                </ul>
            </div>
            
            
            
            
            <form action="" name="form-dados" id="form-dados" method="post" enctype="multipart/form-data">
                
                
               <?php echo $obj_control->formulario_alteracao($_POST); ?>
                
                
                <div class="holder-btns">
                	<input type="hidden" name="id" id="id" value="<?php echo $_GET[id]; ?>" />
                    <input type="hidden" name="action" id="action" value="altera" />
                    
                    <input type="submit" alt="Altera" value="Alterar" class="btn_form_confirma" />
                    <input type="button" alt="Cancelar" value="Cancelar" class="btn_form_cancela" onclick="javascript:history.go(-1)" />
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