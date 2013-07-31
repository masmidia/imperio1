<?php
@session_start();
header ('Content-type: text/html; charset=utf-8');

//	VERIFICO SE O USUARIO EFETUO O LOGIN
if(!isset($_SESSION['login']))
{
	Util::script_msg("Por favor, efetue o login.");
	Util::script_location(Util::caminho_projeto() . "/admin");
}
else
{

	//	VERIFICO SE NAO E A PAGINA INICIAL DO SISTEMA
	if($_SERVER['SCRIPT_NAME'] != (PASTA_PROJETO . "/admin/inicial.php"))
	{
		
		//	VERIFICO SE TEM PERMISSAO PARA ACESSAR A PAGINA
		$permissao_acesso = true;
		
		//	BUSCO NO ARRAY PARA VERIFICAR SE ENCONTRO A PERMISSAO
		foreach($_SESSION['permissoes'] as $permissao)
		{
				
				
				if((PASTA_PROJETO . $permissao['pagina']) == $_SERVER['SCRIPT_NAME'])
				{
					$permissao_acesso = true;
					break;					
				}
		}
		

		
		//	VERIFICO SE FOI LOCALIZADO O ACESSO
		if($permissao_acesso == false)
		{
			Util::script_msg(utf8_decode("Você não tem acesso a essa função do sistema."));
			Util::script_go_back();
		}
	}
}










?>