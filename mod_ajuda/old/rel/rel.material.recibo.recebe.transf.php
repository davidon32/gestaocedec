<?php session_start();
	print "<!DOCTYPE unspecified PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">";
	include_once "../include.php";
	
	$_conexao = new ConexaoMysql();
	
	//$_dados = $_relatorio->Recibo;
	
?>	
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo TITULO;?></title>
		<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
			
	</head>
	<body>
		<table border="0" width="700px" align="center">
			<tr>
				<td align="center"><br><?php FuncaoBase::vifs('volta', 'secao.php?secao=pagamento&acao=receber')?><br><br>
				<?php FuncaoBase::vifs('imprimir');?></td>
			</tr>
			<tr>
				<td align="center"><br>em Avaliação</td>
			</tr>
			
		</table>
		
	<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>

</body>
</html>