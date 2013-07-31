<?php
ob_start();
session_start();




class Grupo_Model extends Dao
{
	
	
	
	
	
	/*	==================================================================================================================	*/
	/*	EFETUA O CADASTRO	*/
	/*	==================================================================================================================	*/
	public function cadastra_grupo($dados)
	{
		$nome = Util::trata_dados_formulario($dados[nome]);
		
		//	VERIFICO SE O GRUPO JA ESTA CADASTRADO
		if($this->verifica_grupo($nome) == 0)
		{		
			$sql = "
					INSERT INTO	tb_grupos_logins
					(nome)
					VALUES
					('$nome')
					";
			parent::executaSQL($sql);
			
			//	ARMAZENA O LOG
			parent::armazena_log("tb_logs_logins", "CADASTRO DE GRUPO $nome", $sql, $_SESSION[login][idlogin]);
			
			return true;
		}
		else
		{
			return false;	
		}
	}
	
	
	/*	==================================================================================================================	*/
	/*	EFETUA A ALTERACAO	*/
	/*	==================================================================================================================	*/
	public function altera_grupo($dados)
	{
		if($dados[id] == 1 or $dados[id] == 2 or $dados[id] == 3)
		{
			Util::script_msg("Não é permitida e alteração desse registro");
			Util::script_go_back();
		}
		else
		{
			$nome = Util::trata_dados_formulario($dados[nome]);
			
			//	VERIFICO SE O GRUPO JA ESTA CADASTRADO
			if($this->verifica_grupo_altera($nome, $dados[id]) == 0)
			{		
				$sql = "UPDATE tb_grupos_logins SET nome = '$nome' WHERE idgrupologin = '$dados[id]'";
				parent::executaSQL($sql);
				
				//	ARMAZENA O LOG
				parent::armazena_log("tb_logs_logins", "ALTERAÇÃO DE GRUPO $dados[id]", $sql, $_SESSION[login][idlogin]);
				
				return true;
			}
			else
			{
				return false;	
			}
		}
	}
	
	
	
	/*	==================================================================================================================	*/
	/*	ATIVA OU DESATIVA	*/
	/*	==================================================================================================================	*/
	public function ativar_desativar($id, $ativo)
	{
		if($ativo == "SIM")
		{
			$sql = "UPDATE tb_grupos_logins SET ativo = 'NAO' WHERE idgrupologin = '$id'";
			parent::executaSQL($sql);
			
			//	ARMAZENA O LOG
			parent::armazena_log("tb_logs_logins", "DESATIVOU O GRUPO $id", $sql, $_SESSION[login][idlogin]);
		}
		else
		{
			$sql = "UPDATE tb_grupos_logins SET ativo = 'SIM' WHERE idgrupologin = '$id'";
			parent::executaSQL($sql);
			
			//	ARMAZENA O LOG
			parent::armazena_log("tb_logs_logins", "ATIVOU O GRUPO $id", $sql, $_SESSION[login][idlogin]);
		}
		
		
	}
	
	
	
	
	/*	==================================================================================================================	*/
	/*	EXCLUI	*/
	/*	==================================================================================================================	*/
	public function excluir($id)
	{
		if($id == 1 or $id == 2 or $id == 3)
		{
			Util::script_msg("Não é permitida e exclusão desse registro");
		}
		else
		{
			//	BUSCA OS DADOS
			$row = $this->select($id);
			
			$sql = "DELETE FROM tb_grupos_logins WHERE idgrupologin = '$id'";
			parent::executaSQL($sql);			
			
			//	ARMAZENA O LOG
			parent::armazena_log("tb_logs_logins", "EXCLUSÃO DO GRUPO COD: $id, NOME: $row[nome]", $sql, $_SESSION[login][idlogin]);
		}
	}
	
	
	
	
	
	
	
