<?php include_once PATH.'/include.php'; ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php print TITULO;?></title>
		<link href="mod_pipa/css/print_rel_imposto.css" rel="stylesheet" type="text/css"/>
		
	</head>
	<body>
		
		

<?php

//	$_conexao = new ConexaoMysql();

	$_relatorio = new Relatorio();
		
	#@ mes em formato de numero via post
	$_mes = isset($_GET['mes']) ? $_GET['mes'] : false;

	$_ano = isset($_GET['ano']) ? $_GET['ano'] : false;

	#@ data Inicial
	$_dt_inicial = isset($_POST['dt_inicial']) ? DataMysql::dataForm($_POST['dt_inicial']) : "";
	
	#@ data Final
	$_dt_final = isset($_POST['dt_final']) ? DataMysql::dataForm($_POST['dt_final']) : "";
		
	//var_dump($_GET);
		
	//FuncaoBase::vd($_mes);
	
	//var_dump($_relatorio->relDirf());
	

	$dados = $_relatorio->relDirf($_ano);

?>

        <div style="text-align: center">
            <button type="submit" onclick="javascript:history.back();">Voltar</button>
            <button type="submit" onclick="javascript:window.print();">Impressão</button>
        </div>
        <br>
	
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
						<td width="200" class="titulo_c">Observação</td>
						
					</tr>	
					
					
					
					<?php
						#@ impressao do cabecalho de grupo com nome e cpf
						for ($i =0; $i < count($dados); $i++) {
							
			
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
						
							$d_contas = $_relatorio->contasDirf($dados[$i]['cpf_cnpj'], $_ano);
							
							//var_dump($d_contas);
							
							$total_valor  = 0;
							$total_SalCon = 0;
							$total_inss   = 0;
							$total_irrf   = 0;
							$total_liquido= 0;
							$total_sest   = 0;
						
							for ($j = 0; $j < count($d_contas); $j++) {
								
								//$liquido = 0;
								
								//var_dump($d_contas);
								$liquido = $d_contas[$j]['valor'] - (float)$d_contas[$j]['irrf'] - (float)$d_contas[$j]['inss'] - (float)$d_contas[$j]['sestsenat'];
								
								//var_dump((float)$d_contas[$j]['irrf']);
								
									
								
								print '<tr>
										<td class="dado5_ponta_esq">&nbsp;</td>
										<td class="dado5"></td>
										<td class="dado5">'.FuncaoBase::numTomes($d_contas[$j]['mes']).'</td>
										<td class="dado5">R$'.number_format($d_contas[$j]['valor'],2, ',', '.').'</td>
										<td class="dado5">R$'.number_format($d_contas[$j]['s_contr'],2, ',', '.').'</td>
										<td class="dado5">R$'.number_format($d_contas[$j]['inss'],2, ',', '.').'</td>
										<td class="dado5">R$'.number_format($d_contas[$j]['irrf'],2, ',', '.').'</td>
										<td class="dado5">R$'.number_format($d_contas[$j]['sestsenat'],2, ',', '.').'</td>
										<td class="dado5">R$'.number_format($liquido,2, ',', '.').'</td>
										<td class="dado5_ponta">&nbsp;</td>
										</tr>';
								
								$total_valor  += $d_contas[$j]['valor'];
								$total_SalCon += $d_contas[$j]['s_contr'];
								$total_inss   += $d_contas[$j]['inss'];
								$total_irrf   += $d_contas[$j]['irrf'];
								$total_liquido+= $liquido;
								$total_sest   += $d_contas[$j]['sestsenat'];
								
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
	
	