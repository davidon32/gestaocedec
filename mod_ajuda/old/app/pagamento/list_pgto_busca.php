<?php session_start();
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
	include_once PATH.'/include.php';

	$_conexao = new ConexaoMysql();

	$_login = new Login();

	$_login->logado();
	
	$_login->Sessao();

	$_deposito = new Deposito();

	$_municipio = new Municipio();
	
?>
<html>
	<head>
		<title><?php echo TITULO; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
	</head>
	<body>
		<div class="container">
			<!-- TOPO /system/topo.php-->
            <?php include_once(PATH.'/system/topo.php'); ?>

			<!-- MENU -->
			<div class="row-fluid">
				<div class="span3">
				    <?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
				</div>

				<div class="span9 fdo_corpo">

			    	<form method="POST" action="index.php?modulo=ajuda&secao=relatorio&acao=rel_material_pago" name="frm_rel_pagamento" >
						<!---->
				
					<legend>Relat&oacute;rio de Material Pago</legend>
					   
					<label>Dep&oacute;sito Destino:</label>
					<?php $_deposito->pegaDeposito();?>
						
					<label>Data Inicial:</label>
					<input type="text" name="txt_dt_inicial" data-mask="99/99/9999" title="Periodo Inicial de Pagamento "/>

					<label>Data Final:</label>
					<input type="text" name="txt_dt_final" data-mask="99/99/9999" title="Periodo Final de Pagamento"/>
					
					<label>Munic&iacute;pio:</label>
					<?php $_municipio->PegaMunicipio();?>
					<br />

					<input class="btn btn-primary" type="submit" name="btn_enviar" value="Relatório" />
					 
					</form>

					<?php 

					//var_dump($_POST);

					 ?>

				</div>
        
       <div class="span12 text-center">
       		<small><?php print RODAPE;?></small>
       </div>

    <script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/jasny-bootstrap.js"></script>
	</body>
</html>
