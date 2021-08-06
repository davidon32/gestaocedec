<?php	include_once '../../include.php';

	$_conexao = new ConexaoMysql();

	//Login::logado();
	
?>

<html>
	<head>
		<title><?php echo TITULO; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="../js/jquery.maskedinput-1.3.min.js"></script>
		<script type="text/javascript" src="../js/mascara.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/estoque.css">
	</head>
	<body>
		<div class="topo">
			<?php
			include_once '../func/topo.php';
			?>
		</div>

		<form method="post" action="relatorio.sc.pagamento.material.php" name="form">
			<table style="text-align: left;" border="0" cellpadding="2" cellspacing="2">
				<tbody>
					<tr>
						<td colspan="3" align="center"> Consulta Material à Espera de Pagamento </td>
					</tr>
					<tr>
						<td style="vertical-align: top; background-color: rgb(217, 217, 223);">
							<label>Data Inicial:</label><input type="text" name="txtDtInicial" class="mask-data"/>
							<br />
							<label>Data Final&nbsp; :</label><input type="text" name="txtDtFinal" class="mask-data" />
							
						<br>
						</td>
						<td style="vertical-align: top; background-color: rgb(217, 217, 223);">
							<label>Municipio:</label>
							<br />
							<?php 
							$mun = new Municipio();
							$mun->PegaMunicipio();
							
							?>
							
													<br>
						</td>
						<td style="vertical-align: top; background-color: rgb(217, 217, 223);">
						<br>
						</td>
					</tr>
					<tr>
						<td style="vertical-align: top; background-color: rgb(217, 217, 223);">
						<br>
						</td>
						<td style="vertical-align: top; background-color: rgb(217, 217, 223);">
						<br>
						</td>
						<td style="vertical-align: top; background-color: rgb(217, 217, 223);">
						<br>
						</td>
					</tr>
					<tr>
						<td style="vertical-align: top; background-color: rgb(217, 217, 223);">
						<br>
						</td>
						<td style="vertical-align: top; background-color: rgb(217, 217, 223);">
						<br>
						</td>
						<td style="vertical-align: top; background-color: rgb(217, 217, 223);">
						<br>
						</td>
					</tr>
					<tr>
						<td colspan="3" align="center">
						<input value="Enviar" name="Enviar" type="submit">
						<br>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
		
		<a href="javascript: history.back();">Voltar</a>

	</body>

</html>