
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "montagem", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "montagem", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaMontagem" id="frmBuscaMontagem">
    <label>Pesquisa : (Data )</label>
    <input type="text" class="form form-control" name="searchMontagemName" id="searcMontagemName" data-mask="99/99/9999">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaMontagem" id="btnBuscaMontagem" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaMontagem']) ? $_POST['btnBuscaMontagem'] : null;
$nome = isset($_POST['searchMontagemName']) ? $_POST['searchMontagemName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new MontagemConEstoqueModel();
    $montagems = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa Montagem</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id_montagem</th>
<th>data_montagem</th>
<th>motorista</th>
<th>placa</th>
<th>id_transportadora</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($montagems as $montagem) {

            print "<tr>
                    <td>".$montagem['id_montagem']."</td>
<td>".$montagem['data_montagem']."</td>
<td>".$montagem['motorista']."</td>
<td>".$montagem['placa']."</td>
<td>".$montagem['id_transportadora']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "montagem", "view", array('id' => $montagem['id_montagem'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "montagem", "edit", array('id' => $montagem['id_montagem'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "montagem", "delete", array('id' => $montagem['id_montagem'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosMontagem); ?>, // array com os dados
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
        $("#searchMontagemName").easyAutocomplete(itens);

    });
</script>
        