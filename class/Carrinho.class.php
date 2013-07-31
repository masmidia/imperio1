<?php
ob_start();
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . PASTA_PROJETO . "/class/Include.class.php");





class Carrinho extends Dao{



	/*	==================================================================================================================	*/
	/*	ADICIONA ITEM 	*/
	/*	==================================================================================================================	*/
	public function add_item($idproduto)
	{
		//	BUSCO OS DADOS DO PRODUTO
		$dados = $this->get_produtos($idproduto);
	
			
		if($dados != false):
		
			$dados[qtd] = 1;
		
			if(!isset($_SESSION[produtos]))
			{
				$_SESSION[produtos][] = $dados;
			}
			else
			{
	
				//	VERIFICO SE O VALOR JA EXISTE
				foreach($_SESSION[produtos] as $key => $produto)
				{
					if($produto[idproduto] == $dados[idproduto])
					{
						$indice = $key;
						$existe = 'SIM';
						break;
					}
				}
				
				
				//	VEJO SE ACHOU ALGUM REGISTRO
				if($existe != 'SIM')
				{
					$_SESSION[produtos][] = $dados;
				}
				
			
				
			}
		
		endif;
		
		
	}
	
	
	
	/*	==================================================================================================================	*/
	#	ATUALIZA OS ITEM
	/*	==================================================================================================================	*/
	public function atualiza_itens($dados)
	{
		
		//	ARAMAZENO O LOCAL DE ENTREGA
		$_SESSION[entrega][bairro] = $_POST[bairro];
		
		
		//	VERIFICO SE O VALOR JA EXISTE
		foreach($dados as $key => $produto)
		{
			
			$_SESSION[produtos][$key][qtd] = $produto;
			
		}
		
		
	}
	
	
	/*	==================================================================================================================	*/
	#	ARMAZENA OS DADOS DA ENTREGA
	/*	==================================================================================================================	*/
	public function armazena_mensagem_endereco_entrega($dados)
	{
		$_SESSION[entrega] = $dados;
	}
	
	
	
	/*	==================================================================================================================	*/
	#	REMOVE UM ITEM
	/*	==================================================================================================================	*/
	public function del_item($idexcluir)
	{
		unset($_SESSION[produtos][$idexcluir]);
		sort($_SESSION[produtos]);
	}
	
	
	
	/*	==================================================================================================================	*/
	#	ATUALIZA OS ITENS DO CARRINHO
	/*	==================================================================================================================	*/
	public function atualiza_carrinho($idexcluir)
	{
		unset($_SESSION[produtos][$idexcluir]);
		sort($_SESSION[produtos]);
	}




	public function verifica_login()
	{
		
		$obj_usuario = new Usuario_Model();
		
		//	VERIFICO SE O USUARIO ESTÁ LOGADO
		$obj_usuario->verifica_login_usuario();
		
	}



	/*	==================================================================================================================	*/
	/*	BUSCA DADOS PRODUTO 	*/
	/*	==================================================================================================================	*/
	public function get_produtos($idproduto)
	{

		$idproduto = Util::trata_dados_formulario($idproduto);
		
		
		// BUSCO O PRODUTO
		$result = parent::executaSQL("SELECT * FROM tb_produtos WHERE idproduto = '$idproduto' ");
		
		
		if(mysql_num_rows($result) > 0):
		
			$dados = mysql_fetch_array($result);
			return $dados;
			
		else:
		
			return false;
		
		endif;
		
	}



	/*	==================================================================================================================	*/
	/*	BUSCA DADOS PRODUTO 	*/
	/*	==================================================================================================================	*/
	public function get_frete($id)
	{

		$id = Util::trata_dados_formulario($id);
		
		
		// BUSCO O PRODUTO
		$result = parent::executaSQL("SELECT * FROM tb_fretes WHERE idfrete = '$id' ");
		
		
		if(mysql_num_rows($result) > 0):
		
			$dados = mysql_fetch_array($result);
			return $dados;
			
		else:
		
			return false;
		
		endif;
		
	}
	
	
	
	
	
