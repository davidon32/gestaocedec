
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_an_tec", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_an_tec", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaH_pedido_an_tec" id="frmBuscaH_pedido_an_tec">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchH_pedido_an_tecName" id="searcH_pedido_an_tecName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaH_pedido_an_tec" id="btnBuscaH_pedido_an_tec" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaH_pedido_an_tec']) ? $_POST['btnBuscaH_pedido_an_tec'] : null;
$nome = isset($_POST['searchH_pedido_an_tecName']) ? $_POST['searchH_pedido_an_tecName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new H_pedido_an_tecajuda_hModel();
    $h_pedido_an_tecs = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa H_pedido_an_tec</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id_analise</th>
<th>id_usuario</th>
<th>id_pedido</th>
<th>data_parecer</th>
<th>parecer</th>
<th>tramit_parecer</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($h_pedido_an_tecs as $h_pedido_an_tec) {

            print "<tr>
                    <td>".$h_pedido_an_tec['id_analise']."</td>
<td>".$h_pedido_an_tec['id_usuario']."</td>
<td>".$h_pedido_an_tec['id_pedido']."</td>
<td>".$h_pedido_an_tec['data_parecer']."</td>
<td>".$h_pedido_an_tec['parecer']."</td>
<td>".$h_pedido_an_tec['tramit_parecer']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_an_tec", "view", array('id' => $h_pedido_an_tec['id_analise'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_an_tec", "edit", array('id' => $h_pedido_an_tec['id_analise'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_an_tec", "delete", array('id' => $h_pedido_an_tec['id_analise'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosH_pedido_an_tec); ?>, // array com os dados
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
        $("#searchH_pedido_an_tecName").easyAutocomplete(itens);

    });
</script>
        