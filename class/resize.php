<?php   

//Incluir a classe responsavel em redimencionar a imagem em tempo real.
include('m2brimagem.class.php');   

/*
* redimensionaImg()
* @param $arquivo: Caminho da imagem
* @param $largura: nova largura da imagem 
* @param $altura: nova altura da imagem 
* @param $tipo: tipo de corte na imagem [crop,fill,''] 
*/

//Recebe os paramentros na chamada da página redimensionar_img
$arquivo = $_GET['arquivo'];
$largura    = $_GET['largura'];   
$altura     = $_GET['altura'];
$tipo = "crop";

//Execulta o redirecionamento da imagem   
$obj_imagem = new m2brimagem($arquivo);   
$valida = $obj_imagem->valida();
if ($valida == 'OK')
{   
	$obj_imagem->redimensiona($largura,$altura,$tipo,array( 0,0,0 ));
	$obj_imagem->grava();
}
exit;   
?>