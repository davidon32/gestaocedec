<?php include_once PATH.'/include.php';

	$_conexao = new ConexaoMysql();

?>
<html>
<head>
<title><?php print TITULO;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../css/pip.cadastro.css">
<script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../../js/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript" src="../../js/mascara.js"></script>

</head>
<script type="text/javascript">

	function checar(){

		if($(".cpf").val() == "") {

			alert("CPF em branco !");
			return false;
		}

					
			
	}

</script>
<body>

	<?php 
		$_op = isset($_GET['op']) ? $_GET['op'] : "";
	?>

	
	<?php
		
		
		
		
		
			/* 'op = 0' == "busca para alteracao de cadastro de motorista" */
			if((is_numeric($_op)) && ($op == 0)){
				
				
				
					print '<div class="titulo">
							Alteração de Cadastro Motorista
						   </div>
						   <br />
							<form name="buscaPipeiro" action="#" method="GET">
							<br />
														Busca Motorista
														<br />
														<br /> CPF: <input type="text" name="cpf" id="cpf" class="cpf" size="20" />
														<input type="submit" name="enviar" id="enviar" value="Buscar" onclick="return checar()" />';
					
														
										
			}
			
			/* 'op = 1' == "busca para impressao de cadastro de motorista" */
			if((is_numeric($_op)) && ($_op == 1)){
			
			
			
				print '<div class="titulo">
							Impressão de Cadastro Motorista
						   </div>
							<form name="buscaPipeiro" action="rel.impressao.cadastro.php" method="post">
							Busca Motorista
							<br /> CPF: <input type="text" name="cpf" id="cpf" class="mask-cpf" size="20" />Formato 999.999.999-99 - 99.999.999/9999-99
							<br />
							Nome: <input type="text" name="nome" size="30">
							<br />
							<input type="submit" name="enviar" id="enviar" value="Buscar" onclick="return checar()" /><br />';
				
				
			
			}
			
	
	?>
</form>
	<br />
	<div class="rodapeJanela" >
	<?php

		$cpf = isset($_GET['cpf']) ? $_GET['cpf'] : false;
		
			if($cpf != false)
				{
				
					if(count($dados = Motorista::buscaMotorista($cpf)) == 1)
						{
				
							print '<a href="sc.altera.motorista.php?cpf='.$_GET['cpf'].'" title="Alterar dados do Motorista">'.$dados[0]['nome'].'</a>';
									
						}			
				}
				
				print '<div style="width: 400px; height: 300px;"></div>';
		
				FuncaoBase::Fechar();
	?>	
	</div>



</body>







</html>


