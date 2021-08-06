<?php session_start();
include_once PATH.'/include.php';

$_conexao = new ConexaoMysql();

$_relatorioAjuda = new RelatorioAju();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo TITULO; ?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<style>
 
@media print
{
  	* {font-size: 10px;}

  	.imprimir {

  		display: none;
  	}

}

table td {
    
    font-size: 10px;
    
}

table th {
    
    color: #000000;
    text-align:center;
    background-color: #A4A4A4;
    font-weight: bold;
    
}

</style>
</head>

<body>


	<?php	

	$_dt_inicial = isset($_POST['txtDtInicial']) ? DataMysql::dataForm($_POST['txtDtInicial']) : false;

	$_dt_final = isset($_POST['txtDtFinal']) ? DataMysql::dataForm($_POST['txtDtFinal']) : false;

	$_id_municipio = isset($_POST['id_municipio']) ? $_POST['id_municipio'] : false;

	$_id_deposito = isset($_POST['id_deposito']) ? $_POST['id_deposito'] : false;

	$id_liberacao = isset($_GET['id']) ? $_GET['id'] : false;

    //var_dump($_POST);
    
    $_nivel = $_SESSION['seguranca']['nivel'];

    /* relatorio de material Liberado restricao dep Avancado*/
    if(($id_liberacao == false) && ($_nivel == 4)){

        $_relatorioAjuda->RelatorioVisualizaLiberacao(false, $_SESSION['seguranca']['id_deposito']);


    } else if((is_numeric($id_liberacao) && $id_liberacao != false)){

		#@ relatorio com o id da liberacao
		$_relatorioAjuda->RelatorioVisualizaLiberacao($id_liberacao);


	}else {

		#@ relatorio com filtro de opcoes
		$_relatorioAjuda->MaterialLiberado($_dt_inicial, $_dt_final, $_id_municipio, $_id_deposito, false);


	}


	?>

	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/jasny-bootstrap.js"></script>
</body>
</html>

