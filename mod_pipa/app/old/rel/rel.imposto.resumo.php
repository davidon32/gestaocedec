<?php include_once '../include.php'; ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php print TITULO;?></title>
		<!--<link href="../css/print_rel_imposto.css" rel="stylesheet" type="text/css"/>-->
		<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
		
	</head>
	<body>
<?php

	$_conexao = new ConexaoMysql();
    
    $_calculo = new Calculo();
		
	#@ mes em formato de numero via post
	$_ano = isset($_GET['ano']) ? $_GET['ano'] : false;
    
    $dadosPf = $_calculo->resumoContasPf($_ano);
    $dadosPj = $_calculo->resumoContasPj($_ano);
    
    //var_dump($dados);
    
    /* total pessoa fisica */
    $totalValorPf = 0.0;
    $totalInssPf  = 0.0;
    $totalIrrfPf  = 0.0;
    $totalSestSenatPf = 0.0;
    $totalGfipPf  = 0.0;
    
    /* total pessoa juridica */
    $totalValorPj = 0.0;
    
    
    /* total geral */
    $totalGeralValor = 0.0;
    $totalGeralInss  = 0.0;
    $totalGeralIrrf  = 0.0;
    $totalGeralSestSenat = 0.0;
    $totalGeralGfip  = 0.0;

	
?>
<div class="span12">
    <legend>Resumo de Contas</legend>
<table class="table">
	
	<tr>
		<td style="text-align: center" colspan="7">
			<label style="font-weight: bold; ">Pessoa Física</label>
		</td>
	</tr>
	
	<?php 

	       print "<td style='text-align:center' colspan='7'>Ano ".$dadosPf[0]['ano']."</td>";
           
           print "<tr>
                    <th>Mes</th>
                    <th>Valor</th>
                    <th>Inss</th>
                    <th>Irrf</th>
                    <th>SestSenat</th>
                    <th>Gfip</th>
                    <th>Liquido</th>
                </tr>";
	   
       for ($i=0; $i < count($dadosPf); $i++) {
           
           print "<tr>
                    <td>".FuncaoBase::numTomes($dadosPj[$i]['mes'])."</td>
                    <td>".'R$'.number_format($dadosPf[$i]['Valor'], 2, ',', '.')."</td>
                    <td>".'R$'.number_format($dadosPf[$i]['Inss'], 2, ',', '.')."</td>
                    <td>".'R$'.number_format($dadosPf[$i]['Irrf'], 2, ',', '.')."</td>
                    <td>".'R$'.number_format($dadosPf[$i]['SestSenat'], 2, ',', '.')."</td>
                    <td>".'R$'.number_format($dadosPf[$i]['Gfip'], 2, ',', '.')."</td>
                    <td>".'R$'.number_format($dadosPf[$i]['Liquido'], 2, ',', '.')."</td>
                </tr>";
                
                // total pf
                $totalValorPf += $dadosPf[$i]['Valor'];
                $totalInssPf  += $dadosPf[$i]['Inss'];
                $totalIrrfPf  += $dadosPf[$i]['Irrf'];
                $totalSestSenatPf += $dadosPf[$i]['SestSenat'];
                $totalGfipPf  += $dadosPf[$i]['Gfip'];
                
                // total Geral
                $totalGeralValor += $dadosPf[$i]['Valor'];
                $totalGeralInss  += $dadosPf[$i]['Inss'];
                $totalGeralIrrf  += $dadosPf[$i]['Irrf'];
                $totalGeralSestSenat += $dadosPf[$i]['SestSenat'];
                $totalGeralGfip  += $dadosPf[$i]['Gfip'];
       
       }

       print "<tr>
                    <td style='font-weight:bold;'>Total</td>
                    <td style='font-style: italic; font-weight:bold;'>".'R$'.number_format($totalValorPf, 2, ',', '.')."</td>
                    <td style='font-style: italic; font-weight:bold;'>".'R$'.number_format($totalInssPf, 2, ',', '.')."</td>
                    <td style='font-style: italic; font-weight:bold;'>".'R$'.number_format($totalIrrfPf, 2, ',', '.')."</td>
                    <td style='font-style: italic; font-weight:bold;'>".'R$'.number_format($totalSestSenatPf, 2, ',', '.')."</td>
                    <td style='font-style: italic; font-weight:bold;'>".'R$'.number_format($totalGfipPf, 2, ',', '.')."</td>
                    <td style='font-style: italic; font-weight:bold;'>".'R$'.number_format($totalValorPf - $totalInssPf - $totalIrrfPf - $totalSestSenatPf, 2, ',', '.')."</td>
                </tr>";
	   
	   ?>
	</tr>
	</table>
	<br>
	<br>
	
	
	<!-- pessoa juridica -->
	
	<table class="table">
	<tr>
		<td style="text-align: center" colspan="7">
			<label style="font-weight: bold;">Pessoa Jurídica</label>
		</td>
	</tr>
	<?php  print "<td style=\"text-align: center\" colspan='7'>Ano ".$dadosPj[0]['ano']."</td>";
    
            print "<tr>
                      <th>Mes</th>
		              <th>Valor</th>
		              <th></th>
		              <th></th>
		              <th></th>
		              <th></th>
		              <th>Líquido</th>
	               </tr>";
                   
	       for ($i=0; $i < count($dadosPj); $i++) {
           
                   print "<tr>
                        <td>".FuncaoBase::numTomes($dadosPj[$i]['mes'])."</td>
                        <td>".'R$'.number_format($dadosPj[$i]['Valor'], 2, ',', '.')."</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>".'R$'.number_format($dadosPj[$i]['Valor'], 2, ',', '.')."</td>";
                        
                        $totalValorPj += $dadosPj[$i]['Valor'];
                        $totalGeralValor += $dadosPj[$i]['Valor'];
           }
    
    print "<tr>
                    <td style='font-weight:bold;'>Total</td>
                    <td style='font-style: italic; font-weight:bold;'>".'R$'.number_format($totalValorPj, 2, ',', '.')."</td>
                    <td colspan='4'></td>
                    <td style='font-style: italic; font-weight:bold;'>".'R$'.number_format($totalValorPj, 2, ',', '.')."</td>
           </tr>";
                   
    ?>
    
    </table>
	<br>
	<br>
	<table class="table">
	<!-- Total geral -->
	<tr>
		<td style="text-align: center" colspan="6">
			<label style="font-weight: bold;" >Total Geral</label>
		</td>
	</tr>
	<tr>
		<th>Total Valor</th>
		<th>Total Inss</th>
		<th>Total Irrf</th>
		<th>Total SestSenat</th>
		<th>Total Gfip</th>
		<th>Total Liquido</th>
	</tr>
	<tr>
		<td><?php print 'R$'.number_format($totalGeralValor, 2, ',', '.'); ?></td>
		<td><?php print 'R$'.number_format($totalGeralInss, 2, ',', '.'); ?></td>
		<td><?php print 'R$'.number_format($totalGeralIrrf, 2, ',', '.'); ?></td>
		<td><?php print 'R$'.number_format($totalGeralSestSenat, 2, ',', '.'); ?></td>
		<td><?php print 'R$'.number_format($totalGeralGfip, 2, ',', '.'); ?></td>
		<td><?php print 'R$'.number_format($totalGeralValor - $totalGeralInss - $totalGeralIrrf - $totalGeralSestSenat, 2, ',', '.'); ?></td>
	</tr>

</table>
</div>

	
	