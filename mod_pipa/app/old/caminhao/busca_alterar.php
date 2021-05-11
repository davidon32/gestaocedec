<?php session_start();
print "<!DOCTYPE html>";
include_once PATH.'/include.php';

$_login = new Login();

$_login->VerificaBrowser();

$_login->logado(CAD_CAMINHAO, $MODULO['mod_pipa']);

$_login->Sessao();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
	<div class="container">
		<div class="row-fluid text-center">
			<img src="../imagem/topo_pipa.png" />
			<hr>
		</div>
		<!-- BARRA -->
		<div class="row-fluid">
			<div class="span6 text-left">
				<small><?php print "Data :".date("d/m/Y");?> </small>
			</div>
			<div class="span6 text-right">
				<small><?php print "Hora :".date("H:i:s");?> </small>
			</div>
		</div>

		<!-- LOGOUT -->
		<div class="row-fluid">
			<div class="span12 text-right">
				<a class="btn btn-primary" href="<?php print SISTEMA;?>/core/logout.php?logout=s" title="Logout do Sistema">Logout</a>
				<p>
				
				
				<hr>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span3">
				<?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
			</div>
			<div class="span9 fdo_corpo">

				<?php
				/* 'op = 0' == "busca caminhao para alteracao de cadastro " */
					
				$_op = isset($_GET['op']) ? $_GET['op'] : "";

				if($_op == 0){


					print '<legend>Alteração de Cadastro Caminhão</legend>
					<br />
					<form name="buscacaminhao" action="#" method="POST">
					<label>Busca Motorista</label>
					<label>Placa</label>
					<input type="text" name="placa" id="placa" data-mask="aaa-9999" />
					<br />
					<input type="submit" class="btn btn-primary" name="enviar" id="enviar" value="Pesquisar" />';
					}?>
				</form>
				<?php 

				$placa = isset($_POST['placa']) ? $_POST['placa'] : false;

				//var_dump($placa);
					
				if($placa != false)
				{

					if(count($dados = Caminhao::buscaCaminhao($placa)) == 1)
					{
						//var_dump($dados);
						print '<a href="?modulo=pipa&secao=caminhao&acao=alterar&placa='.$dados[0]['placa'].'" title="Clique para Alterar Cadastro">Placa : '.$dados[0]['placa'].'</a><br /><br />';
							
					}

				}
				?>
			</div>
			<div class="row-fluid text-center">
				<?php FuncaoBase::Fechar();?>
			</div>
		</div>
		<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
		<script src="../../js/bootstrap.js"></script>
		<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
		<script src="<?php print SISTEMA;?>/js/funcaobase.js"></script>

</body>
</html>


