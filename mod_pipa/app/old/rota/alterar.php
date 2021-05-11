<?php session_start();
print "<!DOCTYPE html>";
include_once PATH.'/include.php';


//$_SESSION['comunidade'] = array();

$_rota = new Rota();

$_idRota = isset($_GET['id']) ? $_GET['id'] : "";

$dados = $_rota->buscaRotaId($_idRota);

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
				<legend>Alterar de Rota</legend>
				<form action="secao.php?secao=rota&acao=validarAlterar" method="POST" name="" id="" class="" />
					<?php //Municipio::PegaMunicipio();?>
					<input type="hidden" name="id" id="id" value="<?php print $_idRota; ?>" />
					<div class="controls controls-row">
                        <label>Nome Rota</label>
                        <input class="span3" type="text" name="nomerota" id="nomerota" value="<?php print $dados['nome'];?>" readonly="readonly"></td>
                    </div>
					<div class="controls controls-row">
					    <label>Número Rota</label>
						<input class="span3" type="text" name="nrota" id="nrota" maxlength="1" value="<?php print $dados['num_rota'];?>" readonly="readonly"></td>
					</div>
					<div class="controls controls-row">
					    <label>Momento</label>
						<select name="momento" id="momento" class="span3">
							<option><?php print $dados['momento'];?></option>
							<option>0.47</option>
							<option>0.49</option>
							<option>0.93</option>
						</select>					
						</div>
						<input class="btn btn-primary" type="submit" name="alterar" id="alterar" value="Alterar" onClick="ValidaCampoBranco()" />
						<br>
						<br>
					<!--Comunidade -->
				    <a href="?modulo=pipa&secao=comunidade&acao=cadastro&idrota=<?=$_idRota;?>" name="comunidade" id="comunidade" class="btn btn-primary" title="Inserir Comunidade">Inserir Comunidade</a>
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

