<?php $id_session = session_id();
    if(empty($id_session)) session_start();
    require_once($_SERVER['DOCUMENT_ROOT'].'/include.php');
	//include_once PATH.'/include.php';

	//$_conexao = new ConexaoMysql();

	$_relatorio = new Relatorio();

	$lote = isset($_GET['lote']) ? $_GET['lote'] : false; 

	$_mes = isset($_GET['mes']) ? $_GET['mes'] : false; 

	$_ano = isset($_GET['ano']) ? $_GET['ano'] : false; 

	$_dt_acerto = isset($_GET['dt']) ? $_GET['dt'] : false;

	if($_dt_acerto == '//'){

		$_dt_acerto = false;
	} 

	$dados = $_relatorio->RelatorioGeralImpostos($_mes, $lote, $_dt_acerto, $_ano);

	//var_dump($_GET);
    
    //var_dump($dados);

	$tot_val = 0;
	$tot_ir = 0;
	$tot_inss = 0;
	$tot_sest = 0;
	$tot_gfip = 0;
	$tot_liquido = 0;
	$tot_sal_contr = 0;
	$tot_ir_40 = 0;	

	//var_dump($_POST);
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php print TITULO;?></title>
		<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
		<link href="/css/rel_screen.css" rel="stylesheet" media="screen">
		<link href="/mod_pipa/css/print_rel_imposto.css" rel="stylesheet" type="text/css" media="print"/>
		

	</head>
	<body>
		<div class="container">
			<table align="center" width="970" >
			<tr>
				<td align="center">
					<a href="/index.php?modulo=pipa&secao=conta&acao=filtroimpressimposto" class="btn btn-primary" title="Voltar página">Voltar</a>
					<a class="btn btn-primary" href="javascript: window.print();" title="Imprimir página">Imprimir</a>
				</td>
			</tr>
		</table>
