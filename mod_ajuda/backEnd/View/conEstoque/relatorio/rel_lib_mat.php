<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php";?>
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
        
        
        //var_dump($_POST);

	$_dt_inicial = isset($_POST['txtDtInicial']) ? DataMysql::dataForm($_POST['txtDtInicial']) : false;

	$_dt_final = isset($_POST['txtDtFinal']) ? DataMysql::dataForm($_POST['txtDtFinal']) : false;

	$_id_municipio = isset($_POST['id_municipio']) ? $_POST['id_municipio'] : false;

	$_id_deposito = isset($_POST['id_deposito']) ? $_POST['id_deposito'] : false;

	$id_liberacao = isset($_GET['id']) ? $_GET['id'] : false;
    
	$_nivel = $_COOKIE['seguranca']['nivel'];

	$listMat = isset($_POST['ckListMat']) ? $_POST['ckListMat'] : "";

	$id_material = isset($_POST['id_material']) ? $_POST['id_material'] : "";
		
	$cabecalho = "<div class=\"col-md-12\">Legenda:<br>
	<i style=\"background-color:#00a65a; color:white\">&nbsp;Pago&nbsp;</i>
	<i style=\"background-color:#f39c12; color:white\">&nbsp;Cancelado&nbsp;</i>
	<i style=\"background-color:#00c0ef; color:white\">&nbsp;Em aberto&nbsp;</i>
        <br><br>
	</div>";
	
        

print $cabecalho;

    /* relatorio de material Liberado restricao dep Avancado*/
    if(($id_liberacao == false) && ($_nivel == 4)){
		
        $_relatorioAjuda->RelatorioVisualizaLiberacao(false, $_COOKIE['seguranca']['id_deposito']);

    } else if((is_numeric($id_liberacao) && $id_liberacao != false)){

		#@ relatorio com o id da liberacao
		$_relatorioAjuda->RelatorioVisualizaLiberacao($id_liberacao);

	/* lista conferencia de materiais **/
	}else if(!empty($listMat)) {
            
            
            

		$total = 0;
		$listRel = $_relatorioAjuda->RelatorioListaMat($id_material);
                
                //var_dump($listRel);
                print "</br>";
		print "<a href='".FuncaoBase::geraLink("ajuda", "relatorio", "fbusca_liberacao")."' class='btn btn-primary'>Voltar</a><br>";
                print "<br>";
                print "<legend>Pedíodo : ".$_POST['txtDtInicial']." a ".$_POST['txtDtFinal']."</legend>";
		print "<table class='table table-bordered table-condensed'>";
		print "<tr>";
		print "<th>#</th>";
		print "<th>Beneficiario</th>";
		print "<th>Data Liberacao</th>";
		print "<th>Código</th>";
		print "<th>Descrição Material</th>";
		print "<th>Quantidade</th>";
		print "</tr>";
		foreach ($listRel as $key => $value) {
			print "<tr>";
			print "<td>".($key+1)."</td>";
			print "<td>".DataMysql::dataVisual($value['dataLibera'])."</td>";
			print "<td><i>".$value['beneficiario']."</i>  <b>".Municipio::PegaNomeMunicipio($value['id_municipio'])."</b></td>";
			print "<td>".$value['cod']."</td>";
			print "<td>".Unidade::PegaNomeId($value['cod'])." </td>";
			print "<td  style='text-align:center'>".$value['quantidade']."</td>";
			print "</tr>";

			$total += $value['quantidade'];
			
		}
		print "<tr>";
		print "<th colspan='5' style='text-align:right'>Total</th>";
		print "<th>".$total."</th>";
		print "</tr>";
		print "</table>";
		
	}else {

		#@ relatorio com filtro de opcoes
            
		$_relatorioAjuda->MaterialLiberado($_dt_inicial, $_dt_final, $_id_municipio, $_id_deposito, false);

	}


	?>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>

