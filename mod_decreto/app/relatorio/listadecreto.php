<?php $id_session = session_id();
    if(empty($id_session)) session_start(); 
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
	include_once PATH.'/include.php';
    
	$con = Conexao::getInstance();

$_login = new Login();

$_login->logado();

$_municipio = new Municipio();

$_processo = new Decretacao();

$_desastre = new Desastre();

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo TITULO;?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<style type="text/css">

	tr td {
		text-align:center;
	}
	
	.semBorda table tr td {
		border: none;
		width: 100%;
		text-align:center;
	}
</style>

</head>
<body>
	<div class="container">
		<p><h4>Perído Chuvoso <?=date("Y")." / ".(date("Y")+1);?></h4></p>

		<table class="table table-bordered">
			<tr>
				<td style="text-align:center;">Ordem</td>
				<td style="text-align:center;">Data Entrada</td>
				<td style="text-align:center;">Município</td>
				<td style="text-align:center;">
					Decreto Municipal
					
							<div style="text-align:center; width:30%";>Nº</div>
							<div style="text-align:center; width:30%";;>Data</div>
							<div style="text-align:center; width:30%"; float:right;>Vigência</div>					
				</td>
				<td style="text-align:center;">Vencimento</td>
				<td style="text-align:center;">Desastre</td>
				
				
			</tr>
		</table>
	</div>
</body>
</html>
