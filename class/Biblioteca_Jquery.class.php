<?php
require_once("Include.class.php");
require_once($_SERVER['DOCUMENT_ROOT'] . PASTA_PROJETO . "/jquery/ckeditor/ckeditor.php");
$caminho_projeto = Util::caminho_projeto();



class Biblioteca_Jquery
{
	
	#-------------------------------------------------------------------------------------------------------------------#
	#	CONSTRUTOR DA CLASSE
	#-------------------------------------------------------------------------------------------------------------------#
	
	public function __construct()
	{
		/*//	FRAMEWORK JQUEY
		echo '<script type="text/javascript" src="'. Util::caminho_projeto() .'/jquery/jquery-1.3.2.js"></script>';
		echo '<script type="text/javascript" src="'. Util::caminho_projeto() .'/jquery/jquery-ui-1.7.1.custom.min.js"></script>';
		
		
		//	PNG FIX
		$this->png_fix();*/
	}
	
	
	
	
	#-------------------------------------------------------------------------------------------------------------------#
	#	BIBLIOTECA CKEDITOR
	#-------------------------------------------------------------------------------------------------------------------#
	static public function biblioteca_color_box_iframe()
	{
	?>
		<link type="text/css" media="screen" rel="stylesheet" href="<?php echo Util::caminho_projeto() ?>/jquery/colorbox/example1/colorbox.css" />
		<script type="text/javascript" src="<?php echo Util::caminho_projeto() ?>/jquery/colorbox/colorbox/jquery.colorbox.js"></script>	
    <?php
	}
	
	
	#-------------------------------------------------------------------------------------------------------------------#
	#	BIBLIOTECA JSLIDER
	#-------------------------------------------------------------------------------------------------------------------#
	static public function biblioteca_fancy_zoon()
	{
	?>
		<script type="text/javascript" src="<?php echo Util::caminho_projeto() ?>/jquery/fancyZoom_1.1/js-global/FancyZoom.js"></script>
		<script type="text/javascript" src="<?php echo Util::caminho_projeto() ?>/jquery/fancyZoom_1.1/js-global/FancyZoomHTML.js"></script>
	<?php
	}
	
	
	#-------------------------------------------------------------------------------------------------------------------#
	#	EFEITO ZOOM COM 'Fancy Zoom Script' 	
	#	PARA UTILIZAR ESSE EFEITO É NECESSARIO COLOCAR NO BODY O COMANDO '<body onload="setupZoom()">'
	#	<a href="IMAGEM NORMAL"><img src="TUMB DA IMAGEM"/></a>
	#-------------------------------------------------------------------------------------------------------------------#
	static public function fancy_zoom()
	{
		echo '
			 <script type="text/javascript"> 
				 $(document).ready(function() {
				   setupZoom();  
				 });
			 </script> 
			 ';

	}
	
	
	#-------------------------------------------------------------------------------------------------------------------#
	#	BIBLIOTECA JSLIDER
	#-------------------------------------------------------------------------------------------------------------------#
	static public function biblioteca_jslider()
	{
	?>
    	<script type="text/javascript" src="<?php echo Util::caminho_projeto() ?>/jquery/easyslider1.7/js/easySlider1.7.js"></script>
    <?php
	}
	
	
	
