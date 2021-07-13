
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "index") ?>">Voltar</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaH_pedido_pedid" id="frmBuscaH_pedido_pedid">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchH_pedido_pedidName" id="searcH_pedido_pedidName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaH_pedido_pedid" id="btnBuscaH_pedido_pedid" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaH_pedido_pedid']) ? $_POST['btnBuscaH_pedido_pedid'] : null;
$nome = isset($_POST['searchH_pedido_pedidName']) ? $_POST['searchH_pedido_pedidName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new H_pedido_pedidajuda_hModel();
    $h_pedido_pedids = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa Pedido de Ajuda Humanitaria</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id</th>
<th>numero</th>
<th>data_entrada_sistema</th>
<th>despachante_analista</th>
<th>despachante_dlog</th>
<th>id_municipio</th>
<th>id_regiao</th>
<th>nome_coordenador</th>
<th>tel_coordenador</th>
<th>cel_coordenador</th>
<th>email_coordenador</th>
<th>nome_prefeito</th>
<th>tel_prefeito</th>
<th>cel_prefeito</th>
<th>email_prefeito</th>
<th>id_cobrade</th>
<th>pop_atendida</th>
<th>decreto_se_ecp_vig</th>
<th>numero_decreto</th>
<th>data_vigencia</th>
<th>tipo_decreto</th>
<th>esforcos_realizados</th>
<th>data_hora_envio</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($h_pedido_pedids as $h_pedido_pedid) {

            print "<tr>
                    <td>".$h_pedido_pedid['id']."</td>
<td>".$h_pedido_pedid['numero']."</td>
<td>".$h_pedido_pedid['data_entrada_sistema']."</td>
<td>".$h_pedido_pedid['despachante_analista']."</td>
<td>".$h_pedido_pedid['despachante_dlog']."</td>
<td>".$h_pedido_pedid['id_municipio']."</td>
<td>".$h_pedido_pedid['id_regiao']."</td>
<td>".$h_pedido_pedid['nome_coordenador']."</td>
<td>".$h_pedido_pedid['tel_coordenador']."</td>
<td>".$h_pedido_pedid['cel_coordenador']."</td>
<td>".$h_pedido_pedid['email_coordenador']."</td>
<td>".$h_pedido_pedid['nome_prefeito']."</td>
<td>".$h_pedido_pedid['tel_prefeito']."</td>
<td>".$h_pedido_pedid['cel_prefeito']."</td>
<td>".$h_pedido_pedid['email_prefeito']."</td>
<td>".$h_pedido_pedid['id_cobrade']."</td>
<td>".$h_pedido_pedid['pop_atendida']."</td>
<td>".$h_pedido_pedid['decreto_se_ecp_vig']."</td>
<td>".$h_pedido_pedid['numero_decreto']."</td>
<td>".$h_pedido_pedid['data_vigencia']."</td>
<td>".$h_pedido_pedid['tipo_decreto']."</td>
<td>".$h_pedido_pedid['esforcos_realizados']."</td>
<td>".$h_pedido_pedid['data_hora_envio']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "view", array('id' => $h_pedido_pedid['id'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "edit", array('id' => $h_pedido_pedid['id'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_pedid", "delete", array('id' => $h_pedido_pedid['id'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosH_pedido_pedid); ?>, // array com os dados
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
        $("#searchH_pedido_pedidName").easyAutocomplete(itens);

    });
</script>
        