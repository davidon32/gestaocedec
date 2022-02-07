<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";

$_relatorioAjuda = new RelatorioAju();



?>
<style>
 
@media print
{
  	* {font-size: 10px;}
  	.imprimir {
  		display: none;
  	}
	a:link {
		display: none;
	}
}

table td {
    
    font-size: 12px;
    
}

table th {
    
    color: #000000;
    text-align:center;
    background-color: #A4A4A4;
    /*font-weight: bold;*/
    
}

</style>
	<?php	
        
	$_dt_inicial = isset($_POST['txtDtInicial']) ? DataMysql::dataForm($_POST['txtDtInicial']) : false;

	$_dt_final = isset($_POST['txtDtFinal']) ? DataMysql::dataForm($_POST['txtDtFinal']) : false;

	$_id_municipio = isset($_POST['id_municipio']) ? $_POST['id_municipio'] : false;

	$_id_deposito = isset($_POST['id_deposito']) ? $_POST['id_deposito'] : false;

	$id_liberacao = isset($_GET['id']) ? $_GET['id'] : false;
    
	$_nivel = $_COOKIE['seguranca']['nivel'];

	$id_material = isset($_POST['id_material']) ? $_POST['id_material'] : "";
	      
		$total = 0;
                $totalEntrada = 0;
                $totalLiberacao = 0;
                $totalTransferencia = 0;
		$listRel = $_relatorioAjuda->RelatorioListaMat($id_material);
                
                $entrada = $_relatorioAjuda->EntradaMaterial($_POST);
                $transferencia = $_relatorioAjuda->EntradaMaterialTransf($_POST);
      
                print "</br>";
		print "<p align='center'><a href='".FuncaoBase::geraLink("ajuda", "relatorio", "fbusca_liberacao")."' class='btn btn-primary'>Voltar</a></p>";
                print "<br>";
                print !empty($_POST['txtDtInicial']) ? "<legend>Pedíodo : ".$_POST['txtDtInicial']." a ".$_POST['txtDtFinal']."</legend>" : "";
                print "<p style='text-align:center'>";
                print !empty($_POST['id_deposito']) ? "<legend>DEPÓSITO ".Deposito::PegaNomeDeposito($_POST['id_deposito'])." - ": "<legend>" ;
                print Unidade::PegaNomeId($id_material)."</legend></p>";
                               
                $corEntrada = "#057A60";
                $corSaida = "#FE2E2E";
                
                
                /* Entrada de materiais */
		print "<table class='table table-bordered table-condensed'>";
		print "<tr>";
		print "<th style='color:".$corEntrada."' colspan='8'><h4>Entrada de Materiais</h4></th>";
		print "</tr>";
		print "<tr>";
		print "<th style='color:".$corEntrada."' width='5%'>#</th>";
		print "<th style='color:".$corEntrada."' width='10%'>Cod Entrada</th>";
		print "<th style='color:".$corEntrada."' width='10%'>Data Entrada</th>";
		print "<th style='color:".$corEntrada."' width='10%'>Cód Material</th>";
		print "<th style='color:".$corEntrada."' width='35%'>Nome</th>";
		print "<th style='color:".$corEntrada."' width='30%'>Origem Material</th>";
		print "<th style='color:".$corEntrada."' width='30%'>Deposito Destino</th>";
                
		print "<th style='color:".$corEntrada."' width='10%'>Qtd</th>";
		print "</tr>";
		foreach ($entrada as $key => $value) {
                        $saida = "";
                        $totalEntrada += $value['quantidade'];
                        if(strpos($value['origem'], "Correção") === 0) {
                            $cor = $corSaida;
                            $saida = "-";
                        }else {
                            $cor = $corEntrada;
                        }
			print "<tr>";
			print "<td style='color:".$cor."'>".($key+1)."</td>";
			print "<td style='color:".$cor."'>".$value['id_produto']."</td>";
			print "<td style='color:".$cor."'>". DataMysql::dataVisual($value['dtEntradaSaida'])."</td>";
			print "<td style='color:".$cor."'>".$value['codProd']."</td>";
			print "<td style='color:".$cor."'>".$value['nome']."</td>";
			print "<td style='color:".$cor."'>".$value['origem']." / ".$value['obs']."</td>";
			print "<td style='color:".$cor."'>".$value['depDestino']."</td>";
			print "<td style='color:".$cor."; text-align:center'>".$value['quantidade']."</td>";
			print "</tr>";
                }
		print "<tr>";
		print "<th colspan='5' style='text-align:right;color:".$corEntrada."'>Total Entrada Materiais</th>";
		print "<th style='color:".$corEntrada."'>".$totalEntrada."</th>";
		print "</tr>";
		print "</table>";
                print "<br>";
                
                if(count($transferencia) >0) {
                /* Transferencia de materiais */
		print "<table class='table table-bordered table-condensed'>";
		print "<tr>";
		print "<th style='color:".$corSaida."' colspan='6'><h4>Transferencia de Materiais entre Depósitos</h4></th>";
		print "</tr>";
		print "<tr>";
		print "<th style='color:".$corSaida."' width='5%'>#</th>";
		print "<th style='color:".$corSaida."' width='10%'>Cód Material</th>";
		print "<th style='color:".$corSaida."' width='10%'>Data Entrada</th>";
		print "<th style='color:".$corSaida."' width='35%'>Nome</th>";
		print "<th style='color:".$corSaida."' width='30%'>Origem</th>";
		print "<th style='color:".$corSaida."' width='10%'>Qtd</th>";
		print "</tr>";
		foreach ($transferencia as $key => $value) {
                        $totalTransferencia += $value['quantidade'];
                        
                            $cor = $corSaida;
                       
			print "<tr>";
			print "<td style='color:".$cor."'>".($key+1)."</td>";
			print "<td style='color:".$cor."'>".$value['codProd']."</td>";
			print "<td style='color:".$cor."'>". DataMysql::dataVisual($value['dtEntradaSaida'])."</td>";
			print "<td style='color:".$cor."'>".$value['nome']."</td>";
			print "<td style='color:".$cor."'>".$value['origem']." ".$value['obs']." para D.A. ".$value['depDestino']."</td>";
			print "<td style='color:".$cor."; text-align:center'>-".$value['quantidade']."</td>";
			print "</tr>";
                }
		print "<tr>";
		print "<th colspan='5' style='text-align:right;color:".$corSaida."'>Total Transferencia Materiais</th>";
		print "<th style='color:".$corSaida."'>-".$totalTransferencia."</th>";
		print "</tr>";
		print "</table>";
                print "<br>";
                }
                
                
                
                /* listagem dos materiais liberados */
		print "<table class='table table-bordered table-condensed'>";
		print "<tr>";
		print "<th colspan='7'><h4>Liberações</h4></th>";
		print "</tr>";
                print "<tr>";
		print "<th width='5%'>#</th>";
		print "<th width='10%'>Nr.Liberacao</th>";
		print "<th width='10%'>Data Liberacao</th>";
		print "<th width='35%'>Beneficiario</th>";
		print "<th width='15%'>Dep Origem</th>";
		print "<th width='15%'>Descrição Material</th>";
		print "<th width='10%'>Quantidade</th>";
		print "</tr>";
		foreach ($listRel as $key => $value) {
			print "<tr>";
			print "<td>".($key+1)."</td>";
			print "<td>".$value['id_liberacao']."</td>";
			print "<td>".DataMysql::dataVisual($value['dataLibera'])."</td>";
			print "<td><i>".$value['beneficiario']."</i>  <b>".Municipio::PegaNomeMunicipio($value['id_municipio'])."</b></td>";
			print "<td>".Deposito::PegaNomeDeposito($value['id_dep_origem'])."</td>";
			print "<td>".$value['cod']." - ".Unidade::PegaNomeId($value['cod'])." </td>";
			print "<td  style='text-align:center'>".$value['quantidade']."</td>";
			print "</tr>";

			$total += $value['quantidade'];
			
		}
		print "<tr>";
		print "<th colspan='6' style='text-align:right'>Total Materiais Liberados</th>";
		print "<th>".$total."</th>";
		print "</tr>";
		print "</table><br>";
                
		/* resumo quantidades */
                
                $saldo = $totalEntrada-$totalTransferencia-$total;
                $corSaldo = "#000000";
                if($saldo > 0){
                    $corSaldo = "#0000CD";
                }
                print "<div class='col-md-8'></div>";
                print "<div class='col-md-4'>";
                print "<table style='width=50%' class='table table-bordered table-condensed' align='text-center'>";
                print "<tr>";
                print "<td style='color:".$corEntrada."; font-weight:bold'>Total Entradas ( + )</td>";
                print "<td style='color:".$corEntrada."; font-weight:bold'>".$totalEntrada."</td>";
                print "</tr>";
                print "<tr>";
                print "<td style='color:".$corSaida."; font-weight:bold'>Total Transferencias ( - )</td>";
                print "<td style='color:".$corSaida."; font-weight:bold'>".$totalTransferencia."</td>";
                print "</tr>";
                print "<tr>";
                print "<td style='color:".$corSaida."; font-weight:bold'>Total Liberações ( - )</td>";
                print "<td style='color:".$corSaida."; font-weight:bold'>".(($total > 0)? -$total : 0)."</td>";
                print "</tr>";
                print "<tr>";
                print "<td style='color:".$corSaldo."; font-weight:bold'>Saldo a Liberar ( = )</td>";
                print "<td style='color:".$corSaldo."; font-weight:bold'>".$saldo."</td>";
                print "</tr>";
                print "</table>";
                print "</div>";
	?>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>

