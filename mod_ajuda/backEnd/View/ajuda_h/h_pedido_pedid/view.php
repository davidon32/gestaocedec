
<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<style>
    
    @media print {
        .print {
            display:none;
        }
    }
    
    
</style>

<?php
var_dump($view);
?>

<button class="btn btn-primary print" id='btn_print' type="button">Impressão</button>

<div class='col-md-12' id='view'>
<div class='col-md-12 text-center'>
<legend><?= $view[1]['tabela']->TABLE_COMMENT ?></legend>
<?php    
if ($_GET['voltar'] == 'idx_recente') {
    print "<a class=\"btn btn-success\" href=\"" . FuncaoBase::geraLink("ajuda", "h_pedido_index", "index") . "\">Voltar</a>";
} else {
    print "<a class=\"btn btn-success\" href=\"" . FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "index") . "\">Voltar</a>";
}
?>
    <br><br>
</div>
    <legend>Número : <?=$view[0]['id'].$view[0]['ano']?></legend>
<table class="table table-bordered table-striped">

    <tr>
        <td class="col-md-3">Identificador do Pedido :</td><td><?= $view[0]['id']; ?></td>
    </tr></div>

<tr>
    <td class="col-md-3">Número Pedido :</td><td><?= $view[0]['numero']; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Data Entrada Sistema :</td><td><?= $view[0]['data_entrada_sistema']; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Analista CEDEC :</td><td><?= $view[0]['despachante_analista']; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Analista DLOG :</td><td><?= $view[0]['despachante_dlog']; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Identificador Municipio :</td><td><?= $h_pedido_pedidModel->getNomeIdFk('cedec_municipio', 'id_municipio', $view[0]['id_municipio'])->nome; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Identificador Mesorregião :</td><td><?= $h_pedido_pedidModel->getNomeIdFk('com_regiao', 'id_regiao', $view[0]['id_regiao'])->nome; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Nome do Coordenador :</td><td><?= $view[0]['nome_coordenador']; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Telefone do Coordenador :</td><td><?= $view[0]['tel_coordenador']; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Celular do Coordenador :</td><td><?= $view[0]['cel_coordenador']; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Email do Coordenador :</td><td><?= $view[0]['email_coordenador']; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Nome do Prefeito :</td><td><?= $view[0]['nome_prefeito']; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Telefone do Prefeito :</td><td><?= $view[0]['tel_prefeito']; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Celular do Prefeito :</td><td><?= $view[0]['cel_prefeito']; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Email do Prefeito :</td><td><?= $view[0]['email_prefeito']; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Tipo do Desastre :</td><td><?= $h_pedido_pedidModel->getNomeIdFk('dec_cobrade', 'id_cobrade', $view[0]['id_cobrade'])->nome; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">População Atendida :</td><td><?= $view[0]['pop_atendida']; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Decreto SE ou ECP Vigente ? :</td><td><?= (($view[0]['decreto_se_ecp_vig'] == 0) ? "Não" : "Sim"); ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Número do Decreto :</td><td><?= $view[0]['numero_decreto']; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Data de Vigencia Decreto :</td><td><?= $view[0]['data_vigencia']; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Tipo do Decreto :</td><td><?= $view[0]['tipo_decreto']; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Esforços Realizados :</td><td><?= $view[0]['esforcos_realizados']; ?></td>
</tr></div>

<tr>
    <td class="col-md-3">Data Hora Envio Homologação :</td><td><?= $view[0]['data_hora_envio']; ?></td>
</tr></div>



</table>
<br>
<br>
<!- tabela de materiais do Originais  -->
<legend>Materiais Enviados na Geração do Pedido</legend>
<span>Este é um registro dos materiais enviados que não sofrerão alterações por parte dos Analistas</span>
<div class='row table-responsive' >
    <div class='col-md-1'>
    </div>
    <div class='col-md-10'><br>

        <table style='background: #cbc7bd' class="table table-bordered table-striped">
            <tr>
                <th>Cod. Item</th>
                <th>Cod. Material</th>
                <th>Descrição</th>
                <th>Qtd</th>
                <th>Qtd Familias At.</th>
            </tr>
            <?php
            $materiais_original = H_pedido_pedidajuda_hModel::item_pedido_original($view[0]['id']);

            foreach ($materiais_original as $key => $material) {

                print "<tr>";
                print "<td class='col-md-1'>" . $material['id'] . "</td>";
                print "<td class='col-md-2'>" . $material['codigo'] . "</td>";
                print "<td class='col-md-5'>" . $material['descricao_item'] . "</td>";
                print "<td class='col-md-1'>" . $material['qtd'] . "</td>";
                print "<td class='col-md-2'>" . $material['qtd_familia_atendida'] . "</td>";
            }
            ?>

        </table>
    </div>
    <div class='col-md-1'>
        &nbsp;
    </div>
</div>