	/*	==================================================================================================================	*/
	/*	BUSCA O VALOR DA COMPRA 	*/
	/*	==================================================================================================================	*/
	public function get_total_venda($idvenda)
	{
		
		//	DADOS DA VENDA
		$dados_venda = $this->get_dados_venda($idvenda);
		
		//	FRETE
		$frete = $this->get_frete($dados_venda[id_frete]);
		
		//	BUSCO OS PRODUTOS
		$result = $this->get_produtos_venda($idvenda);
		
		if(mysql_num_rows($result) > 0):
		
			while($row = mysql_fetch_array($result)):
				
				$total_produtos += $row[valor] * $row[qtd];
			
			endwhile;
		
		endif;
		
		return $total_produtos + $frete[valor];
		
		
	}
	
	
	
	
	
	
	/*	==================================================================================================================	*/
	/*	FINALIZA VENDA 	*/
	/*	==================================================================================================================	*/
	public function finaliza_venda($tipo_pagamento)
	{
		
		$venda =  $this->cadastra_venda($tipo_pagamento);	
		
		
		//	EMAIL VENDA
		$this->email_venda($tipo_pagamento, $venda);
		
		
		//	VERIFICO O TIPO DE PAGAMENTO
		if($tipo_pagamento == 'deposito'):
			
			
			//	LIMPA O CARRINHO
			unset($_SESSION[produtos]);
			unset($_SESSION[entrega]);
			
		
			return "
					<p><h2>Obrigado pela compra.</h2></p>
					<p>Número do seu pedido: <strong>$venda[id]</strong></p>
					<p>Pedido realizado dia $venda[data] às $venda[hora]</p>
					<p>Foi enviado um email para ".$_SESSION[usuario][email]." com mais informações.</p>
					<br>
					<a href='". Util::caminho_projeto().'/meus-pedidos' ."' title='Meus Pedidos'>
						<h2>Clique aqui para ver seus pedidos.</h2>
					</a>
					<br>
					
					";
		
		else:
			
			$this->envia_pagamento_pagseguro($venda);
			
		endif;
		
		
		//	LIMPA O CARRINHO
		unset($_SESSION[produtos]);
		unset($_SESSION[entrega]);
		
	}
	
	
	
	/*	==================================================================================================================	*/
	/*	ENVIA O PAGAMENTO PARA PAGSEGURO 	*/
	/*	==================================================================================================================	*/
	public function envia_pagamento_pagseguro($venda)
	{
		
		//	DADOS DA EMPRESA
		$dados_empresa = $this->get_dados_empresa();
		
		?>	
		
        
        <!-- Declaração do formulário -->  
		<form  method="post" action="https://pagseguro.uol.com.br/v2/checkout/payment.html">  
                  
                <!-- Campos obrigatórios -->  
                <input type="hidden" name="receiverEmail" value="<?php Util::imprime($dados_empresa[email]) ?>">  
                <input type="hidden" name="currency" value="BRL">  
                  
                  
                <!-- Itens do pagamento (ao menos um item é obrigatório) -->  
                <?php
				//	CADASTRO OS PRODUTO
				if(count($_SESSION[produtos]) > 0):
					
					$i = 1;
					
					foreach($_SESSION[produtos] as $produto):
					?>
                    	<input type="hidden" name="itemId<?php echo $i ?>" value="<?php Util::imprime($produto[idproduto]) ?>">  
                        <input type="hidden" name="itemDescription<?php echo $i ?>" value="<?php echo($produto[titulo]) ?>">  
                        <input type="hidden" name="itemAmount<?php echo $i ?>" value="<?php echo Util::formata_moeda($produto[preco], 'pagseguro') ?>">  
                        <input type="hidden" name="itemQuantity<?php echo $i ?>" value="<?php Util::imprime($produto[qtd]) ?>">  
                        <input type="hidden" name="itemWeight<?php echo $i ?>" value="1000">
                    <?php
						
						$i++;
					
					endforeach;
					
				endif;
				?>
                
                
                <!--	FRETE	-->
                <input type="hidden" name="itemId<?php echo $i ?>" value="<?php Util::imprime($venda[id]) ?>">  
                <input type="hidden" name="itemDescription<?php echo $i ?>" value="Frete para <?php echo Util::troca_value_nome($_SESSION[entrega][bairro], "tb_fretes", "idfrete", "titulo") ?>">  
                <input type="hidden" name="itemAmount<?php echo $i ?>" value="<?php echo Util::formata_moeda($venda[frete], 'pagseguro') ?>">  
                <input type="hidden" name="itemQuantity<?php echo $i ?>" value="1">  
                <input type="hidden" name="itemWeight<?php echo $i ?>" value="1000">
                
                
                  
                  
                <!-- Código de referência do pagamento no seu sistema (opcional) -->  
                <input type="hidden" name="reference" value="<?php Util::imprime($venda[id]) ?>">  
                
                  
                <!-- Informações de frete (opcionais) -->  
			    <?php /*?>
                <input type="hidden" name="shippingType" value="1">  
                <input type="hidden" name="shippingAddressPostalCode" value="">  
                <input type="hidden" name="shippingAddressStreet" value="<?php Util::imprime($_SESSION[entrega][endereco]) ?>">  
                <input type="hidden" name="shippingAddressNumber" value="<?php Util::imprime($_SESSION[entrega][numero]) ?>">  
                <input type="hidden" name="shippingAddressComplement" value="<?php Util::imprime($_SESSION[entrega][complemento]) ?>">  
                <input type="hidden" name="shippingAddressDistrict" value="<?php Util::imprime($_SESSION[entrega][bairro]) ?>">  
                <input type="hidden" name="shippingAddressCity" value="Brasília">  
                <input type="hidden" name="shippingAddressState" value="DF">  
                <input type="hidden" name="shippingAddressCountry" value="BRA">  
                <?php */?>
                  
                <!-- Dados do comprador (opcionais) -->  
                <input type="hidden" name="senderName" value="<?php Util::imprime($_SESSION[usuario][nome]) ?>">  
                <input type="hidden" name="senderAreaCode" value="<?php echo substr($_SESSION[usuario][tel_celular], 0, 2) ?>">  
                <input type="hidden" name="senderPhone" value="<?php echo substr($_SESSION[usuario][tel_celular], -3) ?>">  
                <input type="hidden" name="senderEmail" value="<?php Util::imprime($_SESSION[usuario][email]) ?>">  
                  
                <!-- submit do form (obrigatório) -->  
<?php /*?>                <input type="image" name="submit" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/120x53-pagar.gif" alt="Pague com PagSeguro">  
<?php */?>                  
            </form>  
            
            
            
            
            <div style="font-size: large; text-align: center;"> <p>Você vai ser direcionado ao <b>PagSeguro</b> para efetuar o pagamento em <span id="counter"></span> segundos.</div></p> <br/>
              <br/>
              <a href="javascript:document.forms[0].submit();" id="xy" ><h2>Clique aqui se a pagina não redirecionar automaticamente.</h2></a> </div>
            <div style="text-align: center;"> </div>
            <div style="font-size: large; text-align: center;"></div>
            
            
            <script type="text/javascript">         
                var cntr = 7;         
                function tick() 
                {             
                    document.getElementById("counter").innerHTML = cntr--;             
                    
                    if (cntr > 0) 
                    {                 
                        setTimeout(tick, 1000);             
                    } else {                 
                        document.forms[0].submit();             
                    }
                }
                        
                    tick();     
            
            </script>
            
            
            
            
            
            
        
    <?php
	}
	
	
	
