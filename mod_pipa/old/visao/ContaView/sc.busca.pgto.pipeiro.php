<?php 
include_once '../../include.php';

	$_conexao = new ConexaoMysql();
	
	$_login = new Login();

    $_login->VerificaBrowser();

    $_login->logado(CAD_ACERTO, $MODULO['mod_pipa']);

    $_login->Sessao();
	
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
	<body class="janela">
	
		<form action="#" method="POST">
			<table align="center" border="1" cellspacing="0" cellpading="0">
				<tr>
					<td>Relatorio de Pagamento de Pipeiro</td>
				</tr>
				<tr>
					<td>Nome:</td>
				</tr>
				<tr>
					<td><input type="text" name="nome" id="nome" size="20" /></td>
				</tr>
				<tr>
					<td>Placa:</td>
				</tr>
				<tr>
					<td><input type="text" name="placa" id="placa" size="20" /></td>
				</tr>
				
				<tr>
					<td align="center"><input type="submit" name="buscar" id="buscar" size="" value="Buscar" /></td>
				</tr>
				
			</table>
		</form>
	
		<?php 
		
			
			$nome = isset($_POST['nome']) ? $_POST['nome'] : false;
			
			//var_dump($nome);
			
			$placa = isset($_POST['placa']) ? $_POST['placa'] : false;
			
			//var_dump($placa);
			
			
			if($nome != false && $nome != ''){
				
				$dados = Relatorio::RelPagto(false, $nome);
			}else if($placa != null && $placa != ''){
				
				$dados = Relatorio::RelPagto($placa);
				
			}
			
			if(isset($dados)) {
					
				print '<table align="center" border="1" cellspacing="0" cellpading="0">
						<tr>
							<td><a href="rel.pgto.pipeiro.php">'.$dados[0]['nome'].'</td><td>'.$dados[0]['placa'].'</a></td>
						</tr>
						</table>'	;	
				//var_dump($dados);
			
			}
		
		?>
		
	
	
	</body>
</html>

<?php
