
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("cce", "permissao", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("cce", "permissao", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaPermissao" id="frmBuscaPermissao">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchPermissaoName" id="searcPermissaoName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaPermissao" id="btnBuscaPermissao" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaPermissao']) ? $_POST['btnBuscaPermissao'] : null;
$nome = isset($_POST['searchPermissaoName']) ? $_POST['searchPermissaoName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new PermissaodecretoModel();
    $permissaos = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa Permissao</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id_permissao</th>
<th>login</th>
<th>nivel</th>
<th>cad_decreto</th>
<th>relatorio</th>
<th>rel_resumo</th>
<th>id_usuario</th>
<th>edit_decreto</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($permissaos as $permissao) {

            print "<tr>
                    <td>".$permissao['id_permissao']."</td>
<td>".$permissao['login']."</td>
<td>".$permissao['nivel']."</td>
<td>".$permissao['cad_decreto']."</td>
<td>".$permissao['relatorio']."</td>
<td>".$permissao['rel_resumo']."</td>
<td>".$permissao['id_usuario']."</td>
<td>".$permissao['edit_decreto']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("cce", "permissao", "view", array('id' => $permissao['id_permissao'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("cce", "permissao", "edit", array('id' => $permissao['id_permissao'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("cce", "permissao", "delete", array('id' => $permissao['id_permissao'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosPermissao); ?>, // array com os dados
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
        $("#searchPermissaoName").easyAutocomplete(itens);

    });
</script>
        