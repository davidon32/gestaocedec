
<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_admin/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php"; ?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("admin", "release", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("admin", "release", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaRelease" id="frmBuscaRelease">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchReleaseName" id="searcReleaseName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaRelease" id="btnBuscaRelease" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaRelease']) ? $_POST['btnBuscaRelease'] : null;
$nome = isset($_POST['searchReleaseName']) ? $_POST['searchReleaseName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new ReleaseConEstoqueModel();
    $releases = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa Release</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id_release</th>
<th>texto</th>
<th>dt_release</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($releases as $release) {

            print "<tr>
                    <td>".$release['id_release']."</td>
<td>".$release['texto']."</td>
<td>".$release['dt_release']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("admin", "release", "view", array('id' => $release['id_release'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("admin", "release", "edit", array('id' => $release['id_release'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("admin", "release", "delete", array('id' => $release['id_release'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosRelease); ?>, // array com os dados
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
        $("#searchReleaseName").easyAutocomplete(itens);

    });
</script>
        