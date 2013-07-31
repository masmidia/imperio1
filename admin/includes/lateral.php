<div id="container-lateral">
    	<div id="container-lateral-logo">
        	<a href="<?php echo Util::caminho_projeto()?>/admin/inicial.php" title="Administração do site" id="btn-logo"><span>Administração do site</span></a>
        </div>
    	<!-- MENU LATERAL -->
        <div id="container-lateral-menu">
        	<ul>
            	<!-- item menu -->
                <li>
                	<?php
					//	BUSCO NO ARRAY PARA VERIFICAR SE ENCONTRO A PERMISSAO
					$b = 0;
					$categoria_menu_old = '';
					foreach($_SESSION['permissoes'] as $permissao)
					{
						
						$categoria_menu = $permissao['nome_modulo_pagina'];
						
						if($categoria_menu != $categoria_menu_old)
						{
						?>
                        	<div class="holder-topo-menu-1">
                                <h1><?php Util::imprime($permissao['nome_modulo_pagina']); ?></h1>
                            </div>
                        <?php
						}
							if($permissao['exibir_menu'] == 'SIM')
							{
					?>		
                                <ul>
                                    <li>
                                        <a href="<?php echo Util::caminho_projeto() ?><?php Util::imprime($permissao['pagina']); ?>" title="<?php Util::imprime($permissao['label']); ?>">
                                            <?php Util::imprime($permissao['label']); ?>
                                        </a>
                                    </li>
                                </ul>
                    <?php	
							}
						$categoria_menu_old = $categoria_menu;
					}
					?>                    
                </li>
                <!-- item menu -->
                
                
                
            </ul>
        </div>
        <!-- MENU LATERAL -->
    </div>