
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "unidade_med", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "unidade_med", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaUnidade_med" id="frmBuscaUnidade_med">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchUnidade_medName" id="searcUnidade_medName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaUnidade_med" id="btnBuscaUnidade_med" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaUnidade_med']) ? $_POST['btnBuscaUnidade_med'] : null;
$nome = isset($_POST['searchUnidade_medName']) ? $_POST['searchUnidade_medName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new Unidade_medConEstoqueModel();
    $unidade_meds = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa Unidade_med</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id_unidade_med</th>
<th>nome</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($unidade_meds as $unidade_med) {

            print "<tr>
                    <td>".$unidade_med['id_unidade_med']."</td>
<td>".$unidade_med['nome']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "unidade_med", "view", array('id' => $unidade_med['id_unidade_med'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "unidade_med", "edit", array('id' => $unidade_med['id_unidade_med'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "unidade_med", "delete", array('id' => $unidade_med['id_unidade_med'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosUnidade_med); ?>, // array com os dados
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
        $("#searchUnidade_medName").easyAutocomplete(itens);

    });
</script>
        