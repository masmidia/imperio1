<?php
/*
DATA DA ULTIMA ALTERACAO: 				***	31/03/2009
ULTIMO ARQUIVO DA LISTAGEM ALTERADO: 	***	from_lista_cargos.php

******************	HISTORICO DE ALTERACOES**********************
DATA			ALTERADO POR			DESCRICAO
31/03/2009		MARCIO ANDRÉ			COLOQUEI O TARGET NO LINK DE OPÇÕES

*/




//require_once("../../class/Includes.class.php");
require_once('Dao.class.php');
require_once('Util.class.php');
require_once('Biblioteca_Jquery.class.php');









class Listagem extends Dao
{
	//	DECLARACAO DAS VARIAVEIS
	private $pagina = 0;
	private $maximo_registro = 0;
	private $campos_sql = "";
	private $final_sql = "";
	private $nome_colunas = "";
	private $opcoes = "";
	private $ordem = "";
	private $complemento_busca = "";
	private $filtro = "";
	private $descricao = "";
	private $popup_widht = 0;
	private $popup_height = 0;
	private $complemento_url_ordenacao = "";
	private $somatorios = array();
	private $opcoes_diversas = array();


	public function cria_listagem($pagina, $maximo_registro, $campos_sql, $final_sql, $nome_colunas, $opcoes, $ordem, $descricao, $filtro, $complemento_busca, $popup_widht, $popup_height, $complemento_url_ordenacao, $opcoes_diversas)
	{
		//	print_r($nome_colunas);
		$this->pagina = $pagina;
		$this->maximo_registro = $maximo_registro;
		$this->campos_sql = $campos_sql . ",ativo, ordem";
		$this->final_sql = $final_sql . "ORDER BY ordem";
		$this->nome_colunas = $nome_colunas;
		$this->opcoes = $opcoes;
		$this->ordem = $ordem;
		$this->descricao = $descricao;
		$this->filtro = $filtro;
		$this->complemento_busca = $complemento_busca;
		$this->popup_widht = $popup_widht;
		$this->popup_height = $popup_height;
		$this->complemento_url_ordenacao = $complemento_url_ordenacao;
		$this->opcoes_diversas = $opcoes_diversas;



		$this->monta_filtro();
	
        
        

		//	VERIFICO SE RETORNOU ALGO
		if(mysql_num_rows($this->verifica_quantidade($final_sql)) > 0)
		{
			echo '
					<style type="text/css"> 
						table#alter tr td 
						{
							border-bottom:#69F solid 1px;
							font: "Trebuchet MS", Arial, Helvetica, sans-serif;
							font-size:12px;
						}
					</style>
					';
			echo '<table cellspacing="3" cellpadding="2" width="100%" id="alter" border="0">';
			$this->monta_colunas();
			$this->monta_linhas();
			$this->gera_linhas_somatorios();
			echo '</table>';
			$this->get_links($this->pagina, $this->maximo_registro, $this->final_sql);
		}
		else
		{
			echo '<P><font color=red>Nenhum registro encontrado.</font><P>';
		}
	}



	private function verifica_quantidade($final_sql)
	{
		// Conta os resultados no total da minha query
		$sql = "SELECT COUNT(*) AS 'numero_registros' $final_sql";
		$result = parent::executaSQL($sql);
		return $result;
	}





