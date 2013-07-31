<?php
require_once("Dao.class.php");
require_once("Util.class.php");

class Site extends Dao

{
		
		
		
		
		
		
		#-------------------------------------------------------------------------------------------------#
		#	BUSCO VARIOS OS DADOS DA TABELA
		#-------------------------------------------------------------------------------------------------#
		public function select($nome_tabela, $complemento_sql = "")
		{			
			//	ORDENACAO PADRAO
			if($complemento_sql == "")
			{
				$complemento_sql = "ORDER BY ordem";
			}
			
			$sql = "SELECT * FROM $nome_tabela WHERE ativo = 'SIM' $complemento_sql";
			return parent::executaSQL($sql);
		}
		
				
		
		#-------------------------------------------------------------------------------------------------#
		#	BUSCO UM UNICO DADO NA TABELA PASSAND UM DI
		#-------------------------------------------------------------------------------------------------#
		public function select_unico($nome_tabela, $id_tabela, $id)
		{
			//	BUSCO OS DADOS
			$sql = "SELECT * FROM $nome_tabela WHERE $id_tabela = '$id' AND ativo = 'SIM'";
			$result = parent::executaSQL($sql);
			return mysql_fetch_array($result);
		}
		
		
		
		
		#-------------------------------------------------------------------------------------------------#
		#	BUSCO VARIOS OS DADOS DA TABELA
		#-------------------------------------------------------------------------------------------------#
		public function select_geral($nome_tabela, $complemento_sql = "")
		{			
			//	ORDENACAO PADRAO
			if($complemento_sql == "")
			{
				$complemento_sql = "ORDER BY ordem";
			}
			
			$sql = "SELECT * FROM $nome_tabela $complemento_sql";
			return parent::executaSQL($sql);
		}
		
		
		
		#-------------------------------------------------------------------------------------------------#
		#	BUSCO VARIOS OS DADOS DA TABELA
		#-------------------------------------------------------------------------------------------------#
		public function insert($nome_tabela, $metodo = "post")
		{
			$sql = "SELECT * FROM $nome_tabela";
			$result = parent::executaSQL($sql);
			
			
			$qtd_colunas = mysql_num_fields($result);


			for($i = 0; $i< $qtd_colunas; $i++)
			{
				$campo = mysql_fetch_field($result, $i);
				
				
				//	VERIFICO SE E A CHAVE PRIMARIA
				if($campo->primary_key != 1)
				{
					
					//echo $campo->type . "<br />";
					
					//	COLOCAO SO DADOS DO FORM NUM ARRAY
					$campos[] =  array(
										'nome_campo_form'		=>	$campo->name,				//	NOME DO CAMPO NO FORMULARIO			
										'tipo'					=>	$campo->type			//	TIPO DE DADOS DO CAMPO (texto, moeda, data, telefone, cep)
									   );
								
					if($metodo == "post")
					{
						
						$valor_input = parent::trata_dados_banco(Util::trata_dados_formulario($_POST[$campo->name]), $campo->type);
						
						
						
						$dados[] = array(
										 'valor_imput' => $valor_input
										 );
					}
					else
					{
						
					}
				}
			}
			
			
			
			
			return parent::executaINSERT2($nome_tabela, $campos, $dados);
			
		}
		
		
		
		
		
		
		
		
		
		#-------------------------------------------------------------------------------------------------#
		#	BUSCO VARIOS OS DADOS DA TABELA
		#-------------------------------------------------------------------------------------------------#
		public function get_varios_dados_tabela($nome_tabela)
		{
			//	VERIFICO OS PARAMETRO PASSADO
			$parametros = func_get_args();
			switch(func_num_args())
			{
				case 2:
					$filtro = $parametros[1]; 
				break;
				case 3:
					$filtro = $parametros[1];
					$order = $parametros[2];
				break;
				case 4:
					$filtro = $parametros[1];
					$order = $parametros[2];
					$limit = $parametros[3];
				break;
			}
			
			//	ORDENACAO PADRAO
			if(empty($parametros[2]))
			{
				$order = "ORDER BY ordem";
			}
			
			$sql = "SELECT * FROM $nome_tabela WHERE ativo = 'SIM' $filtro $order $limit";
			return parent::executaSQL($sql);
		}
		
				
		
		#-------------------------------------------------------------------------------------------------#
		#	BUSCO UM UNICO DADO NA TABELA PASSAND UM DI
		#-------------------------------------------------------------------------------------------------#
		public function get_dados_tabela($nome_tabela, $id_tabela, $id)
		{
			//	BUSCO OS DADOS
			$sql = "SELECT * FROM $nome_tabela WHERE $id_tabela = '$id' AND ativo = 'SIM'";
			$result = parent::executaSQL($sql);
			return mysql_fetch_array($result);
		}
		
		
	
		
		#-------------------------------------------------------------------------------------------------#
		#	MONTA A URL AMIGAVEL
		#-------------------------------------------------------------------------------------------------#
		public function url_amigavel($titulo)
		{
			$url_titulo = $this->formata_url($titulo);
			return $link = "$url_titulo";			
		}
		
		
		
