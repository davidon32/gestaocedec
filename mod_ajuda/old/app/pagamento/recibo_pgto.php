<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once PATH.'/include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->Logado();

$_login->Sessao();


/* ****************************************************************************************
 *  	Org�o Gestor : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*	Autor        :  Demetrio Silva Passos
*	Função       :  imprimir recibo pagamento de materais
*
*******************************************************************************************/

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print TITULO; ?>
</title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
	<div class="container">
		<div class="span12 text-center">
		<br>
		<br>

		<?php 

			print "<a class=\"btn\" href=\"index.php?modulo=ajuda&secao=relatorio&acao=rel_recibo_pgto&nlib=".$_GET['id']."\">Impressão Recibo</a><br /><br />";
	
			print "<a class=\"btn\" href=\"index.php?modulo=ajuda&secao=relatorio&acao=rel_recibo_pgto_pdf&nlib=".$_GET['id']."\">Salvar PDF</a><br /><br />";
			
			FuncaoBase::vifs("volta", "index.php?modulo=ajuda&secao=pagamento&acao=pagamento");


		?>
		</div>

	</div>

</body>
<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="/js/jasny-bootstrap.js"></script>

<?php 






?>