	public function monta_filtro()
	{
		?>
			<fieldset>
            	<legend>BUSCA</legend>

                <form method="get" action="">

					<label>
					Coluna:
	  	  			</label>
                    <select name="tipo_filtro" id="tipo_filtro">
                    	<option value=''>Sem filtro</option>
                    	<?php
							foreach($this->nome_colunas as $nome_coluna)
							{
								if($nome_coluna[exibir_listagem] == 's')
								{							
									if($_GET[tipo_filtro] == $nome_coluna[nome_campo_form])
									{
										echo "<option value='$nome_coluna[nome_campo_form]' selected='selected'>". utf8_encode($nome_coluna[nome_coluna]) ."</option>";		
									}
									else
									{
											echo "<option value='$nome_coluna[nome_campo_form]'>". utf8_encode($nome_coluna[nome_coluna]) ."</option>";		
									}
								}
							}
						?>
                    </select>



					<label><?php echo utf8_encode("Descrição"); ?></label>
					<input type="text" name="descricao" id="descricao" value="<?php echo $_GET[descricao]; ?>" size="30" />





                  <input type="submit" value="OK" name="botao" class="botao_azul" />
                  <input type="hidden" name="ordem" value="<?php echo $_GET[ordem]; ?>" />

              </form>



            </fieldset>

            <P>
		<?php
	}



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
		$result = $this->verifica_quantidade($final_sql);
		$row = mysql_fetch_array($result);
		$total = $row["numero_registros"];

