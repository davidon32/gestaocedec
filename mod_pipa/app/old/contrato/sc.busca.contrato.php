<?php session_start();
    include_once '../../include.php';

$_conexao = new ConexaoMysql();

$_login = new Login();

    $_login->VerificaBrowser();

    $_login->logado(CAD_CONTRATO, $MODULO['mod_pipa']);

    $_login->Sessao();

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

		/*if($(".placa").val() == "") {

			alert("Placa em branco !");
			return false;*/
		}

					
			
	}

</script>
<body>
	<div class="titulo">
		Alteração de Contrato
	</div>

		
		<form name="buscacontrato" action="#" method="post">
				Busca Contrato
				<br /> Placa: <input type="text" name="placa" id="placa" class="placa" size="10" />
				<br />
				<br /> Nome Motorista: <input type="text" name="nome" id="nome" size="10" />
				<br />
				<input type="submit" name="enviar" id="enviar" value="Buscar" onclick="return checar()" />
				
	<?php

		$_enviar = isset($_POST['enviar']) ? $_POST['enviar'] : false;
	
		$_placa = isset($_POST['placa']) ? $_POST['placa'] : false;
		
		FuncaoBase::vd($_placa);
		
		$_nome = isset($_POST['nome']) ? utf8_decode($_POST['nome']) : false;
	
		FuncaoBase::vd($_nome);
	
		FuncaoBase::vd($_POST);
		
		if($_enviar != false && $_nome != '' or $_placa != ''){
		
			$_dados = Contrato::buscaContrato($_nome, $_placa);
		
			
		FuncaoBase::vd($_dados);	
		
				
		?>
		
		<table border="1" cellspacing="0">
			  <tr>
			    <td>Nome</td>
			    <td>Contrato</td>
			    <td>Data</td>
			    <td>-</td>
			  </tr>
			  

		<?php 
			for ($i = 0; $i < count($_dados); $i++) {
				
				print '<tr>
					    <td>'.utf8_encode($_dados[$i]['nome']).'</td>
					    <td>'.$_dados[$i]['num_contrato'].'</td>
					    <td>'.DataMysql::dataVisual($_dados[$i]['data_contrato']).'</td>
					    <td><a href="sc.altera.contrato.php?&id='.$_dados[$i]['id_contrato'].'">Alterar</a></td>
					    
					    
					  </tr>';
					
			}
		
		}
		?>
		
		</table>
		
	

</form>

<div class="rodapeJanela">
	<?php 
		FuncaoBase::Fechar();
	?>

</div>


</body>







</html>


