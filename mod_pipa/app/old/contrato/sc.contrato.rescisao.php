<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Strict//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">";
include_once '../include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->VerificaBrowser();

$_login->logado(CAD_CONTRATO, $MODULO['mod_pipa']);

$_login->Sessao();

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php print TITULO;?></title>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">


</head>
<body>
	<div class="container">
		<div class="row-fluid text-center">
			<img src="../imagem/topo_pipa.png">
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
			<!-- MENU -->
			<div class="span3">
				<?php include_once 'visao/pipa.menu.php';?>
			</div>
			<div class="span9">

				<legend>Rescisão de Contrato</legend>

				<form action="secao.php?secao=contrato&acao=validarRescindir" method="POST" name="" id="" class="" />

				<table border="0" id="" align="center" style="width: 100%;" class="" cellspacing="0" cellpadding="0">

					<tr>
						<td>
							<label for="num_contrato">Numero Contrato</label>
						</td>
						<td valign="middle">
							<input type="text" name="num_contrato" id="num_contrato" size="20" value="" readonly="readonly" class="" title="Número do Contrato"/>
							<input type="button" name="pesquisar" id="pesquisar" value="Pesquisar"
								onclick="NovaJanela('secao.php?secao=contrato&acao=pesquisar', 700, 300)" class="btn btn-primary" title="Pesquisar Contrato para Rescisão"/>
							<input type="hidden" name="id_contrato" id="id_contrato" readonly="readonly" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="dt_rescisao">Data Rescisao</label>
						</td>
						<td>
							<input type="text" name="dt_rescisao" id="dt_rescisao" size="20" data-mask="99/99/9999" title="Data de Rescisão do Contrato" />
						</td>
					</tr>
					<tr>

						<td colspan="2">
							<br />
							<br />
							<input class="btn btn-primary" type="submit" name="rescindir" id="rescindir" value="Rescindir" title="Concluir Rescisão"/>
						</td>
					</tr>

				</table>
				</form>
			</div>

			<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
			<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
			<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
			<script src="<?php print SISTEMA;?>/js/funcaobase.js"></script>

</body>
</html>
