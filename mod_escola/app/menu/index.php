<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once "/include.php";
    
    $_conexao = new ConexaoMysql();
	
	$_login = new Login();
	
	$_login->logado();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php print TITULO;?></title>
    <!-- Bootstrap -->
    <link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
	<div class="container">
		<!-- TOPO -->
		<div class="row-fluid text-center">
			<img src="../imagem/topo_escola.png" />
			<hr>
		</div>
		
		<!-- BARRA -->
	    <div class="row-fluid">
	      <div class="span6 text-left"><small><?php print "Data :".date("d/m/Y");?></small></div>
	      <div class="span6 text-right"><small><?php print "Hora :".date("H:i:s");?></small></div>
	    </div>

	    <!-- OPÇOES USUÁRIO -->
        <div class="row-fluid text-right"> 
           <?php include 'app/elemento/menu.usuario.php';?>
           <br><br>
           <hr>
         </div> 

		<!-- MENU -->
		<div class="row-fluid">
			<div class="span3">
                <?php include_once "/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
            </div>
		
			<!-- CONTEUDO -->
			<div class="span9 fdo_corpo_imagen"></div>

		</div>

		


		<!-- RODAPE -->
		<div>
			<div class="row-fluid text-center">
				<small><?php print RODAPE;?></small>
			</div>
		</div>
	</div>    
	
	<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
</body>
</html>