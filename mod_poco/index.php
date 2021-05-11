<?php session_start();

include_once '../include.php';

$_conexao = new ConexaoMysql();

//FuncaoBase::vd($_SESSION);

//Login::logado();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print TITULO;?></title>
<link href="/proj.portal_cedec/css/estilo.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/proj.portal_cedec/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="/proj.portal_cedec/js/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript" src="/proj.portal_cedec/js/mascara.js"></script>
</head>
<body>
	<div class="topo"><img src="../imagem/topo_poco.png" /></div><br />

	<div class="logout"><a class="btn btn-primary" href="../core/logout.php?logout=s">Logout</a></div>
	
	<div class="menu"></div>
			
	<div class="corpo">
  	<!-- corpo -->
  	<br />
  	<div style="font-size: 20px;">
  	
  	<?php print 'Modulo Poço Artesiano em construção'?>
  	</div>
  		
	
	</div>
	
	<div class="rodape">rodape</div>
</body>



</html>