<?php
@ob_start();
@session_start();


class Login_Model extends Dao
{
	
	private $nome_tabela = "tb_logins";
	private $chave_tabela = "idlogin";
	
	
	
	/*	==================================================================================================================	*/
	/*	FORMULARIO SENHA	*/
	/*	==================================================================================================================	*/
	public function formulario_senha($dados)
	{
	?>
    	<div class="class-form-2">
            <ul>
                <li>   
                    <p>Senha<span></span></p>
                    <input type="password" name="senha" id="senha" class="validate(required)" />
                </li>
                
                <li>
                    <p>Confirme a senha<span></span></p>
                    <input type="password" name="senha2" id="senha2" class="validate(match(#senha))" />
                </li>
            </ul>
        </div>
    <?php
	}
	
	
	
	/*	==================================================================================================================	*/
	/*	EFETUA A ALTERACAO	*/
	/*	==================================================================================================================	*/
	public function altera_senha($id, $dados)
	{
		$dados[senha] = md5($dados[senha]);

		parent::update($this->nome_tabela, $id, $dados);
		
		//	ARMAZENA O LOG
		parent::armazena_log("tb_logs_logins", "ALTEROU SENHA $id", $sql, $_SESSION[login][idlogin]);
		
		Util::script_msg("Senha alterada com sucesso.");	
		Util::script_location(dirname($_SERVER['SCRIPT_NAME'])."/lista.php");
		
	}
	
	
	
