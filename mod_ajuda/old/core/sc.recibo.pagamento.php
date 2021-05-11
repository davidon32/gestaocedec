<?php include_once '../../include.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php print TITULO;?></title>
<link rel="stylesheet" type="text/css" href="../../css/estilo.css" media="" >
</head>
<style type="text/css">
<!--
	Body {
		width: 400px;
		height: 300px;
		font-size: 11px;
		text-align: center;
	
	}
-->
</style>
<body>

</body>
</html>
<?php

	
	print '<br /><a href="../rel/rel.recibo.pagamento.pdf.php?nlib='.$_GET['id_lib'].'">Salvar Recibo em PDF</a><br /><br />';
	
	print '<a href="../rel/rel.recibo.pagamento.php?nlib='.$_GET['id_lib'].'">Imprimir Recibo de Pagamento de Materiais</a><br />';
	
	print '<br /><a href="javascript:window.close()">Volta menu</a><br />';
	
	//FuncaoBase::vd($_GET);
		
			
?>