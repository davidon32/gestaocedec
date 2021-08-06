<?php include_once '../include.php'; ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php print TITULO;?></title>
		<link href="../css/print_rel_imposto.css" rel="stylesheet" type="text/css"/>
		
	</head>
	<body>
		
		

<?php

	$_conexao = new ConexaoMysql();
		
	#@ mes em formato de numero via post
	$_mes = isset($_GET['mes']) ? $_GET['mes'] : false;

	#@ data Inicial
	$_dt_inicial = isset($_POST['dt_inicial']) ? DataMysql::dataForm($_POST['dt_inicial']) : "";
	
	#@ data Final
	$_dt_final = isset($_POST['dt_final']) ? DataMysql::dataForm($_POST['dt_final']) : "";
		
	//var_dump($_POST);
		
	//var_dump($_mes);
	
	//var_dump($_GET);
	
	//var_dump(Relatorio::relDirf());
	
	$_relatorio = new Relatorio();
	//$dados = $_relatorio->relDirf();

?>
	
		<table align="center" border="0" cellpadding="0" cellspacing="0">
		<tr>
		<td colspan="5" style="font-size: 9px;font-weight: bold;">Data : <?php print date('d/m/Y')?></td>
			<td style="font-size: 9px;font-weight: bold;"></td>
						<td colspan="9" style="font-size: 9px;font-weight: bold;text-align: right;">Hora : <?php print date('G:i:s')?></td>

						
					</tr>
					<tr>
						<td colspan="15" style="font-size: 15px;text-align: center;font-weight: bold;">Relatório de Conferência </td>
					</tr>
					<tr>
						<td colspan="15" style="font-size: 25px;text-align: center;"><?php print FuncaoBase::numTomes($_mes);?>&nbsp;</td>
					</tr>
					
					<tr>
						
						<td style="font-size: 9px; text-align: center; width: 20px;text-align: center;background: #BEBEBE;">Nº</td>
						<td class="titulo_c">CPF</td>
						<td class="titulo_c">Nome</td>
						<td class="titulo_c">Valor Bruto</td>	
						<td class="titulo_c">SestSenat</td>
						<td class="titulo_c">INSS</td>
						<td class="titulo_c">IRRF</td>		
						<td class="titulo_c">Liquido</td>
						<td class="titulo_c">Observação</td>
						
					</tr>	
					
					
					
					<?php
						#@ impressao do cabecalho de grupo com nome e cpf
						for ($i =0; $i < count($dados); $i++) {
							
			
						?>
						<tr>
							<td class="dado6"><?php print $i+1;?></td>
							<td class="dado6"><?php print $dados[$i]['cpf_cnpj']?>&nbsp;</td>
							<td class="dado6"><?php print utf8_encode($dados[$i]['nome'])?></td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							
						<?php
						
							$d_contas = Relatorio::contasDirf($dados[$i]['cpf_cnpj'], $_mes);
							
							//var_dump($d_contas);
							
							$total_valor  = 0;
							$total_sest   = 0;
							$total_inss   = 0;
							$total_irrf   = 0;
							$total_liquido= 0;
						
							for ($j = 0; $j < count($d_contas); $j++) {
								
								
								print '<tr>
										<td class="dado5"></td>
										<td class="dado5"></td>
										<td class="dado5">'.FuncaoBase::numTomes($d_contas[$j]['mes']).'</td>
										<td class="dado5">R$'.number_format($d_contas[$j]['valor'],2, ',', '.').'</td>
										<td class="dado5">R$'.number_format($d_contas[$j]['sestsenat'],2, ',', '.').'</td>
										<td class="dado5">R$'.number_format($d_contas[$j]['inss'],2, ',', '.').'</td>
										<td class="dado5">R$'.number_format($d_contas[$j]['irrf'],2, ',', '.').'</td>
										<td class="dado5">R$'.number_format($d_contas[$j]['liquido'],2, ',', '.').'</td>
										<td class="dado5">&nbsp;</td>
										</tr>';
								
								$total_valor  += $d_contas[$j]['valor'];
								$total_sest += $d_contas[$j]['sestsenat'];
								$total_inss   += $d_contas[$j]['inss'];
								$total_irrf   += $d_contas[$j]['irrf'];
								$total_liquido+= $d_contas[$j]['liquido'];
								
							}
							
							print '<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td class="detalhe_subtotal">Sub Total</td>
										<td class="detalhe_subtotal">R$'.number_format($total_valor,2, ',', '.').'</td>
										<td class="detalhe_subtotal">R$'.number_format($total_sest,2, ',', '.').'</td>
										<td class="detalhe_subtotal">R$'.number_format($total_inss,2, ',', '.').'</td>
										<td class="detalhe_subtotal">R$'.number_format($total_irrf,2, ',', '.').'</td>
										<td class="detalhe_subtotal">R$'.number_format($total_liquido,2, ',', '.').'</td>
										<td></td>
										
									</tr>';

						
							
						}
						?>

					<!-- <tr>
						<td colspan="3" class="dado4">-</td>
						<td class="dado4">R$<?php print number_format($tot_val, 2, ',', '.');?></td>
						<td class="dado4">R$<?php print number_format($tot_sal_contr, 2, ',', '.');?></td>
						<td class="dado4">&nbsp;</td>	
						<td class="dado4">R$<?php print number_format($tot_inss, 2, ',', '.');?></td>
						<td class="dado4">&nbsp;</td>
						<td class="dado4">&nbsp;</td>
						<td class="dado4">&nbsp;</td>
						<td class="dado4">&nbsp;</td>
						<td class="dado4">R$<?php print number_format($tot_ir, 2, ',', '.');?> </td>
						<td class="dado4">R$<?php print number_format($tot_sest, 2, ',', '.');?></td>
						<td class="dado4">R$<?php print number_format($tot_gfip, 2, ',', '.');?></td>
						<td class="dado4">R$<?php print number_format($tot_liquido, 2, ',', '.');?></td>-->
					</tr>
		
		
			</table>
	
	