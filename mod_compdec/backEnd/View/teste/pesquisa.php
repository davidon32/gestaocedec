
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("compdec", "teste", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("compdec", "teste", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaTeste" id="frmBuscaTeste">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchTesteName" id="searcTesteName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaTeste" id="btnBuscaTeste" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaTeste']) ? $_POST['btnBuscaTeste'] : null;
$nome = isset($_POST['searchTesteName']) ? $_POST['searchTesteName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new TesteModel();
    $testes = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa Teste</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id_teste</th>
<th>data_reg</th>
<th>CodUf</th>
<th>Codmundv</th>
<th>Codmun</th>
<th>NomeMunic</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($testes as $teste) {

            print "<tr>
                    <td>".$teste['id_teste']."</td>
<td>".$teste['data_reg']."</td>
<td>".$teste['CodUf']."</td>
<td>".$teste['Codmundv']."</td>
<td>".$teste['Codmun']."</td>
<td>".$teste['NomeMunic']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("compdec", "teste", "view", array('id' => $teste['id_teste'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("compdec", "teste", "edit", array('id' => $teste['id_teste'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("compdec", "teste", "delete", array('id' => $teste['id_teste'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosTeste); ?>, // array com os dados
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
        $("#searchTesteName").easyAutocomplete(itens);

    });
</script>
        