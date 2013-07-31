<?php
require_once("config.php");
require_once("Util.class.php");



class Dao
{
			
			 //atributos para conectar com o banco e base
			 private $username;
			 private $password;
			 private $data_base;
			 private $local;

			 private $conn;

			 //resultado do SQL
			 public $result;
			 private $dados;


			//Conecta com o banco e seleciona o banco
			public function __construct()
			{
				
				//Carrega configuraçòes da aplicação				
				$this->local = HOST_BANCO;
				$this->username = USUARIO_BANCO;
				$this->password = SENHA_BANCO;
				$this->data_base = NOME_BANCO;

				$this->conn = mysql_connect($this->local, $this->username, $this->password) or trigger_error(mysql_error(),E_USER_ERROR);
				mysql_select_db($this->data_base, $this->conn);
				/*
				mysql_query("SET NAMES 'utf8'");
				mysql_query('SET character_set_connection=utf8');
				mysql_query('SET character_set_client=utf8');
				mysql_query('SET character_set_results=utf8');
				*/
			}





			//Executa a query
			public function executaSQL($sql)
			{
				//echo $sql;
				
				$aux_html = "
							<p>&nbsp;</p>
							<div align='center'>
								OPS, OCORREU UM ERRO.
								<br>
								TENTE NOVAMENTE.
							</div>
						";
						
				

				$this->result = mysql_query($sql) or die(
														 "<br> Houve um erro, por favor, recarrege novamente a p&aacute;gina.".$sql
														 );
				
				$this->fecha_conexao();

				return $this->result;
			}
			
			
			
			public function executaINSERT($tabela, $campos, $dados)
			{
				$query1 = "";
				$query2 = "";

				foreach($campos as $campo)
				{
		           	$query1 .= $campo.", ";
		        }
				$query1 = substr($query1,0,-2);

				foreach($dados as $dado)
				{
		        	$query2 .= $dado."', '";
		        }
				$query2 = "'" . substr($query2,0,-3);

				//find_and_replace, data truncated
				 $query2 = str_replace("''", "' '", $query2);
				 $query2 = str_replace("'NULL'", "NULL", $query2);

			   	 $sql = "INSERT INTO
						$tabela
						($query1)
						VALUES
						($query2)";

				//	REORODENOS AS COLUNAS
				$this->ordena_tabela($tabela);

				if($this->executaSQL($sql) == true)
				{
					return 0;
				}


			}
			
			
			

			public function executaINSERT2($tabela, $campos, $dados)
			{
				$query1 = "";
				$query2 = "";

				foreach($campos as $campo)
				{				
		           	$query1 .= $campo[nome_campo_form] . ", ";					
		        }
				$query1 = substr($query1,0,-2);

				foreach($dados as $dado)
				{
		        	$query2 .= $dado[valor_imput] . "', '";
		        }
				$query2 = "'" . substr($query2,0,-3);

				//find_and_replace, data truncated
				 $query2 = str_replace("''", "' '", $query2);
				 $query2 = str_replace("'NULL'", "NULL", $query2);

			   	 $sql = "INSERT INTO
						$tabela
						($query1)
						VALUES
						($query2)";

				
				
				
				//	REORODENOS AS COLUNAS
				//$this->ordena_tabela($tabela);

				if($this->executaSQL($sql) == true)
				{
					//recebo o último id
   					return mysql_insert_id($this->conn); 
				}
				else
				{
					return 0;	
				}


			}
			
			
			
			
			
			
			
			
			#-------------------------------------------------------------------------------------------------#
			#	ALTERA DADOS NA TABELA DESEJADA
			#-------------------------------------------------------------------------------------------------#
			public function update($nome_tabela, $id, $dados)
			{
				//	BUSCO OS DADOS DA TABELA
				$sql = "SELECT * FROM $nome_tabela";
				$result = $this->executaSQL($sql);
				
				
				//	PEGO A QUANTIDADE DE COLUNAS
				$qtd_colunas = mysql_num_fields($result);
	
				
				
				for($i = 0; $i< $qtd_colunas; $i++)
				{
					//	PEGO O NOME DA COLUNA
					$campo = mysql_fetch_field($result, $i);
					
					
					//	VERIFICO SE E A CHAVE PRIMARIA
					if($campo->primary_key != 1)
					{
						
						//	VERIFICO SE O CAMPO FOI PASSADO NA VARIAVEL DADOS
						foreach($dados as $indice_array => $dado)
						{
							
							if("$campo->name" == "$indice_array")
							{
								//echo "achei o campo $indice_array e nome do campo  $campo->name  <br />";
								
								$campos[] =  array(
													'nome_campo_form'		=>	$campo->name,				//	NOME DO CAMPO NO FORMULARIO			
													'tipo'					=>	$campo->type			//	TIPO DE DADOS DO CAMPO (texto, moeda, data, telefone, cep)
												   );
											
								
								$valor_input = $this->trata_dados_banco(Util::trata_dados_formulario(trim($dados[$campo->name])), $campo->type);
								
								
								
								$values .= "$campo->name = '$valor_input', ";
								
								
								
												 
							}
						}
						
					}
				}
				
				
				//	RETIRO A ULTIMA VIRGULA
				$values = substr($values, 0, -2);
				
				
				//	PEGO A CHAVE PRIMARIA DA TABELA
				$chave_primaria = $this->get_chave_primaria_tabela($nome_tabela);
				
				
				//	MONTO O SQL
				$sql = "UPDATE $nome_tabela SET $values WHERE $chave_primaria = '$id' ";
				$this->executaSQL($sql);
				
				
				$this->gera_url_amigavel($nome_tabela, $chave_primaria, $id);
				
			}
			
			
			
			
			
			
			
