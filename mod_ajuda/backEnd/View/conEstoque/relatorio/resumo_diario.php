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
            padding: 0px !important;
            margin: 0px;
        }

        body {
            font-family: helvetica;
            color: rgba(94,93,82,1);
        }

    } 

    .break { page-break-before: always; }


    .rodape {
        background-color: #C0C0C0;
    }

    hr.linha {
        border: 1px solid blue;
    }

    #div-icon {
        display:none;
    }
    
</style>

<?php
    $_relatorioAjuda = new RelatorioAju();
    
    $id_deposito = isset($_POST['id_deposito'])  ? $_POST['id_deposito']  : NULL;
    $txtDtInicial= isset($_POST['txtDtInicial']) ? $_POST['txtDtInicial'] : NULL;
    $txtDtFinal  = isset($_POST['txtDtFinal'])   ? $_POST['txtDtFinal']   : NULL;
    $id_municipio= isset($_POST['id_municipio']) ? $_POST['id_municipio'] : NULL;
    $pesquisar   = isset($_POST['pesquisar'])    ? $_POST['pesquisar']    : NULL;
    $ck_diario   = isset($_POST['ck_diario'])    ? $_POST['ck_diario']    : NULL;
?>
<div class="row">
    <div class="col-md-12 text-center">
        <img src="core/imagem/topo1.png">
        <br><a class='btn btn-info imprimir' href='index.php?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=relatorio&action=busca_resumog'>Voltar</a>
    </div>
</div>

   <div class="col-md-12 text-center">
        <p style="text-align:text-center"><h4> Período : <?=$txtDtInicial;?> a <?=$txtDtFinal;?></h4></p>
    </div>

    <!-- material liberado -->
    <div class="col-md-12 text-center">
        <h3>MATERIAL LIBERADO</h3>
        <?php
        

        $coluna = "style='text-align: center;background-color: #BDBDBD;'";

            #@ relatorio com filtro de opcoes
		$dados = $_relatorioAjuda->MaterialLiberadoResumoDiario($txtDtInicial, $txtDtFinal, $id_municipio, $id_deposito, false);

        //var_dump($dados);
        print "<table class='table table-bordered table-condensed'>";
        print "<tr>
                <th ".$coluna.">#</th>
                <th ".$coluna.">Num Liberação</th>
                <th ".$coluna.">Data Liberação</th>
                <th ".$coluna.">Evento</th>
                <th ".$coluna.">Município</th>
                <th ".$coluna.">Materiais</th>";

            foreach ($dados as $key => $value) {
                print "<tr>
                        <td style='v-align'>".($key+1)."</td>
                        <td>".$value[0]['id_liberacao']."</td>
                        <td>".DataMysql::dataVisual($value[0]['datalibera'])."</td>
                        <td>".$value[0]['evento']."</td>
                        <td>".Municipio::PegaNomeMunicipio($value[0]['id_municipio'])."</td>";
                
                print "<td>";
                print "<table class='table table-condensed table-bordered'>";
                print "<tr><th ".$coluna.">Material</th><th ".$coluna.">Descrição</th><th ".$coluna.">Quantidade</th></tr>";
                foreach ($value[1] as $key1 => $value1) {
                    print "<tr>";
                    print "<td>".Unidade::PegaNomeId($value1['cod'])."</td>";
                    print "<td>".$value1['descricao']."</td>";
                    print "<td>".$value1['quantidade']."</td>";
                    print "</tr>";
                }
                print "</table>";
                
                print "</td></tr>";
            }

            print "</table>";
        ?>
        
    </div>
    
    <!-- material pago -->
    <div class="col-md-12 text-center">
    <hr class="linha">
        <h3>MATERIAL PAGO</h3>
        <?php

            $_mat_pago = RelatorioAju::MaterialPagoResumoDiario($txtDtInicial,
            $txtDtFinal,
            $id_municipio,
            $id_deposito);	

            

            
            print "<table class='table table-bordered table-condensed'>";
            print "<tr>
                <th ".$coluna.">#</th>
                <th ".$coluna.">Num Liberação</th>
                <th ".$coluna.">Data Pagto</th>
                <th ".$coluna.">Num Pgto</th>
                <th ".$coluna.">Data Liberação</th>
                <th ".$coluna.">Município</th>
                <th ".$coluna.">Materiais</th>";
                
                foreach ($_mat_pago as $key => $value) {

                    $produtos = Liberacao::listaProdutos($value['id_liberacao']);

                    print "<tr>
                        <td>".($key+1)."</td>
                        <td>".$value['id_liberacao']."</td>
                        <td>".DataMysql::dataVisual($value['dtPagto'])."</td>
                        <td>".$value['id_pagamento']."</td>
                        <td>".DataMysql::dataVisual($value['dataLibera'])."</td>
                        <td>".Municipio::PegaNomeMunicipio($value['id_municipio'])."</td>";
                
                print "<td>";
                print "<table class='table table-condensed table-bordered'>";
                print "<tr><th ".$coluna.">Material</th><th ".$coluna.">Descrição</th><th ".$coluna.">Quantidade</th></tr>";
                foreach ($produtos as $key1 => $value1) {
                    print "<tr>";
                    print "<td>".Unidade::PegaNomeId($value1['cod'])."</td>";
                    print "<td>".$value1['descricao']."</td>";
                    print "<td>".$value1['quantidade']."</td>";
                    print "</tr>";
                }
                print "</table>";
                
                print "</td></tr>";
            }

            print "</table>";
                    
        ?>
    </div>
    
    <!-- material transferido-->
    <?php 
        $_mat_transf = RelatorioAju::relatorioMaterialTransfResumoDiario($txtDtInicial,
        $txtDtFinal,
        $id_municipio,
        $id_deposito);	

        if(count($_mat_transf) >0){
            print "<div class=\"col-md-12 text-center\">
                    <hr class=\"linha\">
                    <h3>MATERIAL TRANSFERIDO</h3>";

            print "<table class='table table-bordered table-condensed'>";
            print "<tr>
                <th ".$coluna.">#</th>
                <th ".$coluna.">Num Transferencia</th>
                <th ".$coluna.">Data Transf.</th>
                <th ".$coluna.">Data Recebimento</th>
                <th ".$coluna.">Dep. Origem</th>
                <th ".$coluna.">Dep. Destino</th>
                <th ".$coluna.">Materiais</th>";
                
                foreach ($_mat_transf as $key => $value) {

                    $produtos = TransferenciaMaterial::ListaItensTransferencia($value['id_transferencia']);

                    print "<tr>
                        <td>".($key+1)."</td>
                        <td>".$value['id_transferencia']."</td>
                        <td>".DataMysql::dataVisual($value['dt_transferencia'])."</td>
                        <td>".DataMysql::dataVisual($value['dt_chegada'])."</td>
                        <td>".Deposito::PegaNomeDeposito($value['id_dep_origem'])."</td>
                        <td>".Deposito::PegaNomeDeposito($value['id_dep_destino'])."</td>";
                
                print "<td>";
                print "<table class='table table-condensed table-bordered'>";
                print "<tr><th ".$coluna.">Material</th><th ".$coluna.">Descrição</th><th ".$coluna.">Quantidade</th></tr>";
                foreach ($produtos as $key1 => $value1) {
                    print "<tr>";
                    print "<td>".Unidade::PegaNomeId($value1['id_produto'])."</td>";
                    print "<td>".$value1['descricao']."</td>";
                    print "<td>".$value1['quantidade']."</td>";
                    print "</tr>";
                }
                print "</table>";
                
                print "</td></tr>";
            }

            print "</table> </div>";  
           
        }else {

            print "<div class=\"col-md-12 text-center\">
                    <hr class=\"linha\">
                    <h3>MATERIAL TRANSFERIDO</h3><br>
                    
                    Não foi encontrato material Transferido no período selecionado !
                    </div>";
        }
                    
        ?>


    <div class="col-md-12 text-center break">
        <hr class="linha">
        <h3>QUANTITATIVO MATERIAIS</h3>
        
