<?php include_once PATH.'/include.php'; ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php print TITULO;?></title>
		<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
		<link href="mod_pipa/css/print_rel_imposto.css" rel="stylesheet" type="text/css"/>
		<link href="<?php print SISTEMA;?>/css/rel_screen.css" rel="stylesheet" media="screen">
	
	</head>
	<body>
<?php

	$_relatorio = new Relatorio();
    
    $_funcaoBase = new FuncaoBase();
		
	#@ mes em formato de numero via post
	$_mes = isset($_GET['mes']) ? $_GET['mes'] : false;

	$_ano = isset($_GET['ano']) ? $_GET['ano'] : false;

	#@ data Inicial
	$_dt_inicial = isset($_POST['dt_inicial']) ? DataMysql::dataForm($_POST['dt_inicial']) : "";
	
	#@ data Final
	$_dt_final = isset($_POST['dt_final']) ? DataMysql::dataForm($_POST['dt_final']) : "";

	$dados = $_relatorio->relDirfPrestConta($_ano);

?>

	<div class="span12 text-center">
		<button class="btn" onclick="javascript:history.back();">Voltar</button>
		<button class="btn" onclick="javascript:window.print();">Imprimir</button>

	</div>

		<table align="center" border="0" cellpadding="0" cellspacing="0">

		<tr>
					<td class="borda-cima" colspan="14">
						<div class="data">Data : <?php print date('d/m/Y')?></div>
						<div class="hora">Hora : <?php print date('G:i:s')?></div>
						<div class="tit_rel "><span style="font-size:15;">Relatório para PRESTAÇÃO DE CONTA <!-- pedido Ribeiro DADM --></span></div>
					</td>
					</tr>
					<tr>
						<td colspan="14" class="mes"><span style="font-size: 25px;"><?php print FuncaoBase::numTomes($_mes);?></span></td>
					</tr>
					
					<tr>
						
						<td class="titulo_c cabecalho"><br>Nº<br><br></td>
						<td class="titulo_c cabecalho">CPF</td>
						<td class="titulo_c cabecalho">Nome</td>
						<td class="titulo_c cabecalho">PIS/PASEP</td>
						<td class="titulo_c cabecalho">Município</td>
						<td class="titulo_c cabecalho">Valor Bruto</td>	
						<td class="titulo_c cabecalho">INSS</td>
						<td class="titulo_c cabecalho">IRRF</td>
						<td class="titulo_c cabecalho">Sest Senat</td>
						<td class="titulo_c cabecalho">Liquido</td>
						<td class="titulo_c cabecalho">QFE</td>
						<td class="titulo_c cabecalho">&nbsp;&nbsp;Valor QFE&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td class="titulo_c cabecalho">Valor BB</td>
						<td class="titulo_c cabecalho">Nº RPA</td>

						
					</tr>	
					
					
					
					<?php
						#@ impressao do cabecalho de grupo com nome e cpf
						for ($i =0; $i < count($dados); $i++) {
							
			
						?>
						<tr>
							<td class="dado6_ponta_esq"><?php print $i+1;?></td>
							<td class="dado6"><?php print $dados[$i]['cpf_cnpj']?>&nbsp;</td>
							<td class="dado6"><?php print utf8_encode($dados[$i]['nome'])?></td>
							<td class="dado6"><?php print $dados[$i]['pis_pasep']?>&nbsp;</td>
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
										<td class="dado5"></td>
										<td class="dado5">'.$d_contas[$j]['nrota'].'</td>
										<td class="dado5">R$'.number_format($d_contas[$j]['valor'],2, ',', '.').'</td>
										<td class="dado5">R$'.number_format($d_contas[$j]['inss'],2, ',', '.').'</td>
										<td class="dado5">R$'.number_format($d_contas[$j]['irrf'],2, ',', '.').'</td>
										<td class="dado5">R$'.number_format($d_contas[$j]['sestsenat'],2, ',', '.').'</td>
										<td class="dado5">R$'.number_format($liquido,2, ',', '.').'</td>
										<td class="dado5qfe">&nbsp;</td>
										<td class="dado5">&nbsp;</td>
										<td class="dado5">R$'.number_format($d_contas[$j]['liquido'],2, ',', '.').'</td>
										<td class="dado5">'.$d_contas[$j]['id_conta'].'</td>
										</tr>';
								
								$total_valor  += $d_contas[$j]['valor'];
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
										<td class="detalhe_subtotal"></td>
										<td class="detalhe_subtotal"></td>
										<td class="detalhe_subtotal">R$'.number_format($total_valor,2, ',', '.').'</td>
										<td class="detalhe_subtotal">R$'.number_format($total_inss,2, ',', '.').'</td>
										<td class="detalhe_subtotal">R$'.number_format($total_irrf,2, ',', '.').'</td>
										<td class="detalhe_subtotal">R$'.number_format($total_sest,2, ',', '.').'</td>
										<td class="detalhe_subtotal">R$'.number_format($total_liquido,2, ',', '.').'</td>
										<td class="detalhe_subtotal_ponta">&nbsp;</td>
										
									</tr>';

						
							
						}
						?>
		
			</table>
	
	