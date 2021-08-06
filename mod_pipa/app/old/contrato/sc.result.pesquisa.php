<?php
include_once '../../Classe/Class.Conexao.php';

	$_conexao = new ConexaoMysql();

include_once '../Classe/Class.Contrato.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Pesquisa de Motorista sem Contrato</title>
<link rel="stylesheet" type="text/css" href="../../css/estilo.css" media="" >
</head>
<body>

 

</body>
</html>

<?php 

//var_dump($_GET);

Contrato::pesquisaMotSemContrato($_GET['valor']);

?>