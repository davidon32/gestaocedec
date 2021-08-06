
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "entrada_nota", "index") ?>">Voltar</a>
<?php
    if(Usuario::getPermissao("aju_permissao", "entrada_nota") == 1){
        print ' <a class="btn btn-info" title="Novo Registro" href="'.(FuncaoBase::geraLink("ajuda", "entrada_nota", "cadastro")).'">+ Novo</a>';
    }else {
        print ' <a class="btn btn-info" disabled>+ Novo</a> ';
    }
?>

<br>
<br>

<form method="post" action="#" name="frmBuscaEntrada_nota" id="frmBuscaEntrada_nota">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchEntrada_notaName" id="searcEntrada_notaName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaEntrada_nota" id="btnBuscaEntrada_nota" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaEntrada_nota']) ? $_POST['btnBuscaEntrada_nota'] : null;
$nome = isset($_POST['searchEntrada_notaName']) ? $_POST['searchEntrada_notaName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new Entrada_notaConEstoqueModel();
    $entrada_notas = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa Entrada_nota</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id_entrada_nota</th>
<th>id_fornecedor</th>
<th>data_emissao</th>
<th>data_entrega</th>
<th>id_natureza</th>
<th>id_itens_nota</th>
<th>id_almoxarifado</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($entrada_notas as $entrada_nota) {

            print "<tr>
                    <td>".$entrada_nota['id_entrada_nota']."</td>
<td>".$entrada_nota['id_fornecedor']."</td>
<td>".$entrada_nota['data_emissao']."</td>
<td>".$entrada_nota['data_entrega']."</td>
<td>".$entrada_nota['id_natureza']."</td>
<td>".$entrada_nota['id_itens_nota']."</td>
<td>".$entrada_nota['id_almoxarifado']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "entrada_nota", "view", array('id' => $entrada_nota['id_entrada_nota'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "entrada_nota", "edit", array('id' => $entrada_nota['id_entrada_nota'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "entrada_nota", "delete", array('id' => $entrada_nota['id_entrada_nota'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosEntrada_nota); ?>, // array com os dados
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
        $("#searchEntrada_notaName").easyAutocomplete(itens);

    });
</script>
        