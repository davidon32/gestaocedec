<?php session_start();
print "";
include_once '../../include.php';

$_conexao = new ConexaoMysql();

$_relatorio = new Relatorio();

$lote = isset($_GET['lote']) ? $_GET['lote'] : false; 

	$_mes = isset($_GET['mes']) ? $_GET['mes'] : false; 

	$_ano = isset($_GET['ano']) ? $_GET['ano'] : false; 

	$_dt_acerto = isset($_GET['dt']) ? $_GET['dt'] : false;

	if($_dt_acerto == '//'){

		$_dt_acerto = false;
	} 

	$dados = $_relatorio->RelatorioGeralImpostos($_mes, $lote, $_dt_acerto, $_ano);

	//var_dump($dados);

	$tot_val = 0;
	$tot_ir = 0;
	$tot_inss = 0;
	$tot_sest = 0;
	$tot_gfip = 0;
	$tot_liquido = 0;
	$tot_sal_contr = 0;
	$tot_ir_40 = 0;	



?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php print TITULO;?></title>
		<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
		<link href="<?php print SISTEMA;?>/mod_pipa/css/print_rel_imposto.css" rel="stylesheet" type="text/css" media="print"/>
		

	</head>
	<body>
		<div class="container">
			<table align="center" width="970" >
			<tr>
				<td align="center">
					<a href="../secao.php?secao=relatorio&acao=imposto" class="btn btn-primary" title="Voltar página">Voltar</a>
					<a class="btn btn-primary" href="javascript: window.print();" title="Imprimir página">Imprimir</a>
				</td>
			</tr>
		</table>

<table border="0" cellpadding="0" cellspacing="0" align="center" width="970px">
			<tr>
				<td colspan="7" style="font-size: 9px;font-weight: bold;">Data : <?php print date('d/m/Y')?></td>
								<td colspan="8" style="font-size: 9px;font-weight: bold;text-align: right;">Hora : <?php print date('G:i:s')?></td>
								
							</tr>
							<tr>
								<td colspan="8" style="font-size: 15px;text-align: center;font-weight: bold;">Relação de Impostos </td>
							</tr>
							<tr>
								<td colspan="8" style="font-size: 25px;text-align: center;"><?php print FuncaoBase::numTomes($dados[0]['mes'])?>&nbsp;<?php print $_ano;?></td>
							</tr>
							
							<tr>
								
								<td>Nº</td>
								<td colspan="2" class="titulo_c">Nome</td>
								<td class="titulo_c">PIS</td>
								<td class="titulo_c">Sal. Contribuição</td>
								<td class="titulo_c">INSS</td>
								<td class="titulo_c">Cont.Pat</td>
								<td class="titulo_c">SestSenat</td>
							</tr>	
							
							
							
							<?php
							
							for ($i =0; $i < count($dados); $i++) {
								
								$_valor = $dados[$i]['valor'];
								
								//FuncaoBase::vd($_valor);

								$_val_contr = round($dados[$i]['valor'] *0.2, 2);
								
								$_inss = round($dados[$i]['inss'], 2);
								
								$_val_ded_inss = round($dados[$i]['valor'] *0.4, 2) - round($dados[$i]['inss'], 2);
								
							
								$_sest_senat = round($dados[$i]['sestsenat'], 2);
								
								$_gfip = round($dados[$i]['gfip'], 2);
									
								//FuncaoBase::vd($_liquido);
								
						?>
								<tr>
									<td class="dadoCont"><?php print $i+1;?></td>
									<td colspan="2" class="dadoCont"><?php print utf8_encode($dados[$i]['nome']);?></td>
									<td class="dadoCont"><?php print $dados[$i]['pis_pasep'];?> &nbsp;</td>
									<td class="dadoCont">R$ <?php print number_format($_val_contr, 2, ',', '.');?></td>
									<td class="dadoCont">R$ <?php print number_format($_inss, 2, ',', '.');?></td>
									<td class="dadoCont">R$ <?php print number_format($_gfip, 2, ',', '.');?></td>
									<td class="dadoCont">R$ <?php print number_format($_sest_senat, 2, ',', '.');?></td>
								</tr>
								
							
						<?php
						
									$tot_sal_contr += $_val_contr;
									$tot_inss += $_inss;
									$tot_sest += $_sest_senat;
									$tot_gfip += $_gfip;
									
									//FuncaoBase::vd($tot_liquido);
							}
						
						?>
									<tr>
										<td class="dadoCont">-</td>
										<td class="dadoCont">-</td>
										<td class="dadoCont">-</td>
										<td class="dadoCont">-</td>
										<td class="dadoCont">R$<?php print number_format($tot_sal_contr, 2, ',', '.');?></td>
										<td class="dadoCont">R$<?php print number_format($tot_inss, 2, ',', '.');?></td>
										
										<td class="dadoCont">R$<?php print number_format($tot_gfip, 2, ',', '.');?></td>
										<td class="dadoCont">R$<?php print number_format($tot_sest, 2, ',', '.');?></td>
									</tr>
							</table>
		