<?php
ob_start();
session_start();


class Promocoes_Model extends Dao
{
	
	private $nome_tabela = "tb_promocoes";
	private $chave_tabela = "idpromocao";
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
		$obj_site = new Site();
		$obj_jquery = new Biblioteca_Jquery();
		?>
    	<script language="javascript"> 
			$(document).ready(function() {				
				jQuery(function($){
				   $("#data_inicial, #data_inicial").mask("99/99/9999");
				   $(".preco").maskMoney({showSymbol:false, symbol:"R$", decimal:",", thousands:"."});
				});
			});
		</script>
        
        
        
        
        <div class="class-form-1">
            <ul>
                <li>
                	<p>Título<span></span></p>
                    <input type="text" name="titulo" id="titulo" value="<?php Util::imprime($dados[titulo]) ?>" class="validate[required]" />
                </li>
            </ul>    
        </div>    
        
        
        <div class="class-form-2">
            <ul>
                </li>
                <li>
                	<p>Desconto oferecido<span></span></p>
                    <input type="text" name="desconto" id="desconto" value="<?php Util::imprime($dados[desconto]) ?>" class="validate[required]" style="width:90%; text-align:right" /> %
                </li>
				<li>
                	<p>A imagem<span> deve ter 995px de largura</span></p>
                    
                    <?php
					if(!empty($dados[imagem]))
					{
						?>
                        <input type="file" name="imagem" id="imagem" value="<?php Util::imprime($dados[imagem]) ?>" class="" />
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
            </ul>
        </div>
        
        
        
        
       <div class="class-form-1">
            <ul> 
        		<li>
                    <p>Descrição:</p>
                    <?php $obj_jquery->ckeditor('descricao', $dados[descricao]); ?>
                </li>
        	</ul>
       </div> 
        
        
        <?php /*?><h2>Selecione os produtos da promoção.</h2>
        
        <div class="class-form-2">
        	
            
            
            
           <?php 
			$result1 = $obj_site->select("tb_categoriaproduto");
			
			if(mysql_num_rows($result1) > 0):
			
				while($row1 = mysql_fetch_array($result1)):
				?>
                	<br>
                	<h2 style="color:#F36"><?php Util::imprime($row1[titulo]) ?></h2>
					<br>
                    
                    
                    <?php
					$result = $obj_site->select("tb_produtos", "AND id_categoriaproduto = '$row1[0]'");
                        
                        if(mysql_num_rows($result) == 0):
						
							echo "<h4>Nenhum produto nesta categoria</h4>";
						
						else:
						
							?>
							
							<table width="98%" border="0" cellpadding="0" cellspacing="5"   class="tabela_cor_alternada" >
					  
							  <tr>
								<td>Imagem</td>
                                <td>Selecionar</td>
								<td>Descrição</td>
								<td>Valor</td>
							  </tr>
							  
							  
							  
							  <?php 
                        
                        
								while($row = mysql_fetch_array($result)):
									
									
									//	VERIFICO SE O PRODUTO ESTÁ NA PROMOCAO
									$result_temp = $obj_site->select("tb_produtos_promocoes", "AND id_produto = $row[idproduto] AND id_promocao = '$dados[id]'");
									
									if(mysql_num_rows($result_temp) > 0):
										$checked = 'checked';
									else:
										$checked = '';
									endif;
									
								?>
								
									<tr>
										<td><?php echo $obj_site->redimensiona_imagem("../uploads/$row[imagem]", 50, 50); ?></td>
										<td><input type="checkbox" name="idprodutos[]" value="<?php echo $row[0] ?>" style="width:25px;" ></td>
                                        <td><p><?php Util::imprime($row[titulo]) ?></p></td>
                                        <td><?php echo Util::formata_moeda($row[preco]) ?></td>
									</tr>
									
								<?php
								endwhile;
						endif;	
                        ?>
                     
                      
                      
                      
                    </table>
                    
				
				<?php
				
				
				
				
				
				endwhile;
				
			endif;
			
			?> 
            
            
            
        
        </div>
        <?php */?>
        
        
        <br><br>
        <div class="class-form-1">
        	<ul>
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
			$dados[imagem] = Util::upload_imagem("../../uploads", $_FILES[imagem], "4194304",995,null,995,null);
		}
		
		
		//	CADASTRA O USUARIO
		$id = parent::insert($this->nome_tabela, $dados);
		
		
		//	CADASTRA OS PRODUTOS DA PROMOCAO
		//$this->cadastra_produtos_promocao($id, $dados[idprodutos]);
		
		
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
			$dados[imagem] = Util::upload_imagem("../../uploads", $_FILES[imagem], "4194304",995,null,995,null);
		}
		
		
		parent::update($this->nome_tabela, $id, $dados);
		
		
		//	CADASTRA OS PRODUTOS DA PROMOCAO
		//$this->cadastra_produtos_promocao($id, $dados[idprodutos]);
		
		
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
	/*	CADASTRA OS PRODUTOS DA PROMOCAO	*/
	/*	==================================================================================================================	*/
	public function cadastra_produtos_promocao($id, $idprodutos)
	{
		//	APAGO OS PRODUTOS ANTIGOS
		$sql = "DELETE FROM tb_produtos_promocoes WHERE id_promocao = '$id'";
		parent::executaSQL($sql);
		
		
		if(count($idprodutos) > 0):
		
			foreach($idprodutos as $idproduto):
				
				$sql = "INSERT INTO tb_produtos_promocoes (id_promocao, id_produto) VALUES ('$id', '$idproduto')";
				parent::executaSQL($sql);
				
			endforeach;
		
		endif;
	
		
		exit;
		
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