<div class="row">

    <!-- materiais liberados -->
    <div class="col-md-4">
        <?php
            $material = Unidade::getIdNome();
                
            print "<table class='table table-bordered table-condensed table-striped dataTable'>";
            print "<td class='rodape' colspan='2'>Total Materiais Liberados</td>";
            $total_liberacao = 0;
                foreach ($material as $key => $value) {
                    $total = Liberacao::totMaterialLiberado($value['id_unidade'], $_POST);
                    if(!empty($total)){
                        print "<tr><td>".$value['nome']."</td><td class='text-center'>".$total."</td></tr>";
                        $total_liberacao += $total;

                    } 
                }

            print "<tr><td class='rodape'>Total Itens</td><td class='text-center rodape'><b>".$total_liberacao."</b></td></tr>";

            print "</table>";
        ?>
    </div>

    <!-- materiais pagos -->
    <div class="col-md-4">
    <?php
                
            print "<table class='table table-bordered table-condensed table-striped dataTable'>";
            print "<td class='rodape' colspan='2'>Total Materiais Pagos</td>"; 
            $total_pago = 0;
                foreach ($material as $key => $value) {
                    $total_pg = Pagamento::totMaterialPago($value['id_unidade'], $_POST);
                    if($total_pg > 0){
                        print "<tr><td>".$value['nome']."</td><td class='text-center'>".$total_pg."</td></tr>";
                        $total_pago += $total_pg;
                    } 
                }

            print "<tr><td class='rodape'>Total Itens</td><td class='text-center rodape'><b>".$total_pago."</b></td></tr>";

            print "</table>";
        ?>
    </div>

    <!-- materiais transferidos -->
    <div class="col-md-4">
    <?php

                
            print "<table class='table table-bordered table-condensed table-striped dataTable'>";
            print "<td class='rodape' colspan='2'>Total Materiais Transferidos</td>";
                $total_transf = 0;
                foreach ($material as $key => $value) {
                    $total_tr = TransferenciaMaterial::totMaterialTransferencia($value['id_unidade'], $_POST);
                    if($total_tr > 0){
                        print "<tr><td>".$value['nome']."</td><td class='text-center'>".$total_tr."</td></tr>";
                        $total_transf += $total_tr;
                    } 
                }

            print "<tr><td class='rodape'>Total Itens</td><td class='text-center rodape'><b>".$total_transf."</b></td></tr>";

            print "</table>";
        ?>
    </div>
</div>

    </div>
    <br>
    
</div>

</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>

<script type="text/javascript">

$(document).ready(function(){

});


</script>