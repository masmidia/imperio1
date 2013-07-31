<?php
require_once("../../class/Include.class.php");
require_once("Configuracao_Model.php");
require_once("../trava.php");

$control = new Informacao_Model();




if(isset($_POST[action]))
{
	$control->cadastra($_POST);
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

<!-- ======================================================= -->
<!-- DATEPICKER -->
<!-- ======================================================= -->
<link type="text/css" href="../css/smoothness/jquery-ui-1.7.1.custom.css" rel="stylesheet" />
<script src="../js/jquery-1.3.2.min.js" language="javascript"></script>
<script src="../js/jquery-ui-1.7.1.custom.min.js" language="javascript"></script>
<script type="text/javascript">
	$(function() {
		$("#data").datepicker();
		$("#data").datepicker('option', 'dateFormat', 'dd/mm/yy');
		$("#data").datepicker('option', 'dayNames', ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado']);
		$("#data").datepicker('option', 'monthNames', ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro']);
		$("#data").datepicker('option', 'dayNamesMin', ['Do', 'Se', 'Te', 'Qa', 'Qi', 'Se', 'Sa']);
	});
</script>
<!-- ======================================================= -->
<!-- FIM DO DATEPICKER -->
<!-- ======================================================= -->




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
            
            
            
            
            <form action="" name="form-dados" id="form-dados" method="post" enctype="multipart/form-data">
                
                
               <?php echo $control->formulario($_POST); ?>
               
               
               
               
                
                <div class="holder-btns"  style="margin:20px 0px 20px 0px;">
                	<input type="hidden" name="action" id="action" value="cadastra" />
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