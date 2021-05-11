<?php include_once '../../include.php'; ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php print TITULO ;?></title>
		<link href="../css/relatorio.css" rel="stylesheet" type="text/css" />
		<link href="../css/print.css" rel="stylesheet" type="text/css" media="print"/>
	</head>
	<body>
		
		

<?php

include_once '../../include.php';

$time = date_default_timezone_set('America/Sao_Paulo');




	$mes = FuncaoBase::mesTonum($_POST['mes']);
	
	//FuncaoBase::vd($_POST);
	//FuncaoBase::vd($mes);

	$_conexao = new ConexaoMysql();
	$dados = Relatorio::RelatorioBB($mes);
	
	$total = 0;
	
	//FuncaoBase::vd($dados);
	
	?>
<table border="1" cellpadding="0" cellspacing="0">
	
	<tr>
		<td colspan="3" style="font-size: 10px;font-weight: bold;">Data : <?php print date('d/m/Y')?></td>
		<td colspan="3" style="font-size: 10px;font-weight: bold;">Hora : <?php print date('G:i:s')?></td>
		</tr>
	<tr>
		<td colspan="6" class="titulo">Relação para Banco do Brasil</td>
	</tr>
	<tr>
		<td style="width: 50px; font-size: 10px; text-align: center; font-weight: bold; background:#D3D3D3">Nº</td>
		<td style="width: auto; font-size: 10px; text-align: center; font-weight: bold; background:#D3D3D3">Nome</td>
		<td style="width: auto; font-size: 10px; text-align: center; font-weight: bold; background:#D3D3D3">CPF</td>
		<td style="width: auto; font-size: 10px; text-align: center; font-weight: bold; background:#D3D3D3">Nº Cartão ou Conta</td>
		<td style="width: auto; font-size: 10px; text-align: center; font-weight: bold; background:#D3D3D3">Nome Mãe</td>
		<td style="width: auto; font-size: 10px; text-align: center; font-weight: bold; background:#D3D3D3">Valor Líquido a Receber</td>
	</tr>	
	
	
	
	<?php
	
	for ($i =0; $i < count($dados); $i++) {
?>
	<tr>
		<td class="dado"><?php print $i+1;?></td>
		<td class="dado_nome"><?php print utf8_encode($dados[$i][0])?>&nbsp;</td>
		<td class="dado"><?php print $dados[$i][1]?>&nbsp;</td>
		<td class="dado"><?php print $dados[$i][2]?>&nbsp;</td>
		<td class="dado_nome"><?php print utf8_encode($dados[$i][5])?>&nbsp;</td>
		<td class="dado1">R$ <?php print number_format($dados[$i][4], 2, ',', '.')?>&nbsp;</td>
	</tr>
	
	
<?php
 
	$total += $dados[$i][4];
	}

?>
	<tr>
		<td colspan="6" class="titulo_c">&nbsp;</td>
	</tr>

<tr>
		<td class="dado">&nbsp;</td>
		<td class="dado">&nbsp;</td>
		<td class="dado">&nbsp;</td>
		<td class="dado">&nbsp;</td>
		<td class="dado"><span style="text-align: right;">Total</span></td>
		<td class="dado1"><span style="font-weight: bold;">R$ <?php print number_format($total, 2, ',', '.')?></span>&nbsp;</td>
	</tr>
	<tr>
	
	</tr>
	</table>

	<?php 
	
		#@ fechar janela
		FuncaoBase::Fechar();
	
	?>
	<br />
	<a href="javascript: window.print();">Imprimir</a><br />
	<br />
	<br />
	<a href="javascript:history.back();">Voltar</a>
	

	


	</body>
</html>