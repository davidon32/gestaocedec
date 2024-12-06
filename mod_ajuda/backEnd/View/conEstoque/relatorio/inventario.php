<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<style>
    
    @page {
        size: A4;
    }
    
    * {
     fonte{size : 10pt;}   
    }
    
    @media print {
               
        #cabecalho {
            display: none;
        }
        .imprimir {
            display: none;
        }
        .main-footer{
        display: none;
        }
        .box-header {
            display: none;
        }

        body {
            width: 700px;
            margin: 0 auto;
        }
        th, td {
            padding: 2px !important;
            margin: 1px;
            /*white-space: nowrap;*/
        }

        body {
            font-family: calibri;
            color: rgba(94,93,82,1);
        }

    } 

    .break { page-break-before: always; }


    .rodape {
        background-color: #C0C0C0;
    }

    hr.linha {
        border: 0.5em solid blue;
    }

    #div-icon {
        display:none;
    }
    
</style>
<div class="container table table-responsive">
    
<div class='col-md-6 text-center'>
    <?php if(isset($_GET['voltar'])) {
        print "<a class=\"btn btn-success imprimir\" href=\"".FuncaoBase::geraLink('index', 'index', 'index1')."\">Voltar</a>";				 
    }else {
        print "<a class=\"btn btn-success imprimir\" href=\"".FuncaoBase::geraLink('ajuda', 'conestoque', 'relIndex') ."\">Voltar</a>";				 
    }
    ?>
    
</div>
<div class='col-md-6 text-center'>
    <button type="button" class="btn btn-primary imprimir" onclick="window.print();">Imprimir</button>
</div>

<?php

    $id_deposito = isset($_POST['id_deposito']) ? $_POST["id_deposito"] : "";
    
    $dataInventario = isset($_POST['txtDtInicial']) ? DataMysql::dataForm($_POST["txtDtInicial"]) : "";
    
    $linha = "<td>".date('d/m/Y')."</td>";  
   
    if(empty($_POST)){
    
    print "<script>window.location.href='".FuncaoBase::geraLink("ajuda", "relatorio", "form_busca_invet_libera")."';</script>";
    }
    
    $_relatorioAjuda = new RelatorioAju();

    /* relatorio deposito especifico */
    if(empty($dataInventario) || $dataInventario == date('Y/m/d')){
        $dados = $_relatorioAjuda->inventarioGeral($id_deposito);
        //var_dump($dados[0]);
    }else {
        
        $linha = "<td>". DataMysql::dataVisual($dataInventario)."</td>";
        $dados = $_relatorioAjuda->inventarioGeralSaldoAnterior($dataInventario, $id_deposito);
    }
    
    
    


$data = date('d/m/Y');
$hora = date('H:i:s');
$inventario = <<<HTML
<div class="col-md-9 text-center">
       GABINETE MILITAR DO GOVERNADOR DE MINAS GERAIS <br>
       INVENTÁRIO DE MATERIAIS
   </div>
<div class="col-md-3 text-center">
    {$data} {$hora}   
</div>
<div class="col-md-12" style="font-size:10pt;">
    <table class="table table-condensed table-bordered table-hover table-striped" id='inventario'>
        <tr>
            <th>CÓD.</th>
            <th>DATA</th>
            <th>DESCRICAO</th>
            <th>UN</th>
            <th>MARCA</th>
            <th>ESTOQUE</th>
            <th>DEP</th>
            <th>CUSTO UNIT.</th>
            <th>CUSTO TOTAL</th>
            <th>PESO UNIT.(kg) </th>
            <th>PESO TOTAL (kg)</th>
            <th>QTD</th>
        </tr>
HTML;
        
?>
        <?php

            foreach ($dados as $key => $value) {
                
                //var_dump($value);die();
                
                if($value['saldo'] > 0){
                    //var_dump(strrpos($value['produto'], 'CESTA'));
                    $saldo = $value['saldo'];
                    $inventario .="<tr>\n";
                    $inventario .= "<td><a href='".FuncaoBase::geraLink('ajuda', 'relatorio', 'detalheInvent', array('id_deposito'=>$value['id_deposito'], 'id_unidade'=>$value['id_unidade']))."'>".$value['id_unidade']."</a></td>".$linha;
                    if(strrpos($value['produto'], 'CESTA') ===0){
                        $inventario .= "<td style='color:F13B0E'>";
                        $inventario .= "<a href='#'><b><i>".$value['produto']."</i></b>"; 
                        $inventario .= (!empty($value['descricao'])) ? " - ".$value['descricao'] : "";
                    }else {
                        $inventario .= "<td><a href='#'>";
                        $inventario .= $value['produto'];
                        $inventario .= (!empty($value['descricao'])) ? " - ".$value['descricao'] : "";
                    }
                    $inventario .= "</a></td>";
                    $inventario .= "<td><a href='#'>".$value['uni_medida']."</td>";
                    $inventario .= "<td></td>";
                    $inventario .= "<td><a href='#'>".$value['deposito']."</td>";
                    $inventario .= "<td><a href='#'>".$value['abreviacao']."</td>";
                    $inventario .= "<td><a href='#'>R$ ". FuncaoBase::real($value['valor'])."</td>";
                    $inventario .= "<td><a href='#'>R$ ".FuncaoBase::real(($saldo * $value['valor']))."</td>";
                    $inventario .= "<td><a href='#'>".$value['peso']."</td>";
                    $inventario .= "<td><a href='#'>".($saldo * $value['peso'])."</td>";
                    $inventario .= "<td><a href='#'>".$saldo."</td>";
                    $inventario .= "\n</tr>\n\n";
                    
                }else{
                    if(true){ // busca transito
                        //$saldo = GerTransito::MarcaTransito($rSaldo[1],$rSaldo[0])
                        
                    }
                }   
                    
                
            }
        
          
    $inventario .= "</table>
</div>";

    print $inventario;
require 'vendor/autoload.php';
use Dompdf\Dompdf;

/*if(isset($tipo)) {
    if($tipo == 'pdf'){

    // Dompdf namespace
    // dompdf class
    $dompdf = new Dompdf();
    // html que será transformado em PDF
    $dompdf->loadHtml($inventario);
    // (Opcional) Tipo do papel e orientação
    $dompdf->setPaper('A4');
    // Render HTML para PDF
    $dompdf->render();
    // Download do arquivo
    file_put_contents('doc/diario/'.date('d').'-'.date('m').'-'.date('Y').'-'.date('his').'-inventario.pdf', $dompdf->output());
    }else {
        print $inventario;
    }
}*/

?>

</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>

<script src="js/script.js"></script>
<script type="text/javascript">

$(document).ready(function(){
    console.log(checkmobile());
    /* remove colunas mobile */
    if(checkmobile()){
        
        //$("#inventario").tr
        
        $("#inventario").find("tr").each(function() {
            $(this).find("th:eq(0)").remove();
            $(this).find("td:eq(0)").remove();
        });
        
        $("#inventario").find("tr").each(function() {
            $(this).find("th:eq(1)").remove();
            $(this).find("td:eq(1)").remove();
        });
        $("#inventario").find("tr").each(function() {
            $(this).find("th:eq(2)").remove();
            $(this).find("td:eq(2)").remove();
        });
        $("#inventario").find("tr").each(function() {
            $(this).find("th:eq(3)").remove();
            $(this).find("td:eq(3)").remove();
        });
        
        $("#inventario").find("tr").each(function() {
            $(this).find("th:eq(1)").remove();
            $(this).find("td:eq(1)").remove();
        });
        
        
        
 
        
    }

});


</script>