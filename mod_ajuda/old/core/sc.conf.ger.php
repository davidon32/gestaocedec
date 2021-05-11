<?php	include_once '../../include.php';

	$_conexao = new ConexaoMysql();

	//Login::logado();
	
/* ****************************************************************************************
*   Org�o 		 : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*	Autor        :  Demetrio Silva Passos
*	Fun��o       : Tela de Configura��o Geral do Sistema
*
*******************************************************************************************/
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo TITULO; ?></title>
		<link href="css/estoque.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="js/jquery.maskedinput-1.3.min.js"></script>
		<script type="text/javascript" src="js/mascara.js"></script>
	</head>
	<body>

		<div class="layout">
			<div class="bordaForm1">
				<br />
				<table border="0" width="970px">
					<tr>
						<td width="64"></td>
						<td colspan="4" align="center">
						<div class="tituloCorpo">
					  <span class="titulo"> Configura&ccedil;&otilde;es do Sistema </span>					</div></td>
					  <td width="45"></td>
					</tr>
	                <tr>
	               	  <td>&nbsp;</td>
	                    <td width="310"></td>
	                  <td colspan="2"></td>
	                  <td width="183"></td>
	                    <td></td>
	                </tr>
	                <tr>
	                  <td>&nbsp;</td>
	                  <td width="310" align="center" bgcolor="#CCCCCC">Par&acirc;metros do Sistema</td>
	                  <td width="127"></td>
	                  <td width="201" align="center" bgcolor="#CCCCCC">Cadastro de Usu&aacute;rio</td>
	                  <td width="183"></td>
	                  <td></td>
	                </tr>
	                <tr>
	                  <td height="100">&nbsp;</td>
	                  <td align="left" valign="top"> <p>Espera de Pagamento:
	                    <input type="text" size="7" />
	                    dias</p>
	                    <form id="form1" name="form1" method="post" action="">
	                    <input type="submit" name="conf" value="Salvar Altera�oes" />
	                    </form>                    
	                    <p>&nbsp;</p></td>
	                  <td width="127"></td>
	                  <td width="201" align="center"><a href="core/sc.cadastro.usuario.php">Cadastro Usu�rio </a></td>
	                  <td width="183"></td>
	                  <td></td>
	                </tr>
				</table>
				</div>
	</div>
	</body>

</html>