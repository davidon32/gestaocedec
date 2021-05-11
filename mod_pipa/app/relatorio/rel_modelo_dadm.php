<?php include_once PATH.'/include.php';

	$_relatorio = new Relatorio();

 ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php print TITULO;?></title>
	<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
	<style type="text/css">

		*{

			font-family: tahoma;
			font-size: 11px;
		}

		@media print {

			.btn {

				display: none;
			}

		}

	</style>
</head>
<body>
	<div class="container">
		<table align="center">
			<tr>
				<td align="center">
					<a href="index.php?modulo=pipa&secao=conta&acao=filtroimpressimposto" class="btn btn-primary" title="Voltar página">Voltar</a>
					<a class="btn btn-primary" href="javascript: window.print();" title="Imprimir página">Imprimir</a>
				</td>
			</tr>
		</table>
		<?php

			#@ mes em formato de numero via post
			$_mes = isset($_GET['mes']) ? $_GET['mes'] : false;
				
			$_ano =  isset($_GET['ano']) ? $_GET['ano'] : false;

			$_relatorio = new Relatorio();

			$dados = $_relatorio->RelatorioDadm($_mes, $_ano);

			//var_dump($dados);

			$tot_inss     = 0;
			$tot_irrf     = 0;
			$tot_sestsenat = 0;
			$tot_gfip     = 0;
			$tot_liquido  = 0;
			$tot_valor    = 0;

		print "<table class=\"table\" width=\"100%\">
			<tr>
				<td colspan=\"5\" style=\"font-size: 9px;font-weight: bold;\">Data : ".date('d/m/Y')."</td>
				<td colspan=\"9\" style=\"font-size: 9px;font-weight: bold;text-align: right;\">Hora : ".date('G:i:s')."</td>


			</tr>
			<tr>
				<td colspan=\"15\" style=\"font-size: 15px;text-align: center;font-weight: bold;\">Relação de Impostos /DADM</td>
			</tr>
			<tr>
				<td colspan=\"15\" style=\"font-size: 25px;text-align: center;\">".FuncaoBase::numTomes($_mes)."&nbsp;".$_ano."</td>
			</tr>";

			print "<tr>
				<td>Nº</td>
				<td>RPA</td>
				<td>Empenho</td>
				<td>Nome</td>
				<td>KM</td>
				<td>CPF</td>
				<td>Placa</td>
				<td>Inss</td>	
				<td>Irrf</td>
				<td>SestSenat</td>
				<td>Gfip</td>
				<td>Liquido</td>
				<td>Valor</td>
			</tr>";	

			for ($i =0; $i < count($dados); $i++) {

				?>
				<tr>
					<td><?php print $i+1;?></td>
					<td><?php print $dados[$i]['id_conta'];?></td>
					<td><?php print $dados[$i]['num_empenho'];?></td>
					<td><?php print utf8_encode($dados[$i]['nome']);?></td>
					<td><?php print $dados[$i]['km'];?></td>
					<td><?php print $dados[$i]['cpf_cnpj'];?></td>
					<td><?php print $dados[$i]['placa'];?></td>
					<td>R$ <?php print number_format($dados[$i]['inss'], 2, ',', '.');?></td>
					<td>R$ <?php print number_format($dados[$i]['irrf'], 2, ',', '.')?></td>
					<td>R$ <?php print number_format($dados[$i]['sestsenat'], 2, ',', '.')?></td>
					<td>R$ <?php print number_format($dados[$i]['gfip'], 2, ',', '.')?></td>
					<td>R$ <?php print number_format($dados[$i]['liquido'], 2, ',', '.')?></td>
					<td>R$ <?php print number_format($dados[$i]['valor'], 2, ',', '.')?></td>
				</tr>
			<?php

				$tot_inss     += $dados[$i]['inss'];
				$tot_irrf     += $dados[$i]['irrf'];
				$tot_sestsenat+= $dados[$i]['sestsenat'];
				$tot_gfip     += $dados[$i]['gfip'];
				$tot_liquido  += $dados[$i]['liquido'];
				$tot_valor    += $dados[$i]['valor'];

			}
								
			?>
			<tr><td colspan="5"></td>
				<td colspan="8"><hr class="hr"></td></tr>
			<tr>
				<td colspan="7">Total</td>
				<td>R$<?php print number_format($tot_inss, 2, ',', '.');?></td>
				<td>R$<?php print number_format($tot_irrf, 2, ',', '.');?></td>
				<td>R$<?php print number_format($tot_sestsenat, 2, ',', '.');?></td>
				<td>R$<?php print number_format($tot_gfip, 2, ',', '.');?> </td>
				<td>R$<?php print number_format($tot_liquido, 2, ',', '.');?></td>
				<td>R$<?php print number_format($tot_valor, 2, ',', '.');?></td>
				</tr>
				</table>	
			</body>
			</html>