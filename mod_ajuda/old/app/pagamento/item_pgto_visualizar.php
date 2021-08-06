<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once PATH.'/include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->logado();

$_liberacao = new Liberacao();


$_id_libera = isset($_GET['lib']) ? $_GET['lib'] : null;
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo TITULO;?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>

<div class="span12 text-center">
	<legend>Lista de Materiais da Libera&ccedil;&atilde;o</legend>

	Liberação N&ordm;:
	<?php print $_id_libera;?>
	<p>
		<?php $_liberacao->listaProdutos($_id_libera);?>

</div>

<div class="span12 text-center">
	<br />
	<br />
	<a class="btn btn-primary" href="#" onclick="window.close()">Fechar</a>
</div>
<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="/js/jasny-bootstrap.js"></script>
</body>
</html>
