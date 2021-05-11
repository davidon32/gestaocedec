
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "marca", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "marca", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaMarca" id="frmBuscaMarca">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchMarcaName" id="searcMarcaName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaMarca" id="btnBuscaMarca" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaMarca']) ? $_POST['btnBuscaMarca'] : null;
$nome = isset($_POST['searchMarcaName']) ? $_POST['searchMarcaName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new MarcaConEstoqueModel();
    $marcas = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa Marca</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id_marca</th>
<th>nome</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($marcas as $marca) {

            print "<tr>
                    <td>".$marca['id_marca']."</td>
<td>".$marca['nome']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "marca", "view", array('id' => $marca['id_marca'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "marca", "edit", array('id' => $marca['id_marca'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "marca", "delete", array('id' => $marca['id_marca'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosMarca); ?>, // array com os dados
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
        $("#searchMarcaName").easyAutocomplete(itens);

    });
</script>
        