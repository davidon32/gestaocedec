
<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php"; ?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "pedido", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "pedido", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaPedido" id="frmBuscaPedido">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchPedidoName" id="searcPedidoName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaPedido" id="btnBuscaPedido" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaPedido']) ? $_POST['btnBuscaPedido'] : null;
$nome = isset($_POST['searchPedidoName']) ? $_POST['searchPedidoName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new PedidoConEstoqueModel();
    $pedidos = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa Pedido</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id_pedido</th>
<th>id_tp_pedido</th>
<th>data_emissao</th>
<th>data_entrega</th>
<th>id_almoxarifado</th>
<th>id_transportadora</th>
<th>id_destinatario</th>
<th>id_destinatario_final</th>
<th>nome_destinatario_final</th>
<th>obs</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($pedidos as $pedido) {

            print "<tr>
                    <td>".$pedido['id_pedido']."</td>
<td>".$pedido['id_tp_pedido']."</td>
<td>".$pedido['data_emissao']."</td>
<td>".$pedido['data_entrega']."</td>
<td>".$pedido['id_almoxarifado']."</td>
<td>".$pedido['id_transportadora']."</td>
<td>".$pedido['id_destinatario']."</td>
<td>".$pedido['id_destinatario_final']."</td>
<td>".$pedido['nome_destinatario_final']."</td>
<td>".$pedido['obs']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "pedido", "view", array('id' => $pedido['id_pedido'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "pedido", "edit", array('id' => $pedido['id_pedido'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "pedido", "delete", array('id' => $pedido['id_pedido'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

            print
                    "</td>";

            print "</tr>";
        }
       

    print " </tbody></table></div>";
}
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

        var itens = {
            data:
<?php print json_encode($dadosPedido); ?>, // array com os dados
            getValue: "nome", /* alterar com nome do item BD */
            list: {
                match: {
                    enabled: true
                },

                onSelectItemEvent: function () {
                    //var id = $("#searcid_marca").getSelectedItemData().id_marca;
                    //var nome = $("#searcid_marca").getSelectedItemData().nome;

                    // $("#nomeMarca_fk").val(nome); // Mudar
                    //$("#id_marca").val(id);
                }
            }
        };
        /*********** autocomplete ***********/
        $("#searchPedidoName").easyAutocomplete(itens);

    });
</script>
        