<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 
print "<!DOCTYPE html>";

include_once PATH.'/include.php';
/************************************************************************************+
 #	Secretária  : Gabinete Militar do Governado de Minas Gerais                      #
 #	Órgão       : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais   #
 #  Autor       : Demetrio S. Passos     											 #
 #  Criação     : 00/00/0000														 #
 #	Descrição   :
 #
 +************************************************************************************/

//$_conexao = new ConexaoMysql();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
	<div class="container">
		<div class="row-fluid text-center">
			<img src="../imagem/topo_apoio.png" />
			<hr>
		</div>
		<!-- BARRA -->
	    <div class="row-fluid">
	      <div class="span6 text-left"><small><?php print "Data :".date("d/m/Y");?></small></div>
	      <div class="span6 text-right"><small><?php print "Hora :".date("H:i:s");?></small></div>
	    </div>

	    <!-- OPÇOES USUÁRIO -->
        <div class="row-fluid text-right"> 
           <?php include PATH.'/app/elemento/menu.usuario.php';?>
           <br><br>
           <hr>
         </div> 

		<div class="row-fluid">

			<!-- MENU -->
			<div class="span3">
				<?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
			</div>

			<!-- CORPO PAGINA  -->
			<div class="span9">
			</div>
			
			<!-- ESPAÇO CORPO -->
			<div class="row-fluid fdo_corpo"></div>
			
			<!-- RODAPE -->
			<div class="row-fluid">
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
