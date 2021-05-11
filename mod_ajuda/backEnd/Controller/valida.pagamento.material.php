<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
	include_once '../../include.php';
	
	$_conexao = new ConexaoMysql();
	
	$_login = new Login();

	$_login->logado();
	
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo TITULO;?></title>
	<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>


<?php 

$pagamento = new Pagamento();

	
			
		
		?>
		<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
</body>
</html>