<?php session_start();
print "<!DOCTYPE html>";
include_once '../include.php';

$_conexao = new ConexaoMysql();

$_calculo = new Calculo();

$_motorista = new Motorista();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="<?php print SISTEMA;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php print SISTEMA;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">

</head>
<body>
	<div class="container">
		<div class="row-fluid text-center">
			<img src="../imagem/topo_pipa.png" />
			<hr>
		</div>
		<!-- BARRA -->
	    <div class="row-fluid">
	      <div class="span6 text-left"><small><?php print "Data :".date("d/m/Y");?></small></div>
	      <div class="span6 text-right"><small><?php print "Hora :".date("H:i:s");?></small></div>
	    </div>

	    <!-- LOGOUT -->
	    <div class="row-fluid">
	      <div class="span12 text-right">
	        <a class="btn btn-primary" href="<?php print SISTEMA;?>/core/logout.php?logout=s" title="Logout do Sistema">Logout</a>
	        <p>
	        <hr>
	      </div>
	    </div>
		<div class="row-fluid fdo_corpo">
			<div class="span3">
				<?php include_once 'visao/pipa.menu.php';?>
			</div>
			<div class="span3">
				<legend>Valor Cálculo</legend>
				<?php 

					$val_rota       = isset($_POST['vr_rota'])    ? $_POST['vr_rota']                   : "";
				
					$_id_conta      = isset($_POST['idC'])        ? $_POST['idC']                       : "";
											
					$_dt_acerto     = isset($_POST['dt_acerto'])  ? $_POST['dt_acerto']                 : "";
							
					$_mes           = isset($_POST['mes'])        ? FuncaoBase::mesTonum($_POST['mes']) : "";
					
					//var_dump($_mes);

					$_distancia     = isset($_POST['km'])         ? $_POST['km']                        : "";
							
					$_id_motorista  = isset($_POST['id_mot'])     ? $_POST['id_mot']                    : "";
							
					$_placa         = isset($_POST['placa'])      ? $_POST['placa']                     : "";
							
					$obs            = isset($_POST['obs'])        ? ($_POST['obs'])                     : "";
							
					$_situacao      = "0";
                    
                    $_capacidade    = isset($_POST['capacidade']) ? $_POST['capacidade']                : "";

                    $_momento       = isset($_POST['momento'])    ? $_POST['momento']                      : "";
							
					#@ numero do lote de lancamento
					$lote           = isset($_POST['lote'])       ? $_POST['lote']                      : "";
							
					$ano            = isset($_POST['ano'])        ? $_POST['ano']                       : "";     
					
                    $_pessoa = isset($_POST['pessoa'])            ? $_POST['pessoa']                    : "";

					$campos = array($val_rota,					
									$_dt_acerto,
									$_mes,
									$_distancia,
									$_id_motorista,
									$obs,
									$_situacao,
									$lote,
									$ano);
                                    
                    //var_dump($_POST);

					if (FuncaoBase::ValidaCampoBranco($campos)){

						#@ valor do inss
						$inss = $_calculo->inss($val_rota);
						//var_dump($inss);

						#@ vetor irrf com a faixa de ir
						$irrf = $_calculo->irrf($val_rota, $inss[0]);

						#@ somente o valor do irrf
						$vr_irrf = $irrf[0];
						
						#@ somente o valor base
						$base_ir = $irrf[2];
												
						#@ valor do if sest senat
						$sest_senat = $_calculo->sestSenat($val_rota);
						
						#@ valor da gfip
						$gfip = $_calculo->gfip($val_rota);
						
						#@ valor liquido a receber
						$vr_liquido = $val_rota - round($vr_irrf, 2) - round($inss[0],2) - round($sest_senat[0], 2);
				
				?>
			
					<table border="0" class="table">
						<tr>
							<td><label>Nome</label></td>
							<td colspan="2">: <?php print $_motorista->buscaMotoristaNome($_POST['id_mot']);?></td>
						</tr>
						<tr>
							<td colspan="3"><br /></td>
						</tr>
						<tr>
							<td><label>Valor Rota</label></td>
							<td>:<b>R$ <?php print number_format($val_rota, 2, ',', '.');?></b></td>
						</tr>
						<tr>
							<td colspan="3"><br /></td>
						</tr>
						</table>
				</div>
				<div class="span6">
					<legend>Informação da Faixa de IR</legend>
					<table class="table table-striped" cellpadding="0" cellspacing="0">
					<tr>
						<td>Nº Faixa</td><td>de</td><td>até</td><td>Alíquota</td><td>Dedução</td>
						</tr>
						<tr>
							<td><?php print $irrf[1][0]; ?></td>
							<td><?php print $irrf[1][1];?></td>
							<td><?php print $irrf[1][2];?></td>
							<td><?php print $irrf[1][3];?></td>
							<td><?php print $irrf[1][4];?></td>
						</tr>
					</table>
					<br />
					<legend>Demonstrativo de Impostos</legend>
					<table class="table table-striped">
						<tr>
							<td>Imposto</td>
							<td><label>Base Calculo Imposto</label></td>
							<td><label>Valor Imposto</label></td>
						</tr>
						<tr>
							<td><label>Inss</label></td>
							<td>R$ <?php print number_format($inss[1], 2, ',', '.');?></td>
							<td>R$ <?php print number_format($inss[0], 2, ',', '.');?></td>
						</tr>
						<tr>
							<td><label>I.R.R.F.</label></td>
							<td>R$ <?php print number_format($base_ir, 2, ',', '.');?></td>
							<td>R$ <?php print number_format($vr_irrf, 2, ',', '.');?></td>
						</tr>
						<tr>
							<td><label>Sest/Senat</label></td>
							<td>R$ <?php print number_format($sest_senat[1], 2, ',', '.') ;?></td>
							<td>R$ <?php print number_format($sest_senat[0], 2, ',', '.') ;?></td>
						</tr>
						<tr>
							<td><label>Gfip</label></td>
							<td>R$ <?php print number_format($gfip[0], 2, ',', '.');?></td>
							<td>R$ <?php print number_format($gfip[1], 2, ',', '.');?></td>
						</tr>
					</table>
	
				</div>
			
			<div class="row-fluid">
				<div class="span12 text-center">
					<?php 
						}

							//FuncaoBase::vd($_POST);

				print "<a  class=\"btn\" href=\"controle/valida.conta.acertar.php?inss=".number_format($inss[0], 2, '.', '')."
&dt_acerto=".$_dt_acerto."
&mes=".$_mes."
&km=".$_distancia."
&id_motorista=".$_id_motorista."
&irrf=".number_format($vr_irrf, 2, '.', '')."
&sestsenat=".number_format($sest_senat[0], 2, '.', '')."
&gfip=".number_format($gfip[1], 2, '.', '')."
&placa=".$_placa."
&situacao=".$_situacao."
&liquido=".number_format($vr_liquido, 2, '.', '')."
&valor_rec=".number_format($val_rota, 2, '.', '')."
&id_conta=".$_id_conta."
&lote=".$lote."
&obs=".$obs."
&ano=".$ano."
&cap=".$_capacidade."
&mom=".$_momento."
&pessoa=".$_pessoa."\">Gerar Pgto</a>";

				?>

				</div>
			</div>
		</div>
			
						

		<div class="row-fluid text-center"><br />
			<small><?php print RODAPE;?></small>
		</div>		
	</div>
	<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>				
	<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
</body>
</html>