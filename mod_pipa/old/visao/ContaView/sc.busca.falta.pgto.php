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
		<link href="../../css/pip.cadastro.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="../../js/jquery.maskedinput-1.3.min.js"></script>
		<script type="text/javascript" src="../../js/mascara.js"></script>
	</head>
	<body>
	
		
	
		<form action="#" method="POST" name="" >
	
		<?php 
			FuncaoBase::mes();
		?>
		
								
			<input type="submit" name="pesquisa" id="pesquisa" value="Pesquisar">
		
		</form>
		
		<?php 
			
		
			$mes = isset($_POST['mes']) ? $_POST['mes'] : false;
				
			//FuncaoBase::vd($mes);
		
		?>
		
		
		<table border="1" width="600px" cellspacing="0" cellpadding="0">
			<tr>
				<td colspan="3">Relatório de Pipeiros Faltar Efetuar Calculos<br /><br /></td>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center; font-size: 20px; font-family: tahoma"><?php print $mes; ?><br /></td>
			</tr>
			
			<tr>
				<th style="width: 250px; font-size: 10px; font-family: tahoma">Nome </th>
				<th style="width: 100px; font-size: 10px; font-family: tahoma">CPF</th>
				<th style="width: 100px; font-size: 10px; font-family: tahoma">Placa</th>
				<th style="width: 100px; font-size: 10px; font-family: tahoma">Situação</th>
				<th style="width: 100px; font-size: 10px; font-family: tahoma">Data Rescisão</th>
			</tr>
		
		<?php 

			//$numMes = '01/'.FuncaoBase::mesToNum($mes).'';
			
			$dados = Relatorio::buscaFaltaPagamento(FuncaoBase::mesToNum($mes));
		
			//FuncaoBase::vd($dados);
			

			
			for ($i = 0; $i < count($dados); $i++) {
				
		?>
				
		
		
		  <tr>
		    <td style="width: 250px; font-size: 8px; text-align: left; font-family: tahoma"><?php print htmlentities($dados[$i][0]);?></td>
		    <td style="width: 150px; font-size: 8px; text-align: left; font-family: tahoma"><?php print htmlentities($dados[$i][2]);?></td>
		    <td style="width: 100px; font-size: 8px; font-family: tahoma"><?php print $dados[$i][1];?></td>
		     <td style="width: 100px; font-size: 8px; font-family: tahoma; text-align: center" ><?php print $dados[$i][3];?></td>
		      <td style="width: 100px; font-size: 8px; font-family: tahoma"><?php print $dados[$i][4];?></td>
		  </tr>
		
		
		
		
		<?php 
		
			}
		
		
		
		?>
		<tr>
			<td colspan="3" style="text-align: right; font-family: tahoma; font-size: 8px;">Total de Registros : <?php print count($dados);?>&nbsp;&nbsp;</td>
		</tr>
		</table>
		
		
		<?php 
			FuncaoBase::Imprimir();
			
			FuncaoBase::Fechar();?>
	
	</body>
</html>


