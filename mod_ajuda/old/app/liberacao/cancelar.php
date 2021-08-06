<?php session_start();
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
	include_once PATH.'/include.php';

	$_conexao = new ConexaoMysql();

	$_login = new Login();

	$_login->logado();
	
	$_login->Sessao();
	
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Cancelamento de Liberacao <?php print TITULO;?></title>
		<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">

	</head>
	<body>
	    
	    <!-- TOPO /system/topo.php-->
        <?php include_once(PATH.'/system/topo.php'); ?>
	    
		<div class="container">
			
			<!-- MENU -->
			<div class="row-fluid">
				<div class="span3">
				    <?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
				</div>

				<div class="span9 fdo_corpo">

					<legend>Cancelar Liberação</legend>

					<form method="POST" action="index.php?modulo=ajuda&secao=liberacao&acao=valida&opcao=cancela" name="frm_cancela">
		
				
						<label>Nº Liberacao </label>
						<input type="text" name="txt_id_libera" id="txt_id_libera" />

						<label>Motivo </label>
						<textarea name="txt_motivo" id="txt_motivo" /></textarea>
						<br />
						<input class="btn btn-primary" type="submit" name="btn_cancela" onclick="return confirm('Confirmar Cancelamento de Liberacao ?\n\n Atencao Processo sem volta !')"  value="Confirmar" />
						</td>
					</tr>
				
					</table>
				</form>
			</div>
		</div>
		<!-- RODAPE -->
		<div class="row-fluid">
			<div class="span12 text-center">
				<hr>
				<small><?php print RODAPE;?></small>
			</div>
		</div>
	</body>
	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/jasny-bootstrap.js"></script>
</html>	

