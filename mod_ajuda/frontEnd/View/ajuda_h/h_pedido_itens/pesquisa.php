
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_itens", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_itens", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaH_pedido_itens" id="frmBuscaH_pedido_itens">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchH_pedido_itensName" id="searcH_pedido_itensName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaH_pedido_itens" id="btnBuscaH_pedido_itens" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaH_pedido_itens']) ? $_POST['btnBuscaH_pedido_itens'] : null;
$nome = isset($_POST['searchH_pedido_itensName']) ? $_POST['searchH_pedido_itensName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new H_pedido_itensajuda_hModel();
    $h_pedido_itenss = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa H_pedido_itens</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id</th>
<th>codigo</th>
<th>descricao_item</th>
<th>qtd</th>
<th>qtd_familia_atendida</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($h_pedido_itenss as $h_pedido_itens) {

            print "<tr>
                    <td>".$h_pedido_itens['id']."</td>
<td>".$h_pedido_itens['codigo']."</td>
<td>".$h_pedido_itens['descricao_item']."</td>
<td>".$h_pedido_itens['qtd']."</td>
<td>".$h_pedido_itens['qtd_familia_atendida']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_itens", "view", array('id' => $h_pedido_itens['id'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_itens", "edit", array('id' => $h_pedido_itens['id'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_itens", "delete", array('id' => $h_pedido_itens['id'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosH_pedido_itens); ?>, // array com os dados
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
        $("#searchH_pedido_itensName").easyAutocomplete(itens);

    });
</script>
        