
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "cunidade", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "cunidade", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaUnidade" id="frmBuscaUnidade">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchUnidadeName" id="searcUnidadeName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaUnidade" id="btnBuscaUnidade" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaUnidade']) ? $_POST['btnBuscaUnidade'] : null;
$nome = isset($_POST['searchUnidadeName']) ? $_POST['searchUnidadeName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new UnidadeConEstoqueModel();
    $unidades = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa Unidade</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id_unidade</th>
<th>nome</th>
<th>descricao</th>
<th>valor</th>
<th>data_validade</th>
<th>id_marca</th>
<th>id_categoria</th>
<th>id_almoxarifado</th>
<th>id_fornecedor</th>
<th>id_unidade_med</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($unidades as $unidade) {

            print "<tr>
                    <td>".$unidade['id_unidade']."</td>
<td>".$unidade['nome']."</td>
<td>".$unidade['descricao']."</td>
<td>".$unidade['valor']."</td>
<td>".$unidade['data_validade']."</td>
<td>".$unidade['id_marca']."</td>
<td>".$unidade['id_categoria']."</td>
<td>".$unidade['id_almoxarifado']."</td>
<td>".$unidade['id_fornecedor']."</td>
<td>".$unidade['id_unidade_med']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "cunidade", "view", array('id' => $unidade['id_unidade'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "cunidade", "edit", array('id' => $unidade['id_unidade'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "cunidade", "delete", array('id' => $unidade['id_unidade'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosUnidade); ?>, // array com os dados
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
        $("#searchUnidadeName").easyAutocomplete(itens);

    });
</script>
        