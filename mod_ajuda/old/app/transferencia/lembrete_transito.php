<?php session_start();
print "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">";
include_once PATH.'/include.php';

/* ****************************************************************************************
 *   Org�o 		 : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*	Autor        : Demetrio Silva Passos
*	Fun��o       : Tela menu mostra materiais em transito
*
*******************************************************************************************/
$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->logado();

$_transferencia = new TransferenciaMaterial();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print TITULO;?></title>
<link rel="stylesheet" type="text/css" href="css/estilo.css" />
<link rel="stylesheet" type="text/css" href="/css/print.css"
	media="print" />
<style type="text/css">
<!--
	body {
		width: 500px !important;
	
	}

-->
</style>
</head>

<body>
	<div class="tituloCorpo">
		<span class="titulo"><?php print 'Material em Trânsito';?> </span>
	</div>
	<br />
	<div align="center">
		<?php 
		
		$id_transferencia = isset($_GET['id']) ? $_GET['id'] :"";

		$_transferencia->MaterialTransito($_SESSION['seguranca']['id_deposito'],
		                                  $_SESSION['seguranca']['nivel'],
		                                  $id_transferencia);
			
		//var_dump($transito);

		?>

	</div>
	<br />
	<br />
	<div class="center">
		<?php 
		FuncaoBase::fechar();
		?>
	</div>

</body>
</html>