	public function get_dados_empresa()
	{
		//	DADOS DA EMPRESA
		$sql = "SELECT * FROM tb_configuracoes WHERE idconfiguracao = '1' AND ativo = 'SIM'";
		$result = parent::executaSQL($sql);
		return mysql_fetch_array($result);	
	}
	
	
	
	public function get_dados_venda($idvenda)
	{
		//	DADOS DA EMPRESA
		$sql = "SELECT * FROM tb_vendas WHERE idvenda = '$idvenda'";
		$result = parent::executaSQL($sql);
		return mysql_fetch_array($result);	
	}
	
	
	public function get_produtos_venda($idvenda)
	{
		//	DADOS DA EMPRESA
		$sql = "SELECT * FROM tb_vendas_produtos WHERE id_venda = '$idvenda'";
		return parent::executaSQL($sql);
		
	}
	
	
	
	
	/*	==================================================================================================================	*/
	/*	ENVIA A MSG VENDA 	*/
	/*	==================================================================================================================	*/
	public function email_venda($tipo_pagamento, $venda)
	{
		
		//	DADOS DA EMPRESA
		$dados_empresa = $this->get_dados_empresa();
		
		
		//	PEGO A MENSAGEM CASO O TIPO DE PAGAMENTO SEJA DEPOSITO
		if($tipo_pagamento == 'deposito'):
			
			$msg_deposito = $dados_empresa[msg_deposito_bancario];
		
		else:
			
			$msg_deposito = "PagSeguro";
			
		endif;
		
		
		
		
		$msg = '
				Floricultura Beija-Flor <br>
				------------------------------------------------------ <br>
				Numero do pedido: '.$venda[id].' <br>
				Data: '.$venda[data].' às '.$venda[hora].'<br>
		
				<br><br>	
				Produtos<br>
				------------------------------------------------------<br>
				
				<br><br>
				<table width="100%" border="1" cellspacing="5" cellpadding="5">
					  <tr>
						<td>PRODUTO</td>
						<td align="right">QTD</td>
						<td align="right">TOTAL</td>
					  </tr>
						
					  '. $venda[msg_produtos] .'
					
					  <tr>
						<td>Frete</td>
						<td align="right">1</td>
						<td align="right">R$ '. Util::formata_moeda($venda[frete]) .'</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td>Total</td>
						<td align="right">R$ '. Util::formata_moeda($venda[total]) .'</td>
					  </tr>
					</table>
				
				
				
				<br><br>			
				Endereço de Entrega <br>
				------------------------------------------------------ <br>
				Bairro: '. Util::troca_value_nome($_SESSION[entrega][bairro], "tb_fretes", "idfrete", "titulo") .'<br>
				Endereço: '.Util::trata_dados_formulario($_SESSION[entrega][endereco]).' <br>
				Número: '.Util::trata_dados_formulario($_SESSION[entrega][numero]).'<br>
				Complemento: '.Util::trata_dados_formulario($_SESSION[entrega][complemento]).'<br>
				Nome do contato: '.Util::trata_dados_formulario($_SESSION[entrega][nome_contato]).'<br>
				Telefone do contato: '.Util::trata_dados_formulario($_SESSION[entrega][telefone_contato]).'<br>
				
				<br><br>
				Forma de pagamento<br>
				------------------------------------------------------<br>
				'.$msg_deposito.'
				
				<br>
				
				';
			
		
		//	ENVIO A MENSAGEM PARA O USUARIO
		Util::envia_email($_SESSION[usuario][email], "Floricultura Beija Flor: Pedido Nr. $venda[id]", $msg, 'Floricultura Beija Flor', $dados_empresa[email]);
		
		
		//	ENVIO A MENSAGEM PARA A EMPRESA
		Util::envia_email($dados_empresa[email], "Floricultura Beija Flor: Pedido Nr. $venda[id]", $msg, $dados_empresa[nome], $_SESSION[usuario][email]);
		
		
		
		
		
		
	}
	
	
	
	
	
	
	
	


