<?php	include_once '../../include.php';

	$_conexao = new ConexaoMysql();

	//Login::logado();
	
	
 //print $dados = Relatorio::MaterialPago();
 

 
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo TITULO; ?></title>
		<link rel="stylesheet" type="text/css" href="../../css/estilo.css" />
		<script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="../../js/jquery.maskedinput-1.3.min.js"></script>
		<script type="text/javascript" src="../../js/mascara.js"></script>
		
		
	</head>
	<body>

		<form method="post" action="menu.ajuda.php?&op=rmpg" name="" >
			<p>
				<center>
					<table border="1">
	
							<tr>
								<td></td>
								<td align="center" colspan="3">Consulta de Material Pago</td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>
								</td>
								<td><label>Data Inicial:</label></td>
								<td>
									<input type="text" name="txtDtInicial" class="mask-data" size="11" id="" title="Periodo Inicial de Liberacoes "/>
								</td>
								<td>Produto :</td>
								<td>
									<?php print Produto::pegaProduto();?>
								</td>
							</tr>
							<tr>
								<td></td>
								<td><label>Data Final:</label> </td>
								<td>
									<input type="text" name="txtDtFinal" class="mask-data" size="11" id="" title="Periodo Final de Liberacoes"/>
								</td>
								<td>Depósito:</td>
								<td><?php Deposito::pegaDeposito();?></td>
							</tr>
							<tr>
								<td></td>
								
								<td>Municipio:</td>
								<td>
									<?php Municipio::PegaMunicipio();?>
								</td>
								<td></td>
								
							</tr>
							<tr>
								<td></td>
								<td><?php 
										if($_SESSION['seguranca']['nivel'] == 3)
												
											print 'Deposito:'?></td>
								<td><?php
									 if($_SESSION['seguranca']['nivel'] == 3)
									 	Deposito::pegaDeposito();
									?>
								</td>
								<td></td>
								
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td><input type="submit" value="Pesquisar" /></td>
								<td></td>
								
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td><a href="javascript:window.close()">Voltar</a></td>
								<td></td>
								
							</tr>

					</table>
				</center>

			
		</form>
	</body>
</html>
