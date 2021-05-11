<?php session_start();
print "<!DOCTYPE html>";
include_once PATH.'/include.php';

$_SESSION['comunidade'] = array();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<script type="text/javascript">

	function esconde() {

		$("#erro").hide();

	}

</script>
</head>
<body>
	<div class="container">
		<div class="row-fluid text-center">
			<img src="../imagem/topo_pipa.png">
			<hr>
		</div>
		<!-- BARRA -->
	    <div class="row-fluid">
	      <div class="span6 text-left"><small><?php print "Data :".date("d/m/Y");?></small></div>
	      <div class="span6 text-right"><small><?php print "Hora :".date("H:i:s");?></small></div>
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
				<?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
			</div>

			<div class="span9">
				<legend>Cadastro de Rota</legend>
				<form action="?modulo=pipa&secao=rota&acao=validar" method="POST" name="" id="" class="" />
					<?php Municipio::PegaMunicipio();?>
					<div class="controls controls-row">
						<input class="span3" type="text" name="nrota" id="nrota" maxlength="2" placeholder="Número da Rota"></td>
						&nbsp;&nbsp;<a href="javascript:NovaJanela('?modulo=pipa&secao=rota&acao=pesquisar', 500, 600)" class="btn btn-primary">Pesquisa</a>
					</div>
					<div class="controls controls-row">
						<select name="momento" id="momento" class="span3">
							<option>Momento</option>
							<option>0.47</option>
							<option>0.49</option>
							<option>0.93</option>
						</select>					
					</div>
					<div>
					    <input class="span3" type="text" name="txtAno" id="txtAno" value="<?php print date('Y');?>" maxlength="4"/>
					    
					</div>
						<input class="btn btn-primary" type="submit" name="cadastrar" id="cadastrar" value="Cadastrar"	onClick="ValidaCampoBranco()" />
						<br>
						<br>
				</form>
			</div>
		</div>
		<div class="row-fluid fdo_corpo"></div>
		<div class="row-fluid text-center">
			<small><?php print RODAPE;?></small>
		</div>
	</div>
	
	<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/funcaobase.js"></script>
</body>
</html>

