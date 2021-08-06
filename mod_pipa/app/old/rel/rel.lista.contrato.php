<?php include_once '../../include.php'; ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php print TITULO ;?></title>
		<link href="../css/relatorio.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		
		

<?php

	$_conexao = new ConexaoMysql();
	
	$dados = Relatorio::listaContratoGeral($_GET['tipo']);
	
	
	//FuncaoBase::vd($dados);
	
	?>
<table align="center" border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td colspan="4" class="titulo">Listagem Geral de Contrato</td>
	</tr>
	<tr>
		<td class="titulo_c">Número Contrato</td>
		<td class="titulo_c">Nome</td>
		<td class="titulo_c">CPF</td>
		<td class="titulo_c">Placa</td>
		<td class="titulo_c">Data Contrato</td>
		<td class="titulo_c">Situação</td>
		
	</tr>	
	
	
	
	<?php
	
	$total_registro = 0;
	
	for ($i =0; $i < count($dados); $i++) {
	
		$total_registro++;
?>
	<tr>
		<td style="width: 50; height: 20; font-size: 10; text-align: center;"><?php print $dados[$i]['num_contrato']?>&nbsp;</td>
		<td style="width: 230; height: 20; font-size: 10; text-align: left; font-weight: bold;"><?php print utf8_encode($dados[$i]['nome'])?>&nbsp;</td>
		<td style="width: 70; height: 20; font-size: 10; text-align: center; font-weight: bold;"><?php print $dados[$i]['cpf_cnpj']?>&nbsp;</td>
		<td style="width: 70; height: 20; font-size: 10; text-align: center; font-weight: bold;"><?php print $dados[$i]['placa']?>&nbsp;</td>
		<td style="width: 70; height: 20; font-size: 10; text-align: center; font-weight: bold;"><?php print DataMysql::dataVisual($dados[$i]['data_contrato'])?>&nbsp;</td>
		<td style="width: 70; height: 20; font-size: 10; text-align: center; font-weight: bold;"><?php print $dados[$i]['situacao'];?>&nbsp;</td>
		
	</tr>
	
<?php
	}

?>

	<tr>
		<td colspan="4">&nbsp;</td>
		
	</tr>
	
	<tr>
		<td></td>
		<td colspan="2" style="width: 50; height: 20; font-size: 10; text-align: right;">Total de Registros :</td>
		<td style="width: 50; height: 20; font-size: 10; text-align: center;">
			 <?php print $total_registro;?>
		</td>
	</tr>
	
	</table>

	<?php 
	
		#@ fechar janela
		FuncaoBase::Fechar();
	
	?>
	<a href="javascript: window.print();">Imprimir</a><br />
	<br />
	<br />
	<a href="javascript:history.back();">Voltar</a>
	

	


	</body>
</html>