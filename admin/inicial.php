<?php
require_once("../class/Include.class.php");
require_once("./vendas/Venda_Model.php");
require_once("trava.php");
$obj_control = new Venda_Model();

//	BUSCA OS DADOS DO ANALYTICS
// Autenticação
//$obj_google_analytics = new Gapi(EMAIL_GOOGLE_ANALYTICS, SENHA_GOOGLE_ANALYTICS);


// Define o periodo do relatório
$inicio = date('Y-m-01', strtotime('-1 month')); // 1° dia do mês passado
$fim = date('Y-m-t', strtotime('-1 month')); // Último dia do mês passado

// Busca os pageviews e visitas (total do mês passado)
//$obj_google_analytics->requestReportData(ID_GOOGLE_ANALYTICS, 'month', array('pageviews', 'visits', 'pageviews'), null, null, $inicio, $fim);




//	BUSCA AS VISITAS E OS PAGEVIEW
/*foreach ($obj_google_analytics->getResults() as $dados) {
  $dados_analytics[visitas] = $dados->getVisits();
  $dados_analytics[pageview] = $dados->getPageviews();
}*/
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all"/>


    <script language="javascript" type="text/javascript" src="<?php echo Util::caminho_projeto(); ?>/jquery/flot/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo Util::caminho_projeto(); ?>/jquery/flot/jquery.flot.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo Util::caminho_projeto(); ?>/jquery/flot/jquery.flot.time.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo Util::caminho_projeto(); ?>/jquery/flot/jquery.flot.selection.js"></script>



<title>Admin - <?php echo $_SERVER['SERVER_NAME'] ?></title>
</head>

