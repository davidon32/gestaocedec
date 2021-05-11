<?php session_start();
/* ****************************************************************************************
 *  	Org�o Gestor : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*	Autor        :  Demetrio Silva Passos
*	Fun��o       : script para remocao de item no pedido
*
*******************************************************************************************/

include_once PATH.'/include.php';

	$_conexao = new ConexaoMysql();

	$_login = new Login();

	$_login->logado();
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../css/estilo.css" />
</head>

<body class="remove">
	<br />
	<?php
	$remove = isset($_GET['r']) ? $_GET['r']: null;
	$item = isset($_GET['item']) ? $_GET['item'] : null;

		
																		

	if($remove == true){
	
		unset($_SESSION['cesta'][$item]);

		print "<script type='text/javascript'>";

		print "alert('Item Removido com Sucesso !');";

		print "</script>";	

	}

		$_SESSION['cesta'] = array_values($_SESSION['cesta']);

		print "<script type='text/javascript'>";

		print "window.location = 'index.php?token=".hash('sha256', md5(VERSAO)."-".time())."&ac=&modulo=ajuda&secao=liberacao&acao=add_material'";

		print "</script>";	
		
		?>

	<br />
	
</body>
</html>
