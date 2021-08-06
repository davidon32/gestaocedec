<?php include_once '../../include.php';

$_conexao = new ConexaoMysql();

$_relatorioAjuda = new RelatorioAju();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo TITULO; ?></title>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<style>
 
@media print
{
  	* {font-size: 10px;}

  	.imprimir {

  		display: none;
  	}

}
</style>
</head>

<body>

	<?php	

	$_dt_inicial = isset($_POST['txtDtInicial']) ? DataMysql::dataForm($_POST['txtDtInicial']) : false;

	$_dt_final = isset($_POST['txtDtFinal']) ? DataMysql::dataForm($_POST['txtDtFinal']) : false;

	$_id_municipio = isset($_POST['id_municipio']) ? $_POST['id_municipio'] : false;

	$_id_deposito = isset($_POST['id_deposito']) ? $_POST['id_deposito'] : false;

	$visualiza = isset($_GET['id']) ? $_GET['id'] : false;

	if((is_numeric($visualiza) && $visualiza != false)){


		#@ relatorio com o id da liberacao
		$_relatorioAjuda->RelatorioVisualizaLiberacao($visualiza);
		

	}else {

		#@ relatorio com filtro de opcoes
		$_relatorioAjuda->MaterialLiberado($_dt_inicial, $_dt_final, $_id_municipio, $_id_deposito, false);

	}


	?>

	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
</body>
</html>

