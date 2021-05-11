<?php include_once '../../include.php'; ?>
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
		
	//var_dump($_GET);
		
	//FuncaoBase::vd($_mes);
	
	//var_dump(Relatorio::relDirf());
	

	$dados = Relatorio::relDirf1();

?>
	
		<table align="center" border="0" cellpadding="0" cellspacing="0">
		<tr>
					<td colspan="10">
						<div class="data">Data : <?php print date('d/m/Y')?></div>
						<div class="hora">Hora : <?php print date('G:i:s')?></div>
						<div class="tit_rel"><span style="font-size:15;">Relatório para DIRF <!-- pedido capitão andre --></span></div>
					</td>
					</tr>
					<tr>
						<td colspan="15" class="mes"><span style="font-size: 25px;"><?php print FuncaoBase::numTomes($_mes);?></span></td>
					</tr>
					
					<tr>
						
						<td class="titulo_c">Nº</td>
						<td class="titulo_c">CPF</td>
						<td class="titulo_c">Nome</td>
						<td class="titulo_c">Valor Bruto</td>	
						<td class="titulo_c">40% Rend Bruto</td>
						<td class="titulo_c">INSS</td>
						<td class="titulo_c">IRRF</td>
						<td class="titulo_c">Sest Senat</td>
						<td class="titulo_c">Liquido</td>
						<td class="titulo_c">Observação</td>
						
					</tr>	
					
					
					
					<?php
					
						$nreg = count($dados);
						
						
										
						#@ impressao do cabecalho de grupo com nome e cpf
						for ($i =0; $i < 10; $i++) {
							
			
						?>
						<tr>
							<td class="dado6_ponta_esq"><?php print $i+1;?></td>
							<td class="dado6"><?php print $dados[$i]['cpf_cnpj']?>&nbsp;</td>
							<td class="dado6"><?php print utf8_encode($dados[$i]['nome'])?></td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6_ponta">&nbsp;</td>
							
						<?php
						
							$total_valor  = 0;
							$total_SalCon = 0;
							$total_inss   = 0;
							$total_irrf   = 0;
							$total_liquido= 0;
							$total_sest   = 0;
								
							print count($dados[$i]['mes']);
							
							for ($j = 0; $j < count($dados[$i]['mes']); $j++) {
								
							
						
							
							
								$liquido = $dados[$j]['valor'] - $dados[$j]['irrf'] - $dados[$j]['inss'] - $dados[$j]['sestsenat'];
			
								print '<tr>
										<td class="dado5_ponta_esq">&nbsp;</td>
										<td class="dado5"></td>
										<td class="dado5">'.FuncaoBase::numTomes($dados[$i]['mes']).'</td>
										<td class="dado5">R$'.number_format($dados[$j]['valor'],2, ',', '.').'</td>
										<td class="dado5">R$'.number_format($dados[$j]['SalContr'],2, ',', '.').'</td>
										<td class="dado5">R$'.number_format($dados[$j]['inss'],2, ',', '.').'</td>
										<td class="dado5">R$'.number_format($dados[$j]['irrf'],2, ',', '.').'</td>
										<td class="dado5">R$'.number_format($dados[$j]['sestsenat'],2, ',', '.').'</td>
										<td class="dado5">R$'.number_format($liquido,2, ',', '.').'</td>
										<td class="dado5_ponta">&nbsp;</td>
										</tr>';
								
								$total_valor  += $dados[$i]['valor'];
								$total_SalCon += $dados[$i]['SalContr'];
								$total_inss   += $dados[$i]['inss'];
								$total_irrf   += $dados[$i]['irrf'];
								$total_liquido+= $liquido;
								$total_sest   += $dados[$i]['sestsenat'];
								
							}
								
						
							#@ impressao subtotal de cada pipeiro
							print '<tr>
										<td class="dado5_ponta_esq">&nbsp;</td>
										<td>&nbsp;</td>
										<td class="detalhe_subtotal">Sub Total</td>
										<td class="detalhe_subtotal">R$'.number_format($total_valor,2, ',', '.').'</td>
										<td class="detalhe_subtotal">R$'.number_format($total_SalCon,2, ',', '.').'</td>
										<td class="detalhe_subtotal">R$'.number_format($total_inss,2, ',', '.').'</td>
										<td class="detalhe_subtotal">R$'.number_format($total_irrf,2, ',', '.').'</td>
										<td class="detalhe_subtotal">R$'.number_format($total_sest,2, ',', '.').'</td>
										<td class="detalhe_subtotal">R$'.number_format($total_liquido,2, ',', '.').'</td>
										<td class="detalhe_subtotal_ponta">&nbsp;</td>
										
									</tr>';

						
							
						}
						?>
		
			</table>
	
	