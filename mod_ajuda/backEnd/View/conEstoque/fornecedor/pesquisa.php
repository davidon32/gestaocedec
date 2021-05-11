
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "fornecedor", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "fornecedor", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaFornecedor" id="frmBuscaFornecedor">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchFornecedorName" id="searcFornecedorName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaFornecedor" id="btnBuscaFornecedor" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaFornecedor']) ? $_POST['btnBuscaFornecedor'] : null;
$nome = isset($_POST['searchFornecedorName']) ? $_POST['searchFornecedorName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new FornecedorConEstoqueModel();
    $fornecedors = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa Fornecedor</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id_fornecedor</th>
<th>nome</th>
<th>cpfcnpj</th>
<th>endereco</th>
<th>municipio</th>
<th>estado</th>
<th>cep</th>
<th>tel</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($fornecedors as $fornecedor) {

            print "<tr>
                    <td>".$fornecedor['id_fornecedor']."</td>
<td>".$fornecedor['nome']."</td>
<td>".$fornecedor['cpfcnpj']."</td>
<td>".$fornecedor['endereco']."</td>
<td>".$fornecedor['municipio']."</td>
<td>".$fornecedor['estado']."</td>
<td>".$fornecedor['cep']."</td>
<td>".$fornecedor['tel']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "fornecedor", "view", array('id' => $fornecedor['id_fornecedor'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "fornecedor", "edit", array('id' => $fornecedor['id_fornecedor'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "fornecedor", "delete", array('id' => $fornecedor['id_fornecedor'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosFornecedor); ?>, // array com os dados
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
        $("#searchFornecedorName").easyAutocomplete(itens);

    });
</script>
        