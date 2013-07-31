<?php
class Imagem
{
	
	
	/*
* File: SimpleImage.php
* Author: Simon Jarvis
* Copyright: 2006 Simon Jarvis
* Date: 08/11/06
* Link: http://www.white-hat-web-design.co.uk/articles/php-image-resizing.php
* 
* This program is free software; you can redistribute it and/or 
* modify it under the terms of the GNU General Public License 
* as published by the Free Software Foundation; either version 2 
* of the License, or (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful, 
* but WITHOUT ANY WARRANTY; without even the implied warranty of 
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the 
* GNU General Public License for more details: 
* http://www.gnu.org/licenses/gpl.html
*
*/


/*
------------------	USO	------------------------------------
O primeiro exemplo a seguir carrega um arquivo chamado picture.jpg redimensioná-lo para 250 pixels de largura e 400 pixels de altura e salve-o como picture2.jpg

<?php
   include('SimpleImage.php');
   $image = new SimpleImage();
   $image->load('picture.jpg');
   $image->resize(250,400);
   $image->save('picture2.jpg');
?>
Se você deseja redimensionar a largura specifed mas manter a relação de dimensões iguais, em seguida, o script pode trabalhar para fora a altura necessária para você, basta usar a função resizeToWidth.

<?php
   include('SimpleImage.php');
   $image = new SimpleImage();
   $image->load('picture.jpg');
   $image->resizeToWidth(250);
   $image->save('picture2.jpg');
?>
Você pode querer escala de uma imagem a uma determinada percentagem como a seguinte que irá redimensionar a imagem para 50% da sua largura e altura original

<?php
   include('SimpleImage.php');
   $image = new SimpleImage();
   $image->load('picture.jpg');
   $image->scale(50);
   $image->save('picture2.jpg');
?>
Pode, claro, fazer mais do que uma coisa de cada vez. O exemplo a seguir criará duas novas imagens com altura de 200 pixels e 500 pixels

<?php
   include('SimpleImage.php');
   $image = new SimpleImage();
   $image->load('picture.jpg');
   $image->resizeToHeight(500);
   $image->save('picture2.jpg');
   $image->resizeToHeight(200);
   $image->save('picture3.jpg');
?>
A função de saída permite a saída de imagem diretamente para o navegador, sem ter que salvar o arquivo. É útil para a geração de miniaturas voar

<?php
   header('Content-Type: image/jpeg');
   include('SimpleImage.php');
   $image = new SimpleImage();
   $image->load('picture.jpg');
   $image->resizeToWidth(150);
   $image->output();
?>
O exemplo a seguir irá redimensionar e gravar uma imagem que foi enviada através de um formulário

<?php
   if( isset($_POST['submit']) ) {
      include('SimpleImage.php');
      $image = new SimpleImage();
      $image->load($_FILES['uploaded_image']['tmp_name']);
      $image->resizeToWidth(150);
      $image->output();
   } else {
?>
   <form action="upload.php" method="post" enctype="multipart/form-data">
      <input type="file" name="uploaded_image" />
      <input type="submit" name="submit" value="Upload" />
   </form>
<?php
   }
?>


*/



 
   
