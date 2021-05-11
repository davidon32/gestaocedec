
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "itens_nota", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "itens_nota", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaItens_nota" id="frmBuscaItens_nota">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchItens_notaName" id="searcItens_notaName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaItens_nota" id="btnBuscaItens_nota" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaItens_nota']) ? $_POST['btnBuscaItens_nota'] : null;
$nome = isset($_POST['searchItens_notaName']) ? $_POST['searchItens_notaName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new Itens_notaConEstoqueModel();
    $itens_notas = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa Itens_nota</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id_itens_nota</th>
<th>id_unidade</th>
<th>qtd</th>
<th>val_unid</th>
<th>val_total</th>
<th>validade</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($itens_notas as $itens_nota) {

            print "<tr>
                    <td>".$itens_nota['id_itens_nota']."</td>
<td>".$itens_nota['id_unidade']."</td>
<td>".$itens_nota['qtd']."</td>
<td>".$itens_nota['val_unid']."</td>
<td>".$itens_nota['val_total']."</td>
<td>".$itens_nota['validade']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "itens_nota", "view", array('id' => $itens_nota['id_itens_nota'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "itens_nota", "edit", array('id' => $itens_nota['id_itens_nota'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "itens_nota", "delete", array('id' => $itens_nota['id_itens_nota'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosItens_nota); ?>, // array com os dados
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
        $("#searchItens_notaName").easyAutocomplete(itens);

    });
</script>
        