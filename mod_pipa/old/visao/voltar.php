<?php session_start();
print "<!DOCTYPE html>";
include_once '../../include.php';

$_conexao = new ConexaoMysql();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body>
	<div class="container">
		<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		<div class="row-fluid text-center fdo_corpo">
			<br />
		<?php

			#@ Codigo para voltar pagina
			$cod_volt = $_GET['cod'];

			#@ numero RPA
			$num_rpa  = isset($_GET['rpa']) ? $_GET['rpa'] : ""; 
			
			#@ id Motorista
			$id_mot	  = isset($_GET['id_mot']) ? $_GET['id_mot'] : ""; 
			
			#@ Placa
			$placa    = isset($_GET['pl'])     ? $_GET['pl'] : ""; 
			
			#2 Mes
			$mes      = isset($_GET['mes'])    ? $_GET['mes'] : ""; 
			
			#@ voltar cadastro motorista
			if($cod_volt == 0){
				print '	<script>
						alert("Cadastro Realizado com Sucesso !");
				</script>';
				print '<a class="btn btn-primary" href='.Voltar::Volt($cod_volt).'>Voltar</a>';
			
			}
			#@ voltar cadastro caminhao
			if($cod_volt == 1){
			    print '	<script>
			    alert("Cadastro Realizado com Sucesso !");
			    </script>';
			    print '<a href='.Voltar::Volt($cod_volt).'>Voltar</a>';
			
			}
			#@ voltar cadastro lancamento de contas
			if($cod_volt == 2) {
				
				print '<script>alert("Lancamento com Sucesso !");</script>
				 		<a class="btn btn-primary" href="../rel/rel.rpa.php?&rpa='.$num_rpa.'&mod=0">RPA - Recibo de Pagamento Autônomo</a>
						<br />
						<br />
						<a class="btn btn-primary" href="../secao.php?secao=conta&acao=acertar">Voltar</a>';
				
			}
			
		?>
		</div>
		<div class="row-fluid text-center">
			<div class="span12">
				<small><?php print RODAPE;?></small>
			</div>
		</div>
</body>
</html>
	