	#-------------------------------------------------------------------------------------------------------------------#
	#	BIBLIOTECA COLOR BOX
	#-------------------------------------------------------------------------------------------------------------------#
	static public function biblioteca_masked()
	{
		?>
			<script src="<?php echo Util::caminho_projeto() ?>/jquery/masked/jquery.maskedinput-1.2.2.js" type="text/javascript"></script>
            <script src="<?php echo Util::caminho_projeto() ?>/jquery/mask_money/jquery.maskMoney.0.2.js" type="text/javascript"></script>
    	<?php
	}
	
	
	
	
	#-------------------------------------------------------------------------------------------------------------------#
	#	BIBLIOTECA KETCHUP
	#-------------------------------------------------------------------------------------------------------------------#
	static public function biblioteca_ketchup()
	{
		?>
            <link rel="stylesheet" type="text/css" media="screen" href="<?php echo Util::caminho_projeto(); ?>/jquery/ketchup-plugin/css/jquery.ketchup.css" />
            <script type="text/javascript" src="<?php echo Util::caminho_projeto(); ?>/jquery/ketchup-plugin/js/jquery.min.js"></script>
            <script type="text/javascript" src="<?php echo Util::caminho_projeto(); ?>/jquery/ketchup-plugin/js/jquery.ketchup.js"></script>
            <script type="text/javascript" src="<?php echo Util::caminho_projeto(); ?>/jquery/ketchup-plugin/js/jquery.ketchup.messages.js"></script>
            <script type="text/javascript" src="<?php echo Util::caminho_projeto(); ?>/jquery/ketchup-plugin/js/jquery.ketchup.validations.basic.js"></script>
        <?php
	}
	
	
	
	
	
	
	
	
	#-------------------------------------------------------------------------------------------------------------------#
	#	FUNCAO DE VALIDACAO DE FORMULARIO
	# 	EXEMPLOS DE USO
	#	<input type="text" id="ex1_username" class="validate(required, username)" />
	#	<input type="password" id="ex1_password" class="validate(required)" />
	#	<input type="password" id="ex1_password_conf" class="validate(required, match(#ex1_password))" />
	#	<input type="checkbox" name="role" value="other" class="validate(rangeselect(1,3))" />
	#	<textarea id="ex1_about" rows="1" class="validate(rangelength(10,140))"></textarea>
	#-------------------------------------------------------------------------------------------------------------------#
	static public function ketchup($id_form)
	{
	?>
		<script>
            $(document).ready(function() {
              $('#<?php echo $id_form; ?>').ketchup();
            });
        </script>
	<?php
	}
	
	
	#-------------------------------------------------------------------------------------------------------------------#
	#	JSLIDER
	#-------------------------------------------------------------------------------------------------------------------#
	static public function jslider($nome_div, $nome_seta_voltar, $nome_seta_avancar)
	{
		//	CONFIGURACOES PADROES
		$auto = "false";	//	INICIA O SLIDER AUTOMATICAMENTE
		
		
		//	VERIFICO OS PARAMETRO PASSADO
		$parametros = func_get_args();
		

		switch(func_num_args())
		{
			case 4:	
				$auto = $parametros[3];
			break;
		}

		echo "
			 <script type=\"text/javascript\"> 
			 $(document).ready(function(){	
				$(\"#$nome_div\").easySlider({
					continuous: true,					
					prevId: '$nome_seta_voltar',					
					nextId: '$nome_seta_avancar',					
					controlsShow: false,					
					auto: $auto
				});
			 });	
			 </script> 
			";
	}
	
	
	#-------------------------------------------------------------------------------------------------------------------#
	#	FAZ UM TEXT AREA VIRAR UM CKEDITOR
	#-------------------------------------------------------------------------------------------------------------------#
	static public function ckeditor($nome_campo, $value)
	{
		$CKEditor = new CKEditor();
		//$CKEditor->config['toolbar'] = "Full";
		$CKEditor->config['toolbar'] = array(
								  array('Source','-','Save','NewPage','Preview','-','Templates'),
								  array('Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'),
								  array('Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'),
								  array('Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'),
								  '/',
								  array('Bold','Italic','Underline','Strike','-','Subscript','Superscript'),								  
								  array('NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'),
								  array('JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
								  array('Link','Unlink','Anchor'),
								  array('YouTube', 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'),
								 
								  array('Styles','Format','Font','FontSize'),
								  array('TextColor','BGColor'),
								  array('Maximize', 'ShowBlocks','-','About')
								  );
		
		$CKEditor->config['filebrowserBrowseUrl'] = 		Util::caminho_projeto() . '/jquery/ckfinder/ckfinder.html';
		$CKEditor->config['filebrowserImageBrowseUrl'] = 	Util::caminho_projeto() . '/jquery/ckfinder/ckfinder.html?type=Images';
		$CKEditor->config['filebrowserFlashBrowseUrl'] = 	Util::caminho_projeto() . '/jquery/ckfinder/ckfinder.html?type=Flash';
		$CKEditor->config['filebrowserUploadUrl'] = 		Util::caminho_projeto() . '/jquery/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
		$CKEditor->config['filebrowserImageUploadUrl'] = 	Util::caminho_projeto() . '/jquery/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
		$CKEditor->config['filebrowserFlashUploadUrl'] = 	Util::caminho_projeto() . '/jquery/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
		$CKEditor->editor("$nome_campo", "$value");
	}
	
	
	
	
	
	
	
	#-------------------------------------------------------------------------------------------------------------------#
	#	COLORBOX COM IFRAME
	#-------------------------------------------------------------------------------------------------------------------#
	static public function color_box_iframe($id_objeto)
	{ 
		$largura = "60%";
		$altura = "60%";
		
		
		//	VERIFICO OS PARAMETRO PASSADO
		$parametros = func_get_args();
		switch(func_num_args())
		{
			case 2:	
				$largura = $parametros[1];
			break;
			case 3:	
				$largura = $parametros[1];
				$altura = $parametros[2];
			break;
		}
	
		
		echo '
			<script type="text/javascript">
				$(document).ready(function(){
					$("#'. $id_objeto .'").colorbox({width:"'. $largura .'", height:"'. $altura .'", iframe:true});
					
					//Example of preserving a JavaScript event for inline calls.
					$("#click").click(function(){ 
						$("#click").css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
						return false;
					});
				});
			</script>
			';
	}
	
	
	
	#-------------------------------------------------------------------------------------------------------------------#
	#	AUMENTA OU DIMINUI O TAMANHO DA FONTE
	#-------------------------------------------------------------------------------------------------------------------#
	static public function aumente_diminui_fonte($tamanho_inicial)
	{
		/*
			//------------------------------------------------------------------------------------------------//
			//	EXEMPLO DE UTILIZACAO
			//	<a href=\"javascript:mudar_tamanho_fonte('body', -1);\" title=\"Aumentar texto\">A+</a>
			//	<a href=\"javascript:mudar_tamanho_fonte('body', 1);\" title=\"Diminuir texto\">a-</a>
			//	<div id=\"conteudo\">Teste Tamanho da fonte!</div>
			//------------------------------------------------------------------------------------------------// 
		*/
		echo "
			 <script type=\"text/javascript\"> 
				var tagAlvo = new Array('p', 'h1', 'label'); //pega todas as tags p//
				 
				// Especificando os possíveis tamanhos de fontes, poderia ser: x-small, small...
				var tamanhos = new Array( '11px','12px','13px','14px','15px','16px', '17px', '18px','19px','20px','21px','22px','23px','24px','25px','26px','27px','28px','29px','30px','31px','32px','33px');
				var tamanhoInicial = $tamanho_inicial;
				 
				function mudar_tamanho_fonte( idAlvo,acao ){
				  if (!document.getElementById) return
				  var selecionados = null,tamanho = tamanhoInicial,i,j,tagsAlvo;
				  tamanho += acao;
				  if ( tamanho < 0 ) tamanho = 0;
				  if ( tamanho > 10 ) tamanho = 10;
				  tamanhoInicial = tamanho;
				  if ( !( selecionados = document.getElementById( idAlvo ) ) ) selecionados = document.getElementsByTagName( idAlvo )[ 0 ];
				  
				  selecionados.style.fontSize = tamanhos[ tamanho ];
				  
				  for ( i = 0; i < tagAlvo.length; i++ ){
					tagsAlvo = selecionados.getElementsByTagName( tagAlvo[ i ] );
					for ( j = 0; j < tagsAlvo.length; j++ ) tagsAlvo[ j ].style.fontSize = tamanhos[ tamanho ];
				  }
				}
			</script> 
			 ";
	}
	
	
	
	#-------------------------------------------------------------------------------------------------------------------#
	#	CRIA AS MASCARAS DOS IMPUT
	#-------------------------------------------------------------------------------------------------------------------#
	static public function mascara_campos($campos)
	{
		$html = "<script type=\"text/javascript\" language=\"javascript\">
				 	jQuery(function($){
				";
		
						//	VERIFICO OS CAMPOS OBRIGATORIOS
						foreach($campos as $campo)
						{
								switch($campo[tipo])
								{
									case "data";
										//$html2.=  $this->date_picker($campo[nome_campo_form]);;
										$html.= "$(\"#$campo[nome_campo_form]\").mask(\"99/99/9999\");";
									break;
									case "telefone":
										$html.= "$(\"#$campo[nome_campo_form]\").mask(\"(99) 9999-9999\");";
									break;
									case "cep":
										$html.= "$(\"#$campo[nome_campo_form]\").mask(\"99999-999\");";
									break;
									case "moeda":
										$html.= "$(\"#$campo[nome_campo_form]\").maskMoney({showSymbol:false, symbol:\"R$\", decimal:\",\", thousands:\".\"});";
									break;									
								}
						}
				
		$html .= "	});
				  </script>";		
				  
		echo $html;
		echo $html2;
		
	}
	
	
	
	#-------------------------------------------------------------------------------------------------------------------#
	#	PNG FIX
	#-------------------------------------------------------------------------------------------------------------------#
	static public function png_fix()
	{
		//	NORMALIZAR OS PNG DAS PAGINAS
		echo '
			 <!--[if lt IE 7]>        		
				<script defer type="text/javascript" src="'. Util::caminho_projeto() .'/jquery/png_fix/pngfix.js"></script>
		     <![endif]--> 
			 ' ;
		
		/*
		//	NORMALIZAR OS PNG BACKGROUNDS
		echo '
			 <!--[if lt IE 7]>        		
				<script defer type="text/javascript" src="'. Util::caminho_projeto() .'/jquery/pngFix/jquery.pngFix.js"></script>
		     <![endif]--> 
			 ' ;
		echo '
		     <script type="text/javascript"> 
				$(document).ready(function(){ 
					$(document).pngFix(); 
				}); 
			</script> 
			 ';*/
	}
	
	
	

}


//$a = new Biblioteca_Jquery();
//$a->jalerts("");

?>