<br>
<!- tabela de materiais do pedido -->
<legend>Materiais do Pedido</legend>
<div class='row table-responsive'>
    <div class='col-md-1'>
    </div>
    <div class='col-md-10'><br>

        <table class="table table-bordered table-striped">
            <tr>
                <td>Cod. Item</td>
                <td>Cod. Material</td>
                <td>Descrição</td>
                <td>Qtd</td>
                <td>Qtd Familias At.</td>
                <td>Opções</td>
            </tr>
            <?php
            $materiais = H_pedido_pedidajuda_hModel::item_pedido($view[0]['id']);

            foreach ($materiais as $key => $material) {

                print "<tr>";
                print "<td class='col-md-1'>" . $material['id'] . "</td>";
                print "<td class='col-md-2'>" . $material['codigo'] . "</td>";
                print "<td class='col-md-5'>" . $material['descricao_item'] . "</td>";
                print "<td class='col-md-1'>" . $material['qtd'] . "</td>";
                print "<td class='col-md-2'>" . $material['qtd_familia_atendida'] . "</td>";
                print "<td class='col-md-1'>";
                print "<a href='index.php" . FuncaoBase::geraLink('ajuda', 'h_pedido_itens', 'edit', array('id' => $material['id'])) . "'><img src='/core/imagem/editar.png'></a>";
                print "<a href='index.php" . FuncaoBase::geraLink('ajuda', 'h_pedido_itens', 'delete', array('id' => $material['id'], 'id_pedido' => $view[0]['id'])) . "'><img src='/core/imagem/delete.png'></a>";
                print "</td>";
                print "</tr>";
            }
            ?>

        </table>
    </div>
    <div class='col-md-1'>
        &nbsp;
    </div>
</div>

<legend>Lista de Arquivos Anexados</legend>
<div class="row table-responsive">
    <div class='col-md-1'>
    </div>
    <div class="col-md-10">

        <table class="table table-bordered table-condensed table-striped">

            <tr>
                <th>#</th>
                <th>Data Envio</th>
                <th>Nome arquivo</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>

            <?php
            $arquivos = H_pedido_anexoajuda_hModel::ListaAnexo($view[0]['id']);

            foreach ($arquivos as $key => $arquivo) {


                print "<tr>";
                print "<td>" . ($key + 1) . "</td>";
                print "<td>" . DataMysql::dataCompletaVisual($arquivo['data_envio']) . "</td>";
                print "<td>" . $arquivo['nome_arquivo'] . "</td>";
                print "<td>" . $arquivo['descricao'] . "</td>";
                print "<td><a name='deletar_anexo' data-nome_arquivo='" . $arquivo['nome_arquivo'] . "' data-id='" . $arquivo['id'] . "' title='Apagar Arquivo'><img src='/core/imagem/delete.png'></a></td>";
                print "</tr>";
            }
            ?>

        </table>
    </div>
    <div class='col-md-1'>
    </div>
</div>

<?php
$analises_tecnica = H_pedido_an_tecajuda_hModel::listAnalise($view[0]['id']);

$analise_drd = array();
$analise_dlog = array();
$analise_coord = array();

foreach ($analises_tecnica as $key => $analise) {

    if ($analise['tramit_parecer'] == 'analise_drd') {
        $analise_drd[] = $analise;
    }
    if ($analise['tramit_parecer'] == 'analise_dlog') {
        $analise_dlog[] = $analise;
    }
    if ($analise['tramit_parecer'] == 'analise_coord') {
        $analise_coord[] = $analise;
    }
}

#pareceer técnico DRD
if (count($analise_drd) > 0) {

    print "<br><legend> Parecer técnico DRD</legend>";
    foreach ($analise_drd as $key => $an_drd) {

        print "<div class='row'>";
        print "<div class='col-md-1'>";
        print "#" . ($key + 1) . "<p>" . DataMysql::dataVisual($an_drd['data_parecer']) . "</p>";
        print "</div>";

        print "<div class='col-md-11'>";
        print "<p style='text-align: justify'>" . $an_drd['parecer'] . "</p>";
        print "</div>";
        print "</div><hr>";
    }
}

# pareceer técnico DLOG
if (count($analise_dlog) > 0) {

    print "<br><legend> Parecer técnico DLOG</legend>";
    foreach ($analise_dlog as $key => $an_dlog) {

        print "<div class='row'>";
        print "<div class='col-md-1'>";
        print "#" . ($key + 1) . "<p>" . DataMysql::dataVisual($an_dlog['data_parecer']) . "</p>";
        print "</div>";

        print "<div class='col-md-11'>";
        print "<p style='text-align: justify'>" . $an_dlog['parecer'] . "</p>";
        print "</div>";
        print "</div><hr>";
    }
}

# pareceer técnico COORD
if (count($analise_coord) > 0) {

    print "<br><legend> Parecer técnico COORD</legend>";
    foreach ($analise_coord as $key => $an_coord) {

        print "<div class='row'>";
        print "#" . ($key + 1) . "<div class='col-md-1'>";
        print "<p>" . DataMysql::dataVisual($an_coord['data_parecer']) . "</p>";
        print "</div>";

        print "<div class='col-md-11'>";
        print "<p style='text-align: justify'>" . $an_coord['parecer'] . "</p>";
        print "</div>";
        print "</div><hr>";
    }
}

?>
</div>
<div id='print_pedido'>
    <?php
        include('view_pedido.php');
    ?>
    
    
</div>

<!--<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "edit", array('id' => $view[0]['id'])) ?>">Editar</a>-->
<br>
<br>

<br>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

    $(document).ready(function () {
        
        $('#print_pedido').show();
        $("#view").hide();  //
        $("#btn_print").click(function(){
            $("#view").hide();  
            $('#print_pedido').show();
            //window.print();
            $("#btn_print").hide(); 
        });

    });
</script>
