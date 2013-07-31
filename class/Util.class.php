<?php 
ob_start();
@session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . PASTA_PROJETO . "/class/Include.class.php");
require_once($_SERVER['DOCUMENT_ROOT'] . PASTA_PROJETO . "/jquery/ckeditor/ckeditor.php");
require_once("phpMailer_v2.3/class.phpmailer.php");
require_once($_SERVER['DOCUMENT_ROOT'] . PASTA_PROJETO . '/class/recaptchalib.php');
//require_once($_SERVER['DOCUMENT_ROOT'] . PASTA_PROJETO . "/class/dompdf-0.5.1/dompdf_config.inc.php");



class Util
{
	
	
	
	#--------------------------------------------------------------------------------------------------------------#
	#	BUSCA O PREÇO DO PRODUTO
	#--------------------------------------------------------------------------------------------------------------#
	static public function get_lista_produto($result, $class_produto = "")
	{
		$obj_site = new Site();
		
		
		if(mysql_num_rows($result) > 0)
		{
			while($row = mysql_fetch_array($result))
			{
				
				//	VERIFICO SE E PARA USAR A LI DOS PRODUTOS POR CAUSA DA CLASSE DE FILTROS
				if($class_produto != ""):
				?> 
					<li class="element <?php echo Util::troca_value_nome($row[id_categoriaproduto], "tb_categoriaproduto", "idcategoriaproduto", "url_amigavel") ?>">
				<?php
				else:
				?>
                	<li>
                <?php
				endif;
				?>
				
					<a href="<?php echo Util::caminho_projeto();?>/produtos/<?php Util::imprime($row[url_amigavel]); ?>" title="<?php Util::imprime($row[titulo]); ?>">
						<?php $obj_site->redimensiona_imagem("../uploads/$row[imagem]",212,182, array('alt'=>$row[titulo],'class'=>'lista_produtos_img')); ?>
						<h4><?php Util::imprime($row[titulo]); ?></h4>
						<?php
						// VERIFICA SE TEM PREÇO
						if(!empty($row[preco]))
						{
							
							//	VERIFICO SE O PRODUTO ESTA COM PROMOCAO
							if(empty($row[id_promocao])):
							?>
								<h4><span>R$ <?php echo Util::formata_moeda( Util::get_preco_produto($row[idproduto]) ); ?></span></h4>
							<?php
							else:
							?>
								<h4><span>de <b class="preco_riscado">R$ <?php echo Util::formata_moeda($row[preco]); ?></b> <br> por R$ <?php echo Util::formata_moeda( Util::get_preco_produto($row[idproduto]) ); ?></span></h4>
							<?php
							endif;
							
						}
						?>
					</a>
					
					
						<?php
						// VERIFICA SE TEM PREÇO
						// SÓ MOSTRA O BOTÁO DE COMPRAR SE TIVER O PREÇO
						if(!empty($row[preco]))
						{
							?>
                            
                            
                                <div class="lista_produtos_hover">
                                    <div class="lista_produtos_hover_preco">
                                        <a onclick="this.form.submit()" href="<?php echo Util::caminho_projeto();?>/produtos/<?php Util::imprime($row[url_amigavel]); ?>" title="<?php Util::imprime($row[titulo]); ?>">
                                            R$ <?php echo Util::formata_moeda( Util::get_preco_produto($row[idproduto]) ); ?>
                                        </a>
                                    </div>	
                                    
                                    <div class="lista_produtos_hover_btn">
                                       
                                    	<form action="<?php echo Util::caminho_projeto(); ?>/carrinho/" method="post" name="form_produto_<?php echo $row[0]; ?>" id="form_produtos_<?php echo $row[0]; ?>">
                                           
                                            <a onclick="document.getElementById('form_produtos_<?php echo $row[0]; ?>').submit();" href="javascript:void(0);" title="<?php Util::imprime($row[titulo]); ?>" class="btn_adicionar_carrinho">
                                                <img src="<?php echo Util::caminho_projeto() ?>/imgs/btn_adicionar.jpg" alt="<?php Util::imprime($row[titulo]); ?>">
                                            </a>
                                        	
                                            <input type="hidden" name="idproduto" value="<?php echo $row[0]; ?>"  />
                                            <input type="hidden" name="action" value="add" />
                                            
                                        </form>
                                        
                                    </div>
                                </div>
                            
                           
                            
							<?php
						}
						?>
					
				</li>
				<?php
			}
		}
	}
	
	
	
	
	#--------------------------------------------------------------------------------------------------------------#
	#	BUSCA O PREÇO DO PRODUTO
	#--------------------------------------------------------------------------------------------------------------#
	static public function get_preco_produto($idproduto)
	{
		$obj_dao = new Dao();
		
			
		//	BUSCO OS DADOS DO PRODUTO
		$sql = "SELECT * FROM tb_produtos WHERE idproduto = '$idproduto'";
		$result = $obj_dao->executaSQL($sql);
		
		if(mysql_num_rows($result) > 0):
		
			$dados = mysql_fetch_array($result);
			
			//	VERIFICO SE O PRODUTO ESTÁ EM ALGUMA PROMOCAO
			if(!empty($dados[id_promocao])):
			
				//	BUSCO OS DADOS DA PROMOCAO
				$sql1 = "SELECT * FROM tb_promocoes WHERE idpromocao = '$dados[id_promocao]'";
				$result1 = $obj_dao->executaSQL($sql1);
				
				if(mysql_num_rows($result1) > 0):
				
					$dados_promocao = mysql_fetch_array($result1);
					
					//	CALCULO O VALOR
					$preco = $dados[preco] - ($dados[preco] / 100 * $dados_promocao[desconto]);
				
				endif;
			
			else:
			
				$preco = $dados[preco];
			
			endif;
		
		endif;
			
		
		return $preco;
	}
	
	
	
	
	#--------------------------------------------------------------------------------------------------------------#
	#	CRIA IMAGEM CAPTCHA
	#--------------------------------------------------------------------------------------------------------------#
	static public function gera_captcha($theme = 'red', $publickey = "6LciiNkSAAAAAKOiZe5318dAXbe65MsXPdieKbpS")
	{
		//	ESTILO
		?>
        <script type="text/javascript">
		 var RecaptchaOptions = {
			theme : '<?php echo $theme ?>',
			lang: 'pt'
		 };
		 </script>
        <?php
		
		
		echo recaptcha_get_html($publickey);
		
	}
	
	
	
	
	#--------------------------------------------------------------------------------------------------------------#
	#	VALIDA IMAGEM CAPTCHA
	#--------------------------------------------------------------------------------------------------------------#
	static public function valida_captcha($privatekey = "6LfeGd0SAAAAAPn9zN41r9minLRYz0ub2ROx5sFj")
	{
		$resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
		return $resp->is_valid;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	#--------------------------------------------------------------------------------------------------------------#
	#	CAMINHO DO SITE
	#--------------------------------------------------------------------------------------------------------------#
	static public function caminho_projeto()
	{
		return "http://" . $_SERVER['SERVER_NAME'] . PASTA_PROJETO;
	}
	
	
	
	
	#--------------------------------------------------------------------------------------------------------------#
	#	BUSCA OS DADOS DO GOOGLE MAPS PELO CEP --- FORMATO DO CEP 73050-140
	#--------------------------------------------------------------------------------------------------------------#
	static public function get_dados_google_maps($cep)
	{
		$geocode=file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$cep&sensor=false");
		$output = json_decode($geocode);

		
		//echo $output->results[0]->address_components[1]->long_name;
		
	
		$dados[latitude] = $output->results[0]->geometry->location->lat;
		$dados[longitude] = $output->results[0]->geometry->location->lng;
		
		return $dados;
	}
	
	
	
	
	
	#--------------------------------------------------------------------------------------------------------------#
	#	PEGA A IMAGEM DO VIDEO NO YOUTUBE
	#--------------------------------------------------------------------------------------------------------------#
	public function imagem_youtube($url, $size = 'small')
	{
	   $url = explode('v=',$url);
	   $url = explode('&',$url[1]);
	   
	   
	   $url = $size == 'small' ? ('http://i1.ytimg.com/vi/' . $url[0] . '/default.jpg') : ('http://img.youtube.com/vi/' . $url[0] . '/0.jpg');
	   return $url;
	}
	
	
	
	
	#--------------------------------------------------------------------------------------------------------------#
	#	PEGA A IMAGEM DO VIDEO NO YOUTUBE
	#--------------------------------------------------------------------------------------------------------------#
	public function codigo_video_youtube($url)
	{
	   $url = explode('v=',$url);
	   $url = explode('&',$url[1]);
	   return $url[0];
	}
	
	
	
	
	#--------------------------------------------------------------------------------------------------------------#
	#	LIMPA O TEXTO PARA IMPRIMIR NO FORMULARIO
	#--------------------------------------------------------------------------------------------------------------#
	public function imprime_para_form($texto)
	{
		//$texto_limpo = utf8_encode($texto);
		//echo $texto_limpo;
		echo $texto;
	}
	
	
	#-----------------------------------------------------------------------------------------------------------------------#
	#	CRIA UM JAVASCRIPT PARA O CAMPO OBRIGATORIO
	#-----------------------------------------------------------------------------------------------------------------------#
	public function campo_obrigatorio_js($campos)
	{
		$html = "
				<script>
				function checkMail(mail){
					var er = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
					if(typeof(mail) == \"string\"){
						if(er.test(mail)){ return true; }
					}else if(typeof(mail) == \"object\"){
						if(er.test(mail.value)){ 
									return true; 
								}
					}else{ 
						return false;
						}
				}
				
				function validaCpf(cpf)
				{ 
				  
					var i; 
					s = cpf; 
					var c = s.substr(0,9); 
					var dv = s.substr(9,2); 
					var d1 = 0; 
					for (i = 0; i < 9; i++) 
					{ 
						d1 += c.charAt(i)*(10-i);
					}	 
					if (d1 == 0)
					{ 
						return false; 
					} 
					d1 = 11 - (d1 % 11); 
					if (d1 > 9) d1 = 0; 
					if (dv.charAt(0) != d1) 
					{ 
						return false; 
					} 
					d1 *= 2; 
					for (i = 0; i < 9; i++) 
					{ 
					d1 += c.charAt(i)*(11-i); 
					} 
					d1 = 11 - (d1 % 11); 
					if (d1 > 9) d1 = 0; 
					if (dv.charAt(1) != d1) 
					{ 
						return false; 
					} 
				  
					return true; 
				  
				}
				function valida_campos_formulario()
				{
				"; 
		
				foreach($campos as $campo)
				{
					if($campo[obr] == 's')
					{
						switch ($campo[tipo])
						{
							////////////////////////////////////////////////////////////////////////
							case "email":
								
								$html.= "
										if (!checkMail(document.getElementById('$campo[nome_campo_form]').value)) 
										{
											alert('". utf8_encode($campo[msgerros]) ."');
											document.getElementById('$campo[nome_campo_form]').focus();
											return false;
										}
										";
							break;
							
							///////////////////////////////////////////////////////////////////////////
							case "cpf":
								
								$html.= "
										if (!validaCpf(document.getElementById('$campo[nome_campo_form]').value)) 
										{
											alert('". utf8_encode($campo[msgerros]) ."');
											document.getElementById('$campo[nome_campo_form]').focus();
											return false;
										}
										";
							break;
							
							///////////////////////////////////////////////////////////////////////////
							default:
								$html.= "
										if (document.getElementById('$campo[nome_campo_form]').value  == '') 
										{
											alert('". utf8_encode($campo[msgerros]) ."');
											document.getElementById('$campo[nome_campo_form]').focus();
											return false;
										}
										";
							break;
						}
						
					}
				}
				
		$html .= "
					return true;
				}
				 </script>
				 ";
		echo $html;
	}
	
	
	
	#--------------------------------------------------------------------------------------------------------------#
	#	LIMPA O TEXTO PARA IMPRIMIR
	#--------------------------------------------------------------------------------------------------------------#
	public function imprime($texto)
	{
		$texto = strip_tags($texto, '<h1>, <h2>, <h3>, <h4>, <h5>, <h6>, <ul>, <li>, <p>, <strong>, <img>, <b>, <br />, <a>, <i>');
		//	VERIFICO OS PARAMETRO PASSADO
		$parametros = func_get_args();
		switch(func_num_args())
		{
			case 2:	//CORTA O TEXTO
				
				$texto = html_entity_decode($texto);
				$texto = strip_tags($texto);
				
				
				
				//	LIMPO O TEXTO							
				$texto = stripslashes($texto);
				
				$end_substr = $parametros[1];
				$texto = substr($texto, 0, $end_substr);
				
				$texto = utf8_encode($texto);
				$texto_limpo = $texto;
										   		  

				//	VERIFICO SE O TEXTO É MAIOR QUE O TAMANHO PASSADO
				if(strlen($texto) > $end_substr)
				{
					$texto_limpo .= "...";
				}
			break;
			default:
				$texto = html_entity_decode($texto);
				$texto = stripslashes($texto);
				$texto = utf8_encode($texto);
				$texto = str_ireplace("<div", "<p", $texto);
				$texto = str_ireplace("</div>", "</p>", $texto);
				$texto = str_ireplace("<p>&nbsp;</p>","",$texto);
				$texto = str_ireplace("<div>&nbsp;</div>","",$texto);
				$texto_limpo = $texto;
			break;
		}
		
		
		
		echo $texto_limpo;

	}
	
	
	
	#--------------------------------------------------------------------------------------------------------------#
	#	CONTADOR DE VISITAS
	#--------------------------------------------------------------------------------------------------------------#
	public function insere_visitas()
	{
		$obj_dao = new Dao();
		$obj_data = new Manipula_Data_Hora();
		
		
		
		$hora = date("H:i:s");
		$data = date("d/m/Y");
		$ip = $_SERVER['REMOTE_ADDR'];
		
		//	BUSCA A ULTIMA MENSAGEM
		$sql = "SELECT * FROM tb_visitas WHERE ip = '$ip' ORDER BY data DESC, hora DESC LIMIT 1";
		$result = $obj_dao->executaSQL($sql);
		
		if(mysql_num_rows($result) > 0)
		{
			$row = mysql_fetch_array($result);
			
			$ano = substr($row[data], 0, 4);
			$mes = substr($row[data], 5, 2);
			$dia = substr($row[data], 8, 2);
			$hora_postada = $row[hora];
			$ip = $row[ip];
		}
		else
		{
			$ano = 2000;
			$mes = date("m");
			$dia = date("d");
			$hora_postada = date("H:i:s");
		}
		
		// VERIFICA SE A DIFERENÇA DA DATA E HORA É DE 3 MIN
		if($obj_data->difDataHora("$dia/$mes/$ano $hora_postada", "$data $hora", "m") > 3)
		{
			$ip = $_SERVER['REMOTE_ADDR'];
			$hora = date("H:i:s");
			
			$sql = "
					INSERT tb_visitas
						(ip, data, hora, ativo) 
					VALUES 
						('$ip', '".date("Ymd")."' ,'$hora', 'SIM')
					";
			$obj_dao->executaSQL($sql);
		}
	}
	
	public function conta_visitas()
	{
		$obj_dao = new Dao();
		
		// CONTA E RETORNA O NUMERO DE REGISTROS(VISITAS) DA TABELA
		$sql = "SELECT COUNT(idvisita) as numero_registros FROM tb_visitas";
		$result = $obj_dao->executaSQL($sql);
		$row = mysql_fetch_array($result);
		return $row['numero_registros'];
	}
	
	
	
	#--------------------------------------------------------------------------------------------------------------#
	#	RETORNA O NOME DO DIRETORIO
	#--------------------------------------------------------------------------------------------------------------#
	public function nome_diretorio()
	{
		return $file = dirname($_SERVER['SCRIPT_NAME']);
	}
	
	
	
	
	
	#--------------------------------------------------------------------------------------------------------------#
	#	ENVIA UMA MSG PARA O USUÁRIO
	#--------------------------------------------------------------------------------------------------------------#
	public function script_msg($msg)
	{
		$msg_final = utf8_encode($msg);
		
		echo "
			<script>
 		 		alert('$msg_final');
  			</script>
  		";
		
	}
	
	
	
	
	#--------------------------------------------------------------------------------------------------------------#
	#	REDIRECIONA O USUARIO PARA UMA PAGINA ESPECIFICA
	#--------------------------------------------------------------------------------------------------------------#
	public function script_location($pagina)
	{
		echo "
			<script>
				window.location.href='$pagina'
			</script>
		";
	}



	#--------------------------------------------------------------------------------------------------------------#
	#	RETORNA PARA A PAGINA ANTERIOR
	#--------------------------------------------------------------------------------------------------------------#
	public function script_go_back()
	{
		echo '
			<script>
				javascript:history.go(-1)
			</script>
		';
		exit();
	}
	
	
	
	
	#--------------------------------------------------------------------------------------------------------------#
	#	RETORNA PARA A PAGINA ANTERIOR
	#--------------------------------------------------------------------------------------------------------------#
	public function corta_texto($texto, $inicial = 0, $final = 0)
	{
		return substr($texto, $inicial, $final);
	}
	
	
	
	
	#--------------------------------------------------------------------------------------------------------------#
	#	EFETUA UPLOAD DE ARQUIVO
	#--------------------------------------------------------------------------------------------------------------#
	public function upload_arquivo($destino_arquivo, $arquivo)
	{ 		
		
			
		$nome_arquivo_final = strtolower(date("dmYhi") . rand(1111111111, 9999999999) . '.' . str_replace(".","", substr($arquivo[name], -4) ) );
		
		// do as permissoes do diretorio
		@chmod($destino_arquivo, 0777);
		// faço o upload
		if(!move_uploaded_file($arquivo['tmp_name'], $destino_arquivo . '/' . $nome_arquivo_final))
		{
			Util::script_msg("ERRO AO ENVIAR O ARQUIVO!");
			Util::script_go_back();
			exit();
		}
		return $nome_arquivo_final;
	}
	
	
	
	
	#-----------------------------------------------------------------------------------------------------------------------#
	#	ATUALIZA UM DADOS EM UMA COLUNA ESPECIFICA DA TABELA
	#-----------------------------------------------------------------------------------------------------------------------#
	public function atualiza_dado_coluna_tabela($nome_tabela, $id_tabela, $valor_id, $nome_coluna, $value)
	{
		$obj_dao = new Dao();
		$sql = "
				UPDATE $nome_tabela
					SET $nome_coluna = '$value'
				WHERE
					$id_tabela = '$valor_id'
				";
		$obj_dao->executaSQL($sql);
	}
	
	
	
	#--------------------------------------------------------------------------------------------------------------#
	#	EFETUA UPLOAD DE UMA IMAGEM
	#	http://webdeveloper.earthweb.com/repository/javascripts/2001/04/41291/byteconverter.htm - CONVERSOR DE BYTES
	#--------------------------------------------------------------------------------------------------------------#
	public function upload_imagem($destino_arquivo, $arquivo)
	{ 	
		$obj_imagem = new Imagem();

				
		//	ZERO AS CONFIGURACOES
		$tamanho_maximo = null;
		$largura_maxima = null;
		$altura_maxima = null;
		$largura_minima = null;
		$altura_minima = null;
		
		
		
		
		//	VERIFICO SE E UMA IMAGEM
		if(@!eregi("^image\/(pjpeg|jpeg|gif|bmp)$", $arquivo["type"]))
		{
			Util::script_msg("Arquivo em formato inválido! A imagem deve ser jpg, jpeg, bmp, gif ou png. Envie outro arquivo");
			Util::script_go_back();
			exit();
		}
		
		
		//	VERIFICO OS PARAMETRO PASSADO
		$parametros = func_get_args();
		
		
		switch(func_num_args())
		{
			case 3:
				$tamanho_maximo = $parametros[2];
			break;
			case 4:
				$tamanho_maximo = $parametros[2];
				$largura_maxima = $parametros[3];
			break;
			case 5:
				$tamanho_maximo = $parametros[2];
				$largura_maxima = $parametros[3];
				$altura_maxima = $parametros[4];
			break;
			case 6:
				$tamanho_maximo = $parametros[2];
				$largura_maxima = $parametros[3];
				$altura_maxima = $parametros[4];
				$largura_minima = $parametros[5];
			break;
			case 7:
				$tamanho_maximo = $parametros[2];
				$largura_maxima = $parametros[3];
				$altura_maxima = $parametros[4];
				$largura_minima = $parametros[5];
				$altura_minima = $parametros[6];
			break;
		}
		
		
		
		
		// VERIFICO O TAMANHO MAXIMO DO ARQUIVO CASO TENHA SIDO PASSADO
		if(!empty($tamanho_maximo))
		{
			if($arquivo["size"] > $tamanho_maximo)
			{
				Util::script_msg("Arquivo em tamanho muito grande! A imagem deve ser de no máximo " . $tamanho_maximo . " bytes. Envie outro arquivo");
				Util::script_go_back();
				exit();
			}
		}
		
		
		
		// PEGO AS DIMENSOES DA IMAGEM
        $tamanhos = getimagesize($arquivo["tmp_name"]);	
		
		
		
		// VERIFICO A LARGURA MAXIMA DO ARQUIVO CASO TENHA SIDO PASSADO
		if(!empty($largura_maxima))
		{
			if($tamanhos[0] > $largura_maxima)
			{
				Util::script_msg("Largura da imagem não deve ultrapassar " . $largura_maxima . " pixels");
			 	Util::script_go_back();
				exit();
			}
		}
		
		
		// VERIFICO A ALTURA MAXIMA DO ARQUIVO CASO TENHA SIDO PASSADO
		if(!empty($altura_maxima))
		{
			if($tamanhos[1] > $altura_maxima)
			{
				Util::script_msg("Altura da imagem não deve ultrapassar " . $altura_maxima . " pixels");
				Util::script_go_back();
				exit();
			}
		}
		
		
		
		
		// VERIFICO A LARGURA MININA DO ARQUIVO CASO TENHA SIDO PASSADO
		if(!empty($largura_minima))
		{
			if($tamanhos[0] < $largura_minima)
			{
				Util::script_msg("Largura da imagem não deve ser menor que " . $largura_minima . " pixels");
			 	Util::script_go_back();
				exit();
			}
		}
		
		
		// VERIFICO A ALTURA MINIMA DO ARQUIVO CASO TENHA SIDO PASSADO
		if(!empty($altura_minima))
		{
			if($tamanhos[1] < $altura_minima)
			{
				Util::script_msg("Altura da imagem não deve ser menor que " . $altura_minima . " pixels");
				Util::script_go_back();
				exit();
			}
		}
		
		
		//	GERO O NOME DO ARQUIVO		
		$nome_arquivo_final = strtolower(date("dmYhi") . rand(1111111111, 9999999999) . '.' . substr($arquivo[name], -3));
		
		// do as permissoes do diretorio
		@chmod($destino_arquivo, 0777);
		// faço o upload
		if(!move_uploaded_file($arquivo['tmp_name'], $destino_arquivo . '/' . $nome_arquivo_final))
		{
			Util::script_msg("ERRO AO ENVIAR O ARQUIVO!");
			Util::script_go_back();
			exit();
		}
		
		
		//	REDIMENSIONA A IMAGEM
		$obj_imagem->load($destino_arquivo . '/' . $nome_arquivo_final);
		$obj_imagem->redimension_pela_proporcao(1000);
		$obj_imagem->save($destino_arquivo . '/' . $nome_arquivo_final);
		
		return $nome_arquivo_final;
	}
	
	
	
	#-----------------------------------------------------------------------------------------------------------------------#
	#	VERIFICO SE O EMAIL É VALIDO
	#-----------------------------------------------------------------------------------------------------------------------#
	function verifica_email($email)
	{
	   $mail_correcto = 0;
	   //verifico umas coisas
		if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@"))
	   	{
			if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," ")))
		  	{
				//vejo se tem caracter .
			 	if (substr_count($email,".")>= 1)
			 	{
					//obtenho a terminação do dominio
					$term_dom = substr(strrchr ($email, '.'),1);
					//verifico que a terminação do dominio seja correcta
				 	if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) )
				 	{
						//verifico que o de antes do dominio seja correcto
						$antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
						$caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);

