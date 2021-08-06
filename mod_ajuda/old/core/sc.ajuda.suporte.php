<?php
/* ****************************************************************************************
*   Org�o Gestor : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*	Autor        : Demetrio Silva Passos
*	Fun��o       : Tela para Ajuda e Suporte do Sistema 
*
*******************************************************************************************/
include_once '../../include.php';

	//Login::logado();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
				<table width="970" border="0" align="center" >
					<tr>
						<td width="150"></td>
						<td colspan="3">
						<div class="tituloCorpo">
							<span class="titulo">Formul&Aacute;rio de Contato</span>
						</div></td>
						<td width="150"></td>
	
					</tr>
					<tr>
	
						<td></td>
	                    <td colspan="3"><br /></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td align="right"><label>Nome:</label></td>
	                    <td align="left"><input type="text" /></td>
	                    <td align="left"><img src="imagem/help.png"/></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td align="right"><label>email:</label></td>
	                    <td align="left"><input type="text" /></td>
	                    <td align="left"><img src="imagem/help.png" width="16" height="16" /></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td align="right"><label>Tel:</label></td>
	                    <td align="left"><input type="text" class="mask-fone" /></td>
	                    <td align="left"><img src="imagem/help.png" alt="" title="Nome para retorno de contato"/></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td align="right" valign="top"><label>Obs:</label></td>
	                    <td align="left"><textarea name="" cols="30" rows="7"></textarea></td>
						<td align="left" valign="top"><img src="imagem/help.png" alt="" title="Nome para retorno de contato"/></td>
						<td></td>
					</tr>
					<tr>
	
						<td></td>
						<td width="100"></td>
						<td align="right">
						<input type="submit" name="" value="Enviar" />
						</td>
						<td width="300" align="left">&nbsp;</td>
						<td></td>
					</tr>
				</table>
			</div>
		</div>

		<div class="rodape">
			<?php echo RODAPE1 . ' - ' . RODAPE2 . ' - ' . RODAPE3; ?>
		</div>

	</body>
</html>