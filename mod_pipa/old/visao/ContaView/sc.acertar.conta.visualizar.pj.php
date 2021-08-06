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
			<div class="span5">
				<legend>Valor Cálculo</legend>
				<?php 
				
				    

					$val_rota       = isset($_POST['vr_rota'])    ? $_POST['vr_rota']                   : "";
				
					$_id_conta      = isset($_POST['idC'])        ? $_POST['idC']                       : "";
											
					$_dt_acerto     = isset($_POST['dt_acerto'])  ? $_POST['dt_acerto']                 : "";
							
					$_mes           = isset($_POST['mes'])        ? FuncaoBase::mesTonum($_POST['mes']) : "";

					$_distancia     = isset($_POST['km'])         ? $_POST['km']                        : "";
							
					$_id_motorista  = isset($_POST['id_mot'])     ? $_POST['id_mot']                    : "";
							
					$_placa         = isset($_POST['placa'])      ? $_POST['placa']                     : "";
							
					$obs            = isset($_POST['obs'])        ? ($_POST['obs'])                     : "";
							
					$_situacao      = "0";
                    
                    $_capacidade    = isset($_POST['capacidade']) ? $_POST['capacidade']                : "";

                    $_momento       = isset($_POST['momento'])    ? $_POST['momento']                   : "";
							
                    $pessoa       = isset($_POST['pessoa'])       ? $_POST['pessoa']                    : "";
                    
					#@ numero do lote de lancamento
					$lote           = isset($_POST['lote'])       ? $_POST['lote']                      : "";
							
					$ano            = isset($_POST['ano'])        ? $_POST['ano']                       : "";

					$campos = array($val_rota,					
									$_dt_acerto,
									$_mes,
									$_distancia,
									$_id_motorista,
									$obs,
									$_situacao,
									$ano);

                    //var_dump($_POST);

					if (FuncaoBase::ValidaCampoBranco($campos)){
					    
                    //   var_dump($_POST);
                        

				?>
			
					<table border="0" class="table table-bordered">
						<tr>
							<td><label>Nome</label></td>
							<td colspan="2">: <?php print $_motorista->buscaMotoristaNome($_POST['id_mot']);?></td>
							<td><?php print $_placa;?></td>
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
					
					<br />
					
	
				</div>
			
			<div class="row-fluid">
				<div class="span12 text-center">
					<?php 
						}else {
						    
                            print "erro";
                            
						}
                       
                print "<a  class=\"btn\" href=\"controle/valida.conta.acertar.php?dt_acerto=".$_dt_acerto."
&mes=".$_mes."
&km=".$_distancia."
&id_motorista=".$_id_motorista."
&placa=".$_placa."
&situacao=".$_situacao."
&valor_rec=".number_format($val_rota, 2, '.', '')."
&id_conta=".$_id_conta."
&lote=".$lote."
&obs=".$obs."
&ano=".$ano."
&cap=".$_capacidade."
&mom=".$_momento."
&pessoa=".$pessoa."
&id=".$_id_conta."\">Gerar Pgto</a>";
                        
                  
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