			#-------------------------------------------------------------------------------------------------#
			#	ALTERA DADOS NA TABELA DESEJADA
			#-------------------------------------------------------------------------------------------------#
			public function insert($nome_tabela, $dados)
			{
				//	BUSCO OS DADOS DA TABELA
				$sql = "SELECT * FROM $nome_tabela";
				$result = $this->executaSQL($sql);
				
				
				
				//	PEGO A QUANTIDADE DE COLUNAS
				$qtd_colunas = mysql_num_fields($result);

				
				
				for($i = 0; $i< $qtd_colunas; $i++)
				{
					//	PEGO O NOME DA COLUNA
					$campo = mysql_fetch_field($result, $i);
					
					
					//	VERIFICO SE E A CHAVE PRIMARIA
					if($campo->primary_key != 1)
					{
						
						//	VERIFICO SE O CAMPO FOI PASSADO NA VARIAVEL DADOS
						foreach($dados as $indice_array => $dado)
						{
							
							
							
							
							
							if("$campo->name" == "$indice_array")
							{
								//echo "achei o campo $indice_array e nome do campo  $campo->name  <br />";
								//exit;
								
								$campos[] =  array(
													'nome_campo_form'		=>	$campo->name,				//	NOME DO CAMPO NO FORMULARIO			
													'tipo'					=>	$campo->type			//	TIPO DE DADOS DO CAMPO (texto, moeda, data, telefone, cep)
												   );
											
								
								$valor_input = $this->trata_dados_banco(Util::trata_dados_formulario(trim($dados[$campo->name])), $campo->type);
								
								
								$colunas .= $campo->name . ', ';
								$values .= "'$valor_input', ";
								
								
								
												 
							}
						}
						
					} 
				}
				
				
				
				
				//	RETIRO A ULTIMA VIRGULA
				$colunas = substr($colunas, 0, -2);
				$values = substr($values, 0, -2);
				
				
				//	PEGO A CHAVE PRIMARIA DA TABELA
				$chave_primaria = $this->get_chave_primaria_tabela($nome_tabela);
				
				
				//	MONTO O SQL
				$sql = "INSERT INTO $nome_tabela
						($colunas)
						VALUES
						($values)
						";
				$this->executaSQL($sql);
				
				
				
				
				//	RETORNO O ID
   				$id = mysql_insert_id($this->conn); 
				
				
				$this->gera_url_amigavel($nome_tabela, $chave_primaria, $id);
				
				return $id;
				
			}
			
			
			
			
			
			public function gera_url_amigavel($nome_tabela, $chave_primaria, $id)
			{
				$obj_site = new Site();
				
				//	BUSCO OS DADOS DA TABELA
				$sql = "SELECT * FROM $nome_tabela WHERE $chave_primaria = $id";
				$result = $this->executaSQL($sql);
				
				// VERIFICA SE TEM O REGISTRO
				if(mysql_num_rows($result) > 0)
				{
					$dados = mysql_fetch_array($result);
					
					$url = $obj_site->url_amigavel($dados[1]);
					
					$sql = "UPDATE $nome_tabela SET url_amigavel = '$url' WHERE $chave_primaria = $id";
					$result = $this->executaSQL($sql);
				}
				
				
				
					
			}
			
			


			public function executaALTERACAO($tabela, $campos, $dados, $campoid, $id)
			{
				$query1 = "";

				for ($b=0; $b <= count($campos); $b++)
				{
					$query1 .= $campos[$b] ." = '". $dados[$campos[$b]] ."', ";
				}
				$query = substr($query1,0,-9);

				//find_and_replace, data truncated
				 $query = str_replace("''", "' '", $query);
				 $query = str_replace("'NULL'", "NULL", $query);


				$sql = "UPDATE $tabela SET $query WHERE $campoid = $id";


				if($this->executaSQL($sql) == true)
				{
					return 0;
				}

			}
			
			
			
			
			
