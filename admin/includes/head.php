<!--	====================================================================================================	 -->	
<!--	LIMPAR CACHE	 -->
<!--	====================================================================================================	 -->
<?php
header("Pragma: no-cache");
header("Cache: no-cache");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
?>


<!--	====================================================================================================	 -->	
<!--	META TAGS	 -->
<!--	====================================================================================================	 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Sigra" />
<meta name="keywords" content="Sigra" />
<meta name="revisit-after" content="7 Days" />
<meta name="language" content="pt-br" /> 
<meta name="robots" content="all" /> 
<meta name="rating" content="general" /> 
<meta name="copyright" content="Copyright Tekan www.tekan.com.br" /> 
<link rel="index" href="http://www.sigra.com.br/sitemap.xml" />



<!--	====================================================================================================	 -->	
<!--	TITULO DO SITE	 -->
<!--	====================================================================================================	 -->	
<title>Admin - <?php echo $_SERVER['SERVER_NAME'] ?></title>



<!--	====================================================================================================	 -->	
<!--	ARQUIVOS CSS	 -->
<!--	====================================================================================================	 -->
<link href="<?php echo Util::caminho_projeto(); ?>/admin/css/css.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 8]>        		
    <link href="<?php echo Util::caminho_projeto(); ?>/admin/css/cssIE7.css" rel="stylesheet" type="text/css" />
<![endif]-->




<!--	====================================================================================================	 -->	
<!--	ARQUIVOS JAVASCRIPT	 -->
<!--	====================================================================================================	 -->
<script src="<?php echo Util::caminho_projeto(); ?>/jquery/jquery-1.8.2.min.js" language="javascript" type="text/javascript"></script>
<script src="<?php echo Util::caminho_projeto(); ?>/jquery/jquery-ui-1.7.1.custom.min.js" language="javascript"></script>

    
<!--	==================================================================================================================	-->
<!--	MASKED	-->
<!--	==================================================================================================================	-->
<script src="<?php echo Util::caminho_projeto() ?>/jquery/masked/jquery.maskedinput-1.3min.js" type="text/javascript"></script>
<script src="<?php echo Util::caminho_projeto() ?>/jquery/mask_money/jquery.maskMoney.0.2.js" type="text/javascript"></script>
    
    
    
<!--	==================================================================================================================	-->
<!--	FancyZoom 	-->
<!--	==================================================================================================================	-->   
<script src="<?php echo Util::caminho_projeto() ?>/jquery/fancyZoom_1.1/js-global/FancyZoom.js" type="text/javascript"></script>
<script src="<?php echo Util::caminho_projeto() ?>/jquery/fancyZoom_1.1/js-global/FancyZoomHTML.js" type="text/javascript"></script>
    




<!--	====================================================================================================	 -->	
<!--	VALIDACAO DO FORMULARIO	 -->
<!--	====================================================================================================	 -->
<link rel="stylesheet" href="<?php echo Util::caminho_projeto(); ?>/jquery/validation_engine/css/validationEngine.jquery.css" type="text/css"/>
<script src="<?php echo Util::caminho_projeto(); ?>/jquery/validation_engine/js/languages/jquery.validationEngine-pt.js" language="javascript" type="text/javascript"></script>    
<script src="<?php echo Util::caminho_projeto(); ?>/jquery/validation_engine/js/jquery.validationEngine.js" language="javascript" type="text/javascript"></script>    
<script>
// VALIDATE ENGINE
jQuery(document).ready(function(){
	// binds form submission and fields to the validation engine
	$("#form-dados").validationEngine();
});
</script>




<!-- ======================================================= -->
<!-- DATEPICKER -->
<!-- ======================================================= -->
<link type="text/css" href="<?php echo Util::caminho_projeto(); ?>/admin/css/smoothness/jquery-ui-1.7.1.custom.css" rel="stylesheet" />
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





