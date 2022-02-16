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
	      
		$totalItem = 0;
                $totalEntrada = 0;
                $totalLiberacao = 0;
                $totalTransferencia = 0;
		$listRel = $_relatorioAjuda->RelatorioListaMat($id_material);
                
                $entrada = $_relatorioAjuda->EntradaMaterial($_POST);
                
      
                print "</br>";
		print "<p align='center'><a href='".FuncaoBase::geraLink("ajuda", "relatorio", "form_busca_prest_contas")."' class='btn btn-primary'>Voltar</a></p>";
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
		//print "<th style='color:".$corEntrada."' colspan='8'><h4>Entrada de Materiais</h4></th>";
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
                    
                        $items = Liberacao::getItensLiberacao($value['id_produto']);
                        
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
                        
                        /* tranferencia */
                        $transferencia = $_relatorioAjuda->EntradaMaterialTransf($value['codProd'], $value['id_produto']);
                        if(count($transferencia) >0) {
                            foreach ($transferencia as $key => $transf) {
                                
                                    if($transf['depDestino'] != $value['depDestino']){
                                        $totalTransferencia += $transf['quantidade'];

                                            $cor = $corSaida;

                                        print "<tr>";
                                        print "<td style='color:".$cor."'>".($key+1)."</td>";
                                        print "<td style='color:".$cor."'>".$transf['id_produto']."</td>";
                                        print "<td style='color:".$cor."'>". DataMysql::dataVisual($transf['dtEntradaSaida'])."</td>";
                                        print "<td style='color:".$cor."'>".$transf['codProd']."</td>";
                                        print "<td style='color:".$cor."'>".$transf['nome']."</td>";
                                        print "<td style='color:".$cor."'>".$transf['origem']." ".$transf['obs']." para D.A. ".$transf['depDestino']."</td>";
                                        print "<td style='color:".$cor."'>".$transf['depDestino']."</td>";
                                        print "<td style='color:".$cor."; text-align:center'>-".$transf['quantidade']."</td>";
                                        print "</tr>";
                                    }
                            }
                            


                        }
                        /* fim transferencia */
                        
                        if(count($items) > 0) {
                            print "<tr><td colspan='4'></td>";
                            
                            print "<td colspan='4'>";
                            print "<table class='table table-bordered'>";
                                print "<tr>";
                                print "<th>#</th>";
                                print "<th>Codigo Item</th>";
                                print "<th>Nº Liberacao</th>";
                                print "<th>Data Liberação</th>";
                                print "<th>Municipio Destino</th>";
                                print "<th>Qtd</th>";
                                print "</tr>";
                            
                        
                            foreach ($items as $key=>$item){
                           
                                print "<tr>";
                                print "<td>".($key+1)."</td>";
                                print "<td>".$item['cod']."</td>";
                                print "<td>".$item['id_liberacao']."</td>";
                                print "<td>". DataMysql::dataVisual($item['dataLibera'])."</td>";
                                print "<td>".Liberacao::getMunicipioLiberacao($item['id_liberacao'])."</td>";
                                print "<td style='color :".$corSaida."'>-".$item['quantidade']."</td>";
                                print "</tr>";
                                print "</tr>";
                                
                                $totalItem += $item['quantidade'];
                                
                            }
                            if(count($items) > 0) {
                                
                                $cor = ($totalEntrada-$totalItem) > 0 ? "#0000FF" :$corSaida ;
                                print "<tr><td colspan='5' style='text-align:right'>Total Liberado</td>";
                                print "<td style='color :".$corSaida."'>-".$totalItem."</td></tr>";

                                print "</tr>";
                                print "<td colspan='5' style='text-align:right'>Saldo</td>";
                                print "<td style='color :".$cor."'>".($totalEntrada-$totalTransferencia-$totalItem)."</td>";
                                //var_dump($totalEntrada,$totalTransferencia, $totalItem );
                                print "</tr>";
                            }
                                                
                        print "</table>";
                        print "</td></tr>";
                        print "<tr><td colspan='8'><hr style='border:0.1em solid'></td></tr>";
                        }
                        
                        $totalItem = 0;
                        $totalEntrada = 0;
                        $totalTransferencia = 0;
                        
                        
                }
                        print "</table>";
		
                            
	?>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>

