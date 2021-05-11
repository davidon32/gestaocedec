<?php 
include_once '../../include.php';

	$_conexao = new ConexaoMysql();
	
	//Login::logado();
	
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title></title>
		<link href="../css/pip.cadastro.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="../js/jquery.maskedinput-1.3.min.js"></script>
		<script type="text/javascript" src="../js/mascara.js"></script>
	</head>
	<body>
	
	<?php 
	
		foreach ($dados as $chave){
			
			print '<table border="1">
				<tr>
					<td colspan="2">'.$dados['nome'].'</td>
				</tr>
				<tr>
					<td>'.$dados['mes'].'</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
				</tr>
				<tr>
					<td></td>
				</tr>
			
			</table>';
			
			
		}
	
	
	?>
		
	
	
	
	
	</body>
</html>
