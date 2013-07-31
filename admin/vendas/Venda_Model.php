<?php
ob_start();
session_start();


class Venda_Model extends Dao
{
	
	private $nome_tabela = "tb_vendas";
	private $chave_tabela = "idvenda";
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
	/*	ORDENA	*/
	/*	==================================================================================================================	*/
	public function atualiza_promocao($dados){
		
				
		if(count($dados) > 0):
		
			foreach($dados as $key=>$dado):
				
			 	$sql = "UPDATE ". $this->nome_tabela ." SET id_promocao = '$dado' WHERE idproduto = $key ";
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
		$obj_site = new Site();
		?>
        <script type="text/javascript">
			$(document).ready(function () {
				
				function removeCampo() {
					$(".removerCampo").unbind("click");
					$(".removerCampo").bind("click", function () {
						
						if($('.item').length != 1)
						{
							i=0;
							$(".itens ul.item").each(function () {
								i++;
							});
							if (i>1) {
								$(this).parent().parent().remove();
							}
						}
					});
				}
				
				//removeCampo();
				
				$(".adicionarCampo").click(function () {
					novoCampo = $(".itens ul.item:first").clone();
					novoCampo.find("input").val("");
					novoCampo.insertAfter(".itens ul.item:last");
					removeCampo();
				});
				
			});
		</script>
        <style> .removerCampo {float:right;} </style>
        
        
    	<script language="javascript"> 
			$(document).ready(function() {				
				jQuery(function($){
				   $("#data_atendimento").mask("99/99/9999");
				   $("#preco").maskMoney({showSymbol:false, symbol:"R$", decimal:",", thousands:"."});
				});
			});
		</script>
        
        <div class="class-form-1">
            <ul>
            	<li>
                	<p>Título<span></span></p>
                    <input type="text" name="titulo" id="titulo" value="<?php Util::imprime($dados[titulo]) ?>" class="validate[required]" />
                </li>
                <li>
                	<p>Categoria do Produto</p>
					<?php Util::cria_select_bd('tb_categoriaproduto', 'idcategoriaproduto', 'titulo', 'id_categoriaproduto', $dados[id_categoriaproduto], "validate[required]"); ?>
                </li>
                <li>
                	<p>Imagem<span></span></p>
                    
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
                        <input type="file" name="imagem" id="imagem" value="<?php Util::imprime($dados[imagem]) ?>" class="validate[required]" />
                        <?php
					}
					?>
                </li>
                
                <li>
                	<p>Preço<span></span></p>
                    <input type="text" name="preco" id="preco" value="<?php echo Util::formata_moeda($dados[preco]) ?>" class="validate[required]" />
                </li>
                <li>
                    <p>Descrição:</p>
                    <?php $obj_jquery->ckeditor('descricao', $dados[descricao]); ?>
                </li>
            </ul>
        </div>
        <div class="class-form-1">
        	<ul>
				<li>
                	<p>Title Google<span></span></p>
                    <input type="text" name="title_google" id="title_google" value="<?php Util::imprime($dados[title_google]) ?>" class="validate(required)" />
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
        
        
        
        
        <h1>Itens</h1><br />
        <div class="class-form-1">
        
        	<div class="itens">
            	<?php
				//busca os itens já cadastrados
				$result = $obj_site->select("tb_itensproduto"," AND id_produto = '$dados[idproduto]'");
				
				if(mysql_num_rows($result)==0)
				{//verifica se não tem nenhum registro e exibe o primeiro campo pra poder cadastrar
					?>
                    <ul class="item">
                        <li>
	                        <br />
                            <a href="javascript:void(0);" class="removerCampo">Remover Item</a>
                            <p>Título:<span>&nbsp;</span></p>
                            <input name="item[]" type="text" />
                        </li>
                    </ul>
            		<?php
				}
				else
				{//caso tenha registros ele exibe a lista
				
					while($arr = mysql_fetch_array($result))
					{
						?>
                        <ul class="item">
                            <li>
                            	<br />
                                <a href="javascript:void(0);" class="removerCampo">Remover Item</a>
                                <p>Título:<span>&nbsp;</span></p>
                                <input name="item[]" value="<?php Util::imprime($arr[titulo]); ?>" type="text" />
                            </li>
                        </ul>
						<?php					
					}//fecha o while
				}//fecha o else
				?>
            </div>
            
            <p><a href="javascript:void(0);" class="adicionarCampo">Adicionar Item</a></p>
            
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
	/*	CADASTRA OS ITENS DO PRODUTO	*/
	/*	==================================================================================================================	*/
	public function cadastra_item($id, $item)
	{
		
		/*Apaga os registro anteriores*/
		$sql = "DELETE FROM tb_itensproduto WHERE id_produto = '$id'";
		parent::executaSQL($sql);
		
		$qtd = count($item);
		
		for($i = 0; $i < $qtd; $i++){
			$sql = "INSERT INTO tb_itensproduto 
						(id_produto, titulo) 
					VALUES
						('$id', '".Util::trata_dados_formulario($item[$i])."')
					";
			
			parent::executaSQL($sql);
				
		}
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
			$dados[imagem] = Util::upload_imagem("../../uploads", $_FILES[imagem], "4194304",null,null,800,600);
		}
		
		//	CADASTRA O USUARIO
		$id = parent::insert($this->nome_tabela, $dados);
		
		// CADASTRA OS ITENS
		$this->cadastra_item($id, $dados[item]);
		
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
			$dados[imagem] = Util::upload_imagem("../../uploads", $_FILES[imagem], "4194304",null,null,800,600);
		}
		
		parent::update($this->nome_tabela, $id, $dados);
		
		// CADASTRA OS ITENS
		$this->cadastra_item($id, $dados[item]);
		
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
	/*	ATIVA OU DESATIVA	*/
	/*	==================================================================================================================	*/
	public function atualiza_status($id, $status)
	{
		
		$sql = "UPDATE " . $this->nome_tabela. " SET status_venda = '$status' WHERE " . $this->chave_tabela. " = '$id'";
		parent::executaSQL($sql);
		
		
		
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
					data desc, hora DESC
				";
			return parent::executaSQL($sql);
		}
		
	}
	
	
	
	
	
	
	
}

?>
