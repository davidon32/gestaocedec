<?php include_once '../../include.php';

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
		<link href="../css/relatorio.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="/proj.portal_cedec/js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="/proj.portal_cedec/js/jquery.maskedinput-1.3.min.js"></script>
		<script type="text/javascript" src="/proj.portal_cedec/js/mascara.js"></script>
	</head>
	<body>
	<br />
	
	<form method="post" action="#" name="">

		Placa:<input type="text" name="placa" id="placa" class="placa" size="8" value="" >
		
		<input type="submit" name="enviar" id="enviar" size="" value="Pesquisar" >
		

	</form> 

	</body>
</html>

<?php

	$_placa = isset($_POST['placa']) ? $_POST['placa'] : false;

	
	//FuncaoBase::vd($_POST);
		
	if(($_placa != false) || ($_placa != '')) {
		

		
		$dados = Relatorio::ConsultaConta($_POST['placa']);
		
		//FuncaoBase::vd($dados);
		
		if (count($dados) == 0){
			
			print 'Pesquisa não retornou registro !';
			
		}else {
		
			for ($i = 0; $i < count($dados); $i++) {
			
				print '<table border="1" width="" cellspacing="0">
				<tr><td>'.$dados[$i][0].'</td>
				<td>'.htmlentities($dados[$i][1]).'</td>
				<td>'.FuncaoBase::numTomes($dados[$i][2]).'</td>
				</tr>
				</table>';
			
			}
		}
		
	}

	

?>


