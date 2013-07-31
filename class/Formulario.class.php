<?php

class Formulario{

	private $cont_erros = 1;  // atributo para contagem de erros no formulário
	private $dados = array(); // nome dos campos com seus respectivos valores que foram preenchidos
	private $msg_erros = '';  // Notificações do formulário
	private $campos = '';


	//capta os dados do formulário valida e amazena no $dados
	//Exemplo: array(array(''=>)) 
	public function __construct($formulario)
	{
		
		for($i=0; $i < count($formulario); $i++ )
		{

			if( $formulario[$i]['obr'] == 's'  and $formulario[$i]['tipo'] != "arquivo")
			{
				
				
				if( $_POST[$formulario[$i]['nome_campo_form']] == "" )
				{
					$this->cont_erros = $this->cont_erros + 1;
					$this->msg_erros = $this->msg_erros. "<br>" . $formulario[$i]['msgerros'];
				}
				else
				{
					//$this->dados[$formulario[$i]['nome_campo_form']] = utf8_encode(addslashes(trim($_POST[$formulario[$i]['nome_campo_form']])));
					$this->dados[$formulario[$i]['nome_campo_form']] = $this->trata_dados_formulario($_POST[$formulario[$i]['nome_campo_form']], $formulario[$i]['tipo']);
					$this->campos[$i] = $formulario[$i]['nome_campo_form'];
				}
				
			}
			else
			{
				//$this->dados[$formulario[$i]['nome_campo_form']] = utf8_encode(addslashes(trim( $_POST[$formulario[$i]['nome_campo_form']])));
				$this->dados[$formulario[$i]['nome_campo_form']] = $this->trata_dados_formulario($_POST[$formulario[$i]['nome_campo_form']], $formulario[$i]['tipo']);
				$this->campos[$i] = $formulario[$i]['nome_campo_form'];
			}
		}
	}
	
	
	
	
	#---------------------------------------------------------------------------------------------------------------------------#
	#	TRATO OS CAMPOS DO FORMULARIO DE ACORDO COM O BANCO
	#---------------------------------------------------------------------------------------------------------------------------#
	private function trata_dados_formulario($valor, $tipo)
	{
		switch($tipo)
		{
			case "moeda":
				return Util::formata_moeda($valor, "banco");
			break;
			case "data":
				return Util::formata_data($valor, "banco");
			break;
			case "senha":
				return md5($valor);
			break;
			default:	//	TEXTO
				$valor = trim($valor);
				$valor = addslashes($valor);
				$valor = utf8_decode($valor);
				
				return $valor;
				//return addslashes(trim($valor));
			break;
		}
		
		
	}
	
	

	public function get_campos()
	{
		return $this->campos;
	}

	//returna dados
	public function get_dados_formulario()
	{
		return $this->dados;
	}

	//Retorna mensagem de erro
	public function get_msg_erros()
	{
		?>
        <fieldset class="msg_erro">
			<legend><img src="../admin/imagens/atencao.png" border="0"  />	Atenção</legend>        	
			<?php
            echo $this->msg_erros;
            ?>
        </fieldset>
        <?php
	}

	//Returna true ou false se estar errado
	public function get_erros()
	{
		if( $this->cont_erros == 1)
		{
			return 1;
		}
		else
		{
			return 2;
		}
	}
}



?>