	/*	==================================================================================================================	*/
	/*	CADASTRA NA TABELA 	*/
	/*	==================================================================================================================	*/
	public function cadastra_venda($tipo_pagamento)
	{
		
		$dados[id_usuario]			=	Util::trata_dados_formulario($_SESSION[usuario][idusuario]); 
		$dados[data]				=	date("d/m/Y"); 
		$dados[hora]				=	date("H:i");
		$dados[mensagem_cartao]		=	Util::trata_dados_formulario($_SESSION[entrega][mensagem]);
		$dados[id_frete]			=	Util::trata_dados_formulario($_SESSION[entrega][bairro]); 
		$dados[endereco]			=	Util::trata_dados_formulario($_SESSION[entrega][endereco]); 
		$dados[numero]				=	Util::trata_dados_formulario($_SESSION[entrega][numero]); 
		$dados[complemento]			=	Util::trata_dados_formulario($_SESSION[entrega][complemento]);
		$dados[nome_contato]		=	Util::trata_dados_formulario($_SESSION[entrega][nome_contato]);
		$dados[telefone_contato]	=	Util::trata_dados_formulario($_SESSION[entrega][telefone_contato]);
		$dados[tipo_pagamento] 		= 	$tipo_pagamento; 
		
		
		//	CADASTRO NA TABELA DE VENDAS
		$vendas[id] = parent::insert('tb_vendas', $dados);
		
		
		//	CADASTRO OS PRODUTO
		if(count($_SESSION[produtos]) > 0):
			
			foreach($_SESSION[produtos] as $produto):
				
			
				
				$sql = "INSERT INTO tb_vendas_produtos 
						(id_venda, id_produto, valor, qtd, titulo)
						VALUES
						('$vendas[id]', '$produto[idproduto]', '$produto[preco]', '$produto[qtd]', '$produto[titulo]')
						";
				parent::executaSQL($sql);
				
				$total += $produto[preco] * $produto[qtd];
				
				
				#	=====================================================	#
				#	MENSAGEM DOS PRODUTOS
				#	=====================================================	#
				$vendas[msg_produtos] .= 
				"
				  <tr>
					<td>". $produto[titulo] ."</td>
					<td align='right'>". $produto[qtd] ."</td>
					<td align='right'>R$ ". Util::formata_moeda($produto[preco]) ."</td>
				  </tr>
				";
				
				
				
				
			endforeach;
			
		endif;
		
		
		//	CALCULO O VALOR DO FRETE
		$frete = $this->get_frete($dados[id_frete]);
		$vendas[frete] = $frete[valor];
		$vendas[total_produtos] = $total;
		$vendas[total] = $vendas[frete] + $vendas[total_produtos];
		$vendas[data]	= $dados[data];
		$vendas[hora]	= $dados[hora];
		
		
		return $vendas;
		
		
			
	}

	
	
	
	


}








?>





