   var $image;
   var $image_type;
 
 	
   function load($filename) 
   {
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
         $this->image = imagecreatefrompng($filename);
      }
   }
   
   
   
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image,$filename);         
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image,$filename);
      }   
      if( $permissions != null) {
         chmod($filename,$permissions);
      }
   }
   
   
   
   
   function output($image_type=IMAGETYPE_JPEG) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image);         
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image);
      }   
   }
   
   
   
   function getWidth() {
      return imagesx($this->image);
   }
   
   
   function getHeight() {
      return imagesy($this->image);
   }
   
   
   function resizeToHeight($height) {
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
   
   
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
   
   
   
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100; 
      $this->resize($width,$height);
   }
   
   
   
   
   
   /*
   function redimension_pela_proporcao($width) 
   {
      $width_imagem = $this->getWidth();
	  $height_imagem = $this->getheight();
		
	
	  if ($width_imagem > $height_imagem)
	  {
			$cal = $width_imagem;
	  }
	  else
	  {
			$cal = $height_imagem;
	  }
		
	  $prop = (100 * $width / $cal) / 100;
	  $altura_final = $height_imagem * $prop; 			
	  $largura_final = $width_imagem * $prop; 			
      
      $this->resize($largura_final, $altura_final);
   }
   */
   
   
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;   
   } 
	
	
	
	
   #--------------------------------------------------------------------------------------------------------------------------#
   #	REDIMENSIONA PELA PROPORCAO	-ALTERADO POR MARCIO
   #--------------------------------------------------------------------------------------------------------------------------#
   function redimension_pela_proporcao($width) 
   {
      $width_imagem = $this->getWidth();
	  $height_imagem = $this->getheight();
		
	
	  if ($width_imagem > $height_imagem)
	  {
			$this->resizeToWidth($width);
	  }
	  else
	  {
			$this->resizeToHeight($width);
			
	  }
		
	  
   }
	
	
   #--------------------------------------------------------------------------------------------------------------------------#
   #	FUNCAO PARA CRIAR UM CROP	-ALTERADO POR MARCIO
   #--------------------------------------------------------------------------------------------------------------------------#
   public function crop($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale)
   {
	
		list($imagewidth, $imageheight, $imageType) = getimagesize($image);
		
		$imageType = image_type_to_mime_type($imageType);
		
		$newImageWidth = ceil($width * $scale);
		
		$newImageHeight = ceil($height * $scale);
		
		$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
		switch($imageType) 
		{
			case "image/gif":
				$source=imagecreatefromgif($image); 
				break;
			case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				$source=imagecreatefromjpeg($image); 
				break;
			case "image/png":
			case "image/x-png":
				$source=imagecreatefrompng($image); 
				break;
		}
		
		imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
		
		switch($imageType) 
		{
			case "image/gif":
				imagegif($newImage,$thumb_image_name); 
				break;
			case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				imagejpeg($newImage,$thumb_image_name,90); 
				break;
			case "image/png":
			case "image/x-png":
				imagepng($newImage,$thumb_image_name);  
				break;
		}
    }
	
	
	
	
	#-------------------------------------------------------------------------------------------------#
	#	ALTERO OS DADOS DA TABELA
	#-------------------------------------------------------------------------------------------------#
	public function gera_imagem_crop($id, $nome_arquivo, $nome_tabela, $idtabela, $nome_campo, $tamanho_imagem, $tamanho_width_tumb, $tamanho_height_tumb, $url_retorno, $msg_sucesso)
	{
		//	CADASTRO A IMAGEM
		/*
		$id = $id;
		$nome_tabela = $this->nome_tabela;
		$idtabela = $this->id_tabela;
		$nome_campo = "imagem_capa";
		$tamanho_imagem = 600;
		$tamanho_width_tumb = 150;
		$tamanho_height_tumb = 150;
		$url_retorno = $_SERVER['PHP_SELF'];
		*/
		
		$caminho = Util::caminho_projeto() . "/jquery/crop/gera_crop_capa.php?id=$id&nome_tabela=$nome_tabela&idtabela=$idtabela&nome_campo=$nome_campo&tamanho_imagem=$tamanho_imagem&tamanho_width_tumb=$tamanho_width_tumb&tamanho_height_tumb=$tamanho_height_tumb&nome_arquivo=$nome_arquivo&url_retorno=$url_retorno&msg_sucesso=$msg_sucesso";
		header("Location: $caminho");
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*

	#---------------------------------------------------------------------------------------------------------------#
	#	CRIA A IMAGEM
	#---------------------------------------------------------------------------------------------------------------#
	public function trata_imagem($caminho, $arquivo, $tamanho_imagem)
	{	
		//	VERIFICO OS PARAMETRO PASSADO
		$parametros = func_get_args();
		switch(func_num_args())
		{
			case 3:
				$tamanho_maximo = $parametros[2];
			break;
		}
		
		
	
		//	PERMISSAO NO DIRETORIO
		chmod($caminho, 0777);
		
		//IMAGEM A SER ABERTA (800x640)
		echo $imagem = "$caminho/$arquivo";
		
		//DEFINE OS PARÂMETROS DA MINIATURA
		$largura = 200;
		$altura = 160;
		
		//NOME DO ARQUIVO DA MINIATURA
		$imagem_gerada = explode(".", $imagem);
		$imagem_gerada = $imagem_gerada[0]."_mini.jpg";
		
		//CRIA UMA NOVA IMAGEM
		$imagem_orig = imagecreatefromjpeg($imagem);
		//LARGURA
		$pontoX = ImagesX($imagem_orig);
		//ALTURA
		$pontoY = ImagesY($imagem_orig);
		
		//CRIA O THUMBNAIL
		$imagem_fin = imagecreatetruecolor($largura, $altura);
		
		//COPIA A IMAGEM ORIGINAL PARA DENTRO
		imagecopyresampled($imagem_fin, $imagem_orig, 0, 0, 0, 0, $largura+1, $altura+1, $pontoX, $pontoY);
		
		//SALVA A IMAGEM
		imagejpeg($imagem_fin, $imagem_gerada);
		
		//LIBERA A MEMÓRIA
		imagedestroy($imagem_orig);
		imagedestroy($imagem_fin);
		
		
		
		
		exit();
		
		
		
		
		
		
		
		
		
		
		
		
		/*
		//	cria a imagem
		echo "$caminho/$arquivo";
		$img_velha = imagecreatefromjpeg("$caminho/$arquivo");
		$largurao = imagesx($img_velha);
		$alturao = imagesy($img_velha);
		
		//PEGO TAMANHO DA IMAGEM
		if ($largurao > $alturao)
		{
			$cal = $largurao;
		}
		else
		{
			$cal = $alturao;
		}
			
		$prop = (100 * $tamanho_imagem_grande / $cal) / 100;
	echo	$alturad = $alturao * $prop; 			
	echo 	$largurad = $largurao * $prop; 	

		
		
		
		$img_nova = imagecreatetruecolor( $largurad , $alturad );
		imagecopyresampled($img_nova,$img_velha, 0, 0, 0, 0, $largurad,$alturad, $largurao, $alturao);
		
		
	}
	
	
	
	#---------------------------------------------------------------------------------------------------------------#
	#	COLOCA UMA LOGO NA IMAGEM
	#---------------------------------------------------------------------------------------------------------------#
	public function trata_imagem_coloca_logo()
	{
		//	MARCA D'ÁGUA
		if ($criar_logo == "s")
		{
			$logo = imagecreatefromjpeg( $imagem_logo );
			imagecopymerge($img_nova , $logo , $largurad - (imagesx($logo) + 5) , $alturad - ( imagesy($logo) + 5 ) , 0 , 0 , imagesx($logo) , imagesy($logo) , 70);
		}	
		
		imagejpeg($img_nova, "$caminho/$arquivo");		
		imagedestroy($img_nova);
		imagedestroy($img_velha);
		
		if ($criar_logo)
		{
			imagedestroy($logo);
		}
	}
			
		*/
}





?>