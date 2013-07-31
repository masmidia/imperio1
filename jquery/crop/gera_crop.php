<?php
require_once("../../class/Dao.class.php");
require_once("../../class/Util.class.php");
require_once("../../class/Imagem.class.php");
$obj_imagem = new Imagem();
$obj_dao = new Dao();




//	VERIFICO SE PS PARAMENTROS FORAM PASSADOS CORRETAMENTE
if(empty($_GET[id]) or empty($_GET[nome_tabela]) or empty($_GET[nome_campo]) or empty($_GET[nome_chave_estrangeira]) or empty($_GET[tamanho_imagem]) or empty($_GET[tamanho_width_tumb]) or empty($_GET[tamanho_height_tumb]) )
{
	Util::script_msg("Atenção Administrador, passe os paramentos corretamente");
	exit();
}




//	VERIFICO SE E PARA FINALIZAR
if(isset($_POST[upload_thumbnail]))
{
	$x1 = $_POST["x1"];
	$y1 = $_POST["y1"];
	$x2 = $_POST["x2"];
	$y2 = $_POST["y2"];
	$w = $_POST["w"];
	$h = $_POST["h"];
	$nomeTum = "../../uploads/tumb_$_POST[nome_arquivo]";
	$img_original = "../../uploads/$_POST[nome_arquivo]";
	$thumb_width = $_GET[tamanho_width_tumb];
	
	$scale = $thumb_width/$w;
	$cropped = $obj_imagem->crop($nomeTum, $img_original, $w, $h, $x1, $y1, $scale);
	
	//	ARMAZENO O NOME DA IMAGEM NA TABELA
	$sql = "INSERT INTO $_GET[nome_tabela] ($_GET[nome_chave_estrangeira], $_GET[nome_campo]) VALUES ('$_GET[id]', '$_POST[nome_arquivo]')";
	$obj_dao->executaSQL($sql);
	
	//	ENVIO O AVISO DE SUCESSO
	Util::script_msg("Imagem enviada com sucesso.");
	Util::script_location("index.php?$_SERVER[QUERY_STRING]");
}
else
{
	//	ENVIA O ARQUIVO
	$nome_arquivo = Util::upload_arquivo("../../uploads/", $_FILES['arquivo']);
	
	//	TRATO A IMAGEM
	$image = new Imagem();
	$image->load("../../uploads/$nome_arquivo");
	//	CRIO A IMAGEM
	$image->redimension_pela_proporcao($_GET[tamanho_imagem]);
	$image->save("../../uploads/$nome_arquivo");

	
	
	
	//	DIMENSOES PARA TRATAR E CRIAR A TUMB
	$dimensoes = getimagesize("../../uploads/$nome_arquivo");
	$thumb_width = $_GET[tamanho_width_tumb];
	$thumb_height = $_GET[tamanho_height_tumb];
	$current_large_image_width = $dimensoes['0'];
	$current_large_image_height = $dimensoes['1'];
}






//	BUSCO A QUANTIDADE DE IMAGEM CADASTRADA
$sql = "SELECT COUNT(*) AS total FROM $_GET[nome_tabela] WHERE $_GET[nome_chave_estrangeira] = '$_GET[id]'";
$row = mysql_fetch_array($obj_dao->executaSQL($sql));

//	VERIFICO A QUANTIDADE DE IMAGENS QUE O USUARIO PODE ENVIAR
$qtd_max_imgs = $_GET[qtd_max_imgs] - $row[total];


?>










<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>



<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="jquery.imgareaselect.min.js"></script>
<script type="text/javascript"> 
function preview(img, selection) { 
	var scaleX = <?php echo $thumb_width;?> / selection.width; 
	var scaleY = <?php echo $thumb_height;?> / selection.height;
	
	$('#thumbnail + div > img').css({ 
		width: Math.round(scaleX * <?php echo $current_large_image_width;?>) + 'px', 
		height: Math.round(scaleY * <?php echo $current_large_image_height;?>) + 'px',
		marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px',
		marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
	});
	$('#x1').val(selection.x1);
	$('#y1').val(selection.y1);
	$('#x2').val(selection.x2);
	$('#y2').val(selection.y2);
	$('#w').val(selection.width);
	$('#h').val(selection.height);
} 
 
$(document).ready(function () { 
	$('#save_thumb').click(function() {
		var x1 = $('#x1').val();
		var y1 = $('#y1').val();
		var x2 = $('#x2').val();
		var y2 = $('#y2').val();
		var w = $('#w').val();
		var h = $('#h').val();
		if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
			alert("You must make a selection first");
			return false;
		}else{
			return true;
		}
	});
}); 

$(window).load(function () { 
	$('#thumbnail').imgAreaSelect({ aspectRatio: '1:<?php echo $thumb_height/$thumb_width;?>', onSelectChange: preview });
});
 
</script>











</head>
<body>








<?php





//	VERIFICO SE FOI EXCEDIDO A QUANTIDADE
if($qtd_max_imgs > 0)
{
	?>
        <h1>Selecione o local da imagem desejado</h1>
        
        
        
        
        <div align="center">
        <img src="<?php echo "../../uploads/$nome_arquivo"; ?>" style="float: left; margin-right: 10px;" id="thumbnail" alt="Create Thumbnail" />
        <div style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:<?php echo $thumb_width;?>px; height:<?php echo $thumb_height;?>px;">
            <img src="<?php echo "../../uploads/$nome_arquivo"; ?>" style="position: relative;" alt="Thumbnail Preview" />
        </div>
            <br style="clear:both;"/>
            <form name="thumbnail" action="" method="post">
                <input type="hidden" name="x1" value="" id="x1" />
                <input type="hidden" name="y1" value="" id="y1" />
                <input type="hidden" name="x2" value="" id="x2" />
                <input type="hidden" name="y2" value="" id="y2" />
                <input type="hidden" name="w" value="" id="w" />
                <input type="hidden" name="h" value="" id="h" />
                <input type="hidden" name="nome_arquivo" value="<?php echo $nome_arquivo; ?>" id="h" />
                <input type="submit" name="upload_thumbnail" value="Gerar Thumbnail" id="save_thumb" />
            </form>
        </div>
        
        
        
        
       
        
        
    <?php
	
}

else
{
	echo "<h1>Limite de imagens alcançado, caso deseje enviar apague alguma imagem.</h1>";	
}

?>







</body>
</html>


























