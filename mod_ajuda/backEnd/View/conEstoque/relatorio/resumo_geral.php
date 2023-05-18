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

        *{ 
            background-color: #836FFF;
        }

        #cabecalho {
            display: none;
        }
    

    .rodape {
        background-color: #C0C0C0;
    }

    hr.linha {
        border: 1px solid blue;
    }

    #div-icon {
        display: none;
    }

}

</style>

<!-- Resumo de liberacoes -->
<div class="row">
    <div class="col-md-12 text-center">
        <a class='btn btn-info' href='index.php?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=relatorio&action=busca_resumog'>Voltar</a><br><br>
        <br>
        <p style="text-align:text-center"><h3> Resumo Liberações</h3></p>
    </div>
    <div class="col-md-4">
        <canvas id="mat_liberado" style="height:250px"></canvas>
    </div>
    <div class="col-md-8">
        <table class="table table-condensed">
            <tr>
                <td>Liberações Realizadas</td><td> <h3>:<?= Ajuda::getMateriaisLiberadosEpagos($_POST);?></h3></td>
            </tr>
            <tr>
                <td>Materiais Pagos (Entregues)</td> <td><h3>: <?=Ajuda::getMateriaisPagos($_POST);?></h3></td>
            </tr>
            <tr>
                <td>Liberações em Aberto (aguardando Retirada)</td><td><h3>: <?= Ajuda::getLiberacao($_POST);?></h3></td>
            </tr>
            <tr>
                <td>Materiais Esperando Pagamento</td> <td><h3>: <?= Ajuda::getLiberacao($_POST);?></h3></td>
            </tr>
            <!--<tr>
                <td>Materiais Esperando Pagamento </td> <td>: <?= Ajuda::getMaterialEsperaPagto($_POST, 0);?></h3></td>
            </tr> -->
            <tr>
                <td>Materiais em Transito (Transferencia entre Depositos)</td> <td><h3> : <?= Ajuda::getMaterialTransito($_POST, 1);?></h3></td>
            </tr>
        </table>
    </div>
    <div class="col-md-1">
    
    </div>
    <br>
    
</div>
<div class="col-md-12">
    <hr class="linha">
</div>



<!-- Total de Liberações Geral -->
<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
            
        <?php

            $dataInicial = isset($_POST['txtDtInicial']) ? $_POST['txtDtInicial'] : "";
            $dataFinal = isset($_POST['txtDtFinal']) ? $_POST['txtDtFinal'] : "";
            $id_municipio = isset($_POST['id_municipio']) ? (($_POST['id_municipio'] == 0) ? NULL : $_POST['id_municipio']) : NULL;

            $material = Unidade::getIdNome();
                
            /** total de liberacoes por material */
            print "<div class='col-md-12 text-center' style='background-color:#C0C0C0'><h4>Total de Liberações (Geral)</h4> Período : ".$dataInicial." a ".$dataFinal."</div>";

            print "<table class='table table-bordered table-condensed table-striped dataTable'>";
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
    <div class="col-md-3">
    </div>
</div>

    <div class="col-md-12">
        <hr class="linha">
    </div>
<div class="row">
    <!-- Total liberações por Evento -->
    <div class="col-md-3">
    </div>
    <div class="col-md-6">

        <?php

        /* lista os eventos que tenham liberacoes */
        $evento = Material::materiaisLiberadosEvento();
        
        foreach ($evento as $key1 => $value1) {
            $total_itens = 0;
            

            print "<div class='col-md-12 text-center' style='background-color:#C0C0C0'><h4>Total Materiais Liberados Evento : ".$value1['evento']."</h4> - Período : ".$dataInicial." a ".$dataFinal."</div>";
            
                print "<table class='table table-bordered table-condensed table-striped'>";
                    foreach ($material as $key => $value) {
                        
                        $tot = Liberacao::totMaterialLiberadoPorEvento($value['id_unidade'], $_POST, $value1['evento']);
                        if($tot > 0){
                            //var_dump(Produto::getProdutos($value['id_unidade'])['origem']);
                            $total_itens += $tot;
                            print "<tr><td>".$value['id_unidade']."-".$value['nome']."</td><td class='text-center'>".$tot."</td></tr>";  
                        }
                    }
                print "<tr><td class='rodape'>Total Itens</td><td class='text-center rodape'><b>".$total_itens."</b></td></tr>";
                print "</table>";

                print '<hr class="linha">';
            }
        ?>
    </div>
    <div class="col-md-3">
    </div>
</div>

