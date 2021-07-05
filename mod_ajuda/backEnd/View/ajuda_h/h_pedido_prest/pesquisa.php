
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_prest", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_prest", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaH_pedido_prest" id="frmBuscaH_pedido_prest">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchH_pedido_prestName" id="searcH_pedido_prestName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaH_pedido_prest" id="btnBuscaH_pedido_prest" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaH_pedido_prest']) ? $_POST['btnBuscaH_pedido_prest'] : null;
$nome = isset($_POST['searchH_pedido_prestName']) ? $_POST['searchH_pedido_prestName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new H_pedido_prestajuda_hModel();
    $h_pedido_prests = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa H_pedido_prest</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id</th>
<th>id_pedido</th>
<th>cod_material</th>
<th>nome_material</th>
<th>total_familia_at</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($h_pedido_prests as $h_pedido_prest) {

            print "<tr>
                    <td>".$h_pedido_prest['id']."</td>
<td>".$h_pedido_prest['id_pedido']."</td>
<td>".$h_pedido_prest['cod_material']."</td>
<td>".$h_pedido_prest['nome_material']."</td>
<td>".$h_pedido_prest['total_familia_at']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_prest", "view", array('id' => $h_pedido_prest['id'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_prest", "edit", array('id' => $h_pedido_prest['id'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_prest", "delete", array('id' => $h_pedido_prest['id'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosH_pedido_prest); ?>, // array com os dados
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
        $("#searchH_pedido_prestName").easyAutocomplete(itens);

    });
</script>
        