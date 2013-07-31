<?php
require_once("../../class/Include.class.php");
require_once("Promocao_Model.php");
require_once("../trava.php");


$obj_control = new Promocoes_Model();



if(isset($_POST[action]))
{
	$obj_control->ativar_desativar($_POST[id], $_POST[ativo]);
	Util::script_msg("Registro alterado com sucesso");
	Util::script_location("lista.php");
}




$row = $obj_control->select($_GET[id]);

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
            	Ativar e desativar registro
            </div>
             <div class="holder-erro">
                <ul>
                    <?php echo $msn ?>
                </ul>
            </div>
            
            
            
            
            <form action="" name="form_pags" id="form_pags" method="post" enctype="multipart/form-data">
            	<input type="hidden" name="valida" id="valida" value="ok" />
               
               <?php
			   if($_GET[ativo] == "SIM")
			   {
					echo "<h1>Deseja mesmo desativar? </h1> ";   
			   }
			   else
			   {
				   echo "<h1>Deseja mesmo ativar? </h1> ";   
			   }
			   ?>
                  
                
               <br />
               <h4><?php Util::imprime($row[titulo]) ?></h4>
               
               
               
               
                
                <div class="holder-btns">
                	<input type="hidden" name="id" id="id" value="<?php echo $_GET[id]; ?>" />
                    <input type="hidden" name="ativo" id="ativo" value="<?php echo $_GET[ativo]; ?>" />
                    <input type="hidden" name="action" id="action" value="ativar_desativar" />
                    <input type="image" src="../imgs/btn-sim.jpg" alt="Sim" />
                    
                    <a href="javascript:history.go(-1)" title="Não">
                    	<img src="../imgs/btn-nao.jpg" alt="Não" />
                    </a>
                </div>
            </form>
            
            
            
          
            
            
            
        
</div>
        <!-- ============================= CONTAINER CONTEUDO HOLDER =================================== -->
        
    	
    
    
    
    </div>
    <!-- ============================= CONTAINER CONTEUDO =================================== -->


</div>
<!-- ============================= CONTAINER =================================== -->

<!--	====================================================================================================	 -->	
<!--	ARQUIVOS JAVASCRIPT	 -->
<!--	====================================================================================================	 -->
<script src="<?php echo $pre ?>jquery/jquery-1.4.4.min.js" type="text/javascript" ></script>
<script src="<?php echo $pre ?>jquery/jquery.colorbox-min.js" type="text/javascript" ></script>
<script src="<?php echo $pre ?>jquery/jquery.validate.js" type="text/javascript" ></script>
<script src="<?php echo $pre ?>jquery/add-video.js" type="text/javascript" ></script>

<script type="text/javascript">
$(document).ready(function(){
	$(".example7").colorbox({width:"80%", height:"80%", iframe:true});				
});




$(document).ready(function(){
	$(".colorbox_galeria").colorbox({width:"500px", height:"70%", iframe:true});				
});

$(".colorbox_galeria").colorbox({					
	onClosed:function(){  window.location.reload(); }
});

$(document).ready(function(){
	$(".editar_galeria").colorbox({width:"750px", height:"250px", iframe:true});				
});

$(".editar_galeria").colorbox({					
	onClosed:function(){  window.location.reload(); }
});


$("a[rel='galeria1']").colorbox();


</script>

<script type="text/javascript"> 
$.validator.setDefaults({
	submitHandler: function() { $("#form_pags").submit(); }
});
 
$().ready(function() {
	$("#form_pags").validate({
		rules: {
			titulo: {
				required: true,
				texto: 'titulo'			
			}/*,
			texto: {
				required: true,
				texto: 'titulo'			
			}*/
			
			
		},
		messages: {
			titulo: "Por favor entre com o título da pagina",
			texo: "Por favor entre com o texto da pagina"
		}
	});
});
</script> 
</body>
</html>