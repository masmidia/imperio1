<?php 
require_once('Dao.class.php');
require_once('Util.class.php');

class Paginacao extends Dao
{
	public function get_paginacao_registro($pagina, $maximo_registro, $campos_sql, $final_sql)
	{
		// Declaração da pagina inicial  
		if($pagina == "") {  
			$pagina = "1";  
		} 
		
	
		// Calculando o registro inicial  
		$inicio = $pagina - 1;  
		$inicio = $maximo_registro * $inicio;
		
		
		
		// Conta os resultados no total da minha query  
		$sql = "SELECT COUNT(*) AS 'numero_registros' $final_sql";  
		$result = parent::executaSQL($sql);
		$row = mysql_fetch_array($result);  
		$total = $row["numero_registros"];
		
		//	VERIFICO SE RETORNOU ALGO
		if($total<=0) 
		{  
			$sql = "SELECT $campos_sql $final_sql LIMIT $inicio, $maximo_registro";  
			$result = parent::executaSQL($sql);	
			return $result;
		} 
		else 
		{  
			$sql = "SELECT $campos_sql $final_sql LIMIT $inicio, $maximo_registro";  
			$result = parent::executaSQL($sql);	
			return $result;
		}		
	}
	
	
	
	
	public function html_links_paginacao($pagina, $maximo_registro, $final_sql, $complemento_link)
	{
		// verificio se é a primeira pagina
		if($pagina == "") {  
			$pagina = "1";  
		} 
		
		// Conta os resultados no total da minha query  
		$sql = "SELECT COUNT(*) AS 'numero_registros' $final_sql";  
		$result = parent::executaSQL($sql);
		$row = mysql_fetch_array($result);  
		$total = $row["numero_registros"];
		
		
		// Calculando pagina anterior  
		$menos = $pagina - 1;  
	
		// Calculando pagina posterior  
		$mais = $pagina + 1;
	
		// Retorna o próximo maior valor inteiro arredondando para cima
		$pgs = ceil($total / $maximo_registro);  
		
		if($pgs > 1 ) {  
			
			
			
			$html .= '<div align=center> <ul>';				
				// Mostragem de pagina  
				if($menos > 0) {  
				   $html .= "<li><a href=\"?pagina=$menos$complemento_link\" >Anterior</a></li> ";  
				}  
				// Listando as paginas  
				for($i=1;$i <= $pgs;$i++) {  
					if($i != $pagina) {  
					   $html .= "  <li><a href=\"?pagina=".($i)."$complemento_link\" >$i</a></li>";  
					} else {  
						$html .= "  <li class='selected'>".$i."</li>";  
					}  
				}  
				if($mais <= $pgs) {  
				   $html .= "   <li><a href=\"?pagina=$mais$complemento_link\" >proxima</a></li>";  
				}  		
			$html .= '</ul> </div>';
			
		}
		
		return $html;
	}
	
	
	
	
	public function get_links_paginacao($pagina, $maximo_registro, $final_sql, $complemento_link = '', $listar_pagina = 'SIM')
	{
		// verificio se é a primeira pagina
		if($pagina == "") {  
			$pagina = "1";  
		} 
		
		// Calculando o registro inicial  
		$inicio = $pagina - 1;  
		$inicio = $maximo_registro * $inicio;
		
		
		// Conta os resultados no total da minha query  
		$sql = "SELECT COUNT(*) AS 'numero_registros' $final_sql";  
		$result = parent::executaSQL($sql);
		$row = mysql_fetch_array($result);  
		$total = $row["numero_registros"];
		
		
		// Calculando pagina anterior  
		$menos = $pagina - 1;  
	
		// Calculando pagina posterior  
		$mais = $pagina + 1;
	
		// Retorna o próximo maior valor inteiro arredondando para cima
		$pgs = ceil($total / $maximo_registro);  
		
		if($pgs > 1 ) {  
	
			echo '<ul>';
				// Mostragem de pagina  
				if($menos > 0) {  
				   echo "<li><a href=\"?pagina=$menos$complemento_link\" class='texto_paginacao_voltar'>
							Anterior
						</a></li> ";  
				}
				else
				{
					echo "<li><a href=\"javascript:void(0);\" class='texto_paginacao_voltar'>
							Anterior
						</a></li> ";
				}
				
				
				if($inicio == 0)
				{
					$registro_atual = 1;
				}
				else
				{
					$registro_atual = $inicio + 1;
				}
				
				echo "
					  <li class='selected'>
						<span>$registro_atual</span> 
					  	<span class='paginacao_de'>de</span> <span class='paginacao_de'>$total</span>
					  </li>
					  ";  
				
				
				
				
				
					
					
				if($mais <= $pgs) {  
				   echo " <li>  <a href=\"?pagina=$mais$complemento_link\" class='texto_paginacao_avancar'>
				   				proxima
							</a> </li> ";  
				}  	
				else
				{
					echo " <li>  <a href=\"javascript:void(0);\" class='texto_paginacao_avancar'>
				   				<span>proxima</span>
							</a> </li>";  
				}
				
					
			echo '</ul>';
			
		}
	}
	
	
	
	public function total_registros()
	{
		// Conta os resultados no total da minha query  
		$sql = "SELECT COUNT(*) AS 'numero_registros' $final_sql";  
		$result = parent::executaSQL($sql);
		$row = mysql_fetch_array($result);  
		$total = $row["numero_registros"];	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	// BOTÃO DE PAGINAÇÃO COM AJAX
	public function get_btn_paginacao($pagina, $maximo_registro, $final_sql, $complemento_link = '', $listar_pagina = 'SIM')
	{
		// verificio se é a primeira pagina
		if($pagina == "") {  
			$pagina = "1";  
		} 
		
		// Calculando o registro inicial  
		$inicio = $pagina - 1;  
		$inicio = $maximo_registro * $inicio;
		
		
		// Conta os resultados no total da minha query  
		$sql = "SELECT COUNT(*) AS 'numero_registros' $final_sql";  
		$result = parent::executaSQL($sql);
		$row = mysql_fetch_array($result);  
		$total = $row["numero_registros"];
	
		// Retorna o próximo maior valor inteiro arredondando para cima
		$pgs = ceil($total / $maximo_registro);  
		
		if($pgs > 1 )
		{
			?>
            <div id="paginacao">
            <input type="hidden" name="total" id="total" value="<?php echo $pgs; ?>">
                <div id="status"></div>
                <a href="javascript:void(0);" rel="2" id="btn_paginacao">
                    Mostrar mais registros
                </a>
            </div>
            <?php
		}
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
?>