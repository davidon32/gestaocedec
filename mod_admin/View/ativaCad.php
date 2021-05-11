<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once '../include.php';

//Login::logado();

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php print TITULO; ?></title>
		<link href="/css/bootstrap.css" rel="stylesheet" media="">
    <link href="/css/bootstrap-responsive.css" rel="stylesheet" media="">
	</head>
	<body>
	<div class="container">

		<!-- TOPO -->
		<div class="row-fluid text-center">
			<img src="../imagem/topo_gestao.png" alt="Topo" />
			<hr>
		</div>

		<!-- BARRA -->
		<div class="row-fluid">
			<div class="span6 text-left">
				<small><?php print "Data :" . date("d/m/Y"); ?></small>
			</div>
			<div class="span6 text-right">
				<small><?php print "Hora :" . date("H:i:s"); ?></small>
			</div>
		</div>

		<!-- OPÇOES USUÁRIO -->
		<div class="row-fluid text-right"> 
           <?php
            //require_once('view/menu.adm.php');
            ?>
         </div>


		<div class="row-fluid">
			<!-- MENU -->
			<div class="span2">
            <?php include_once 'view/menuadm.php';?>
          </div>

			<!-- CORPO -->
			<div class="span10" style="min-height: 700px;" >

			</div>
			<br>
			<br>
			<div class="span12 text-center">
            	<small><?php print RODAPE;?></small>
        </div>
		</div>

	</div>

	<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="/js/jasny-bootstrap.js"></script>
<script src="/js/funcaobase.js"></script>

</body>
</html>