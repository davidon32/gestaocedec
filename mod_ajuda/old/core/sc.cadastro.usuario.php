<?php include_once '../../include.php';

	$_conexao = new ConexaoMysql();

	//Login::logado();
	
/* ****************************************************************************************
 *   Org�o 		 : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*	Autor        : Demetrio Silva Passos
*	Fun��o       : Tela para cadastro de usuarios
*
*******************************************************************************************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo VERSAO; ?></title>
        <link rel="stylesheet" type="text/css" href="../css/estoque.css" />
	</head>

	<body>

		<form name="" action="valida.cadastro.usuario.php" method="post">
			<table width="793" border="0">
				<tr>
					<td width="117">Nome Usuário :</td>
					<td width="128">
					<input type="text" name="txtUsuario" size="20" />
					</td>
					<td width="17"><img src="../imagem/help.png" title="Nome do Usuário do sistema"/></td>
				  <td width="1">&nbsp;</td>
					<td colspan="2" align="center" bgcolor="#CCCCCC">Cadastros em Geral</td>
					<td width="9" align="center">&nbsp;</td>
					<td width="135" align="center" bgcolor="#CCCCCC"><p>Tela Inicial</p></td>
				</tr>
				<tr>
					<td>Senha :</td>
					<td>
					<input type="password" name="txtSenha" size="20" />
					</td>
					<td><img src="../imagem/help.png" title="Senha do Usuário do sistema"/></td>
				  <td>&nbsp;</td>
					<td width="290" align="left"><input name="ch_cad_mat" type="checkbox" id="checkbox" />
                    <span class="text">Cadastro de Materiais</span></td>
					<td width="17"><img src="../imagem/help.png" title="Acesso ao Cadastro de Materiais"/></td>
					<td width="9">&nbsp;</td>
					<td width="135"><input name="lembrete_lib" type="checkbox" id="checkbox16" />
                    <span class="text">Lembrete Liberação</span></td>
				</tr>
				<tr>
					<td>Nivel :</td>
					<td>
					<input type="text" name="txtNivel" size="20" />
					</td>
					<td><img src="../imagem/help.png" alt="Nivel de acesso" title="nivel de acesso do sistema"/></td>
				  <td>&nbsp;</td>
					<td align="left"><input type="checkbox" name="ch_lib_mat" id="checkbox2" />
                    <span class="text">Liberação de Materiais</span></td>
					<td><img src="../imagem/help.png" alt="" title="Acesso a Liberações de Materiais"/></td>
					<td>&nbsp;</td>
					<td><input name="lembrete_Transito" type="checkbox" id="checkbox17" />
                    <span class="text">Lembrete Transito</span></td>
				</tr>
				<tr>
					<td>Status:</td>
					<td>
					<input type="text" name="txtStatus" size="20" />
					</td>
					<td><img src="../imagem/help.png" alt="Usuario Ativo ou inativa" title="Usuário ativo ou inativo do sistema"/></td>
				  <td>&nbsp;</td>
					<td align="left" class="text"><input type="checkbox" name="ch_pg_mat" id="checkbox3" />
				    <label for="checkbox3"></label>
				    Pagamento de Materiais</td>
					<td class="text"><img src="../imagem/help.png" alt="" title="Acesso ao Pagamento de Materiais"/></td>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td>Deposito:</td>
					<td align="left"><?php Deposito::pegaDeposito();
					?></td>
					<td><img src="../imagem/help.png" alt="Depósito que o usuário pertence" title="Depósito o qual pertence o usuário"/></td>
				  <td>&nbsp;</td>
					<td align="left"><input type="checkbox" name="ch_transf_mat" id="checkbox4" />
                    <span class="text">Transferência de Materiais</span></td>
					<td><img src="../imagem/help.png" alt="" title="Acesso a Transferência de Materiais"/></td>
					<td colspan="2">&nbsp;</td>
				</tr>
							
				<tr>
					<td>&nbsp;</td>
					<td colspan="2">&nbsp;</td>
				  <td>&nbsp;</td>
					<td align="left"><input type="checkbox" name="ch_cons_rel" id="checkbox5" />
				    <label for="checkbox5" class="text">Consultas e Relatórios</label></td>
					<td><img src="../imagem/help.png" alt="" title="Acesso a Consulta e Relatórios do sistema"/></td>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td colspan="2">&nbsp;</td>
				  <td>&nbsp;</td>
				  <td align="left"><input type="checkbox" name="ch_cad_usuario" id="checkbox9" />
                  <span class="text">Cadastro de Usuarios</span></td>
				  <td><img src="../imagem/help.png" alt="" title="Acesso ao Cadastro de Usuários"/></td>
				  <td colspan="2">&nbsp;</td>
              </tr>
				<tr>
				  <td>&nbsp;</td>
				  <td colspan="2">&nbsp;</td>
				  <td>&nbsp;</td>
				  <td align="left"><input type="checkbox" name="ch_ajuda" id="checkbox10" />
                  <span class="text">Ajuda / Suporte</span></td>
				  <td><img src="../imagem/help.png" alt="" title="Acesso a Ajuda e Suporte"/></td>
				  <td colspan="2">&nbsp;</td>
              </tr>
				<tr>
				  <td>&nbsp;</td>
				  <td colspan="2">&nbsp;</td>
				  <td>&nbsp;</td>
				  <td colspan="2">&nbsp;</td>
				  <td colspan="2">&nbsp;</td>
              </tr>
				<tr>
				  <td>&nbsp;</td>
				  <td colspan="2">&nbsp;</td>
				  <td>&nbsp;</td>
				  <td colspan="2" align="center" bgcolor="#CCCCCC">Relatórios</td>
				  <td colspan="2" align="center">&nbsp;</td>
              </tr>
				<tr>
				  <td>&nbsp;</td>
				  <td colspan="2">&nbsp;</td>
				  <td>&nbsp;</td>
				  <td align="left"><input type="checkbox" name="ch_pos_estoque_g" id="checkbox6" />
                  <span class="text">Posição Geral do Estoque</span></td>
				  <td align="left"><img src="../imagem/help.png" alt="" title="Acesso a Posiçao do Saldo Geraldo dos Depósitos"/></td>
				  <td colspan="2" align="left">&nbsp;</td>
		      </tr>
				<tr>
				  <td>&nbsp;</td>
				  <td colspan="2">&nbsp;</td>
				  <td>&nbsp;</td>
				  <td align="left"><input type="checkbox" name="ch_pos_estoque_d" id="checkbox11" />
                  <span class="text">Posição Saldo por Depósito</span></td>
				  <td align="left"><img src="../imagem/help.png" alt="" title="Acesso a posição de Saldo filtrado por Depósito"/></td>
				  <td colspan="2" align="left">&nbsp;</td>
		      </tr>
				<tr>
				  <td>&nbsp;</td>
				  <td colspan="2">&nbsp;</td>
				  <td>&nbsp;</td>
				  <td align="left"><input type="checkbox" name="ch_cons_pgto_mat" id="checkbox12" />
                  <span class="text">Consulta Pagamento de Materiais</span></td>
				  <td align="left"><img src="../imagem/help.png" alt="" title="Acesso a Consulta de Pagamento de Materiais"/></td>
				  <td colspan="2" align="left">&nbsp;</td>
		      </tr>
				<tr>
				  <td>&nbsp;</td>
				  <td colspan="2">&nbsp;</td>
				  <td>&nbsp;</td>
				  <td align="left"><input type="checkbox" name="ch_cons_mat_lib" id="checkbox7" />
			      <span class="text"> Consulta Material Liberado</span></td>
				  <td align="left"><img src="../imagem/help.png" alt="" title="Acesso a Consulta de Materiais Liberados"/></td>
				  <td colspan="2" align="left">&nbsp;</td>
              </tr>
				<tr>
				  <td>&nbsp;</td>
				  <td colspan="2">&nbsp;</td>
				  <td>&nbsp;</td>
				  <td align="left"><input type="checkbox" name="ch_cons_espera_pg" id="checkbox8" />
                  <span class="text">Consulta Material Esperando Pagamento</span></td>
				  <td align="left"><img src="../imagem/help.png" alt="" title="Acesso a Consulta de Materiais à Espera de Pagamento"/></td>
				  <td colspan="2" align="left">&nbsp;</td>
              </tr>
				<tr>
				  <td>&nbsp;</td>
				  <td colspan="2">&nbsp;</td>
				  <td>&nbsp;</td>
				  <td align="left"><input type="checkbox" name="ch_cons_tranf_mat" id="checkbox13" />
			      <span class="text">			      Consulta Transferência de Materiais</span></td>
				  <td align="left"><img src="../imagem/help.png" alt="" title="Acesso a Consulta de Materiais Transferidos"/></td>
				  <td colspan="2" align="left">&nbsp;</td>
              </tr>
				<tr>
				  <td>&nbsp;</td>
				  <td colspan="2">&nbsp;</td>
				  <td>&nbsp;</td>
				  <td align="left"><input type="checkbox" name="ch_cons_mat_transito" id="checkbox14" />
                  <span class="text">Consulta Material em Trânsito</span></td>
				  <td align="left"><img src="../imagem/help.png" alt="" title="Acesso a Consulta de Materiais em trênsito"/></td>
				  <td colspan="2" align="left">&nbsp;</td>
              </tr>
				<tr>
				  <td>&nbsp;</td>
				  <td colspan="2">&nbsp;</td>
				  <td>&nbsp;</td>
				  <td align="left"><input type="checkbox" name="ch_cons_lib" id="checkbox15" />
			      <span class="text">			      Consulta de Liberações</span></td>
				  <td align="left"><img src="../imagem/help.png" alt="" title="Acesso a Consulta de Liberações"/></td>
				  <td colspan="2" align="left">&nbsp;</td>
              </tr>
				<tr>
				  <td>&nbsp;</td>
				  <td colspan="2">&nbsp;</td>
				  <td>&nbsp;</td>
				  <td colspan="2" align="left">&nbsp;</td>
				  <td colspan="2" align="left">&nbsp;</td>
              </tr>
				<tr>
				  <td>&nbsp;</td>
				  <td colspan="2">&nbsp;</td>
				  <td>&nbsp;</td>
				  <td colspan="4"></td>
		      </tr>
		      <tr>
				  <td>&nbsp;</td>
				  <td colspan="2">&nbsp;</td>
				  <td>&nbsp;</td>
				  <td colspan="2" align="center" bgcolor="#CCCCCC">Conf Sistema</td>
				  <td colspan="2" align="center">&nbsp;</td>
              </tr>
				<tr>
				  <td>&nbsp;</td>
				  <td colspan="2">&nbsp;</td>
				  <td>&nbsp;</td>
				  <td align="left"><input type="checkbox" name="ch_conf_ger" id="checkbox6" />
                  <span class="text">Configuracao Geral Sistema</span></td>
				  <td align="left"><img src="../imagem/help.png" alt="" title="Acesso as Configuracoes Gerais do Sistema"/></td>
				  <td colspan="2" align="left">&nbsp;</td>
		      </tr>
			</table>

			<table border="1" cellspacing="0">
				<tr>
					<td></td>
			  </tr>

		  </table>
		  <input type="submit" name="cadastra" value="Cadastrar" />
		  <a href='#'>Voltar </a>
			
		</form>
	</body>
</html>