<?php
//	ESCOLHO AS CLASSES DO MENU

switch (Util::nome_diretorio())
{
	case PASTA_PROJETO;
		$class_home	= "select";
	break;
	
	case PASTA_PROJETO."/quem-somos";
		$class_quem_somos = "select";
	break;
	
	case PASTA_PROJETO."/produtos";
		$class_produtos = "select";
	break;
	
		case PASTA_PROJETO."/servicos";
		$class_servicos = "select";
	break;
	
	break;
		case PASTA_PROJETO."/portifolio";
		$class_portifolios = "select";
	break;
	
	break;
		case PASTA_PROJETO."/promocoes";
		$class_promocoes = "select";
	break;
	
	break;
		case PASTA_PROJETO."/orcamentos";
		$class_orcamentos = "select";
	break;
	
	break;
		case PASTA_PROJETO."/fale-conosco";
		$class_fale_conosco = "select";
	break;
	
	default;
		$class_home	= "select";
	break;
}


/*
$result = $obj_site->select("tb_configuracoes","AND idconfiguracao = 1");
$config = mysql_fetch_array($result);

*/




?>

<meta charset="UTF-8">

<title>Império - <?php Util::imprime($obj_site->get_title($title)); ?></title>

<link rel="stylesheet" href="<?php echo Util::caminho_projeto(); ?>/css/fonts.css"/>
<link href="<?php echo Util::caminho_projeto(); ?>/css/geral.css" rel="stylesheet" type="text/css" media="screen" />


<!--[if lt IE 9]>
<link href="<?php echo Util::caminho_projeto(); ?>/css/cssIE8.css" rel="stylesheet" type="text/css" />
<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Util::caminho_projeto(); ?>/css/circle/common.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Util::caminho_projeto(); ?>/css/circle/style.css" />

<script src="<?php echo Util::caminho_projeto(); ?>/jquery/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="<?php echo Util::caminho_projeto(); ?>/jquery/jquery-ui-1.7.1.custom.min.js" type="text/javascript"></script>
<script src="<?php echo Util::caminho_projeto(); ?>/jquery/modernizr.custom.79639.js" type="text/javascript"></script> 




<meta name="description" content="<?php Util::imprime($obj_site->get_description($description)); ?>">
<meta name="keywords" content="<?php Util::imprime($obj_site->get_keywords($keywords)); ?>">
<meta name="robots" content="all">
<meta name="rating" content="general">







<!--	====================================================================================================	 -->	
<!--	UTILIZANDO CUFON PARA FONTS	 -->
<!--	====================================================================================================	 -->
<script src="<?php echo Util::caminho_projeto(); ?>/jquery/cufon-yui.js" language="javascript" type="text/javascript"></script>    
<script src="<?php echo Util::caminho_projeto(); ?>/fonts/Helvetica_Neue_300-Helvetica_Neue_700.font.js" language="javascript" type="text/javascript"></script>   
<script type="text/javascript">
	Cufon.replace('.helvetica_700, .botao', { fontWeight: 700 }); // Works without a selector engine
	Cufon.replace('.helvetica_300', { fontWeight: 300 }); // Works without a selector engine
</script>





<!--	====================================================================================================	 -->	
<!--	VALIDACAO DO FORMULARIO	 -->
<!--	====================================================================================================	 -->
<link rel="stylesheet" href="<?php echo Util::caminho_projeto(); ?>/jquery/validation_engine/css/validationEngine.jquery.css" type="text/css"/>
<script src="<?php echo Util::caminho_projeto(); ?>/jquery/validation_engine/js/languages/jquery.validationEngine-pt.js"  type="text/javascript"></script>    
<script src="<?php echo Util::caminho_projeto(); ?>/jquery/validation_engine/js/jquery.validationEngine.js"  type="text/javascript"></script>    




<!--	====================================================================================================	 -->	
<!--	MASCARA	 -->
<!--	====================================================================================================	 -->
<script src="<?php echo Util::caminho_projeto() ?>/jquery/masked/jquery.maskedinput-1.2.2.js" type="text/javascript"></script>






<!--	====================================================================================================	 -->	
<!--	MENSAGEM DE NAVEGADOR DESATUALIZADO	 -->
<!--	====================================================================================================	 -->
<script type="text/javascript"> 
var $buoop = {vs:{i:8,f:3.6,o:10.6,s:4,n:9}} 
$buoop.ol = window.onload; 
window.onload=function(){ 
 try {if ($buoop.ol) $buoop.ol();}catch (e) {} 
 var e = document.createElement("script"); 
 e.setAttribute("type", "text/javascript"); 
 e.setAttribute("src", "http://browser-update.org/update.js"); 
 document.body.appendChild(e); 
} 
</script> 






<script type="text/javascript">
$(document).ready(function(){					

	$(" .lista_produtos li").hover(function(){
		$(this).find('.lista_produtos_hover').css({visibility: "visible",display: "none"}).fadeIn(400);
		},function(){
		$(this).find('.lista_produtos_hover').css({visibility: "hidden"});
	});
	
	
	
});
</script>







