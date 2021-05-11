
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "tp_pedido", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "tp_pedido", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaTp_pedido" id="frmBuscaTp_pedido">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchTp_pedidoName" id="searcTp_pedidoName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaTp_pedido" id="btnBuscaTp_pedido" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaTp_pedido']) ? $_POST['btnBuscaTp_pedido'] : null;
$nome = isset($_POST['searchTp_pedidoName']) ? $_POST['searchTp_pedidoName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new Tp_pedidoConEstoqueModel();
    $tp_pedidos = $busca->listaNome($nome);
    
    print "<br><div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>Código</th>
<th>nome</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($tp_pedidos as $tp_pedido) {

            print "<tr>
                    <td>".$tp_pedido['id_tp_pedido']."</td>
<td>".$tp_pedido['nome']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "tp_pedido", "view", array('id' => $tp_pedido['id_tp_pedido'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "tp_pedido", "edit", array('id' => $tp_pedido['id_tp_pedido'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "tp_pedido", "delete", array('id' => $tp_pedido['id_tp_pedido'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosTp_pedido); ?>, // array com os dados
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
        $("#searchTp_pedidoName").easyAutocomplete(itens);

    });
</script>
        