<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once '../include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->logado();

$_deposito = new Deposito();

$_relatorioAjuda = new RelatorioAju();

$nivelUser = $_SESSION['seguranca']['nivel']; 


?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo TITULO; ?></title>
	<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
	<style type="text/css">

	@media print {

		.imprimir {

			display: none;

		}


	}

	</style>
</head>
<body>
	<div class="container">
		<!-- TOPO-->
		<div class="row-fluid text-center imprimir">
			<img src="../images/topo_ajuda.png" />
			<hr>
		</div>

		<!-- BARRA -->
		<div class="row-fluid imprimir">
			<div class="span6 text-left"><small><?php print "Data :".date("d/m/Y");?></small></div>
			<div class="span6 text-right"><small><?php print "Hora :".date("H:i:s");?></small></div>
		</div>
		
		<!-- LOGOUT -->
		<div class="row-fluid text-right imprimir">
			<a class="btn" href="<?php print SISTEMA;?>/core/logout.php?logout=s" title="Fazer logout do sistema">Logout</a>
			<p>
				<hr>
		</div>

			<!-- MENU -->
			<div class="row-fluid">
				<div class="span3 imprimir"><?php include_once 'visao/sc.ajuda.menu.php';?></div>

				<div class="span9 text-center fdo_corpo">
					<legend>Posi&ccedil;&atilde;o de Saldo por Dep&oacute;sito</legend>

					<form action="#" method="POST" name="frm_enviar">
						
						<table border="0" align="center">
							<tr>
								<?php

									#@ Saldo de por Depósito 
								if(($nivelUser > 1)) {
									
									print "<td>Deposito:</td>
									<td><td>";

									$_deposito->pegaDeposito();

									print "<tr>
									<td colspan='3' align='center'>
									<button class='btn imprimir' type='submit' name='btn_enviar' value='btn_enviar'>Visualizar</button><br /></td>
									</tr>";

								}elseif ($nivelUser < 2) {

									$id_deposito = $_SESSION['seguranca']['id_deposito'];

									$_relatorioAjuda->SaldoDeposito($id_deposito, $_SESSION['seguranca']['nivel'], $_SESSION['seguranca']['idUser']);

								}



								?>
						</table>
					</form>


							<?php

							$id_deposito = isset($_POST['id_deposito']) ? $_POST['id_deposito'] : null;
							$_enviar     = isset($_POST['btn_enviar']) ? true : null;

							if($_enviar) {

								$_relatorioAjuda->SaldoDeposito($id_deposito, $nivelUser, $_SESSION['seguranca']['idUser']);

							}

							?>

				</div>
			</div>	
			<div class="span12 text-center">
				<small><?php //print RODAPE;?></small>	
			</div>
	</div>
					<script src="http://code.jquery.com/jquery.js"></script>
					<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
					<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
				</body>
				</html>

