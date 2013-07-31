<?php
require_once("../../class/Include.class.php");
require_once("Venda_Model.php");
require_once("../trava.php");

$obj_control = new Venda_Model();


if(isset($_POST[action]))
{
	$obj_control->atualiza_status($_POST[id], $_POST[status_venda]);
	Util::script_msg("Dados alterado com sucesso.");
	Util::script_location("lista.php");
}



$dados = $obj_control->select($_GET[id]);




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" href="../css/style.css" type="text/css" media="all"/>
    <?php require_once("../includes/head.php"); ?>    
</head>



<body>


<!-- ============================= CONTAINER =================================== -->
<div id="container">
	
    
    <!-- ============================= CONTAINER LATERAL =================================== -->
    <?php require_once("../includes/lateral.php") ?>
    <!-- ============================= CONTAINER LATERAL =================================== -->
    
    
    <!-- ============================= CONTAINER CONTEUDO =================================== -->
    <div id="container-conteudo">
    	
        <!-- ============================= CONTAINER CONTEUDO TOPO =================================== -->
        <?php require_once("../includes/topo.php") ?>
        <!-- ============================= CONTAINER CONTEUDO TOPO =================================== -->
        
        
        
        
        
        <!-- ============================= CONTAINER CONTEUDO HOLDER =================================== -->
        <div id="container-conteudo-holder">
        	
            <div class="titulo-pags">
            	Detlahes da venda
            </div>
             <div class="holder-erro">
                <ul>
                    <?php echo $msn ?>
                </ul>
            </div>
            
            
            
            
            <div class="class-form-2">
				
                <ul>
                    <li>
                        <h2>Codigo da venda</h2>
                        <p><?php Util::imprime($dados[idvenda]) ?></p>
                    </li>
                    <li>
                        <h2>Cliente</h2>
                        <p><?php Util::imprime( Util::troca_value_nome($dados[id_usuario], 'tb_usuarios', 'idusuario', 'nome') ); ?></p>
                    </li>
                    <li>
                        <h2>Data</h2>
                        <p><?php echo Util::formata_data($dados[data]) ?></p>
                    </li>
                    <li>
                        <h2>Hora</h2>
                        <p><?php Util::imprime($dados[hora], 5) ?></p>
                    </li>
                	<li>
                		<h2>Bairro</h2>
                        <p><?php Util::imprime( Util::troca_value_nome($dados[id_frete], 'tb_fretes', 'idfrete', 'titulo') ); ?></p>
                    </li>
                    <li>
                        <h2>Endereço</h2>
                        <p><?php Util::imprime($dados[endereco]) ?></p>
                    </li>
                    <li>
                        <h2>Número</h2>
                        <p><?php Util::imprime($dados[numero]) ?></p>
                    </li>
                    <li>
                        <h2>Complemento</h2>
                        <p><?php Util::imprime($dados[complemento]) ?></p>
                    </li>
                    <li>
                        <h2>Nome do contato</h2>
                        <p><?php Util::imprime($dados[nome_contato]) ?></p>
                    </li>
                    <li>
                        <h2>Telefone do contato</h2>
                        <p><?php Util::imprime($dados[telefone_contato]) ?></p>
                    </li>
                </ul>
                
            </div>
            
            
            <div class="class-form-2">
				
                <ul>
                    <li>
                    	<h2>Mensagem do cartão</h2>
                        <p><?php Util::imprime($dados[mensagem_cartao]) ?></p>
                    </li>
                </ul>
            </div>
          
            
            <br />
            <h1>Produtos</h1>
            
           
            
            <table cellpadding="5" cellspacing="5" id="tabela_pedidos" style="width:90%" >
                <tr>
                    <th align="left"><p>Descrição</p></th>
                  <th align="right"><p>Quantidade</p></th>
                  <th align="right"><p>Valor</p></th>
                </tr>
                
                
        
                <?php
                $result = $obj_control->executaSQL("SELECT * FROM tb_vendas_produtos WHERE id_venda = '$_GET[id]'");
                while($row = mysql_fetch_array($result)):
                ?>	
                    <tr>
                        <td  style="border-bottom:1px solid #000;"><p><?php Util::imprime($row[titulo]) ?></p></td>
                        <td  style="border-bottom:1px solid #000;" align="right"><p><?php  Util::imprime($row[qtd]) ?></p></td>
                      	<td  style="border-bottom:1px solid #000;" align="right"><p>R$ <?php echo Util::formata_moeda($row[valor]);  ?></p></td>
                    </tr>
                <?php
                endwhile;
                ?>
                            
                  
                    
            </table>
            
            
            
            <br /><br />
            <h1>Status da venda</h1>
            
            
            <form method="post" name="form_envia" >

            
                <div class="class-form-2">
                    
                    <ul>
                        <li>
                            <?php Util::status_venda('status_venda', $dados[status_venda]) ?>
                        </li>
                    </ul>
                    
                </div>
				
                
                <div class="holder-btns"  style="margin:20px 0px 20px 0px;">
                	<input type="hidden" name="id" value="<?php echo $_GET[id] ?>"  />
                    <input type="hidden" name="action" id="action" value="cadastra" />
                    <input type="image" name="btn_enviar" src="../imgs/btn-enviar.jpg" alt="Cadastar" />
                </div>
                
                
            
            </form>
            
        
</div>
        <!-- ============================= CONTAINER CONTEUDO HOLDER =================================== -->
        
    	
    
    
    
    </div>
    <!-- ============================= CONTAINER CONTEUDO =================================== -->


</div>
<!-- ============================= CONTAINER =================================== -->


</body>
</html>