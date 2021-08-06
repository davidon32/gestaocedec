<?php include_once '../../include.php';

	$_conexao = new ConexaoMysql();

	//Login::logado();

?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title></title>
		<link href="../../css/estilo.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="../../js/jquery.maskedinput-1.3.min.js"></script>
		<script type="text/javascript" src="../../js/mascara.js"></script>
	</head>
	<body class="cad_mat">
		<form action="#" method="POST">
			<br />
			<table align="center" border="0" cellspacing="0" cellpading="0">
				<tr>
					<td align="center" colspan="2">Cadastro de Deposito</td>
				</tr>
				<tr>
					<td>Nome</td>
					<td>:<input type="text" name="nome" id="nome" size="50"/></td>
				</tr>
				<tr>
					<td>Endereço</td>
					<td>:<input type="text" name="endereco" id="endereco" size="50"/></td>
				</tr>
				<tr>
					<br />
					<td align="center" colspan="2"><input type="submit" name="enviar" id="enviar" value="Cadastrar" /></td>
				</tr>
			
			</table>
		</form>
	
	</body>
</html>



<?php

	$acao = isset($_POST['enviar']) ? $_POST['enviar'] : null ;
	
	//var_dump($acao);
	
	if($acao == 'Cadastrar') {
	
		$deposito = isset($_POST['nome']) ? utf8_decode($_POST['nome']) : null;
		
		$endereco = isset($_POST['endereco']) ? utf8_decode($_POST['endereco']) : null;
		
		
	
	
		if(Deposito::CadastraDeposito($deposito, $endereco)){
			
			Deposito::LancaSaldoZerado(Deposito::PegaIdDeposito($deposito));
	
		}else{
			
			print FuncaoBase::alert('Erro ao Cadastrar Depósito !');
		}
	
	}
	
	//var_dump(Deposito::vet_id_produto());
		
?>