	/*	==================================================================================================================	*/
	/*	VERIFICO SE JA POSSUI O GRUPO CADASTRADO	*/
	/*	==================================================================================================================	*/
	public function verifica_grupo($nome)
	{
		$sql = "SELECT * FROM tb_grupos_logins WHERE nome = '$nome'";
		return mysql_num_rows(parent::executaSQL($sql));
	}
	
	
	
	
	
	
	/*	==================================================================================================================	*/
	/*	VERIFICO SE JA POSSUI O GRUPO CADASTRADO QUANDO ALTERAR	*/
	/*	==================================================================================================================	*/
	public function verifica_grupo_altera($nome, $id)
	{
		$sql = "SELECT * FROM tb_grupos_logins WHERE nome = '$nome' AND idgrupologin <> '$id'";
		return mysql_num_rows(parent::executaSQL($sql));
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
						tb_grupos_logins
					WHERE
						idgrupologin = '$id'
					ORDER BY
						nome
					";
			return mysql_fetch_array(parent::executaSQL($sql));
		}
		else
		{
			$sql = "
				SELECT
					*
				FROM
					tb_grupos_logins
				ORDER BY
					nome
				";
			return parent::executaSQL($sql);
		}
		
		
	}
	
	
	
	
	/*	==================================================================================================================	*/
	/*	BUSCA OS MODULOS DA PAGINA	*/
	/*	==================================================================================================================	*/
	public function select_modulos_paginas()
	{
		$sql = "
				SELECT
					*
				FROM
					tb_modulos_paginas
				ORDER BY
					nome
				";
		return parent::executaSQL($sql);
	}
	
	
	
	/*	==================================================================================================================	*/
	/*	VERIFICO SE O GRUPO TEM PERMISSAO A MODULO	*/
	/*	==================================================================================================================	*/
	public function select_modulos_paginas_permissao($id_grupologin, $id_pagina)
	{
		$sql = "
				SELECT
					*
				FROM
					tb_grupos_logins_tb_paginas
				WHERE
					id_grupologin = '$id_grupologin'
					AND id_pagina = '$id_pagina'
				";
		return mysql_num_rows(parent::executaSQL($sql));
	}
	
	
	/*	==================================================================================================================	*/
	/*	BUSCA AS PAGINAS DOS MODULOS */
	/*	==================================================================================================================	*/
	public function select_paginas_modulos($id)
	{
		$sql = "
				SELECT
					*
				FROM
					tb_paginas
				WHERE 
					id_modulopagina = '$id'
				ORDER BY
					label
				";
		return parent::executaSQL($sql);
	}
	
	
	
	
	/*	==================================================================================================================	*/
	/*	BUSCA AS PAGINAS DOS MODULOS */
	/*	==================================================================================================================	*/
	public function gerenciar_permissoes($dados)
	{
		
		//	APAGO AS PERMISSOES ANTERIORES
		$sql = "DELETE FROM tb_grupos_logins_tb_paginas WHERE id_grupologin = '$dados[id_grupologin]'";
		parent::executaSQL($sql);
		
		
		
		//	VERIFICO SE TEM ALGUM SELECIONADP
		
		if(count($dados[pagina]) > 0)
		{
			foreach($dados[pagina] as $dado)
			{
				
				$sql = "
						INSERT INTO tb_grupos_logins_tb_paginas 
							(id_grupologin, id_pagina )
						VALUES 
							('$dados[id_grupologin]', '$dado')
						";
				parent::executaSQL($sql);
			}
		}
	}
	
	
	
	
	
	
	
	/*	==================================================================================================================	*/
	/*	FORMULARIO	*/
	/*	==================================================================================================================	*/
	public function formulario($dados)
	{
	?>
    	<div class="class-form-2">
            <ul>
                <li>
                    <p>Nome do grupo<span>Ex.: Administrador, Aluno.</span></p>
                    <input type="text" name="nome" id="nome" value="<?php echo $dados[nome] ?>" class="validate(required)" />
                </li>
            </ul>
        </div>
    <?php
	}
	
	
	
	
}





















?>

