		#-------------------------------------------------------------------------------------------------#
		#	MONTA A URL AMIGAVEL
		#-------------------------------------------------------------------------------------------------#
		public function url($titulo)
		{
			$url_titulo = $this->formata_url($titulo);
			return $link = "$url_titulo";			
		}
		
		
		#---------------------------------------------------------------------------------------------------------#
		#	FORMATA  LINK PARA O BANCO
		#---------------------------------------------------------------------------------------------------------#
		public function formata_url($link)
		{
			$link = $this->retira_acento($link);
			
			$link = strtolower(str_replace("/","",$link));
			$link = strtolower(str_replace(":","",$link));
			$link = strtolower(str_replace("-","",$link));		
			$link = strtolower(str_replace("'","",$link));
			$link = strtolower(str_replace('"',"",$link));
			$link = strtolower(str_replace('\\',"",$link));
			$link = strtolower(str_replace('+',"",$link));
			$link = strtolower(str_replace("%","",$link));
			$link = strtolower(str_replace("!","",$link));		
			$link = strtolower(str_replace("@","",$link));
			$link = strtolower(str_replace('#',"",$link));
			$link = strtolower(str_replace('$',"",$link));
			$link = strtolower(str_replace('%',"",$link));
			$link = strtolower(str_replace("&","",$link));
			$link = strtolower(str_replace("*","",$link));
			$link = strtolower(str_replace("(","",$link));
			$link = strtolower(str_replace(")","",$link));
			$link = strtolower(str_replace(".","",$link));
			$link = strtolower(str_replace(",","",$link));
			$link = strtolower(str_replace(";","",$link));
			$link = strtolower(str_replace("{","",$link));
			$link = strtolower(str_replace("}","",$link));
			$link = strtolower(str_replace("[","",$link));
			$link = strtolower(str_replace("]","",$link));
			$link = strtolower(str_replace("º","",$link));
			$link = strtolower(str_replace(" ","-",$link));
			$link = strtolower(str_replace("?","",$link));
			return  $link;
		
		}
		
		
		
		#---------------------------------------------------------------------------------------------------------#
		#	RETIRA O ACENTO DO LINK
		#---------------------------------------------------------------------------------------------------------#
		public function retira_acento($texto)
		{ 
		  $array1 = array(   "á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç" 
							 , "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç" ); 
		  $array2 = array(   "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c" 
							 , "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C" ); 
		  return  str_replace( $array1, $array2, $texto); 
		} 
		
		
		
		
		
		
		#-------------------------------------------------------------------------------------------------#
		#	RETORNA O NOME DE UMA COLUNA DA TABELA
		#-------------------------------------------------------------------------------------------------#
		public function troca_value_nome($value, $nome_tabela, $id_tabela, $nome_campo_desejado)
		{
			$obj_dao = new Dao();
			$sql = "
					SELECT $nome_campo_desejado
					FROM $nome_tabela
					WHERE $id_tabela = $value
					";
			$result = $obj_dao->executaSQL($sql);
			$row = mysql_fetch_assoc($result);
			return "$row[$nome_campo_desejado]";
		}
		
		
		
		
		
		
		#-------------------------------------------------------------------------------------------------#
		#	BUSCA O DESCRIPTION DO GOOGLE
		#-------------------------------------------------------------------------------------------------#
		public function get_description($description_google = '')
		{
			if(!empty($description_google))
			{
				return $description_google;
			}
			else
			{
				$dados = $this->select_unico("tb_configuracoes", "idconfiguracao", "1");
				return $dados[description_google];
			}
		}
		
		
		
		
		
		#-------------------------------------------------------------------------------------------------#
		#	BUSCA AS KEYWORDS DO GOOGLE
		#-------------------------------------------------------------------------------------------------#
		public function get_keywords($keywords = '')
		{
			if(!empty($keywords))
			{
				return $keywords;
			}
			else
			{
				$dados = $this->select_unico("tb_configuracoes", "idconfiguracao", "1");
				return $dados[keywords_google];
			}
		}
		
		
		
		
		#-------------------------------------------------------------------------------------------------#
		#	BUSCA O TITLE DO GOOGLE
		#-------------------------------------------------------------------------------------------------#
		public function get_title($title = '')
		{
			if(!empty($title))
			{
				return $title;
			}
			else
			{
				$dados = $this->select_unico("tb_configuracoes", "idconfiguracao", "1");
				return $dados[title_google];
			}
		}
		
		
		
		
		/*	==================================================================================================================	*/
		/*	EFETUA CROP DA IMAGEM	*/
		/*	==================================================================================================================	*/
		public function redimensiona_imagem($nome_arquivo,$largura = 960, $altura = 400, $config = array())
		{
			//Recebe os paramentros na chamada da página redimensionar_img
			//$arquivo = $_SERVER['DOCUMENT_ROOT'] . PASTA_PROJETO."/uploads/$nome_arquivo";
			$tipo = "crop";
			
			//	VERIFICO SE PASSOU ALGUMA ARRAY
			if(count($config) > 0):
				
				foreach($config as $key=>$conf):
					$configuracoes .= "$key='$conf' ";
				endforeach;
				
			endif;
			
			
			?>
			<img src="<?php echo Util::caminho_projeto(); ?>/class/resize.php?arquivo=<?php echo $nome_arquivo; ?>&amp;largura=<?php echo $largura; ?>&amp;altura=<?php echo $altura; ?>&amp;tipo=crop" <?php echo $configuracoes; ?> />
			<?php
			
			
		}
		
		
		
		
		
	
}
?>