						if ($caracter_ult != "@" && $caracter_ult != ".")
						{
					   		$mail_correcto = 1;
						}
				 	}
		  		}
	   		}
		}

		return $mail_correcto;
	}
	
	
	
	
	
	
	#--------------------------------------------------------------------------------------------------------------#
	#	APAGA UM ARQUIVO
	#--------------------------------------------------------------------------------------------------------------#
	public function deleta_arquivo($destino_arquivo, $arquivo)
	{ 				
		@chmod($destino_arquivo, 0777);
		if(unlink($destino_arquivo . $arquivo) == false)
		{
			Util::script_msg("ERRO AO APAGAR O ARQUIVO!");
			Util::script_go_back();
			exit();
		}
	}
	
	
	#--------------------------------------------------------------------------------------------------------------#
	#	VERIFICA A EXTENSAO
	#--------------------------------------------------------------------------------------------------------------#
	public function verifica_extensao($arquivo)
	{ 	
		$extensao = explode(".", $arquivo);
		
		//	SELECIONA A EXTENSAO
		switch($extensao[1])
		{
			case "pdf":
			?>
            	<img src="<?php echo Util::caminho_projeto(); ?>/uploads/icon-pdf.jpg" alt="PDF" />
            <?php
			break;
		}
	}
	
	
	#-----------------------------------------------------------------------------------------------------------------------#
	#	ENVIA EMAIL
	#-----------------------------------------------------------------------------------------------------------------------#
	function envia_email($destinatario, $assunto, $texto_mensagem, $nome_remetente, $email_remetente)
	{		
		// Inicia a classe PHPMailer
		$mail = new PHPMailer();
		 
		// Define os dados do servidor e tipo de conexão
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->IsSMTP(); // Define que a mensagem será SMTP
		$mail->Host = "smtp.masmidia.com.br"; // Endereço do servidor SMTP (caso queira utilizar a autenticação, utilize o host smtp.seudomínio.com.br)
		$mail->Port = 587;
		$mail->SMTPAuth = true; // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
		$mail->Username = 'cliente@masmidia.com.br'; // Usuário do servidor SMTP
		$mail->Password = 'mas357310'; // Senha do servidor SMTP
		
		 
		// Define o remetente
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->From = $destinatario; // Seu e-mail
		$mail->Sender = $destinatario; // Seu e-mail
		$mail->FromName = $nome_remetente; // Seu nome
		 
		// Define os destinatário(s)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->AddAddress($destinatario, $assunto);
		//$mail->AddAddress('e-mail@destino2.com.br');
		//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
		//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
		 
		// Define os dados técnicos da Mensagem
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
		$mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional)
		 
		// Define a mensagem (Texto e Assunto)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->Subject  = $assunto; // Assunto da mensagem
		$mail->Body = $texto_mensagem;
		$mail->AltBody = $texto_mensagem;
		 
		// Define os anexos (opcional)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		//$mail->AddAttachment("/home/login/documento.pdf", "novo_nome.pdf");  // Insere um anexo
		 
		// Envia o e-mail
		$enviado = $mail->Send();
		 
		// Limpa os destinatários e os anexos
		$mail->ClearAllRecipients();
		$mail->ClearAttachments();
		 
		// Exibe uma mensagem de resultado
		if ($enviado) 
		{
			return true;
			//echo "E-mail enviado com sucesso!";
		} 
		else 
		{
			Util::envia_email_2($destinatario, $assunto, $texto_mensagem, $nome_remetente, $email_remetente);
			
			//return false;
			/*echo "Não foi possível enviar o e-mail.
			 
			";
			echo "Informações do erro: 
			" . $mail->ErrorInfo;*/
		}
		
		
	}

	
	
	
	#-----------------------------------------------------------------------------------------------------------------------#
	#	ENVIA EMAIL
	#-----------------------------------------------------------------------------------------------------------------------#
	function envia_email_2($destinatario, $assunto, $texto_mensagem, $nome_remetente, $email_remetente)
	{
		/* Medida preventiva para evitar que outros domínios sejam remetente da sua mensagem. */
		if (@eregi('tempsite.ws$|locaweb.com.br$|hospedagemdesites.ws$|websiteseguro.com$', $_SERVER[HTTP_HOST])) {
		
				//$emailsender='contato@gordeixos.com.br'; // Substitua essa linha pelo seu e-mail@seudominio
				$emailsender = $destinatario;
		} else {
		
				//$emailsender = "contato@" . $_SERVER[HTTP_HOST];
				$emailsender = $destinatario;
		
				//    Na linha acima estamos forçando que o remetente seja 'webmaster@seudominio',
		
				// você pode alterar para que o remetente seja, por exemplo, 'contato@seudominio'.
		}
		
		
		
		$emailsender= $email_remetente;
		
		
		/* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta. Não alterar */

		if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
		
		elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
		
		else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");
		
		
		
		/* Montando o cabeçalho da mensagem */

		$headers = "MIME-Version: 1.1".$quebra_linha;
		
		#$headers .= "Content-type: text/html; charset=iso-8859-1".$quebra_linha;
		$headers .= "Content-type: text/html; charset=utf-8".$quebra_linha;
		
		// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
		
		$headers .= "From: ".$emailsender.$quebra_linha;
		
		$headers .= "Cc: ".$comcopia.$quebra_linha;
		
		$headers .= "Bcc: ".$comcopiaoculta.$quebra_linha;
		
		$headers .= "Reply-To: ".$emailremetente.$quebra_linha;
		
		// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)
		
		 
		
		/* Enviando a mensagem */
		
		//Verificando qual é o MTA que está instalado no servidor e efetuamos o ajuste colocando o paramentro -r caso seja Postfix
		
		if(!mail($destinatario, $assunto, $texto_mensagem, $headers ,"-r".$email_remetente)){ // Se for Postfix
		
			$headers .= "Return-Path: " . $email_remetente . $quebra_linha; // Se "não for Postfix"
		
			mail($destinatario, $assunto, $texto_mensagem, $headers );
			
			return true;
		
		}
		else
		{
			return false;	
		}

	}
	
	
	
	
	
	#-----------------------------------------------------------------------------------------------------------------------#
	#	CRIA UM SELECT A PARTIR DE UMA TABELA NO BANCO DE DADOS
	#-----------------------------------------------------------------------------------------------------------------------#
	public function cria_select_bd($nome_tabela, $id_tabela, $nome_campo_desejado, $nome_select, $value_checked, $class = "",$titulo = 'Selecione', $javascript="",$complemento="")
	{
		$obj_dao = new Dao();
		
		if(!empty($complemento)){
			$complemento = " WHERE $complemento";
		}else{
			$complemento = "";
		}
		
		
		$sql = "SELECT $id_tabela, $nome_campo_desejado FROM $nome_tabela $complemento ORDER BY $nome_campo_desejado";
		$result = $obj_dao->executaSQL($sql);
		echo "<select name='$nome_select' id='$nome_select' class='$class' $javascript>";
		echo "<option value=''>$titulo</option>";
		
		while($row = mysql_fetch_array($result, MYSQL_BOTH))
		{
			if($row[0] != $value_checked)
			{
				echo "<option value='$row[0]'>". utf8_encode($row[1]) ."</option>";
			}
			else
			{
				echo "<option value='$row[0]' selected='selected'>". utf8_encode($row[1]) ."</option>";
			}
		}
		echo "</select>";
	}
	
	
	
	#-----------------------------------------------------------------------------------------------------------------------#
	#	CRIA UM SELECT A PARTIR DE UMA TABELA NO BANCO DE DADOS
	#-----------------------------------------------------------------------------------------------------------------------#
	public function cria_select_bd_com_sql($nome_select, $value_checked, $sql, $javascript)
	{
		$obj_dao = new Dao();
		$result = $obj_dao->executaSQL($sql);
		echo "<select name='$nome_select' id='$nome_select' $javascript >";
		echo "<option value=''>Selecione</option>";
		
		while($row = mysql_fetch_array($result, MYSQL_BOTH))
		{
			if($row[0] != $value_checked)
			{
				echo "<option value='$row[0]'>". utf8_encode($row[1]) ."</option>";
			}
			else
			{
				echo "<option value='$row[0]' selected='selected'>". utf8_encode($row[1]) ."</option>";
			}
		}
		echo "</select>";
	}
	
	
	
	
	
	#-----------------------------------------------------------------------------------------------------------------------#
	#	EXIBE A DATA NA FORMA CORRETA
	#-----------------------------------------------------------------------------------------------------------------------#
	static public function formata_data($data, $tipo = "")
	{
		if ($data != "")
		{
			//	SE O TIPO FOR EXIBIR RETORNA A DATA NO FORMATO 00/00/0000
			if($tipo == 'banco')
			{
				$data = str_replace("-", "", $data);
				$data = str_replace("/", "", $data);
				$nova_data = (substr($data,4,4)).'/'.(substr($data,2,2)).'/'.(substr($data,0,2));
			}
			else	//	RETORNA A DATA NO FORMATO 0000/00/00
			{
				$data = str_replace("-", "", $data);
				$data = str_replace("/", "", $data);
				$nova_data = (substr($data,6,2)).'/'.(substr($data,4,2)).'/'.(substr($data,0,4));
			}
			
			return($nova_data);
		}
	}
	
	
	

	
	
	#-------------------------------------------------------------------------------------------------#
	#	RETORNA O NOME DE UMA COLUNA DA TABELA
	#-------------------------------------------------------------------------------------------------#
	public function troca_value_nome($value, $nome_tabela, $id_tabela, $nome_campo_desejado)
	{
		if(trim($value) != "")
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
	}
	
	
	
	
	
	#-----------------------------------------------------------------------------------------------------------------------#
	#	GERA UM SELECT COM OS EVENTOS DO CALENDARIO
	#-----------------------------------------------------------------------------------------------------------------------#
	static public function tipos_eventos_calendario($name, $uf, $class = '')
	{
		//lista de ufs
		$uf = trim($uf);
				$lista_uf = array( 
									"Matéria",
									"Atividade",
									"Prova"
									);
									
									
				echo '<select name="'.$name.'" id="'.$name.'" class="'.$class.'">';
				echo '<option value="">Selecione</option>';
				
				for($i=0; $i < count($lista_uf); $i++)
				{
					//verica se há na lista e check em caso afirmativo
					if( $uf == $lista_uf[$i] )
					{
					    echo '<option value="'. utf8_encode($lista_uf[$i]) .'" selected="selected">';
							echo $lista_uf[$i];
						echo '</option>';
					}
					else
					{
						echo '<option value="'. $lista_uf[$i] .'">';
							echo utf8_encode($lista_uf[$i]);
						echo '</option>';
					}
				}

			echo '</select>';
	}
	
	
	
	
	#-----------------------------------------------------------------------------------------------------------------------#
	#	GERA UM SELECT COM OS EVENTOS DO CALENDARIO
	#-----------------------------------------------------------------------------------------------------------------------#
	static public function get_tipo_banner($name, $valor, $class = '', $titulo = "Selecione", $complemento_javascript = "")
	{
		  $obj_dao = new Dao();
		  //lista de ufs
		  $valor = trim($valor);
		  $lista = array(
		  				array('id' => 'Index Topo', 'titulo' => "Index Topo"),
						array('id' => 'Index Slider', 'titulo' => "Index Slider"),
						array('id' => 'Index Busca', 'titulo' => "Index Busca"),
						array('id' => 'Index e Classificados', 'titulo' => "Index e Classificados"),
						);
		echo '<select name="'.$name.'" id="'.$name.'" class="'.$class.'">';
		echo "<option value=''>$titulo</option>";
		for($i=0; $i < count($lista); $i++)
		{
			//verica se há na lista e check em caso afirmativo
			if($valor == $lista[$i][id])
			{
				?>
				   <option value="<?php Util::imprime($lista[$i][id]); ?>" selected="selected"><?php Util::imprime($lista[$i][titulo]); ?></option>
				<?php
			}
			else
			{
				?>
				<option value="<?php Util::imprime($lista[$i][id]); ?>"><?php Util::imprime($lista[$i][titulo]); ?></option>
				<?php
			}
		}
		echo '</select>';
	}
	
	
	
	
	
	
	#-----------------------------------------------------------------------------------------------------------------------#
	#	GERA UM SELECT COM OS EVENTOS DO CALENDARIO
	#-----------------------------------------------------------------------------------------------------------------------#
	static public function get_sim_nao($name, $valor, $class = '', $titulo = "Selecione", $complemento_javascript = "")
	{
		  $obj_dao = new Dao();
		  //lista de ufs
		  $valor = trim($valor);
		  $lista = array(
		  				array('id' => 'SIM', 'titulo' => "SIM"),
						array('id' => 'NAO', 'titulo' => "NÃO"),
						);
		echo '<select name="'.$name.'" id="'.$name.'" class="'.$class.'">';
		echo "<option value=''>$titulo</option>";
		for($i=0; $i < count($lista); $i++)
		{
			//verica se há na lista e check em caso afirmativo
			if($valor == $lista[$i][id])
			{
				?>
				   <option value="<?php Util::imprime($lista[$i][id]); ?>" selected="selected"><?php Util::imprime($lista[$i][titulo]); ?></option>
				<?php
			}
			else
			{
				?>
				<option value="<?php Util::imprime($lista[$i][id]); ?>"><?php Util::imprime($lista[$i][titulo]); ?></option>
				<?php
			}
		}
		echo '</select>';
	}
	
	
	
	
	#-----------------------------------------------------------------------------------------------------------------------#
	#	GERA UM SELECT COM OS EVENTOS DO CALENDARIO
	#-----------------------------------------------------------------------------------------------------------------------#
	static public function get_faixa_tipo_venda_imovel($value)
	{
		switch($value)
		{
			case 'ALUGUEL':
			?>
				<img src="<?php echo Util::caminho_projeto() ?>/imgs/img_aluguel.png" alt="Aluguel" />
			<?php
			break;
			case 'LANCAMENTO':
			?>
				<img src="<?php echo Util::caminho_projeto() ?>/imgs/img_lancamento.png" alt="Lançamento" />
			<?php
			break;
			case 'VENDA':
			?>
				<img src="<?php echo Util::caminho_projeto() ?>/imgs/img_venda.png" alt="Venda" />
			<?php
			break;
		}
	}
	
	
	
	#-----------------------------------------------------------------------------------------------------------------------#
	#	GERA UM SELECT COM OS EVENTOS DO CALENDARIO
	#-----------------------------------------------------------------------------------------------------------------------#
	static public function get_tipo_venda_imovel($name, $valor, $class = '', $titulo = "Selecione", $complemento_javascript = "")
	{
		  $obj_dao = new Dao();
		  //lista de ufs
		  $valor = trim($valor);
		  $lista = array(
		  				array('id' => 'DESTAQUES', 'titulo' => "DESTAQUES"),
						array('id' => 'LANCAMENTO', 'titulo' => "LANÇAMENTO"),
						//array('id' => 'VENDA', 'titulo' => "VENDA"),
						);
		echo '<select name="'.$name.'" id="'.$name.'" class="'.$class.'">';
		echo "<option value=''>$titulo</option>";
		for($i=0; $i < count($lista); $i++)
		{
			//verica se há na lista e check em caso afirmativo
			if($valor == $lista[$i][id])
			{
				?>
				   <option value="<?php Util::imprime($lista[$i][id]); ?>" selected="selected"><?php Util::imprime($lista[$i][titulo]); ?></option>
				<?php
			}
			else
			{
				?>
				<option value="<?php Util::imprime($lista[$i][id]); ?>"><?php Util::imprime($lista[$i][titulo]); ?></option>
				<?php
			}
		}
		echo '</select>';
	}
	
	
	
	
	#-----------------------------------------------------------------------------------------------------------------------#
	#	TRATO OS CAMPOS DO FORMULARIO DE ACORDO COM O BANCO
	#-----------------------------------------------------------------------------------------------------------------------#
	static function trata_dados_formulario($valor)
	{
		return utf8_decode(stripslashes (addslashes(trim(mysql_real_escape_string($valor)))));
		
		//return addslashes(trim($valor));
	}
	
	
	
	#-----------------------------------------------------------------------------------------------------------------------#
	# GERA UM SELECT COM TODAS AS UFS
	#-----------------------------------------------------------------------------------------------------------------------#
	static public function  get_tipos($name, $valor, $class = '', $titulo = "Selecione", $complemento_javascript = "")
	{
		//lista de ufs
		  $valor = trim($valor);
		  $lista = array(
		  				array('id' => 'Novo', 'titulo' => "Novo"),
						array('id' => 'Seminovo', 'titulo' => "Seminovo"),
						);
		echo '<select name="'.$name.'" id="'.$name.'" class="'.$class.'">';
		echo "<option value=''>$titulo</option>";
		for($i=0; $i < count($lista); $i++)
		{
			//verica se há na lista e check em caso afirmativo
			if($valor == $lista[$i][id])
			{
				?>
				   <option value="<?php Util::imprime($lista[$i][id]); ?>" selected="selected"><?php Util::imprime($lista[$i][titulo]); ?></option>
				<?php
			}
			else
			{
				?>
				<option value="<?php Util::imprime($lista[$i][id]); ?>"><?php Util::imprime($lista[$i][titulo]); ?></option>
				<?php
			}
		}
		echo '</select>';
	}
	
	
	#-----------------------------------------------------------------------------------------------------------------------#
	#	GERA UM SELECT COM TODAS AS UFS
	#-----------------------------------------------------------------------------------------------------------------------#
	static public function get_ufs($name, $uf, $class = '')
	{
		//lista de ufs
		$uf = trim($uf);
				$lista_uf = array( "AC",
									"AL",
									"AM",
									"AP",
									"BA",
									"CE",
									"DF",
									"ES",
									"GO",
									"MA",
									"MG",
									"MS",
									"MT",
									"PA",
									"PB",
									"PE",
									"PI",
									"PR",
									"RJ",
									"RN",
									"RO",
									"RR",
									"RS",
									"SC",
									"SE",
									"SP",
									"TO");
									
									
				echo '<select name="'.$name.'" id="'.$name.'" class="'.$class.'">';
				echo '<option value="">Selecione</option>';
				
				for($i=0; $i < count($lista_uf); $i++)
				{
					//verica se há na lista e check em caso afirmativo
					if( $uf == $lista_uf[$i] )
					{
					    echo '<option value="'. $lista_uf[$i] .'" selected="selected">';
							echo $lista_uf[$i];
						echo '</option>';
					}
					else
					{
						echo '<option value="'. $lista_uf[$i] .'">';
							echo $lista_uf[$i];
						echo '</option>';
					}
				}

			echo '</select>';
	}
	
	
	
	
	
	
	#-----------------------------------------------------------------------------------------------------------------------#
	#	GERA UM SELECT COM TODAS AS UFS
	#-----------------------------------------------------------------------------------------------------------------------#
	static public function status_venda($name, $uf, $class = '')
	{
		//lista de ufs
		$uf = trim($uf);
				$lista_uf = array( "AGUARDANDO PAGAMENTO",
									"CANCELADA",
									"ENTREGE"
									);
									
									
				echo '<select name="'.$name.'" id="'.$name.'" class="'.$class.'">';
				echo '<option value="">Selecione</option>';
				
				for($i=0; $i < count($lista_uf); $i++)
				{
					//verica se há na lista e check em caso afirmativo
					if( $uf == $lista_uf[$i] )
					{
					    echo '<option value="'. $lista_uf[$i] .'" selected="selected">';
							echo $lista_uf[$i];
						echo '</option>';
					}
					else
					{
						echo '<option value="'. $lista_uf[$i] .'">';
							echo $lista_uf[$i];
						echo '</option>';
					}
				}

			echo '</select>';
	}
	
	
	
	static public function formata_moeda($valor, $tipo = 'exibir')
	{
		//	RETORNA O VALOR NO FORMATO DE MOEDA EX: 1.200,34
		switch($tipo):
			
			case 'exibir':
				$valor_final = number_format($valor, 2, ',', '.');
			break;
			case 'pagseguro':
				$valor_final = number_format($valor, 2, '.', '');
			break;
			
			default:
				//Remove o . (ponto)
				$novovalor = str_replace(".","","$valor");
				//Substitui a , por . (ponto)
				$valor_final = str_replace(",",".","$novovalor");
			break;
			
			
			
		endswitch;
		
		/*
		if($tipo == 'exibir')
		{
			$valor_final = number_format($valor, 2, ',', '.');
		}
		else	//	RETORNA NO VALOR DO BANCO EX: 1200.34
		{
			//Remove o . (ponto)
			$novovalor = str_replace(".","","$valor");
			//Substitui a , por . (ponto)
			$valor_final = str_replace(",",".","$novovalor");
		}
		*/
		
		return $valor_final;
	}
	
	
	
	
	#-----------------------------------------------------------------------------------------------------------------------#
	# GERA ANOS
	#-----------------------------------------------------------------------------------------------------------------------#
	static public function get_anos($name, $ano, $titulo)
	{
		echo '<select name="'.$name.'" id="'.$name.'" class="">';
		echo "<option value=''>$titulo</option>"; 
		
		
		$ano_selecionado_temp = date("Y");
		
		for($i=0; $i < 30; $i++)
		{
			
			$ano_selecionado = $ano_selecionado_temp - $i;
			
			//verica se há na lista e check em caso afirmativo
			if($ano == $ano_selecionado)
			{
				?>
				   <option value="<?php Util::imprime($ano_selecionado); ?>" selected="selected"><?php Util::imprime($ano_selecionado); ?></option>
				<?php
			}
			else
			{
				?>
				<option value="<?php Util::imprime($ano_selecionado); ?>"><?php Util::imprime($ano_selecionado); ?></option>
				<?php
			}
		}
		echo '</select>';

	}

	#-------------------------------------------------------------------------------------------------------------------#
	#	FAZ UM TEXT AREA COM CKEDITOR
	#-------------------------------------------------------------------------------------------------------------------#
	static public function ckeditor($nome_campo, $value)
	{
		$CKEditor = new CKEditor();
		//$CKEditor->config['toolbar'] = "Full";
		$CKEditor->config['toolbar'] = array(
								  array('Source'/*,'-','Save','NewPage','Preview','-','Templates'*/),
								  array('Cut','Copy','Paste','PasteText','PasteFromWord'/*,'-','Print', 'SpellChecker', 'Scayt'*/),
								  array('Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'),
								  /*array('Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'),*/
								  '/',
								  array('Bold','Italic','Underline','Strike','-','Subscript','Superscript'),								  
								  array('NumberedList','BulletedList'/*,'-','Outdent','Indent','Blockquote','CreateDiv'*/),
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
	
	
	
	static public function cumprimento()
	{
		/*Script que "cumprimenta" o usuário na página. Bom dia, Boa tarde,etc*/
	 
		$hora_do_dia=date("H");
		 
		/*uso de condicionais, poderíamos utilizar o switch também*/
		 
		if (($hora_do_dia >=6) && ($hora_do_dia <=12)) echo "BOM DIA";
		if (($hora_do_dia >12) && ($hora_do_dia <=18)) echo "BOA TARDE";
		if (($hora_do_dia >18) && ($hora_do_dia <=24)) echo "BOA NOITE";
		if (($hora_do_dia >24) && ($hora_do_dia <6)) echo "BOA MADRUGADA";
	}
	
	
	
}
?>