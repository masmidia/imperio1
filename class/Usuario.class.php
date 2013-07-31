<?php
require_once("Dao.class.php");
require_once("Util.class.php");



class Usuario extends Dao
{
	private $nome_tabela = "tb_usuarios";
	private $id_tabela = "idusuario";
	
	
	
	
	#-------------------------------------------------------------------------------------------------#
	#	BUSCO OS DADOS NA TABELA
	#-------------------------------------------------------------------------------------------------#
	public function verifica_usuario_logado()
	{
		
		if(isset($_SESSION[usuario])):
			return true;
		else:
			return false;
		endif;
	
	}
	
	
		
	
	#-------------------------------------------------------------------------------------------------#
	#	BUSCO OS DADOS NA TABELA
	#-------------------------------------------------------------------------------------------------#
	public function verifica_usuario($email, $senha)
	{		
		$email = Util::trata_dados_formulario($email);
		$senha = md5(Util::trata_dados_formulario($senha));
	
	
		$sql = "SELECT * FROM tb_usuarios WHERE email = '$email' AND senha = '$senha' AND ativo = 'SIM'";
		$result = parent::executaSQL($sql);
		
		
		if( mysql_num_rows($result) > 0)
		{
			$row = mysql_fetch_array($result);
			$_SESSION[usuario] = $row;
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	
	
	#-------------------------------------------------------------------------------------------------#
	#	CADASTRA O USUARIO
	#-------------------------------------------------------------------------------------------------#
	public function cadastra_usuario($dados)
	{	
		
		
		//	CODIFICO A SENHA
		$dados[email] = Util::trata_dados_formulario($dados[email]);
		$dados[senha] = md5($dados[senha]);
		
		
		
		
		//	VERIFICO SE O EMAIL NÃO EXISTE
		$sql = "SELECT * FROM tb_usuarios WHERE email = '$dados[email]'";
		$result = parent::executaSQL($sql);
		
		if(mysql_num_rows($result) == 0):

			$id = parent::insert("tb_usuarios", $dados);
			$_SESSION[usuario] = $this->get_dados_tabela($id);
			return $id;
			
		else:
		
			return false;
		
		endif;
	}
	
	
	
	
	#-------------------------------------------------------------------------------------------------#
	#	ATUALIZA OS DADOS
	#-------------------------------------------------------------------------------------------------#
	public function atualiza_dados($dados)
	{
		
		parent::update('tb_usuarios', $_SESSION[usuario][idusuario], $dados);
		
		
		$_SESSION[usuario] = $this->get_dados_tabela($_SESSION[usuario][idusuario]);
	
	}
	
	
	#-------------------------------------------------------------------------------------------------#
	#	ATUALIZA OS DADOS
	#-------------------------------------------------------------------------------------------------#
	public function atualiza_senha($senha)
	{
		
		$dados[senha] = md5( Util::trata_dados_formulario($senha));
		
		
		parent::update('tb_usuarios', $_SESSION[usuario][idusuario], $dados);
		
	
	}
	
	
	
	
	
	
	#-------------------------------------------------------------------------------------------------#
	#	BUSCO OS DADOS NA TABELA
	#-------------------------------------------------------------------------------------------------#
	public function get_dados_tabela($id)
	{
		//	BUSCO OS DADOS
		$sql = "SELECT * FROM ". $this->nome_tabela ." WHERE ". $this->id_tabela ." = '$id'";
		$result = parent::executaSQL($sql);
		return mysql_fetch_array($result);
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
		echo $sql = "UPDATE $this->nome_tabela SET senha = '$senha' WHERE $this->id_tabela = '$dados[idusuario]'";
		parent::executaSQL($sql);
		
		
		//	ENVIO O EMAIL PARA O USUARIO
		$texto_mensagem = "
							Caro usuário, como solicitado segua abaixo sua nova senha. <br />
							
							Senha: $password
							";
		
		Util::envia_email($dados[email], "Recuperação de senha", $texto_mensagem, $_SERVER['SERVER_NAME'], "atendimento@".$_SERVER['SERVER_NAME']);
		
	}

}












?>