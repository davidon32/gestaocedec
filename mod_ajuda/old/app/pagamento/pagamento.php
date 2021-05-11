<?php session_start();
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
	include_once PATH.'/include.php';

/* ****************************************************************************************
 *   Orgão 		 : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanitária
*
*	Autor        :  Demetrio Silva Passos
*	Função       :  Tela para Pagamento de Materiais Liberados
*
*******************************************************************************************/

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->Logado();

$_login->Sessao();

$_pagamento = new Pagamento();

//FuncaoBase::vd($_SESSION);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo TITULO; ?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="/js/funcaobase.js"></script>
</head>

<body>
    
    <!-- TOPO /system/topo.php-->
    <?php include_once(PATH.'/system/topo.php'); ?>
    
	<div class="container">
		
		<!-- MENU -->
		<div class="row-fluid">
			<div class="span3">
			   <?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
			</div>
			<div class="span9 fdo_corpo">
				<legend> Pagamento de Materiais Liberados</legend>
				
					<?php $_pagamento->mostraMaterialPagto($_SESSION['seguranca']['id_deposito'], $_SESSION['seguranca']['nivel']);?>
			</div>
		</div>
		<div class="row-fluid text-center">
			<div class="span12">
				<small><?php print RODAPE;?></small>
			</div>
		</div>
	</div>
	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/jasny-bootstrap.js"></script>
	
	</body>
</html>