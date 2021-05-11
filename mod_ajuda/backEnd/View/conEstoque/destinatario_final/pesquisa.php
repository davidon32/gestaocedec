
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "destinatario_final", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("ajuda", "destinatario_final", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaDestinatario_final" id="frmBuscaDestinatario_final">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchDestinatario_finalName" id="searcDestinatario_finalName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaDestinatario_final" id="btnBuscaDestinatario_final" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaDestinatario_final']) ? $_POST['btnBuscaDestinatario_final'] : null;
$nome = isset($_POST['searchDestinatario_finalName']) ? $_POST['searchDestinatario_finalName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new Destinatario_finalConEstoqueModel();
    $destinatario_finals = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa Destinatario_final</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id_destinatario_final</th>
<th>nome</th>
<th>endereco</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($destinatario_finals as $destinatario_final) {

            print "<tr>
                    <td>".$destinatario_final['id_destinatario_final']."</td>
<td>".$destinatario_final['nome']."</td>
<td>".$destinatario_final['endereco']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "destinatario_final", "view", array('id' => $destinatario_final['id_destinatario_final'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "destinatario_final", "edit", array('id' => $destinatario_final['id_destinatario_final'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "destinatario_final", "delete", array('id' => $destinatario_final['id_destinatario_final'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosDestinatario_final); ?>, // array com os dados
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
        $("#searchDestinatario_finalName").easyAutocomplete(itens);

    });
</script>
        