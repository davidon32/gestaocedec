<?php session_start();
print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
include_once PATH.'/include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

$_login->Logado();

$_deposito = new Deposito();

if(isset($_GET['id'])){

	$_id_liberacao = (int)$_GET['id'];
	
	$_liberacao = new Liberacao();
	

	$_dados = $_liberacao->buscaLiberacao($_id_liberacao);

}




?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo TITULO;?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
<legend class="text-center">Materiais Liberados</legend>

	<div class="container">
		<div class="span12"></div>
		<div class="span12 ">
			<br />
			<table border="0" width="500px" align="center">
				<tr>
					<td>Nº</td><td><?php print $_dados[0]['id_liberacao']?></td>
				</tr>
				<tr>
					<td>Beneficiário</td><td><?php print $_dados[0]['beneficiario']?></td>
				</tr>
				<tr>
					<td>Data Liberação</td><td><?php print DataMysql::dataVisual($_dados[0]['dataLibera']);?></td>
				</tr>
				<tr>
					<td>Destino</td><td><?php print $_deposito->PegaNomeDeposito($_dados[0]['depDestino']);?></td>
				</tr>
				<tr>
					<td>Beneficiário</td><td><?php print $_dados[0]['beneficiario']?></td>
				</tr>
				
				<tr>
					<td colspan="2" align="center">Materiais</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
					<br />
						<?php 
						
							$_liberacao->ListaProdutos($_id_liberacao);
											
						?>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="text-center">
					<br />
						<?php FuncaoBase::vifs('fechar');?>
						
					</td>
				</tr>
							
			</table>
			
		
		
		</div>
	
	
	</div>



	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/jasny-bootstrap.js"></script>
	<script src="/js/funcaobase.js"></script>
</body>
</html>


