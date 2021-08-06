<?php include_once PATH.'/include.php'; ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php print TITULO;?></title>
		<link href="/mod_pipa/css/print_rel_imposto.css" rel="stylesheet" type="text/css"/>
		
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
	

	$dados = Relatorio::contasDPCA2(false, $_mes);

?>
	
		<table align="center" border="0" cellpadding="0" cellspacing="0">
		<tr>
					<td colspan="20">
						<div class="data">Data : <?php print date('d/m/Y')?></div>
						<div class="hora">Hora : <?php print date('G:i:s')?></div>
						<div class="tit_rel"><span style="font-size:15;">Relatório para DIRF <!-- pedido capitão andre --></span></div>
					</td>
					</tr>
					<tr>
						<td colspan="20" class="mes"><span style="font-size: 25px;"><?php print FuncaoBase::numTomes($_mes);?></span></td>
					</tr>
					
					<tr>
						
						<td class="titulo_c">Nº</td>
						<td class="titulo_c">Nome</td>
						<td class="titulo_c">CPF</td>
						<td class="titulo_c">Competência Mês</td>
						<td class="titulo_c">Nº RPA</td>
						<td class="titulo_c">Valor Bruto</td>	
						<td class="titulo_c">Valor BRUTO SIAF</td>
						<td class="titulo_c">Valor INSS</td>
						<td class="titulo_c">Valor GFIP</td>
						<td class="titulo_c">(DRH) Contribuição Patronal (inf. Gfip)</td>
						<td class="titulo_c">Valor Sest/Senat</td>
						<td class="titulo_c">IRRF</td>
						<td class="titulo_c">IRRF (SIAF)</td>
						<td class="titulo_c">Liquido Pago (BB)</td>
						<td class="titulo_c">Data Remessa BB</td>
						<td class="titulo_c">Nº Empenho</td>
						<td class="titulo_c">Sequência Liquidação</td>
						<td class="titulo_c">Data</td>
						<td class="titulo_c">Nº Pagto Escritural</td>
						<td class="titulo_c">Data Registro Escritural</td>
						
					</tr>	
					
					
					
					<?php
						#@ impressao do cabecalho de grupo com nome e cpf
						for ($i =0; $i < count($dados); $i++) {
							
			
						?>
						<tr>
							<td class="dado6_ponta_esq"><?php print $i+1;?></td>
							<td class="dado6"><?php print utf8_encode($dados[$i]['nome'])?></td>
							<td class="dado6"><?php print $dados[$i]['cpf_cnpj']?>&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6">&nbsp;</td>
							<td class="dado6_ponta">&nbsp;</td>
							
						<?php
						
							$d_contas = Relatorio::contasDPCA2($dados[$i]['cpf_cnpj']);
							
							//var_dump($d_contas);
							
							$total_valor  = 0;
							$total_gfip = 0;
							$total_inss   = 0;
							$total_irrf   = 0;
							$total_liquido= 0; // obs falta arrumar o somatorio do valor liquido
							$total_sest   = 0;
						
							for ($j = 0; $j < count($d_contas); $j++) {
								
								
								print '<tr>
										<td class="dado5_ponta_esq">&nbsp;</td>
										<td class="dado5"></td>
										<td class="dado5"></td>
										<td class="dado5">'.FuncaoBase::numTomes($d_contas[$j]['mes']).'</td>
										<td class="dado5">'.$d_contas[$j]['id_conta'].'</td>
										<td class="dado5">R$'.number_format($d_contas[$j]['valor'],2, ',', '.').'</td>
										<td class="dado5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
										<td class="dado5">R$'.number_format($d_contas[$j]['inss'],2, ',', '.').'</td>
										<td class="dado5">R$'.number_format($d_contas[$j]['gfip'],2, ',', '.').'</td>
										<td class="dado5">&nbsp;</td>
										<td class="dado5">R$'.number_format($d_contas[$j]['sestsenat'],2, ',', '.').'</td>
										<td class="dado5">R$'.number_format($d_contas[$j]['irrf'],2, ',', '.').'</td>
										<td class="dado5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
										<td class="dado5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
										<td class="dado5">__/__/____</td>
										<td class="dado5">&nbsp;</td>
										<td class="dado5">&nbsp;</td>
										<td class="dado5">__/__/____</td>
										<td class="dado5">&nbsp;</td>
										<td class="dado5_ponta">__/__/____</td>
										</tr>';
								
								$total_valor  += $d_contas[$j]['valor'];
								$total_gfip += $d_contas[$j]['gfip'];
								$total_inss   += $d_contas[$j]['inss'];
								$total_irrf   += $d_contas[$j]['irrf'];
								$total_liquido+= $d_contas[$j]['liquido'];
								$total_sest   += $d_contas[$j]['sestsenat'];
								
							}
							
							#@ impressao subtotal de cada pipeiro
							print '<tr>
										<td class="dado5_ponta_esq">&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td class="detalhe_subtotal">Sub Total</td>
										<td>&nbsp;</td>
										<td class="detalhe_subtotal">R$'.number_format($total_valor,2, ',', '.').'</td>
										<td>&nbsp;</td>
										<td class="detalhe_subtotal">R$'.number_format($total_inss,2, ',', '.').'</td>
										<td class="detalhe_subtotal">R$'.number_format($total_gfip,2, ',', '.').'</td>
										<td>&nbsp;</td>
										
										<td class="detalhe_subtotal">R$'.number_format($total_sest,2, ',', '.').'</td>
										<td class="detalhe_subtotal">R$'.number_format($total_irrf,2, ',', '.').'</td>
										<td class="detalhe_subtotal"></td>
										<td class="detalhe_subtotal_ponta">&nbsp;</td>
										
									</tr>';

						
							
						}
						?>
									<tr>
										<td colspan="20"><br /></td>
										
									</tr>
							
									<tr>
										<td class="detalhe_subtotal" colspan="3"></td>
										<td class="detalhe_subtotal" colspan="3">Total Valor Bruto :<?php ?></td>
										<td class="detalhe_subtotal" colspan="3">Total INSS :</td>
										<td class="detalhe_subtotal" colspan="3">Total Gfip :</td>
										<td class="detalhe_subtotal" colspan="3">Total SEST /SENAT :</td>
										<td class="detalhe_subtotal" colspan="5">Total IRRF :</td>
										</tr>
		
			</table>
	
	