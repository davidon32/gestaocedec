
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("decreto", "cobrade", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("decreto", "cobrade", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaCobrade" id="frmBuscaCobrade">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchCobradeName" id="searcCobradeName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaCobrade" id="btnBuscaCobrade" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaCobrade']) ? $_POST['btnBuscaCobrade'] : null;
$nome = isset($_POST['searchCobradeName']) ? $_POST['searchCobradeName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new CobradeModel();
    $cobrades = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa Cobrade</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id_cobrade</th>
<th>codigo</th>
<th>descricao</th>
<th>nome</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($cobrades as $cobrade) {

            print "<tr>
                    <td>".$cobrade['id_cobrade']."</td>
<td>".$cobrade['codigo']."</td>
<td>".$cobrade['descricao']."</td>
<td>".$cobrade['nome']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("decreto", "cobrade", "view", array('id' => $cobrade['id_cobrade'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("decreto", "cobrade", "edit", array('id' => $cobrade['id_cobrade'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("decreto", "cobrade", "delete", array('id' => $cobrade['id_cobrade'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosCobrade); ?>, // array com os dados
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
        $("#searchCobradeName").easyAutocomplete(itens);

    });
</script>
        