<body>
<!-- ============================= CONTAINER =================================== -->
<div id="container">
	
    
    <!-- ============================= CONTAINER LATERAL =================================== -->
    <?php require_once("includes/lateral.php") ?>
    <!-- ============================= CONTAINER LATERAL =================================== -->
    
    
    <!-- ============================= CONTAINER CONTEUDO =================================== -->
    <div id="container-conteudo">
    	
        <!-- ============================= CONTAINER CONTEUDO TOPO =================================== -->
        <?php require_once("includes/topo.php") ?>
        <!-- ============================= CONTAINER CONTEUDO TOPO =================================== -->
        
        
        <!-- ============================= CONTAINER CONTEUDO HOLDER =================================== -->
        <div id="container-conteudo-holder">
        	
            <!-- Acesso rápido -->
            <div class="acesso-rapido">
                <div class="titulo-pags">
					ACESSO RÁPIDO
				</div>
                
                <ul class="options_admin">
                	<li>
                    	<a href="<?php echo Util::caminho_projeto() ?>/" title="Home">
                        	<img src="imgs/home.jpg" alt="Home">
                            <p>Início</p>
                        </a>
                    </li>
                    <li>
                    	<a href="<?php echo Util::caminho_projeto() ?>/admin/login/altera_senha.php" title="Alterar Senha">
                        	<img src="imgs/alterar_senha.png" alt="Alterar Senha">
                            <p>Alterar Senha</p>
                        </a>
                    </li>
                    
                    <li>
                    	<a href="<?php echo Util::caminho_projeto() ?>/admin/login/lista.php" title="Usuários">
                        	<img src="imgs/usuario.png" alt="Usuários">
                            <p>Usuários</p>
                        </a>
                    </li>
                    <li>
                    	<a href="<?php echo Util::caminho_projeto() ?>/admin/logoff.php" title="Sair">
                        	<img src="imgs/sair.png" alt="Sair">
                            <p>Sair</p>
                        </a>
                    </li>
                </ul>
                
                
                
                
                <div class="titulo-pags" style="margin-top:30px;">
                    ÚLTIMAS VENDAS
                </div>
                
                
                
				
                
                
                <?php
			$result = $obj_control->executaSQL("SELECT * FROM tb_vendas WHERE status_venda = 'AGUARDANDO PAGAMENTO' ORDER BY data DESC, hora DESC LIMIT 50");
			
			
			
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
                                <th width="34">COD VENDA</th>
                                <th width="469">CLIENTE</th>
								<th width="49">DATA</th>
                                <th width="49">HORA</th>
                                <th width="49">STATUS</th>
                                <th width="47">DETALHE</th>
                            </tr> 
                        </thead> 
                        <tbody> 
                           <?php
                           while($row = mysql_fetch_array($result))
                           {
                           ?>
                            <tr>
								<td class="titulo-componente-tabela">
								  <?php Util::imprime($row[0]); ?>
                              </td>
								
                                
                              <td class="titulo-componente-tabela">
								  <?php Util::imprime( Util::troca_value_nome($row[id_usuario], 'tb_usuarios', 'idusuario', 'nome') ); ?>
                              </td>
                                
                                
                                <td class="titulo-componente-tabela">
								  <?php echo Util::formata_data($row[data]); ?>
                                </td>
                                
                                
                                <td align="center" class="titulo-componente-tabela">
								  <?php Util::imprime($row[hora], 5); ?>
                                </td>
                                
                                
                                
                                <td align="center">
                                	<?php Util::imprime($row[status_venda]); ?>
                                </td>
								
                                
                                
                                <td align="center">
                                	<a href="./vendas/detalhe.php?id=<?php Util::imprime($row[0]); ?>" title="Detalhe">
                                    	<img src="./imgs/detalhe.png" alt="Detalhe" width="36" />
                                    </a>
                                </td>
								
								
								
                              
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
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                <?php
					/*
                
                <div style="width:100%; overflow:hidden; padding-bottom:20px;">
                    <h1 style="float:left;"><span><?php echo  $dados_analytics[visitas]; ?></span> visitas</h1>
                    <h1 style="float:right;"><span><?php echo $dados_analytics[pageview]; ?></span> paginas visualizadas</h1>
                    
                </div>
                
                
                
                <div class="titulo-pags">
					GRÁFICO DE ACESSO
				</div>
                
                
               
                
                
                
					
					// Busca os pageviews e visitas de cada dia do último mês
                    $obj_google_analytics->requestReportData(ID_GOOGLE_ANALYTICS, 'day', array('pageviews', 'visits'), 'day', null, $inicio, $fim, 1, 50);
                    foreach ($obj_google_analytics->getResults() as $dados) {
                      ++$i;
					  
					
					  $dados_analyticas_grafico[$i][dia] = $dados;
					  $dados_analyticas_grafico[$i][visitas] = $dados->getVisits();
					  $dados_analyticas_grafico[$i][pageview] = $dados->getPageviews();
					  //echo 'Dia ' . $dados . ': ' . $dados->getVisits() . ' Visita(s) e ' . $dados->getPageviews() . ' Pageview(s)<br />';
                    }					
					
					foreach($dados_analyticas_grafico as $dado)
					{
						$dia[] = $dado[dia];
					
					}
					
					
					foreach($dados_analyticas_grafico as $dado)
					{
						$visita[] = $dado[visitas];
					
					}*/
					?>
                                
                          
                   
                    
                   
                   
                   
                  
                   <div>
                   
                        <div id="placeholder" style="width:690px;height:300px;"></div>
						<div id="overview" style="margin-left:50px;margin-top:20px;width:400px;height:50px"></div>
                    
						<script id="source" type="text/javascript" language="javascript">
                        $(function () {
                            
                            <?php
                            if(count($dia) > 0):
                            
                                for($i=0; $i < count($dia); $i++):
                                    $grafico .= "[$dia[$i], $visita[$i]],";
                                endfor;	
                                
                                $grafico = substr($grafico, 0, -1);
                                
                            endif;
                            
                    
                            ?>
                            
                            var data = [ <?php echo $grafico; ?> ];
        
                            $.plot($("#placeholder"), [ data ], {
                                series: {
                                    bars: {
                                        show: true,
                                        barWidth: 0.6,
                                        align: "center" }
                                },
                                xaxis: {
                                    mode: "categories",
                                    tickLength: 0
                                }
                            });
                        });
                        </script>
                    </div>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                
                
            </div>
            <!-- Acesso rápido -->
            
            
            
            
        
        </div>
        <!-- ============================= CONTAINER CONTEUDO HOLDER =================================== -->
        
    	
    
    
    
    </div>
    <!-- ============================= CONTAINER CONTEUDO =================================== -->


</div>
<!-- ============================= CONTAINER =================================== -->
</body>
</html>