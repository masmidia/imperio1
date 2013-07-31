<?php
ini_set("allow_url_fopen", 1);
ini_set("allow_url_include", 1);
header('Content-Type: text/html; charset=UTF-8');


require_once("Dao.class.php");
require_once("Util.class.php");
require_once("Data_Hora.class.php");
$obj_dao = new Dao();



/*
	PARA A UTILIZACAO DA CLASSE E NECESSARIO A CRIACAO DE UMA TABELA, SEGUE O COMANDO SQL ABAIXO


	CREATE TABLE  `tb_msgs_twitters` (
	  `idmsgtwitter` int(10) unsigned NOT NULL AUTO_INCREMENT,
	  `msg` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
	  `data_postada` date NOT NULL,
	  `hora_postada` time NOT NULL,
	  `time` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
	  `id` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
	  `autor_nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
	  `autor_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	  `avatar` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
	  `tempo_postado` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
	  PRIMARY KEY (`idmsgtwitter`)
	) ENGINE=MyISAM AUTO_INCREMENT=146 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

*/







class Twitter extends Dao
{
	
	#-------------------------------------------------------------------------------------------------------------#
	#	METODO QUE RETORNA AS MSG DO TWITTER
	#-------------------------------------------------------------------------------------------------------------#
	public function busca_mensagens_bd($usuario = "g1", $limit = 0, $qtd_msg = 0)
	{
		
		
		$this->atualiza_mensagens_bd($usuario);
		
		$sql = "SELECT * FROM tb_msgs_twitters ORDER BY data_postada DESC, hora_postada DESC LIMIT $limit, $qtd_msg";
		return parent::executaSQL($sql);
		
	}
	
	
	
	
	
	#-------------------------------------------------------------------------------------------------------------#
	#	VERIFICA SE É NECESSÁRIO ATUALIZAR AS MENSAGENS DO TWITTER NO BD
	#-------------------------------------------------------------------------------------------------------------#
	private function atualiza_mensagens_bd($usuario)
	{
		$obj_data = new Manipula_Data_Hora();
		$hora = date("H:i:s");
		$data = date("d/m/Y");
		
		
		
		
		//	BUSCA A ULTIMA MENSAGEM
		$sql = "SELECT * FROM tb_msgs_twitters ORDER BY data_postada DESC, hora_postada DESC LIMIT 1";
		$result = parent::executaSQL($sql);
		
		if(mysql_num_rows($result) > 0)
		{
			$row = mysql_fetch_array($result);
			
			$ano = substr($row[data_ultima_verificacao], 0, 4);
			$mes = substr($row[data_ultima_verificacao], 5, 2);
			$dia = substr($row[data_ultima_verificacao], 8, 2);
			$hora_postada = $row[hora_ultima_verificacao];
			
			
		}
		else
		{
			$ano = 2000;
			$mes = date("m");
			$dia = date("d");
			$hora_postada = date("H:i:s");
		}
		
		
		
		
		
		 if($obj_data->difDataHora("$dia/$mes/$ano $hora_postada", "$data $hora", "m") > 3)
		 {
			
				//	ATUALIZA A DATA E HORA DA ULTIMA VERIFICACAO
				$this->armazena_data_hora_ultima_verificacao($row[idmsgtwitter]);
			
				$tweets = $this->busca_msgs_twitter($usuario);
				
				
				
				foreach ($tweets->entry as $tweet) 
				{
					
					
					
					$id = $tweet->id;
					$autor_nome = Util::trata_dados_formulario($tweet->author->name);
					$autor_url = $tweet->author->uri;
					$link = $tweet->link[0]->attributes()->href;
					$avatar = $tweet->link[1]->attributes()->href;
					$conteudo = Util::trata_dados_formulario($tweet->content);
					$tempo_postado = Util::trata_dados_formulario($tweet->updated);
					$data_postada = substr($tweet->updated, 0, 10);
					$hora_postada = substr($tweet->updated, 11, 8);
					
					
					//	VERIFICO SE JA EXISTE A MSG NO BANCO
					$sql = "SELECT * FROM tb_msgs_twitters WHERE id = '$id'";
					$result = parent::executaSQL($sql);
					
					if(mysql_num_rows($result) == 0)
					{
						$sql = "
								INSERT tb_msgs_twitters 
									(msg, data_postada, hora_postada, time, id, autor_nome, autor_url, link, avatar, tempo_postado, data_ultima_verificacao, hora_ultima_verificacao) 
								VALUES 
									('$conteudo', '$data_postada' ,'$hora_postada', '$time', '$id', '$autor_nome', '$autor_url', '$link', '$avatar', '$tempo_postado', '".date("Ymd")."', '$hora')
								";
						parent::executaSQL($sql);
					}	
					
				}
				
		 }
	}
	
	
	
	#-------------------------------------------------------------------------------------------------------------#
	#	ARMAZENA A DATA E HORA DA ULTIMA VERIFICACAO
	#-------------------------------------------------------------------------------------------------------------#
	function armazena_data_hora_ultima_verificacao($idmsgtwitter) 
	{
		$hora = date("H:i:s");
		$data = date("Ymd");
		
		$sql = "UPDATE tb_msgs_twitters SET data_ultima_verificacao = '$data', hora_ultima_verificacao = '$hora' WHERE idmsgtwitter = '$idmsgtwitter'";
		parent::executaSQL($sql);
		
	}
		
	
	
	#-------------------------------------------------------------------------------------------------------------#
	#	AJUSTA A HORA, EXEMPLO: 19 Minutos atrás
	#-------------------------------------------------------------------------------------------------------------#
	function tempo_postagem($tm1 ,$rcs = 0) 
	{
		$tm = strtotime($tm1);
		
		$cur_tm = time(); $dif = $cur_tm-$tm;
		$pds = array('segundo','minuto','hora','dia','semana','mês','ano','década');
		$lngh = array(1,60,3600,86400,604800,2630880,31570560,315705600);
		for($v = sizeof($lngh)-1; ($v >= 0)&&(($no = $dif/$lngh[$v])<=1); $v--); if($v < 0) $v = 0; $_tm = $cur_tm-($dif%$lngh[$v]);
		
		$no = floor($no); if($no <> 1) $pds[$v] .='s'; $x=sprintf("%d %s ",$no,$pds[$v]);
		if(($rcs == 1)&&($v >= 1)&&(($cur_tm-$_tm) > 0)) $x .= time_ago($_tm);
		return $x;
	}
	
	
	
	
	
	
	public function busca_msgs_twitter($usuario)
	{
	
		$query = urlencode($usuario);
		$rpp = $_GET["rpp"];
		$page = $_GET["page"];
		$since_id = $_GET["since_id"];
		$paginator = $_GET["paginator"];
		
		
		if ($query=="") {
			$query="_davidleandro";
		}
		
		
		
		if (!is_numeric($rpp)) {
			$rpp = 15;
		}
		
		if (!is_numeric($page)) {
			$page = 1;
		}
		
		if (!is_numeric($since_id)) {
			$since_id = "";
		}
		
		if ($paginator=="false") {
			$paginator = false;
		} else {
			$paginator = true;
		}
		
		
		
		return $tweets = simplexml_load_file("http://search.twitter.com/search.atom?rpp={$rpp}&page={$page}&since_id={$since_id}&q={$query}");
		
	}
	
	
	
	
	
	
	
}








?>