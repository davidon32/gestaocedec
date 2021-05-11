<?php session_start();
	include_once PATH.'/include.php';

	$_conexao = new ConexaoMysql();

	$_relatorio = new Relatorio();

	$lote = isset($_GET['lote']) ? $_GET['lote'] : false; 

	$_mes = isset($_GET['mes']) ? $_GET['mes'] : false; 

	$_ano = isset($_GET['ano']) ? $_GET['ano'] : false; 

	$_dt_acerto = isset($_GET['dt']) ? $_GET['dt'] : false;
    
    $_individual = isset($_GET['tp']) ? $_GET['tp'] : false;

	if($_dt_acerto == '//'){

		$_dt_acerto = false;
	} 

	$dados = $_relatorio->RelatorioContasPj($_mes, $lote, $_ano, $_individual);

	//var_dump($dados);

	$tot_val = 0;

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
					<a href="index.php?modulo=pipa&secao=conta&acao=filtroimpressimposto" class="btn btn-primary" title="Voltar página">Voltar</a>
					<a class="btn btn-primary" href="javascript: window.print();" title="Imprimir página">Imprimir</a>
				</td>
			</tr>
		</table>
<table class="tab_impressao" border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
		<tr>
		<td class="borda-cima borda-esq esquerdo" colspan="3">Data : <?php print date('d/m/Y')?></td>
			<td colspan="3" class="borda-cima">Lote :<?php print $lote ;?></td>
						<td class="borda-cima borda-dir direito" colspan="3">Hora : <?php print date('G:i:s')?></td>

						
					</tr>
					<tr>
						<td class="borda-esq borda-dir" colspan="9" style="font-size: 15px;text-align: center;font-weight: bold;">Relação de Impostos </td>
					</tr>
					<tr>
						<td class="borda-esq borda-dir centro" colspan="9"><span style="font-size: 25px;"><?php print FuncaoBase::numTomes($dados[0]['mes'])?>&nbsp;<?php print $_ano;?></span></td>
					</tr>

                    <?php if(!$_individual){ 					
    					print "<tr> 
                                    <td class='cabecalho borda-cima borda-esq borda-dir borda-baixo centro'>Nº<br><br></td>
                                    <td class='titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro'>Nome</td>
                                    <td class='titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro'>CNPJ</td>
                                    <td class='titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro'>Placa</td>
                                    <td class='titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro'>Capacidade<br>M³</td>
                                    <td class='titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro'>Momento<br>(Tipo piso)</td>
                                    <td class='titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro'>Rota</td>
                                    <td class='titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro'>KM</td>    
                                    <td class='titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro'>Valor</td>
                                </tr>";
                     }
					
						for ($i =0; $i < count($dados); $i++) {
						        
						    if($_individual && $i== 0) {
                                print "<tr>
                                            <td class='cabecalho borda-cima borda-esq borda-dir borda-baixo centro'>Nº<br><br></td>
                                            <td class='titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro'>Nome</td>
                                            <td class='titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro'>CNPJ</td>
                                            <td class='titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro'>Placa</td>
                                            <td class='titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro'>Capacidade<br>M³</td>
                                            <td class='titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro'>Momento<br>(Tipo piso)</td>
                                            <td class='titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro'>Rota</td>
                                            <td class='titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro'>KM</td>    
                                            <td class='titulo_c cabecalho borda-cima borda-esq borda-dir borda-baixo centro'>Valor</td>
                                        </tr>";
                            }   
							
							$_valor = $dados[$i]['valor'];
					?>
						<tr>
							<td class="dado3 borda-esq <?php print ($i%2 == 1) ? "linha ": "";?>"><?php print $i+1;?></td>
							<td class="dado3 <?php print ($i%2 == 1) ? "linha ": "";?>"><?php print utf8_encode($dados[$i]['nome'])?></td>
							<td class="dado3 <?php print ($i%2 == 1) ? "linha ": "";?>"><?php print $dados[$i]['cpf_cnpj']?>&nbsp;</td>
							<td class="dado3 centro <?php print ($i%2 == 1) ? "linha ": "";?>"><?php print $dados[$i]['placa']?>&nbsp;</td>
							<td class="dado3 centro <?php print ($i%2 == 1) ? "linha ": "";?>"><?php print $dados[$i]['capacidade']?>&nbsp;</td>
							<td class="dado3 centro <?php print ($i%2 == 1) ? "linha ": "";?>"><?php print "R$ ".$dados[$i]['momento']?>&nbsp;</td>
							<td class="dado3 <?php print ($i%2 == 1) ? "linha ": "";?>"><?php print $dados[$i]['nomerota']."&nbsp;&nbsp;".$dados[$i]['num_rota'];?></td>
							<td class="dado3 <?php print ($i%2 == 1) ? "linha ": "";?>"><?php print $dados[$i]['km']?>&nbsp;</td>
							<td class="dado3 centro <?php print ($i%2 == 1) ? "linha ": "";?> borda-dir">R$ <?php print number_format($dados[$i]['valor'], 2, ',', '.')?></td>
						</tr>
				<?php
				 
					$tot_val += $_valor;
					
					}
				
				?>
					<tr>
						  <td colspan="9"><hr class="hr"></td>
					</tr>
					<tr>
						<td colspan="8" class="dado4">Total</td>
						<td class="dado4">R$<?php print number_format($tot_val, 2, ',', '.');?></td>
					</tr>
			</table>
	