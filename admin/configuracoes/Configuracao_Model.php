<?php
ob_start();
session_start();


class Informacao_Model extends Dao
{
	
	private $nome_tabela = "tb_configuracoes";
	private $chave_tabela = "idconfiguracao";
	public $obj_imagem;
	
	
	/*	==================================================================================================================	*/
	#	CONSTRUTOR DA CLASSE
	/*	==================================================================================================================	*/
	public function __construct()
	{
		$this->obj_imagem = new Imagem();
		parent::__construct();
	}
	
	
	
	/*	==================================================================================================================	*/
	/*	FORMULARIO	*/
	/*	==================================================================================================================	*/
	public function formulario($dados)
	{
		$obj_jquery = new Biblioteca_Jquery();
	?>
    	<script language="javascript"> 
			$(document).ready(function() {				
				jQuery(function($){
				   $("#data_atendimento").mask("99/99/9999");
				});
			});
		</script>
        
        
        <div class="class-form-1">
            <ul>
            	
				<li>
                	<p>Título padrão<span></span></p>
                    <input type="text" name="title_google" id="title_google" value="<?php Util::imprime($dados[title_google]) ?>" class="validate(required)" />
                </li>
				<li>
                	<p>Description padrão<span></span></p>
                    <input type="text" name="description_google" id="description_google" value="<?php Util::imprime($dados[description_google]) ?>" class="validate(required)" />
                </li>
				<li>
                	<p>Keywords padrão<span></span></p>
                    <input type="text" name="keywords_google" id="keywords_google" value="<?php Util::imprime($dados[keywords_google]) ?>" class="validate(required)" />
                </li>
                
                
                
				
				<li>
                	<p>Endereço<span></span></p>
                    <input type="text" name="endereco" id="endereco" value="<?php Util::imprime($dados[endereco]) ?>" class="validate(required)" />
                </li>
				
				<li>
                	<p>Telefone - 01<span></span></p>
                    <input type="text" name="telefone1" id="telefone1" value="<?php Util::imprime($dados[telefone1]) ?>" class="validate(required)" />
                </li>
				
				<li>
                	<p>Telefone - 02<span></span></p>
                    <input type="text" name="telefone2" id="telefone2" value="<?php Util::imprime($dados[telefone2]) ?>" class="validate(required)" />
                </li>
				
				<li>
                	<p>Email<span></span></p>
                    <input type="text" name="email" id="email" value="<?php Util::imprime($dados[email]) ?>" class="validate(required)" />
                </li>
				
				<li>
                	<p>Latitude<span></span></p>
                    <input type="text" name="latitude" id="latitude" value="<?php Util::imprime($dados[latitude]) ?>" class="validate(required)" />
                </li>
				
				<li>
                	<p>Longitude<span></span></p>
                    <input type="text" name="longitude" id="longitude" value="<?php Util::imprime($dados[longitude]) ?>" class="validate(required)" />
                </li>
				
				<li>
                	<p>Ling Página Google<span></span></p>
                    <input type="text" name="ling_google" id="ling_google" value="<?php Util::imprime($dados[ling_google]) ?>" class="validate(required)" />
                </li>
				
				
                
				<li>
                    <p>Mensagem Email para depóstio bancário</p>
                    <?php $obj_jquery->ckeditor('msg_deposito_bancario', $dados[msg_deposito_bancario]); ?>
                </li>
				
                
                
            </ul>
        </div>
        
        
    <?php
	}
	
	/*	==================================================================================================================	*/
	/*	EFETUA CROP DA IMAGEM	*/
	/*	==================================================================================================================	*/
	public function efetua_crop_imagem($id, $nome_arquivo, $nome_campo, $tamanho_width_tumb, $tamanho_height_tumb, $url_retorno, $msg_sucesso, $tamanho_imagem = 593)
	{
		//	CRIO O CROP DA IMAGEM
		$nome_tabela = $this->nome_tabela;
		$idtabela = $this->chave_tabela;		
		$this->obj_imagem->gera_imagem_crop($id, $nome_arquivo, $nome_tabela, $idtabela, $nome_campo, $tamanho_imagem, $tamanho_width_tumb, $tamanho_height_tumb, $url_retorno, $msg_sucesso);	
	}
	
	
	
	/*	==================================================================================================================	*/
	/*	EFETUA O CADASTRO	*/
	/*	==================================================================================================================	*/
	public function cadastra($dados)
	{
		
		//	CADASTRA O USUARIO
		
		$id = parent::insert($this->nome_tabela, $_POST);
		
		//	ARMAZENA O LOG
		parent::armazena_log("tb_logs_logins", "CADASTRO DO CLIENTE $dados[nome]", $sql, $_SESSION[login][idlogin]);
		
		
		//	VERIFICO SE E PARA CRIAR A IMAGEM DA CAPA
		if($_FILES[imagem][name] != "")
		{
			//	EFETUO O UPLOAD DA IMAGEM
			$nome_arquivo = Util::upload_imagem("../../uploads", $_FILES[imagem], "3145728");	
			
			//	EFETUO O CROP DA IMAGEM
			$this->efetua_crop_imagem($id, $nome_arquivo, "imagem", 593, 364, $_SERVER['PHP_SELF'], "Cadastro efetuado com sucesso");
			     //efetua_crop_imagem($id, $nome_arquivo, $nome_campo, $tamanho_width_tumb, $tamanho_height_tumb, $url_retorno, $msg_sucesso, $tamanho_imagem = 800)
		}
		
		
		
		Util::script_msg("Cadastro efetuado com sucesso.");
		Util::script_location(dirname($_SERVER['SCRIPT_NAME'])."/cadastra.php");
	}
	
	
	
	/*	==================================================================================================================	*/
	/*	EFETUA A ALTERACAO	*/
	/*	==================================================================================================================	*/
	public function altera($id, $dados)
	{
		
		parent::update($this->nome_tabela, $id, $dados);
		
		
		//	ARMAZENA O LOG
		parent::armazena_log("tb_logs_logins", "ALTERAÇÃO DO CLIENTE $dados[nome]", $sql, $_SESSION[login][idlogin]);
		
		//	VERIFICO SE E PARA CRIAR A IMAGEM DA CAPA
		if($_FILES[imagem][name] != "")
		{
			//	EFETUO O UPLOAD DA IMAGEM
			$nome_arquivo = Util::upload_imagem("../../uploads", $_FILES[imagem], "3145728");	
			
			//	EFETUO O CROP DA IMAGEM
			$this->efetua_crop_imagem($id, $nome_arquivo, "imagem", 593, 364, $_SERVER['PHP_SELF'], "Cadastro efetuado com sucesso");
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
					ordem desc
				";
			return parent::executaSQL($sql);
		}
		
	}
	
	
	
	
	
	
	
}

?>