<table class="tab_impressao" border="0" cellpadding="0" cellspacing="0" align="center">
		<tr>
		<td class="borda-cima borda-esq esquerdo" colspan="5">Data : <?php print date('d/m/Y')?></td>
			<td class="borda-cima">Lote :<?php print $lote ;?></td>
						<td class="borda-cima borda-dir direito" colspan="10">Hora : <?php print date('G:i:s')?></td>

						
					</tr>
					<tr>
						<td class="borda-esq borda-dir" colspan="17" style="font-size: 15px;text-align: center;font-weight: bold;">Relação de Impostos </td>
					</tr>
					<tr>
						<td class="borda-esq borda-dir centro" colspan="17"><span style="font-size: 25px;"><?php print FuncaoBase::numTomes($dados[0]['mes'])?>&nbsp;<?php print $_ano;?></span></td>
					</tr>
					
					<tr>
						
						<td class="cabecalho borda-cima borda-esq borda-dir borda-baixo centro">Nº<br><br></td>
						<td class="titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro">Nome</td>
						<td class="titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro">CPF</td>
						<td class="titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro">Placa</td>
						<td class="titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro">Municipio</td>
						<td class="titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro">KM</td>
						<td class="titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro">Cap. M³</td>
						<td class="titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro">Momento</td>
						<td class="titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro">Valor Bruto</td>	
						<td class="titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro">Base Impost 20%</td>
						<!-- <td class="titulo_c">Aliquota %</td>-->
						<td class="titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro">INSS 11%</td>
						<td class="titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro">Base IRRF 10%</td>
						<!-- <td class="titulo_c">Dedução INSS</td>-->
						<!-- <td class="titulo_c">Faixa</td>-->
						<!-- <td class="titulo_c">Deduzir</td>-->
						<td class="titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro">IRRF</td>		
						<td class="titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro">SestSenat 2.5%</td>
						<td class="titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro">Cont.Pat 20%</td>
						<td class="titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro">Liquido</td>
						
					</tr>	
					
					
					
					<?php
					
						for ($i =0; $i < count($dados); $i++) {
							
							$_valor = $dados[$i]['valor'];
							
							//FuncaoBase::vd($_valor);
							
							$_val_contr = round($dados[$i]['valor'] *0.2, 2);
							
							$_inss = round($dados[$i]['inss'], 2);
							
							$_rend_40 = round($dados[$i]['valor'] * 0.1, 2);
							
							//$_val_ded_inss = round($dados[$i]['valor'] *0.1, 2) - round($dados[$i]['inss'], 2);
							
							$_irrf = round($dados[$i]['irrf'], 2);
							
							$_sest_senat = round($dados[$i]['sestsenat'], 2);
							
							$_gfip = round($dados[$i]['gfip'], 2);
							
							# liquido : valor - ir - inss -sest/senat
							
							$_liquido = $dados[$i]['valor'] - $dados[$i]['inss'] - $dados[$i]['irrf'] - $dados[$i]['sestsenat'];  
							
							//$_liquido =  round($dados[$i]['liquido'], 2);
							
							//FuncaoBase::vd($_liquido);
					
					?>
						<tr>
							<td class="dado3 borda-esq <?php print ($i%2 == 1) ? "linha ": "";?>"><?php print $i+1;?></td>
							<td class="dado3 <?php print ($i%2 == 1) ? "linha ": "";?>"><?php print utf8_encode($dados[$i]['nome'])?></td>
							<td class="dado3 <?php print ($i%2 == 1) ? "linha ": "";?>"><?php print $dados[$i]['cpf_cnpj']?>&nbsp;</td>
							<td class="dado3 <?php print ($i%2 == 1) ? "linha ": "";?>"><?php print $dados[$i]['placa']?>&nbsp;</td>
							<td class="dado3 <?php print ($i%2 == 1) ? "linha ": "";?>"><?php print $dados[$i]['nrota']?>&nbsp;</td>
							<td class="dado3 <?php print ($i%2 == 1) ? "linha ": "";?>"><?php print $dados[$i]['km']?>&nbsp;</td>
							<td class="dado3 text-center <?php print ($i%2 == 1) ? "linha ": "";?>"><?php print $dados[$i]['capacidadeconta']?>&nbsp;</td>
							<td class="dado3 <?php print ($i%2 == 1) ? "linha ": "";?>"><?php print $dados[$i]['momentoconta']?>&nbsp;</td>
							
							<td class="dado3 <?php print ($i%2 == 1) ? "linha ": "";?>">R$ <?php print number_format($_valor, 2, ',', '.');?></td>
							<td class="dado3 <?php print ($i%2 == 1) ? "linha ": "";?>">R$ <?php print number_format($_val_contr, 2, ',', '.')?></td>
							<!-- <td class="dado3">11,00</td>-->
					
							<td class="dado3 <?php print ($i%2 == 1) ? "linha ": "";?>">R$ <?php print number_format($_inss, 2, ',', '.')?></td>
							<td class="dado3 <?php print ($i%2 == 1) ? "linha ": "";?>">R$ <?php print number_format($_rend_40, 2, ',', '.')?></td>
							<!--<td class="dado3">R$ <?php print number_format($_val_ded_inss, 2, ',', '.')?></td>-->
							<!-- <td class="dado3">-</td>-->
							<!-- <td class="dado3">-</td>-->
							<td class="dado3 <?php print ($i%2 == 1) ? "linha ": "";?>">R$ <?php print number_format($_irrf, 2, ',', '.')?></td>
							<td class="dado3 <?php print ($i%2 == 1) ? "linha ": "";?>">R$ <?php print number_format($_sest_senat, 2, ',', '.')?></td>
							<td class="dado3 <?php print ($i%2 == 1) ? "linha ": "";?>">R$ <?php print number_format($_gfip, 2, ',', '.')?></td>
							<td class="dado3 <?php print ($i%2 == 1) ? "linha ": "";?> borda-dir">R$ <?php print number_format($_liquido, 2, ',', '.')?></td>
						
						</tr>
					
					
				<?php
				 
					$tot_val += $_valor;
					$tot_sal_contr += $_val_contr;
					$tot_ir += $_irrf;
					$tot_inss += $_inss;
					$tot_sest += $_sest_senat;
					$tot_gfip += $_gfip;
					$tot_liquido += $_liquido;
					$tot_ir_40 += $_rend_40;
					}
				
				?>
					<tr>
						  <td colspan="14"><hr class="hr"></td>
					</tr>
					<tr>
						<td colspan="8" class="dado4">Total</td>
						<td class="dado4">R$<?php print number_format($tot_val, 2, ',', '.');?></td>
						<td class="dado4">R$<?php print number_format($tot_sal_contr, 2, ',', '.');?></td>
						<!-- <td class="dado4">&nbsp;</td>-->	
						<td class="dado4">R$<?php print number_format($tot_inss, 2, ',', '.');?></td>
						<!--<td class="dado4">&nbsp;</td>-->
						<td class="dado4">&nbsp;</td>
						<!-- <td class="dado4">&nbsp;</td>
						<td class="dado4">&nbsp;</td>-->
						<td class="dado4">R$<?php print number_format($tot_ir, 2, ',', '.');?> </td>
						<td class="dado4">R$<?php print number_format($tot_sest, 2, ',', '.');?></td>
						<td class="dado4">R$<?php print number_format($tot_gfip, 2, ',', '.');?></td>
						<td class="dado4">R$<?php print number_format($tot_liquido, 2, ',', '.');?></td>
					</tr>
					
					<tr>
                          <td colspan="14">
                              <br>
                              * Para apuração do VALOR BRUTO usar fórmula:  <span style="font-weight: bold; font-size: 12pt;">VALOR BRUTO = KM * CAPACIDADE * MOMENTO DO TRANSPORTE</span>
                              <br>
                              <br>
                              * A Base para cálculo do INSS, SEST/SENAT, CONTRIBUIÇÃO PATRONAL é : <span style="font-weight: bold; font-size: 12pt;">SALÁRIO CONTRIBUIÇÃO = VALOR BRUTO * 20%</span>
                              <br></br>
                              * O Cálculo para INSS é : <span style="font-weight: bold; font-size: 12pt;">INSS = SALÁRIO CONTRIBUIÇÃO * 11%</span>
                              <br>
                              <br>
                              * A Cálculo do SEST/SENAT é : <span style="font-weight: bold; font-size: 12pt;">SALÁRIO CONTRIBUIÇÃO * 2,5%</span>
                              <br>
                              <br>
                              * O Cálculo da CONTRIBUIÇÃO PATRONAL é :<span style="font-weight: bold; font-size: 12pt;">SALÁRIO CONTRIBUIÇÃO * 20%</span> 
                              <br>
                              <br>
                              * A Base para cálculo do IRRF é <span style="font-weight: bold; font-size: 12pt;">VALOR BRUTO * 10%</span>
                              <br>
                              <br>
                              * O VALOR LÍQUIDO é calculado na fórmula : <span style="font-weight: bold; font-size: 12pt;">VALOR LÍQUIDO = VALOR BRUTO - INSS - SEST/SENAT - IRRF</span>
                              
                              
                          </td>
                    </tr>
		
		
			</table>
	