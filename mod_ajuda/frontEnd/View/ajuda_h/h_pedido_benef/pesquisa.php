
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_benef", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_benef", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaH_pedido_benef" id="frmBuscaH_pedido_benef">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchH_pedido_benefName" id="searcH_pedido_benefName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaH_pedido_benef" id="btnBuscaH_pedido_benef" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaH_pedido_benef']) ? $_POST['btnBuscaH_pedido_benef'] : null;
$nome = isset($_POST['searchH_pedido_benefName']) ? $_POST['searchH_pedido_benefName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new H_pedido_benefajuda_hModel();
    $h_pedido_benefs = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa H_pedido_benef</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id</th>
<th>nome_beneficiario</th>
<th>rg</th>
<th>comunidade</th>
<th>qtd</th>
<th>data_entrega</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($h_pedido_benefs as $h_pedido_benef) {

            print "<tr>
                    <td>".$h_pedido_benef['id']."</td>
<td>".$h_pedido_benef['nome_beneficiario']."</td>
<td>".$h_pedido_benef['rg']."</td>
<td>".$h_pedido_benef['comunidade']."</td>
<td>".$h_pedido_benef['qtd']."</td>
<td>".$h_pedido_benef['data_entrega']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_benef", "view", array('id' => $h_pedido_benef['id'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_benef", "edit", array('id' => $h_pedido_benef['id'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_benef", "delete", array('id' => $h_pedido_benef['id'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosH_pedido_benef); ?>, // array com os dados
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
        $("#searchH_pedido_benefName").easyAutocomplete(itens);

    });
</script>
        