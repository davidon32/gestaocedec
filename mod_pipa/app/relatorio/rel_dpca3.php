<?php session_start();
	include_once PATH.'/include.php';

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

	//var_dump($_POST);
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
					<a href="index.php?modulo=pipa&secao=conta&acao=filtroimpressimposto" class="btn btn-primary" title="Voltar página">Voltar</a>
					<a class="btn btn-primary" href="javascript: window.print();" title="Imprimir página">Imprimir</a>
				</td>
			</tr>
		</table>
		<?php
		  for ($i =0; $i < count($dados); $i++) {
		
            print " <table class=\"tab_impressao\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\">
		              <tr>
		                  <td colspan=\"5\">Data : ".date('d/m/Y')."</td>
			              <td style=\"font-size: 9px;font-weight: bold;\">Lote :.".$lote."</td>
						  <td colspan=\"9\" style=\"font-size: 9px;font-weight: bold;text-align: right;\">Hora : ".date('G:i:s')."</td>
                      </tr>
					  <tr>
                          <td colspan=\"15\" style=\"font-size: 15px;text-align: center;font-weight: bold;\>Relação de Impostos </td>
                      </tr>
					  <tr>
						  <td colspan=\"15\" style=\"font-size: 25px;text-align: center;\">".FuncaoBase::numTomes($dados[0]['mes'])."&nbsp".$_ano."</td>
					  </tr>
					  <tr>
						
						  <td >Nº</td>
						  <td class=\"titulo_c\">Nome</td>
						  <td class=\"titulo_c\">CPF</td>
						  <td class=\"titulo_c\">Placa</td>
						  <td class=\"titulo_c\">KM</td>
						  <td class=\"titulo_c\">Valor Bruto</td>	
						  <td class=\"titulo_c\">Sal. Contribuição 20%</td>
						  <!-- <td class=\"titulo_c\">Aliquota %</td>-->
						  <td class=\"titulo_c\">INSS 11%</td>
						  <td class=\"titulo_c\">10% Rend Bruto</td>
						  <!-- <td class=\"titulo_c\">Dedução INSS</td>-->
						  <!-- <td class=\"titulo_c\">Faixa</td>-->
						  <!-- <td class=\"titulo_c\">Deduzir</td>-->
						  <td class=\"titulo_c\">IRRF</td>		
						  <td class=\"titulo_c\">SestSenat 2.5%</td>
						  <td class=\"titulo_c\">Cont.Pat 20%</td>
						  <td class=\"titulo_c\">Liquido</td>
						
					   </tr>";	
							
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
					
					
					print "<tr>
							<td class=\"dado3\">".($i+1)."</td>
							<td class=\"dado3\">".utf8_encode($dados[$i]['nome'])."</td>
							<td class=\"dado3\">".$dados[$i]['cpf_cnpj']."&nbsp;</td>
							<td class=\"dado3\">".$dados[$i]['placa']."&nbsp;</td>
							<td class=\"dado3\">".$dados[$i]['km']."&nbsp;</td>
							
							<td class=\"dado3\">R$ ".number_format($_valor, 2, ',', '.')."</td>
							<td class=\"dado3\">R$ ".number_format($_val_contr, 2, ',', '.')."</td>
							<!-- <td class=\"dado3\">11,00</td>-->
					
							<td class=\"dado3\">R$ ".number_format($_inss, 2, ',', '.')."</td>
							<td class=\"dado3\">R$ ".number_format($_rend_40, 2, ',', '.')."</td>
							<td class=\"dado3\">R$ ".number_format($_irrf, 2, ',', '.')."</td>
							<td class=\"dado3\">R$ ".number_format($_sest_senat, 2, ',', '.')."</td>
							<td class=\"dado3\">R$ ".number_format($_gfip, 2, ',', '.')."</td>
							<td class=\"dado3\">R$ ".number_format($_liquido, 2, ',', '.')."</td>
						
						</tr>
						<tr>
						  <td><br><br><br><br><br><br><br><br><br></td>
						</tr>";

						
					$tot_val += $_valor;
					$tot_sal_contr += $_val_contr;
					$tot_ir += $_irrf;
					$tot_inss += $_inss;
					$tot_sest += $_sest_senat;
					$tot_gfip += $_gfip;
					$tot_liquido += $_liquido;
					$tot_ir_40 += $_rend_40;
                    
                    print "<div style=\"page-break-before: always\"></div>";
					
                    
                    print "  <table align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
                                <tr>
                                    <td colspan=\"2\">Cálculo com base na cláusula 5ª, item 1 do Contrato de Prestação de Serviços :<br><br></td>
                                </tr>
                                <tr>
                                    <td colspan=\"2\"><br>V = L x C x Km x N<br><br></td>
                                </tr>
                                <tr>
                                    <td>V</td><td>= Valor do Cálculo</td>
                                </tr>
                                <tr>
                                    <td>L</td><td>= Volume em M³ (Capacidade do Tanque de Água)</td>
                                </tr>
                                <tr>
                                    <td>C</td><td>= Carrada (Valor por R$ 0,49* km rodado) <br>* A Defesa Civil está atendendo área Rural</td>
                                </tr>
                                <tr>
                                    <td>Km</td><td>= Distância Percorrida</td>
                                </tr>
                                <tr>
                                    <td>N</td><td>= Número de Viagens<br></br></td>
                                </tr>
                                <tr>
                                    <td>Memória de Calculo :</td><td></td>
                                </tr>
                                <tr>
                                    <td colspan=\"2\">
                                        <table align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
                                            <tr>
                                                <td>V</td>
                                                <td>L</td>
                                                <td>C</td>
                                                <td>Km</td>
                                                <td>N</td>
                                            </tr>
                                            <tr>
                                                <td>R$". number_format($_valor, 2, ',', '.')."</td>
                                                <td>". $dados[$i]['capacidade']."</td>
                                                <td>0.49</td>
                                                <td>".$dados[$i]['km']."</td>
                                                <td>1</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                              </table>";
}
				
?>	