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
			<div class="span9">
				<legend>Cadastro de Caminhão</legend>

				<form id="form1" name="form1" method="post" action="?modulo=pipa&secao=caminhao&acao=validar">

					<div class="controls controls-row">
						<input class="span3" type="text" name="placa" id="placa" data-mask="aaa-9999" placeholder="Placa">
						<a href="?modulo=pipa&secao=caminhao&acao=pesquisar" class="window btn" rel="500x400">Pesquisa</a>
					</div>

					<div class="controls controls-row">
						<input class="span3" name="modelo" type="text" id="modelo" placeholder="Modelo" />
						<input class="span3" name="marca" type="text" id="marca" placeholder="Marca" />
						<input class="span3" name="fabric" type="text" data-mask="9999" id="fabric" maxlength="4" placeholder="Ano" />
					</div>

					<div class="controls controls-row">
						<input class="span3" type="text" name="chassi" id="chassi" placeholder="Chassi" />
						<input class="span3" type="text" name="renavam" id="renavam" placeholder="Renavam" />
						<input class="span3" type="text" name="capacidade" id="capacidade" placeholder="Capacidade M³" maxlength="2" />
					</div>

					<input class="btn btn-primary" type="submit" id="cadastrar" name="cadastrar" value="Cadastrar"
						onclick="return confirm('Deseja Confirmar o cadastro !');" />
				</form>
			</div>
			<div class="row-fluid fdo_corpo"></div>
			<div class="row-fluid">
				<div class="span12 text-center">
					<small><?php print RODAPE;?> </small>
				</div>
			</div>

		</div>

		<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
		<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
		<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
		<script src="<?php print SISTEMA;?>/js/funcaobase.js"></script>
		<script type="text/javascript">

    ﻿$(document).ready(function()
{

  /* Quando algum hyperlink com a classe "window" for clicado */

  $('a.window').click(function()
  {
    var dimensions = (this.rel) 
      ? this.rel
      : '660x600';
    dimensions = dimensions.split('x');
    var width = dimensions[0];
    var height = dimensions[1];
    var bWindow = window.open(this.href, this.id, 'width=' + width + ',height=' + height + ',left=' + (((screen.width - width) / 2) - 20) + ',top=' + (((screen.height - height) / 2) - 20) + ',scrollbars=yes,resizable=yes,toolbars=no');
    bWindow.focus();
    return false; 
  });
});

</script>

</body>
</html>