<!-- Liberações por Municipio -->
<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
        <div class='col-md-12'>
            <table class="table table-bordered">
                <tr><th class="col-md-8 text-center" colspan="3" style='background-color:#C0C0C0'>Liberações por Municípios <br>Período : <?=$_POST['txtDtInicial'];?> a <?=$_POST['txtDtFinal'];?></th></tr>
                <tr><th>#</th><th class="col-md-8 text-center" style='background-color:#C0C0C0'>Município</th><th class="col-md-4 text-center" style='background-color:#C0C0C0'>Qtd de Liberações</th></tr>
                <?php

                    $liberacoes = Liberacao::liberacaoPorMunicipio($_POST);

                    $total_lib_por_mun = 0;

                    foreach ($liberacoes as $key => $value) {
                        print "<tr><td>".($key+1)."</td><td class='col-md-8' style='background-color:#E6E6E6'><a class='mostra' id='".$value['id_municipio']."' title='Clique para ver os materiais'>".Municipio::PegaNomeMunicipio($value['id_municipio'])."</a>";
                        print "<div class='material' id='material".$value['id_municipio']."' style='background-color:#D8D8D8'><p class=\"text-center\"><i>Materiais Liberados</i><p>";
                        
                        $mat = Liberacao::totMaterialLiberadoMapa($value['id_municipio'], $_POST);
                        foreach ($mat as $key => $value1) {
                            print "<div class='col-md-8' style='background-color:#D8D8D8'>".$value1['nome']."</div><div class='col-md-4' style='background-color:#D8D8D8'>".$value1['qtd']."</div>";
                        }
                       
                        print "</div>";
                        print "</td><td class='col-md-4 text-center' style='background-color:#E6E6E6'>".$value['qtd']."</td></tr>";
                        $total_lib_por_mun += $value['qtd'];
                    }

                ?>
                <tr><td colspan="2" style='background-color:#C0C0C0'>Total de Liberações</td><td class='text-center' style='background-color:#C0C0C0'><?=$total_lib_por_mun;?></td></tr>
            </table>
        </div>
    </div>
    <div class="col-md-3">
    </div>
</div>
<div class="col-md-12">
    <hr class="linha">
</div>

<!-- Liberações por municipio e por Evento-->
<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">

    <?php

    
    ?>
        <!-- <div class='col-md-12'>
            <table class="table table-bordered">

                <tr><th class="col-md-8 text-center" colspan="2" style='background-color:#C0C0C0'>Liberações por Municípios e Evento :  <br>Período : <?=$_POST['txtDtInicial'];?> a <?=$_POST['txtDtFinal'];?></th></tr>
                <tr><th class="col-md-8 text-center" style='background-color:#C0C0C0'>Município</th><th class="col-md-4 text-center" style='background-color:#C0C0C0'>Qtd de Liberações</th></tr>
                <?php
        
                    /* lista os eventos que tenham liberacoes */
                    $evento = Material::materiaisLiberadosEvento();

                    foreach ($evento as $key1 => $value1) {
                        
                        $total_lib_por_mun_evento = 0;
                        # param nome do evento
                        $liberacoesPorEvento = Liberacao::liberacaoPorMunicipioPorEvento($value1, $_POST);

                        print "<div class='col-md-12 text-center' style='background-color:#C0C0C0'><h4>Total Materiais Liberados Evento : ".$value1['evento']."</h4> - Período : ".$dataInicial." a ".$dataFinal."</div>";
                        
                            print "<table class='table table-bordered table-condensed table-striped'>";

                            foreach ($liberacoesPorEvento as $key => $value) {
                                print "<tr><td class='col-md-8'>".Municipio::PegaNomeMunicipio($value['id_municipio'])."</td><td class='col-md-4 text-center'>".$value['qtd']."</td></tr>";
                                $total_lib_por_mun_evento += $value['qtd'];
                            }
                            print "<tr><td class='rodape'>Total Itens</td><td class='text-center rodape'><b>".$total_lib_por_mun_evento."</b></td></tr>";
                            print "</table>";

                    }
                ?>
            </table> -->
            <hr class="linha">
        </div>
    </div>
    <div class="col-md-3">
    </div>
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

    $(".material").hide();

    $(".mostra").click(function(){

        var id = 'material'+$(this).attr('id');

        if($("#"+id+"").is(":visible")){
            $("#"+id+"").hide();
        }else {
            $("#"+id+"").show();
        }
    });

    new Chart(document.getElementById("mat_liberado"), {
    type: 'doughnut',
    data: {
      labels: ["Material Liberado", "Material Pago", "Liberações (Aguardando Retirada"],
      datasets: [
        {
          label: "Population (millions)",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: [<?=Ajuda::getMateriaisLiberadosEpagos($_POST)?>,<?= Ajuda::getMateriaisPagos($_POST);?>,<?= Ajuda::getLiberacao($_POST);?>]
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Liberações'
      }
    }
});

});


</script>