		//	VERIFICO SE RETORNOU ALGO
		if($total<=0)
		{
			echo '<P><font color=red>Nenhum registro encontrado, Por Favor tente novamente</font><P>';
			exit();
			//Util::script_msg("Nenhum registro encontrado, Por Favor tente novamente");
			//Util::script_go_back();
			//exit();
		}
		else
		{
			//	ORDENACAO DO SQL
			if($this->ordem != '')
			{
				$ordem_sql = "ORDER BY $this->ordem";
			}
			else
			{
				$ordem_sql = "";
			}



			$sql = "SELECT $campos_sql $final_sql $ordem_sql LIMIT $inicio, $maximo_registro";
			$result = parent::executaSQL($sql);
			return $result;
		}
	}



	//	MÉTODO DE CONTRUÇÃO DAS COLUNAS
	private function monta_colunas()
	{
		//	CRIO A LINHA
		echo '<tr class = "label">';
		$ordem = explode(",", $this->campos_sql);
		//	FAÇO UM LOOP PARA MONTAR AS COLUNAS
		for($i= 0; $i < count($this->nome_colunas); $i++)
		{
			$alinhamento = $this->nome_colunas[$i][alinhamento];
			$pagina = $this->pagina;
			$nome_coluna = $this->nome_colunas[$i][nome_coluna];
			$campo_sql = $this->campos_sql[$i];
			$ordenacao = trim($ordem[$i]);
			$filtro = $this->filtro;
			$descricao = $this->descricao;



			if($this->nome_colunas[$i][link] == 's')
			{
				if($this->nome_colunas[$i][exibir_listagem] == 's')
				{
					echo "<td align=$alinhamento>
								". utf8_encode($nome_coluna) ."
						  </td>";
					/*
					echo "<td align=$alinhamento>
							<a href='$_SERVER[SCRIPT_NAME]?pagina=$pagina&ordem=$ordenacao&descricao=$descricao&tipo_filtro=$filtro&id_unidade=$_GET[id_unidade]$this->complemento_url_ordenacao'>
								". utf8_encode($nome_coluna) ."
							</a>
						  </td>";
						  */
				}
			}
			else
			{
				if($this->nome_colunas[$i][exibir_listagem] == 's')
				{
					echo "<td align=$alinhamento>
								$nome_coluna
						  </td>";
				}
			}



		}

		// COLUNA PADRA DE OPÇÃO DE DETALHAMENTO
		$colspan = count($this->opcoes) + count($this->opcoes_diversas);
		
		/*
		echo '<td align=center style="width:45px;">
		      	ATIVO
			  </td>';
		*/
		
		echo '<td align=center style="width:45px;">
		      	ORDEM
			  </td>';
		
		if($colspan > 0)
		{
			echo "<td colspan=$colspan align=center>OPCOES</td>";
			//	FECHO A LINHA
			echo '</tr>';
		}
	}






	public function monta_linhas()
	{
		$result = $this->get_paginacao_registro($this->pagina, $this->maximo_registro, $this->campos_sql, $this->final_sql);
		//	EXECUTO ATE CHEGAR NO FINAL
		
		$s = 0;
		while($row = mysql_fetch_array($result, MYSQL_BOTH))
		{
			
			// CRIO AS LINHAS
			echo '<tr class="tr" >';

				// FAÇO UM LOOP PARA VER QTS COLUNAS VAO SER CRIADAS
				for ($i=0; $i < count($this->nome_colunas); $i++)
				{
					//	 ESCOLHO O TIPO DE DADO
					switch($this->nome_colunas[$i][tipo])
					{
						case 'moeda':
							$descricao = Util::exibe_valor_moeda($row[$i]);
						break;
						case 'data':
							$descricao = Util::data_certa($row[$i]);
						break;
						case 'dia':
							switch($row[$i])
							{
								case '0':
									$descricao = 'DOMINGO';
								break;
								case '1':
									$descricao = 'SEGUNDA - FEIRA';
								break;
								case '2':
									$descricao = 'TERCA - FEIRA';
								break;
								case '3':
									$descricao = 'QUARTA - FEIRA';
								break;
								case '4':
									$descricao = 'QUINTA - FEIRA';
								break;
								case '5':
									$descricao = 'SEXTA - FEIRA';
								break;
								case '6':
									$descricao = 'SABADO';
								break;
							}
						break;
						default:
							$descricao = $row[$i];
						break;
					}

					echo "<td align =". $this->nome_colunas[$i][alinhamento] .">". utf8_encode($descricao.$tipo) ." </td>";




					// VERIFICO SE E PARA SOMAR
					if($this->nome_colunas[$i][somatorio] == 's')
					{
						//	 CHAMO A FUNCA
						$this->somatorios($this->nome_colunas[$i][nome_coluna], $row[$i]);
					}
				}



				//	IMPUT DO CAMPO ORDEM
				?>
                
                <td align="center" style="width:45px;">
                	<form action="<?php echo $_SERVER[REQUEST_URI]; ?>" method="post" name="form_ordem_registro">
                        <input type="hidden" name="id" value="<?php echo base64_encode($row[0]); ?>">
                        <input name="ordem_registro" id="ordem_registro" type="text" style="width:20px;" value="<?php echo $row[ordem]; ?>" onclick="ordena_registro()" />
                        <input type="image" name="btn_ordena_registro" id="btn_ordena_registro" src="../img/disquete.jpg" alt="Salvar a ordem" title="Salvar a ordem" />
                    </form>
                </td>
				
				<?php
					//	VERIFICO QUAIS OPÇÕES TERAO LINK
					for($b=0; $b < count($this->opcoes); $b++)
					{
						//	VERIFICA SE E PARA COLOCAR O BOTAO DE MULTIPLAS IMAGENS
						if($this->opcoes[$b][multiplas_imagens] == 's')
						{
							Biblioteca_JQuery::color_box_iframe("upload_multiplas_imagens_$s", "80%", "80%");
							echo $this->opcoes[$b][url];
						?>
							<td align="center">
                                <a id="upload_multiplas_imagens_<?php echo $s; ?>" href="<?php echo Util::caminho_projeto() ?>/jquery/swfupload/index.php?id=<?php echo $row[0]; ?>&tamanho_max_arquivo=<?php echo $this->opcoes[$b][tamanho_max_arquivo]; ?>&qtd_max_imgs=<?php echo $this->opcoes[$b][qtd_max_imgs]; ?>&nome_tabela=<?php echo $this->opcoes[$b][nome_tabela]; ?>&nome_campo=<?php echo $this->opcoes[$b][nome_campo]; ?>&nome_chave_estrangeira=<?php echo $this->opcoes[$b][nome_chave_estrangeira]; ?>&tamanho_imagem=<?php echo $this->opcoes[$b][tamanho_imagem]; ?>&tamanho_tumb=<?php echo $this->opcoes[$b][tamanho_tumb]; ?>">
                                    <img src="<?php echo Util::caminho_projeto(); ?>/admin/img/add_foto.jpg" border="0" title="<?php echo $this->opcoes[$b][title]; ?>" />
                                </a>
							</td>

						<?php
						}
						
						
						//	VERIFICA SE E PARA COLOCAR O BOTAO DE MULTIPLAS IMAGENS
						if($this->opcoes[$b][multiplas_imagens_1] == 's')
						{
							Biblioteca_JQuery::color_box_iframe("upload_multiplas_imagens_1_$s", "80%", "80%");
							echo $this->opcoes[$b][url];
						?>
							<td align="center">
                                <a id="upload_multiplas_imagens_1_<?php echo $s; ?>" href="<?php echo Util::caminho_projeto() ?>/jquery/swfupload/index.php?id=<?php echo $row[0]; ?>&tamanho_max_arquivo=<?php echo $this->opcoes[$b][tamanho_max_arquivo]; ?>&qtd_max_imgs=<?php echo $this->opcoes[$b][qtd_max_imgs]; ?>&nome_tabela=<?php echo $this->opcoes[$b][nome_tabela]; ?>&nome_campo=<?php echo $this->opcoes[$b][nome_campo]; ?>&nome_chave_estrangeira=<?php echo $this->opcoes[$b][nome_chave_estrangeira]; ?>&tamanho_imagem=<?php echo $this->opcoes[$b][tamanho_imagem]; ?>&tamanho_tumb=<?php echo $this->opcoes[$b][tamanho_tumb]; ?>">
                                    <img src="<?php echo Util::caminho_projeto(); ?>/admin/img/add_foto.jpg" border="0" title="<?php echo $this->opcoes[$b][title]; ?>" />
                                </a>
							</td>

						<?php
						}
						
						
						
						//	VERIFICA SE E PARA COLOCAR O BOTAO DE IMAGEM PARA CROP
						if($this->opcoes[$b][imagem_crop] == 's')
						{
							Biblioteca_JQuery::color_box_iframe("upload_imagem_crop_$s", "80%", "80%");
							echo $this->opcoes[$b][url];
						?>
							<td align="center">
                                <a id="upload_imagem_crop_<?php echo $s; ?>" href="<?php echo Util::caminho_projeto() ?>/jquery/crop/index.php?id=<?php echo $row[0]; ?>&tamanho_max_arquivo=<?php echo $this->opcoes[$b][tamanho_max_arquivo]; ?>&qtd_max_imgs=<?php echo $this->opcoes[$b][qtd_max_imgs]; ?>&nome_tabela=<?php echo $this->opcoes[$b][nome_tabela]; ?>&nome_campo=<?php echo $this->opcoes[$b][nome_campo]; ?>&nome_chave_estrangeira=<?php echo $this->opcoes[$b][nome_chave_estrangeira]; ?>&tamanho_imagem=<?php echo $this->opcoes[$b][tamanho_imagem]; ?>&tamanho_width_tumb=<?php echo $this->opcoes[$b][tamanho_width_tumb]; ?>&tamanho_height_tumb=<?php echo $this->opcoes[$b][tamanho_height_tumb]; ?>">
                                    <img src="<?php echo Util::caminho_projeto(); ?>/admin/img/crop_imagens.png" border="0" title="<?php echo $this->opcoes[$b][title]; ?>" />
                                </a>
							</td>

						<?php
						}
						
						
						
						
						
						
						
						//	VERIFICA SE E PARA VIZUALIZAR IMAGENS
						if($this->opcoes[$b][ver_imagens] == 's')
						{
							Biblioteca_JQuery::color_box_iframe("ver_imagens_$s", "80%", "80%");
							echo $this->opcoes[$b][url];
						?>
							<td align="center">
                                <a id="ver_imagens_<?php echo $s; ?>" href="<?php echo Util::caminho_projeto() ?>/jquery/swfupload/vizualiza_imagem.php?id=<?php echo $row[0]; ?>&nome_tabela=<?php echo $this->opcoes[$b][nome_tabela]; ?>&nome_campo=<?php echo $this->opcoes[$b][nome_campo]; ?>&nome_chave_estrangeira=<?php echo $this->opcoes[$b][nome_chave_estrangeira]; ?>">
                                    <img src="<?php echo Util::caminho_projeto(); ?>/admin/img/foto.jpg" border="0" title="<?php echo $this->opcoes[$b][title]; ?>" />
                                </a>
							</td>

						<?php
						}
						
						
						
						//	VERIFICA SE E PARA VIZUALIZAR IMAGENS OPCAO 2
						if($this->opcoes[$b][ver_imagens_1] == 's')
						{
							Biblioteca_JQuery::color_box_iframe("ver_imagens_1_$s", "80%", "80%");
							echo $this->opcoes[$b][url];
						?>
							<td align="center">
                                <a id="ver_imagens_1_<?php echo $s; ?>" href="<?php echo Util::caminho_projeto() ?>/jquery/swfupload/vizualiza_imagem.php?id=<?php echo $row[0]; ?>&nome_tabela=<?php echo $this->opcoes[$b][nome_tabela]; ?>&nome_campo=<?php echo $this->opcoes[$b][nome_campo]; ?>&nome_chave_estrangeira=<?php echo $this->opcoes[$b][nome_chave_estrangeira]; ?>">
                                    <img src="<?php echo Util::caminho_projeto(); ?>/admin/img/foto.jpg" border="0" title="<?php echo $this->opcoes[$b][title]; ?>" />
                                </a>
							</td>

						<?php
						}
						
						
						//	VERIFICA SE E PARA VIZUALIZAR IMAGENS OPCAO 3
						if($this->opcoes[$b][ver_imagens_2] == 's')
						{
							Biblioteca_JQuery::color_box_iframe("ver_imagens_2_$s", "80%", "80%");
							echo $this->opcoes[$b][url];
						?>
							<td align="center">
                                <a id="ver_imagens_2_<?php echo $s; ?>" href="<?php echo Util::caminho_projeto() ?>/jquery/swfupload/vizualiza_imagem.php?id=<?php echo $row[0]; ?>&nome_tabela=<?php echo $this->opcoes[$b][nome_tabela]; ?>&nome_campo=<?php echo $this->opcoes[$b][nome_campo]; ?>&nome_chave_estrangeira=<?php echo $this->opcoes[$b][nome_chave_estrangeira]; ?>">
                                    <img src="<?php echo Util::caminho_projeto(); ?>/admin/img/foto.jpg" border="0" title="<?php echo $this->opcoes[$b][title]; ?>" />
                                </a>
							</td>

						<?php
						}



						//	VERIFICA OP
						if($this->opcoes[$b][op] == 's')
						{
							$url = $this->opcoes[$b][url];
							$id = base64_encode($row[0]);

						?>
							<td align="center">
							<a target="<?php echo $this->opcoes[$b][target]; ?>" href="javascript:open_window('<?php echo $url; ?>','<?php echo $id; ?>', 1, <?php echo $this->popup_widht; ?>, <?php echo $this->popup_height; ?>)">
                            	<img src="../imagens/zoon.png" border="0" title="<?php echo $this->opcoes[$b][title]; ?>" />
                            </a>
							</td>

						<?php
						}
						
						
						//	VERIFICA ALTERAR
						if($this->opcoes[$b][alterar] == 's')
						{
							echo '<td align="center">
									<a target="'. $this->opcoes[$b][target] .'" href=' . $this->opcoes[$b][url] . '?id=' . base64_encode($row[0]) . '>
										<img src="'. Util::caminho_projeto() .'/admin/img/editar.jpg" border=0 title="' . $this->opcoes[$b][title] . '"/>
									</a>
								  </td>';
						}
	
	
						//	VERIFICA EXCLUIR
						if($this->opcoes[$b][excluir] == 's')
						{
							?>
								<td align="center">
                                    <form method="post" action="" onsubmit="if (confirm('EXCLUIR o registro de Nr:    <?php echo $row[0]; ?>')) {return true;} else {return false}">
                                        <input type="hidden" name="id_exc" value="<?php echo base64_encode($row[0]); ?>">
                                        <input type="image" src="<?php echo Util::caminho_projeto(); ?>/admin/img/deletar.jpg"  border="0" style="border-style:none;" title="<?php echo $this->opcoes[$b][title]; ?>">
                                    </form>
                                </td>

                            <?php
						}
						
						
						
						//	VERIFICA DESATIVAR
						if($this->opcoes[$b][desativar] == 's')
						{							
							if($row[ativo] == "SIM")
							{
							?>
								<td align="center">
                                    <form method="post" action="" onsubmit="if (confirm('DESATIVAR o registro de Nr:    <?php echo $row[0]; ?>')) {return true;} else {return false}">
                                        <input type="hidden" name="id_ativar_desativar" value="<?php echo base64_encode($row[0]); ?>">
                                        <input type="hidden" name="acao" value="NAO">
                                        <input type="image" src="<?php echo Util::caminho_projeto(); ?>/admin/img/desativar.jpg"  border="0" style="border-style:none;" title="Desativar o item">
                                    </form>
                                </td>
                            <?php
							}
							else
							{
							?>
                            	<td align="center">
                                    <form method="post" action="" onsubmit="if (confirm('ATIVAR o registro de Nr:    <?php echo $row[0]; ?>')) {return true;} else {return false}">
                                        <input type="hidden" name="id_ativar_desativar" value="<?php echo base64_encode($row[0]); ?>">
                                        <input type="hidden" name="acao" value="SIM">
                                        <input type="image" src="<?php echo Util::caminho_projeto(); ?>/admin/img/ativar.jpg"  border="0" style="border-style:none;" title="Ativar o item">
                                    </form>
                                </td>
							<?php	
							}
						}
						
						
						






					}

						//	MONTO AS OPÇÕES AUXILIARES
						for($c=0; $c < count($this->opcoes_diversas); $c++)
						{

							if($this->opcoes_diversas[$c][tipo] == 'form')
							{
							?>
								<td align="center">
                                    <form target="<?php echo $this->opcoes_diversas[$c][target] ?>" method="<?php echo $this->opcoes_diversas[$c][method] ?>" action="<?php echo $this->opcoes_diversas[$c][action] ?>" <?php if($this->opcoes_diversas[$c][msg_onsubmit] != ''){ ?> onsubmit="if (confirm('<?php echo $this->opcoes_diversas[$c][msg_onsubmit] ?>:    <?php echo $row[0]; ?>')) {return true;} else {return false}" <?php } ?>>
                                        <input type="hidden" name="<?php echo $this->opcoes_diversas[$c][nome_hidden] ?>" value="<?php echo base64_encode($row[0]); ?>">
                                        <input type="image" src="<?php echo $this->opcoes_diversas[$c][img_botao] ?>" border="0" width="20" height="20" style="border-style:none;" title="<?php echo $this->opcoes_diversas[$c][title] ?>">
                                    </form>
                                </td>
							<?php
							}
							else
							{
								$url = $this->opcoes_diversas[$c][url];
								$id = base64_encode($row[0]);
								$popup_widht = $this->opcoes_diversas[$c][popup_widht];
								$popup_height = $this->opcoes_diversas[$c][popup_height];


								if($this->opcoes_diversas[$c][open_window] == 's')
								{
									$url = "href=javascript:open_window('$url','$id',1,$popup_widht,$popup_height)";
								}
								else
								{
									$url = "href='". $this->opcoes_diversas[$c][url] ."?id=". base64_encode($row[0]) ."'" ;
								}
							?>
								<td align="center">
									<a target="<?php echo $this->opcoes_diversas[$c][target]; ?>" <?php echo $url; ?> >
										<img src="<?php echo $this->opcoes_diversas[$c][img_botao]; ?>" border="0" title="<?php echo $this->opcoes_diversas[$c][title]; ?>" />
									</a>
								</td>
							<?php
							}
						}
			//	FECHO
			echo '</tr>';

		 	$s++;
		}


	}




	private function somatorios($nome_coluna, $valor)
	{
		$achou = '';
		//	VERIFICO SE O ARRAY JA EXISTE
		if(count($this->somatorios) > 0)
		{
			for($i=0; $i < count($this->somatorios); $i++)
			{
				if($this->somatorios[$i][nome_coluna] == $nome_coluna)
				{
					$this->somatorios[$i][total] += $valor;
					$achou = 'sim';
				}
			}


			//	verifico se e para criar um novo array
			if($achou != 'sim')
			{
				$novo_valor = array('nome_coluna'=>$nome_coluna, 'total'=>$valor);
				array_push($this->somatorios, $novo_valor);
			}
		}
		else
		{
			$this->somatorios = array(
								  array('nome_coluna'=>$nome_coluna, 'total'=>$valor)
								  );
		}

	}





	public function gera_linhas_somatorios()
	{
		//	VERIFICO SE E PARA CRIAR AS LINHAS
		if(count($this->somatorios) > 0)
		{
			echo "<tr class=totalizadores>";
			for($i=0; $i < count($this->nome_colunas); $i++)
			{
				$alinhamento = $this->nome_colunas[$i][alinhamento];

				for($b=0; $b < count($this->somatorios); $b++)
				{
					if($this->nome_colunas[$i][nome_coluna] == $this->somatorios[$b][nome_coluna])
					{
						$valor = $this->somatorios[$b][total];
					}

				}

				// 	VERIFICO SE E PARA IMPRIMIR O VALOR
				if($this->nome_colunas[$i][somatorio] == 's')
				{
					//	 ESCOLHO O TIPO DE DADO
					switch($this->nome_colunas[$i][tipo])
					{
						case 'moeda':
							$valor = Util::exibe_valor_moeda($valor);
						break;
						case 'data':
							$valor = Util::data_certa($valor);
						break;
						default:
							$valor = $valor;
						break;
					}

					echo "
						 	<td align=$alinhamento>
								" . $valor . "
						 	</td>
						 ";
					$valor = '';
				}
				else
				{
					echo "<td align=$alinhamento></td>";
				}



			}
			echo '</tr>';
		}
	}





	public function get_links($pagina, $maximo_registro, $final_sql)
	{
		//	COMPLEMENTO DO LINK
		$ordem = $this->ordem;
		$filtro = $this->filtro;
		$descricao = $this->descricao;
		$complemento_link = "&ordem=$ordem&descricao=$descricao&tipo_filtro=$filtro&id_unidade=$_GET[id_unidade]$this->complemento_url_ordenacao";

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

			echo '<div align=center>';
				// Mostragem de pagina
				if($menos > 0) {
				   echo "<a href=\"?pagina=$menos$complemento_link\" class='texto_paginacao'>Anterior</a> ";
				}
				// Listando as paginas
				for($i=1;$i <= $pgs;$i++) {
					if($i != $pagina) {
					   echo "  <a href=\"?pagina=".($i)."$complemento_link\" class='texto_paginacao'>$i</a>";
					} else {
						echo "  <strong lass='texto_paginacao_pgatual'>".$i."</strong>";
					}
				}
				if($mais <= $pgs) {
				   echo "   <a href=\"?pagina=$mais$complemento_link\" class='texto_paginacao'>proxima</a>";
				}
			echo '</div>';

		}
	}



	public function excluir_registro($tabela, $nomeidtabela, $id)
	{
		$id = base64_decode($id);
		$sql = "DELETE FROM $tabela WHERE $nomeidtabela = '$id'";
		parent::executaSQL($sql);
	}
	
	
	
	
	
	public function atualiza_ordem_registro()
	{
		
	}


















}
?>