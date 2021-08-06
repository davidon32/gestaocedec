<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once PATH.'/include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->logado();

$_login->Sessao();

$_deposito = new Deposito();

$_relatorioAjuda = new RelatorioAju();

$nivelUser = $_SESSION['seguranca']['nivel']; 


?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo TITULO; ?></title>
	<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
	<style type="text/css">

	@media print {

		.imprimir {

			display: none;

		}


	}

	</style>
</head>
<body>
    <!-- TOPO /system/topo.php-->
    <?php include_once(PATH.'/system/topo.php'); ?>
    
	<div class="container">
		
			<!-- MENU -->
			<div class="row-fluid">
				<div class="span3 imprimir">
				    <?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
				</div>

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
					<script src="/js/jquery.js"></script>
					<script src="/js/bootstrap.js"></script>
					<script src="/js/jasny-bootstrap.js"></script>
				</body>
				</html>

