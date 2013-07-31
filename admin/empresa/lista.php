<?php
require_once("../../class/Include.class.php");
require_once("Empresa_Model.php");
require_once("../trava.php");

$obj_control = new Empresa_Model();
$obj_site = new Site();
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
            	LISTAGEM
            </div>
            
            
            
            <?php
			$result = $obj_control->select();
			
			
			
			if(mysql_num_rows($result) == 0)
			{
				echo "<h1>Nenhum resultado cadastrado</h1>";	
			}
			else
			{
			?>
            
            <form action="" method="post" name="form_listagem" id="form_listagem" enctype="multipart/form-data">
                <div class="tabela-holder">
                
                    <table cellpadding="2" cellspacing="3"> 
                        <thead> 
                            <tr>
                                <th width="34">COD</th>
                                <th width="469">TÍTULO</th>
                                <?php /*?><th width="200">GALERIA AMBIENTE INTERNO</th>
                                <th width="200">GALERIA AMBIENTE EXTERNO</th><?php */?>
                                <?php /*?><th width="47">ALBUM</th><?php */?>
                                <?php /*?><th width="47">EXIBIR</th> <?php */?>
                                <th width="41">EDITAR</th> 
                                <?php /*?><th width="54">DELETAR</th><?php */?>
                            </tr> 
                        </thead> 
                        <tbody> 
                           <?php
                           while($row = mysql_fetch_array($result))
                           {
                           ?>
                            <tr>
                              <td class="titulo-componente-tabela"><?php Util::imprime($row[0]); ?></td>
                              <td class="titulo-componente-tabela">
								  <?php Util::imprime($row[titulo]); ?>
                                </td>
                                
                                <?php /*?><td align="center">
                                	<?php
									$idtabela = "";
									$tamanho_max_arquivo = 5000;
								    $qtd_max_imgs = 1000;
								    $title = 'Enviar imagens para o album';
								  	$nome_tabela = 'tb_galerias_ambiente_interno';
								    $nome_chave_estrangeira	= 'id_interno';
								  	$nome_campo = 'imagem';
								  	$tamanho_imagem = 1920;
								  	$tamanho_tumb = 130;
									?>
                                
                                    <a href="envia_imagens.php?id=<?php echo $row[0]; ?>&tamanho_max_arquivo=<?php echo $tamanho_max_arquivo; ?>&qtd_max_imgs=<?php echo $qtd_max_imgs; ?>&nome_tabela=<?php echo $nome_tabela; ?>&nome_campo=<?php echo $nome_campo; ?>&nome_chave_estrangeira=<?php echo $nome_chave_estrangeira; ?>&tamanho_imagem=<?php echo $tamanho_imagem; ?>&tamanho_tumb=<?php echo $tamanho_tumb; ?>">
                                        <img src="../imgs/galeria.png" border="0" title="<?php echo $title; ?>" />
                                    </a>
                                </td>
                                
                                
                                <td align="center">
                                	<?php
									$idtabela = "";
									$tamanho_max_arquivo = 5000;
								    $qtd_max_imgs = 1000;
								    $title = 'Enviar imagens para o album';
								  	$nome_tabela = 'tb_galerias_ambiente_externo';
								    $nome_chave_estrangeira	= 'id_externo';
								  	$nome_campo = 'imagem';
								  	$tamanho_imagem = 1920;
								  	$tamanho_tumb = 130;
									?>
                                
                                    <a href="envia_imagens.php?id=<?php echo $row[0]; ?>&tamanho_max_arquivo=<?php echo $tamanho_max_arquivo; ?>&qtd_max_imgs=<?php echo $qtd_max_imgs; ?>&nome_tabela=<?php echo $nome_tabela; ?>&nome_campo=<?php echo $nome_campo; ?>&nome_chave_estrangeira=<?php echo $nome_chave_estrangeira; ?>&tamanho_imagem=<?php echo $tamanho_imagem; ?>&tamanho_tumb=<?php echo $tamanho_tumb; ?>">
                                        <img src="../imgs/galeria.png" border="0" title="<?php echo $title; ?>" />
                                    </a>
                                </td>
                                <?php */?>
                                <?php /*?><td align="center">
                                	<?php
									if($row[ativo] == 'NAO')
									{
										$titulo = "Desativar";
									}
									else
									{
										$titulo = "Ativar";
									}
									?>
                                
                                	<a href="ativa_desativa.php?action=ativar_desativar&id=<?php Util::imprime($row[0]); ?>&ativo=<?php Util::imprime($row[ativo]); ?>" title="<?php Util::imprime($titulo); ?>">
	                                    <img src="../imgs/Comment-<?php echo ($row['ativo'] == "NAO" ? 'remove':'add') ?>-64.jpg" alt="<?php Util::imprime($titulo); ?>" />
                                    </a>
                                </td> <?php */?>
                                
                                <td align="center">
                                    <a href="altera.php?action=alterar&id=<?php Util::imprime($row[0]); ?>" title="Editar">
                                        <img src="../imgs/Comment-edit-64.jpg" alt="Editar" />
                                    </a>
                                </td> 
                                <?php /*?><td align="center">
                                	<a href="exclui.php?id=<?php Util::imprime($row[0]); ?>" title="Deletar">
                                    	<img src="../imgs/Comment-delete-64.jpg" alt="Deletar" />
                                    </a>
                                </td><?php */?>
                            </tr>
                            <?php
                           }
                            ?>
                        </tbody> 
                    </table> 
        </div>
                
                <div class="tabela-fundo">
                    &nbsp;
                </div>
            
            </form>
            <?php
			}
			?>
            
	  </div>
        <!-- ============================= CONTAINER CONTEUDO HOLDER =================================== -->
        
    </div>
    <!-- ============================= CONTAINER CONTEUDO =================================== -->
</div>
<!-- ============================= CONTAINER =================================== -->


</body>
</html>