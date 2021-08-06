<?php session_start();
	include_once PATH.'/include.php';

	$_conexao = new ConexaoMysql();
	
	$_login = new Login();

	$_login->Logado();
	
	$_login->Sessao();

	$_pedido = new Pedido();

if(!isset($_SESSION['cesta'])){

	$_SESSION['cesta'] = array();
}

?>
<head>
	<title> <?php print TITULO ;?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">

</head>
<body>
	<div class="conainer">
		<div class="row-fluid">
			<?php 

	 			$_pedido->MostraPedido($_SESSION['cesta']);

	 		?>
 		</div>
		<div class="row-fluid text-center"><br /><br />
		
			<?php FuncaoBase::Fechar();?>

		</div>
</div>
</body>
<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="/js/jasny-bootstrap.js"></script>
</html>