			#---------------------------------------------------------------------------------------------------------------------------#
			#	TRATO OS CAMPOS DO FORMULARIO DE ACORDO COM O BANCO
			#---------------------------------------------------------------------------------------------------------------------------#
			public function trata_dados_banco($valor, $tipo)
			{
				switch($tipo)
				{
					case "real":
						$valor = Util::formata_moeda($valor, "banco");
					break;
					case "date":
						$valor =  Util::formata_data($valor, 'banco');
					break;
				}
				
				return $valor;	
				
			}
			
			
			
			
			#------------------------------------------------------------------------------------------------------------#
			#	ORDENOS A COLUNA ORDEM DE UMA TABELA INCREMENTANDO 1 NUMERO
			#------------------------------------------------------------------------------------------------------------#		
			public function ordena_tabela($nome_tabela)
			{
				// BUSCO O ID DA TABELA
				$id_tabela = $this->get_chave_primaria_tabela($nome_tabela);
				
				$sql = "SELECT * FROM $nome_tabela";
				$result = $this->executaSQL($sql);
				
				while($row = mysql_fetch_array($result))
				{
					$ordem = $row[ordem] + 1;
					
					$sql = "UPDATE $nome_tabela SET ordem = '$ordem' WHERE $id_tabela = $row[0]";
					$this->executaSQL($sql);
				}
			}
			
			
			
			
			#------------------------------------------------------------------------------------------------------------#
			#	ARMAZENA O LOG
			#------------------------------------------------------------------------------------------------------------#		
			public function armazena_log($nome_tabela, $operacao, $sql, $id_login)
			{				
				$operacao = utf8_decode($operacao);
				$consulta_sql = addslashes(trim($sql));
				$data = date("Ymd");
				$hora = date("H:i:s");
				
				$sql = "INSERT $nome_tabela (operacao, consulta_sql, data, hora, id_login) VALUES ('$operacao', '$consulta_sql', '$data', '$hora', '$id_login')";
				$this->executaSQL($sql);
			}
			
			
			
			
			#------------------------------------------------------------------------------------------------------------#
			#	ARMAZENA O LOG
			#------------------------------------------------------------------------------------------------------------#		
			public function armazena_atualizacao($id, $titulo, $descricao, $modulo)
			{				
				$data = date("Ymd");
				$hora = date("H:i:s");
				/*$titulo = Util::trata_dados_formulario($titulo);
				$descricao = Util::trata_dados_formulario($descricao);
				$modulo = Util::trata_dados_formulario($modulo);*/
				
				$sql = "
						INSERT tb_atualizacoes
							(id, titulo, descricao, modulo, data, hora) 
						VALUES 
							('$id', '$titulo', '$descricao', '$modulo', '$data', '$hora')
						";
				$this->executaSQL($sql);
			}
			
			
			
			
			
			
			
			
			#------------------------------------------------------------------------------------------------------------#
			#	PEGO A CHAVE PRIMARIA DA TABELA
			#------------------------------------------------------------------------------------------------------------#		
			public function get_chave_primaria_tabela($nome_tabela)
			{
				$sql = "SELECT * FROM $nome_tabela";
				$result = $this->executaSQL($sql);
				
				$qtd_colunas = mysql_num_fields($result);
				

				for($i = 0; $i< $qtd_colunas; $i++)
				{
					$campo = mysql_fetch_field($result, $i);
					
					
					//	VERIFICO SE E A CHAVE PRIMARIA
					if($campo->primary_key == 1)
					{
						$chave_primaria = $campo->name;
					}
					
					
				}
				
				return $chave_primaria;
			}
			
			
			
			#------------------------------------------------------------------------------------------------------------#
			#	PEGO O ULTIMO ID INSERIDO NA TABELA
			#------------------------------------------------------------------------------------------------------------#		
			public function get_ultimo_id($id_tabela, $nome_tabela)
			{
				$sql = "SELECT MAX($id_tabela) AS idtabela FROM $nome_tabela";
				$result = $this->executaSQL($sql);
				$row = mysql_fetch_array($result);
				return $row[idtabela];
			}
			
			
			
			#------------------------------------------------------------------------------------------------------------#
			#	FECHO A CONEXAO
			#------------------------------------------------------------------------------------------------------------#		
			public function fecha_conexao()
			{
				//mysql_close($this->conn);
			}
			
		

		
		#------------------------------------------------------------------------------------------------------------#
		#	PEGO OD NOMES DA COLUNAS DA TABELA
		#------------------------------------------------------------------------------------------------------------#		
		public function nome_colunas_tabela($nome_tabela)
		{
			$chave_primaria = $this->get_chave_primaria_tabela($nome_tabela);
			
			$sql = "SELECT * FROM $nome_tabela";
			$result = $this->executaSQL($sql);
			
			//	para obter a quantidade de campos da consulta utilize
			$qtd_campos = mysql_num_fields($result);
			
			
			//	para obter informações sobre a coluna utilize
			$campo = mysql_fetch_field($result, indice_campo);
			
			//	$campo é um objeto, entre suas propriedaes você pode utilizar
			//	name - nome do campo
			//	type - tipo do campo
			
						
			$qtd_campos = mysql_num_fields($result);
			
			for($i=0; $i < $qtd_campos; $i++)
			{		
				$campo = mysql_fetch_field( $result, $i);
				
				//	VERIFICO SE NAO E A CHAVE PRIMARIA
				if($campo->name !== $chave_primaria)
				{
					$campos[] = array("nome"=>$campo->name, "tipo"=>$campo->type);	
				}
			}
			
			return $campos;
		}
}




















?>