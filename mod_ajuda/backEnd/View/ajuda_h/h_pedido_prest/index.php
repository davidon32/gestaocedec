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
<?php
$id = isset($_GET['id']) ? $_GET['id'] : "";

$h_pedido = H_pedido_pedidajuda_hModel::buscaPedidoId($id);
//var_dump($h_pedido[0]['status']);

$h_pedido_prest = new H_pedido_prestajuda_hModel();
?>

<div class="col-md-6 text-left">
    <a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_index", "index") ?>">Voltar</a>
</div>
<div class="col-md-6 text-right">
    <?php
    if ($h_pedido[0]['status'] == 6) {
        print "<a class=\"btn btn-primary\" href=\"" . FuncaoBase::geraLink("ajuda", "h_pedido_prest", "homologa", array('id' => $_GET['id'])) . "\">Homologar</a>";
    }
    ?>
    <a class="btn btn-primary" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_prest", "visualizar", array('id' => $_GET['id'])) ?>">Visualizar</a>

</div>
<br>
<br>

<?php
print "<legend>Prestação de Contas Pedido : <b>" . Municipio::PegaNomeMunicipio($h_pedido[0]['id_municipio']) . "</b></legend>";
print "Status : <b>" . H_pedido_pedidajuda_hModel::enumFase($h_pedido[0]['tramit']) . "</b>";

print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
<th>#</th>
<th>id_pedido</th>
<th>cod_material</th>
<th>nome_material</th>
<th>Qtd</th>
<th>% Conclusão Prestação Contas</th>

<th>Opções</th>
            </tr>
</thead>
<tbody>";


$materiais = $h_pedido_prest::listaPrestContasporPedido($id);


foreach ($materiais as $key => $material) {


    $beneficiario = $h_pedido_prest->percBenef($material['id']); # $material[id'] - id do item da prest. de contas

    if ($beneficiario > 0) {

        $percent = ( $beneficiario / $material['qtd']) * 100;
    } else {
        $percent = 0;
    }


    $cor_percent_prest = ( $percent == 50 ) ? '#32CD32' : '';

    print "<tr style='background-color: " . $cor_percent_prest . "'>
<td>" . ($key + 1) . "</td>
<td>" . $material['id_pedido'] . "</td>
<td>" . $material['cod_material'] . "</td>
<td>" . $material['nome_material'] . "</td>
<td>" . $material['qtd'] . "</td>
<td>" . $percent . "</td>
";

    print "<td>";
    print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_prest", "view", array('id' => $material['id'])) . "'><img src='/core/imagem/view.png' title='Visualizar Prestação de Contas'></a>";
    #print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_prest", "homologar", array('id' => $material['id'], 'id_pedido' => $material['id_pedido'])) . "'><img src='/core/imagem/contas.png' title='Fazer Prestação de Contas'></a>|";
    #print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_prest", "homologa", array('id'=>$_GET['id'],'id_material' => $material['id']))."' ><img src='/core/imagem/check.png' width='30' title='Homologar Material de Pedido'></a>";

    print
            "</td>";

    print "</tr>";
}


print " </tbody></table></div>";
?>


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

    });
</script>
