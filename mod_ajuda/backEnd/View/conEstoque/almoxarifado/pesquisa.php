
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "almoxarifado", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "almoxarifado", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaAlmoxarifado" id="frmBuscaAlmoxarifado">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchAlmoxarifadoName" id="searcAlmoxarifadoName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaAlmoxarifado" id="btnBuscaAlmoxarifado" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaAlmoxarifado']) ? $_POST['btnBuscaAlmoxarifado'] : null;
$nome = isset($_POST['searchAlmoxarifadoName']) ? $_POST['searchAlmoxarifadoName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new AlmoxarifadoConEstoqueModel();
    $almoxarifados = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa Armazém</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>Código</th>
<th>nome</th>
<th>endereco</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($almoxarifados as $almoxarifado) {

            print "<tr>
                    <td>".$almoxarifado['id_almoxarifado']."</td>
<td>".$almoxarifado['nome']."</td>
<td>".$almoxarifado['endereco']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "almoxarifado", "view", array('id' => $almoxarifado['id_almoxarifado'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "almoxarifado", "edit", array('id' => $almoxarifado['id_almoxarifado'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "almoxarifado", "delete", array('id' => $almoxarifado['id_almoxarifado'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosAlmoxarifado); ?>, // array com os dados
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
        $("#searchAlmoxarifadoName").easyAutocomplete(itens);

    });
</script>
        