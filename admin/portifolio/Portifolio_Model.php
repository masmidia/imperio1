<?php
ob_start();
session_start();


class Portifolio_Model extends Dao
{
	
	private $nome_tabela = "tb_portifolios";
	private $chave_tabela = "idportifolio";
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
	/*	ORDENA	*/
	/*	==================================================================================================================	*/
	public function atualizar_ordem($ordem){
		
		if(count($ordem) > 0):
		
			foreach($ordem as $key=>$orde):
				
				$sql = "UPDATE ". $this->nome_tabela ." SET ordem = '$orde' WHERE ". $this->chave_tabela ." = $key ";
				parent::executaSQL($sql);
				
			endforeach;
		
		endif;
		
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
                	<p>Serviço<span></span></p>
                    <?php Util::cria_select_bd("tb_servicos", "idservico", "titulo", "id_servico", $dados[id_servico], "validate[required]") ?>
                </li>
            	<li>
                	<p>Título<span></span></p>
                    <input type="text" name="titulo" id="titulo" value="<?php Util::imprime($dados[titulo]) ?>" class="validate[required]" />
                </li>
				<li>
                	<p>Imagem<span>Deve ser no mínimo 1920px de largura</span></p>
                    
                    <?php
					if(!empty($dados[imagem]))
					{
						?>
                        <input type="file" name="imagem" id="imagem" value="<?php Util::imprime($dados[imagem]) ?>" />
                        <p>Atual:</p>
	                    <img src="<?php echo Util::caminho_projeto(); ?>/uploads/<?php Util::imprime($dados[imagem]) ?>" style="max-width:690px;" />
                        <?php
					}
					else
					{
						?>
                        <input type="file" name="imagem" id="imagem" value="<?php Util::imprime($dados[imagem]) ?>" />
                        <?php
					}
					?>
                </li>
            </ul>
        </div>
        <div class="class-form-1">
        	<ul>
				<li>
                	<p>Descrição</p>
                    <?php $obj_jquery->ckeditor('descricao', $dados[descricao]); ?>
                </li>
				<li>
                	<p>Title Google<span></span></p>
                    <input type="text" name="title_google" id="title_google" value="<?php Util::imprime($dados[title_google]) ?>" />
                </li>
                <li>
                	<p>Keywords Google</p>
                    <textarea name="keywords_google" id="keywords_google"><?php Util::imprime($dados[keywords_google]) ?></textarea>
                </li>
                <li>
                	<p>Description Google</p>
                    <textarea name="description_google" id="description_google"><?php Util::imprime($dados[description_google]) ?></textarea>
                </li>
            </ul>
        </div>
    	<?php
	}
	
	/*	==================================================================================================================	*/
	/*	EFETUA CROP DA IMAGEM	*/
	/*	==================================================================================================================	*/
	public function efetua_crop_imagem($id, $nome_arquivo, $nome_campo, $tamanho_width_tumb, $tamanho_height_tumb, $url_retorno, $msg_sucesso, $tamanho_imagem = 1920)
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
		//	VERIFICO SE E PARA CRIAR A IMAGEM DA CAPA
		if($_FILES[imagem][name] != "")
		{
			//	EFETUO O UPLOAD DA IMAGEM
			$dados[imagem] = Util::upload_imagem("../../uploads", $_FILES[imagem], "4194304");
		}
		
		//	CADASTRA O USUARIO
		$id = parent::insert($this->nome_tabela, $dados);
		
		//	ARMAZENA O LOG
		parent::armazena_log("tb_logs_logins", "CADASTRO DO CLIENTE $dados[nome]", $sql, $_SESSION[login][idlogin]);
		
		
		//	VERIFICO SE E PARA CRIAR A IMAGEM DA CAPA
		/*if($_FILES[imagem][name] != "")
		{
			//	EFETUO O CROP DA IMAGEM
			$this->efetua_crop_imagem($id, $dados[imagem], "imagem", 195, 148, $_SERVER['PHP_SELF'], "Cadastro efetuado com sucesso");
			     //efetua_crop_imagem($id, $nome_arquivo, $nome_campo, $tamanho_width_tumb, $tamanho_height_tumb, $url_retorno, $msg_sucesso, $tamanho_imagem = 800)
		}*/
		
		Util::script_msg("Cadastro efetuado com sucesso.");
		Util::script_location(dirname($_SERVER['SCRIPT_NAME'])."/cadastra.php");
		
	}
	
	
	
	
	/*	==================================================================================================================	*/
	/*	EFETUA A ALTERACAO	*/
	/*	==================================================================================================================	*/
	public function altera($id, $dados)
	{
		//	VERIFICO SE E PARA CRIAR A IMAGEM DA CAPA
		if($_FILES[imagem][name] != "")
		{
			//	EFETUO O UPLOAD DA IMAGEM
			$dados[imagem] = Util::upload_imagem("../../uploads", $_FILES[imagem], "4194304");
		}
		
		parent::update($this->nome_tabela, $id, $dados);
		
		
		//	ARMAZENA O LOG
		parent::armazena_log("tb_logs_logins", "ALTERAÇÃO DO CLIENTE $dados[nome]", $sql, $_SESSION[login][idlogin]);
		
		//	VERIFICO SE E PARA CRIAR A IMAGEM DA CAPA
		/*if($_FILES[imagem][name] != "")
		{
			//	EFETUO O CROP DA IMAGEM
			$this->efetua_crop_imagem($id, $dados[imagem], "imagem", 195, 148, $_SERVER['PHP_SELF'], "Cadastro efetuado com sucesso");
		}*/
		
		Util::script_msg("Alterado com sucesso.");
		Util::script_location(dirname($_SERVER['SCRIPT_NAME'])."/lista.php");
		
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