	/*	==================================================================================================================	*/
	/*	RECUPERA SENHA	*/
	/*	==================================================================================================================	*/
	public function recupera_senha($email)
	{
		$email = Util::trata_dados_formulario($email);
		
		//	VERIFICO SE OS DADOS SAO VALIDOS
		$sql = "SELECT * FROM $this->nome_tabela WHERE email = '$email'";
		$result = parent::executasQL($sql);
		
		
		
		if(mysql_num_rows($result) > 0)
		{
			$dados = mysql_fetch_array($result);
			$this->gera_senha_envia_email($dados);
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	
	
	/*	==================================================================================================================	*/
	/*	GERA UMA NOVA SENHA PARA O USUARIO	*/
	/*	==================================================================================================================	*/
	public function gera_senha_envia_email($dados)
	{
		//	GERO A SENHA
		$CaracteresAceitos = 'ABCDZYWZ0123456789'; 
	  	$max = strlen($CaracteresAceitos)-1;
	  	$password = null;
	  	for($i=0; $i < 8; $i++) 
		{ 
		  	$password .= $CaracteresAceitos{mt_rand(0, $max)};
	  	}
		
		$senha = md5($password);
		
		//	ATUALIZO A SENHA NO BANCO
		$sql = "UPDATE $this->nome_tabela SET senha = '$senha' WHERE $this->chave_tabela = '$dados[idlogin]'";
		parent::executaSQL($sql);
		
		
		//	ENVIO O EMAIL PARA O USUARIO
		$texto_mensagem = "
							Caro usuário, como solicitado segua abaixo sua nova senha. <br />
							
							Senha: $password
							";
		
		Util::envia_email($dados[email], "Recuperação de senha", $texto_mensagem, $_SERVER['SERVER_NAME'], "atendimento@".$_SERVER['SERVER_NAME']);
		
	}
	
	
	
	/*	==================================================================================================================	*/
	/*	EFETUA O CADASTRO	*/
	/*	==================================================================================================================	*/
	public function cadastra($dados)
	{
		$nome = Util::trata_dados_formulario($dados[nome]);
		$email = Util::trata_dados_formulario($dados[email]);
		$id_grupologin = Util::trata_dados_formulario($dados[id_grupologin]);
		$senha = md5($dados[senha]);
		
		//	VERIFICO SE O GRUPO JA ESTA CADASTRADO
		if($this->verifica($email) == 0)
		{		
			$sql = "
					INSERT INTO	" . $this->nome_tabela. "
					(nome, senha, email, id_grupologin)
					VALUES
					('$nome', '$senha', '$email', '$id_grupologin')
					";
			parent::executaSQL($sql);
			
			//	ARMAZENA O LOG
			parent::armazena_log("tb_logs_logins", "CADASTRO DO LOGIN $nome", $sql, $_SESSION[login][idlogin]);
			
			return true;
		}
		else
		{
			return false;	
		}
	}
	
	
	
	/*	==================================================================================================================	*/
	/*	EFETUA A ALTERACAO	*/
	/*	==================================================================================================================	*/
	public function altera($dados)
	{
		$nome = Util::trata_dados_formulario($dados[nome]);
		$email = Util::trata_dados_formulario($dados[email]);
		$id_grupologin = Util::trata_dados_formulario($dados[id_grupologin]);
		
		//	VERIFICO SE O GRUPO JA ESTA CADASTRADO
		if($this->verifica_altera($email, $dados[id]) == 0)
		{		
			$sql = "UPDATE " . $this->nome_tabela. " SET nome = '$nome', email = '$email', id_grupologin = '$id_grupologin' WHERE " . $this->chave_tabela. " = '$dados[id]'";
			parent::executaSQL($sql);
			
			//	ARMAZENA O LOG
			parent::armazena_log("tb_logs_logins", "ALTERAÇÃO DO LOGIN $dados[id]", $sql, $_SESSION[login][idlogin]);
			
			return true;
		}
		else
		{
			return false;	
		}
	}
	
	
	
	/*	==================================================================================================================	*/
	/*	ATIVA OU DESATIVA	*/
	/*	==================================================================================================================	*/
	public function ativar_desativar($id, $ativo)
	{
		if($ativo == "SIM")
		{
			$sql = "UPDATE " . $this->nome_tabela. " SET ativo = 'NAO' WHERE " . $this->chave_tabela. " = '$id'";
			parent::executaSQL($sql);
			
			//	ARMAZENA O LOG
			parent::armazena_log("tb_logs_logins", "DESATIVOU O LOGIN $id", $sql, $_SESSION[login][idlogin]);
		}
		else
		{
			$sql = "UPDATE " . $this->nome_tabela. " SET ativo = 'SIM' WHERE " . $this->chave_tabela. " = '$id'";
			parent::executaSQL($sql);
			
			//	ARMAZENA O LOG
			parent::armazena_log("tb_logs_logins", "ATIVOU O LOGIN $id", $sql, $_SESSION[login][idlogin]);
		}
		
	}
	
	
	
	
	/*	==================================================================================================================	*/
	/*	EXCLUI	*/
	/*	==================================================================================================================	*/
	public function excluir($id)
	{
		//	BUSCA OS DADOS
		$row = $this->select($id);
		
		$sql = "DELETE FROM " . $this->nome_tabela. " WHERE " . $this->chave_tabela. " = '$id'";
		parent::executaSQL($sql);
		
		//	ARMAZENA O LOG
		parent::armazena_log("tb_logs_logins", "EXCLUSÃO DO LOGIN $id, NOME: $row[nome], Email: $row[email]", $sql, $_SESSION[login][idlogin]);
	}
	
	
	
	
	
	
	
	/*	==================================================================================================================	*/
	/*	VERIFICO SE JA POSSUI O GRUPO CADASTRADO	*/
	/*	==================================================================================================================	*/
	public function verifica($email)
	{
		$sql = "SELECT * FROM " . $this->nome_tabela. " WHERE email = '$email'";
		return mysql_num_rows(parent::executaSQL($sql));
	}
	
	
	
	
	/*	==================================================================================================================	*/
	/*	VERIFICO SE JA POSSUI O GRUPO CADASTRADO QUANDO ALTERAR	*/
	/*	==================================================================================================================	*/
	public function verifica_altera($email, $id)
	{
			$sql = "SELECT * FROM " . $this->nome_tabela. " WHERE email = '$email' AND " . $this->chave_tabela. " <> '$id'";
		return mysql_num_rows(parent::executaSQL($sql));
	}
	
	
	

	
	/*	==================================================================================================================	*/
	/*	BUSCA OS DADOS	*/
	/*	==================================================================================================================	*/
	public function select($id = "")
	{
		if($id != "")
		{
			$sql = "
					SELECT
						*
					FROM
						" . $this->nome_tabela. "
					WHERE
						" . $this->chave_tabela. " = '$id'
					ORDER BY
						nome
					";
			return mysql_fetch_array(parent::executaSQL($sql));
		}
		else
		{
			$sql = "
				SELECT
					*
				FROM
					" . $this->nome_tabela. "
				ORDER BY
					nome
				";
			return parent::executaSQL($sql);
		}
		
	}
	
	
	
	
	
	/*	==================================================================================================================	*/
	/*	EFETUA LOGIN	*/
	/*	==================================================================================================================	*/
	public function efetuar_login($email, $senha)
	{
		$email = Util::trata_dados_formulario($email);
		$senha = md5($senha);
		
		$sql = "SELECT * FROM tb_logins WHERE email = '$email' AND senha = '$senha' AND ativo = 'SIM'";
		$result = parent::executaSQL($sql);
		
		
		if(mysql_num_rows($result) > 0)
		{
			
			$row = mysql_fetch_array($result);
			
			
			//	VERIFICO SE O GRUPO ESTA HABILITADO PARA ACESSAR
			if($this->verifica_grupo_ativo($row[id_grupologin]) == true)
			{	
							
				$_SESSION[login] = $row;
				
				//	BUSCO AS PERMISSOES DE ACESSO DO USUARIO
				$sql = "
						SELECT
						  tp.*, tmp.nome AS nome_modulo_pagina
						FROM
						  tb_grupos_logins_tb_paginas tgltp, tb_paginas tp, tb_modulos_paginas tmp
						WHERE
						  tgltp.id_pagina = tp.idpagina
						  AND tp.id_modulopagina = tmp.idmodulopagina
						  AND tgltp.id_grupologin = '$row[id_grupologin]'
						ORDER BY
						  tmp.nome, label
						";
				$result = parent::executaSQL($sql);
				
				
				if(mysql_num_rows($result) > 0)
				{
					$i = 0;
					while($row = mysql_fetch_array($result))
					{
						
						$_SESSION[permissoes][$i][pagina] = $row[pagina];
						$_SESSION[permissoes][$i][label] = $row[label];
						$_SESSION[permissoes][$i][exibir_menu] = $row[exibir_menu];
						$_SESSION[permissoes][$i][id_modulopagina] = $row[id_modulopagina];
						$_SESSION[permissoes][$i][nome_modulo_pagina] = $row[nome_modulo_pagina];
						$i++;
					}
					
				}
				return true;
			}
			else
			{
				return false;	
			}
		}
		else
		{
			return false;	
		}
	}
	
	
	
	
	
	public function verifica_grupo_ativo($id_grupologin)
	{
		$sql = "SELECT * FROM tb_grupos_logins WHERE idgrupologin = '$id_grupologin'";
		$row = mysql_fetch_array(parent::executaSQL($sql));
		
		if($row[ativo] == 'SIM')
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	
	/*	==================================================================================================================	*/
	/*	FORMULARIO	*/
	/*	==================================================================================================================	*/
	public function formulario($dados)
	{
	?>
    	
    	<script>
			jQuery(document).ready(function(){
				// binds form submission and fields to the validation engine
				jQuery("#form-dados").validationEngine();
			});
		</script>
        
    	<div class="class-form-2">
            <ul>
                <li>
                    <p>Nome<span></span></p>
                    <input type="text" name="nome" id="nome" value="<?php echo $dados[nome] ?>" class="validate[required]" />
                </li>
                
                <li>
                    <p>Grupo<span></span></p>
                    <?php Util::cria_select_bd("tb_grupos_logins", "idgrupologin", "nome", "id_grupologin", $dados[id_grupologin], "validate[required]") ?>
                </li>
                    
                <li>
                    <p>Email<span></span></p>
                    <input type="text" name="email" id="email" value="<?php echo $dados[email] ?>" class="validate[required]" />
                </li>
                 
                <li>   
                    <p>Senha<span></span></p>
                    <input type="password" name="senha" id="senha" class="validate[required]" />
                </li>
                
                <li>
                    <p>Confirme a senha<span></span></p>
                    <input type="password" name="senha2" id="senha2" class="validate[required,equals[senha]]" />
                </li>
            </ul>
        </div>
    <?php
	}
	
	
	
	/*	==================================================================================================================	*/
	/*	FORMULARIO	*/
	/*	==================================================================================================================	*/
	public function formulario_alteracao($dados)
	{
	?>
    	
        <script>
			jQuery(document).ready(function(){
				// binds form submission and fields to the validation engine
				jQuery("#form-dados").validationEngine();
			});
		</script>
        
    	<div class="class-form-2">
            <ul>
                <li>
                    <p>Nome<span></span></p>
                    <input type="text" name="nome" id="nome" value="<?php echo $dados[nome] ?>" class="validate[required])" />
                </li>
                
                <li>
                    <p>Grupo<span></span></p>
                    <?php Util::cria_select_bd("tb_grupos_logins", "idgrupologin", "nome", "id_grupologin", $dados[id_grupologin], "validate[required]") ?>
                </li>
                    
                <li>
                    <p>Email<span></span></p>
                    <input type="text" name="email" id="email" value="<?php echo $dados[email] ?>" class="validate[required]" />
                </li>                 
            </ul>
        </div>
    <?php
	}
	
	
	
	
	
}

?>
