
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

<a class="btn btn-success" href="<?= FuncaoBase::geraLink("decreto", "processo", "index") ?>">Voltar</a>
<a class="btn btn-info" href="<?= FuncaoBase::geraLink("decreto", "processo", "cadastro") ?>" title="Novo Registro">+ Novo</a>

<br>
<br>

<form method="post" action="#" name="frmBuscaProcesso" id="frmBuscaProcesso">
    <label>Pesquisa :</label>
    <input type="text" class="form form-control" name="searchProcessoName" id="searcProcessoName">

    <br>

    <input type="submit" class="btn btn-info" name="btnBuscaProcesso" id="btnBuscaProcesso" value="Pesquisar">

</form>

<?php


$btn = isset($_POST['btnBuscaProcesso']) ? $_POST['btnBuscaProcesso'] : null;
$nome = isset($_POST['searchProcessoName']) ? $_POST['searchProcessoName'] : null;

if ($btn == 'Pesquisar') {

    $busca = new ProcessodecretoModel();
    $processos = $busca->listaNome($nome);
    
    //var_dump($unidades);

    print "<legend>Pesquisa Processo</legend>";

    print "<div class=\"table-responsive\"><table class=\"table table-bordered table-striped\">
    <thead>
            <tr>
                <th>id_processo</th>
<th>ano</th>
<th>data_entrada</th>
<th>num_processo</th>
<th>id_municipio</th>
<th>num_dec_mun</th>
<th>data_dec_mun</th>
<th>dec_vigencia</th>
<th>id_cobrade</th>
<th>data_vencimento</th>
<th>status</th>
<th>id_funcionario</th>
<th>num_dec_homo</th>
<th>data_pub_dec_homo</th>
<th>num_dt_port_dec_rec</th>
<th>num_dt_dou</th>
<th>populacao</th>
<th>val_pib</th>
<th>val_orcamento</th>
<th>val_arrecadacao</th>
<th>val_rec_anual</th>
<th>val_rec_mensal</th>
<th>tel_municipio</th>
<th>email</th>
<th>val_total</th>
<th>morto</th>
<th>ferido</th>
<th>enfermo</th>
<th>desabrigado</th>
<th>desalojado</th>
<th>outro</th>
<th>afetado</th>
<th>mat_pub_saude_destr</th>
<th>mat_pub_saude_danif</th>
<th>val_mat_pub_saude</th>
<th>mat_pub_ensino_destr</th>
<th>mat_pub_ensino_danif</th>
<th>val_mat_pub_ensino</th>
<th>mat_pub_outro_destr</th>
<th>mat_pub_outro_danif</th>
<th>val_mat_pub_outro</th>
<th>mat_pub_com_destr</th>
<th>mat_pub_com_danif</th>
<th>val_mat_pub_com</th>
<th>mat_unid_hab_destr</th>
<th>mat_unid_hab_danif</th>
<th>val_mat_unid_hab</th>
<th>mat_obr_infr_pub_destr</th>
<th>mat_obr_infr_pub_danif</th>
<th>val_mat_obr_infr_pub</th>
<th>agua_pop_atingida</th>
<th>solo_pop_atingida</th>
<th>ar_pop_atingida</th>
<th>incendio_pop_atingida</th>
<th>val_eco_pub_saude</th>
<th>val_eco_pub_agua</th>
<th>val_eco_pub_esgoto</th>
<th>val_eco_pub_lixo</th>
<th>val_eco_pub_praga</th>
<th>val_eco_pub_energia</th>
<th>val_eco_pub_telec</th>
<th>val_eco_pub_transp</th>
<th>val_eco_pub_comb</th>
<th>val_eco_pub_segur</th>
<th>val_eco_pub_ensino</th>
<th>val_eco_pub</th>
<th>val_eco_priv_agricul</th>
<th>val_eco_priv_pecuaria</th>
<th>val_eco_priv_industria</th>
<th>val_eco_priv_servico</th>
<th>val_eco_priv</th>
<th>ck_stat_reconhecido</th>
<th>ck_stat_arquivo</th>
<th>ck_stat_homologa</th>
<th>ck_stat_analise</th>
<th>Opções</th>
            </tr>
</thead>
<tbody>";

    foreach ($processos as $processo) {

            print "<tr>
                    <td>".$processo['id_processo']."</td>
<td>".$processo['ano']."</td>
<td>".$processo['data_entrada']."</td>
<td>".$processo['num_processo']."</td>
<td>".$processo['id_municipio']."</td>
<td>".$processo['num_dec_mun']."</td>
<td>".$processo['data_dec_mun']."</td>
<td>".$processo['dec_vigencia']."</td>
<td>".$processo['id_cobrade']."</td>
<td>".$processo['data_vencimento']."</td>
<td>".$processo['status']."</td>
<td>".$processo['id_funcionario']."</td>
<td>".$processo['num_dec_homo']."</td>
<td>".$processo['data_pub_dec_homo']."</td>
<td>".$processo['num_dt_port_dec_rec']."</td>
<td>".$processo['num_dt_dou']."</td>
<td>".$processo['populacao']."</td>
<td>".$processo['val_pib']."</td>
<td>".$processo['val_orcamento']."</td>
<td>".$processo['val_arrecadacao']."</td>
<td>".$processo['val_rec_anual']."</td>
<td>".$processo['val_rec_mensal']."</td>
<td>".$processo['tel_municipio']."</td>
<td>".$processo['email']."</td>
<td>".$processo['val_total']."</td>
<td>".$processo['morto']."</td>
<td>".$processo['ferido']."</td>
<td>".$processo['enfermo']."</td>
<td>".$processo['desabrigado']."</td>
<td>".$processo['desalojado']."</td>
<td>".$processo['outro']."</td>
<td>".$processo['afetado']."</td>
<td>".$processo['mat_pub_saude_destr']."</td>
<td>".$processo['mat_pub_saude_danif']."</td>
<td>".$processo['val_mat_pub_saude']."</td>
<td>".$processo['mat_pub_ensino_destr']."</td>
<td>".$processo['mat_pub_ensino_danif']."</td>
<td>".$processo['val_mat_pub_ensino']."</td>
<td>".$processo['mat_pub_outro_destr']."</td>
<td>".$processo['mat_pub_outro_danif']."</td>
<td>".$processo['val_mat_pub_outro']."</td>
<td>".$processo['mat_pub_com_destr']."</td>
<td>".$processo['mat_pub_com_danif']."</td>
<td>".$processo['val_mat_pub_com']."</td>
<td>".$processo['mat_unid_hab_destr']."</td>
<td>".$processo['mat_unid_hab_danif']."</td>
<td>".$processo['val_mat_unid_hab']."</td>
<td>".$processo['mat_obr_infr_pub_destr']."</td>
<td>".$processo['mat_obr_infr_pub_danif']."</td>
<td>".$processo['val_mat_obr_infr_pub']."</td>
<td>".$processo['agua_pop_atingida']."</td>
<td>".$processo['solo_pop_atingida']."</td>
<td>".$processo['ar_pop_atingida']."</td>
<td>".$processo['incendio_pop_atingida']."</td>
<td>".$processo['val_eco_pub_saude']."</td>
<td>".$processo['val_eco_pub_agua']."</td>
<td>".$processo['val_eco_pub_esgoto']."</td>
<td>".$processo['val_eco_pub_lixo']."</td>
<td>".$processo['val_eco_pub_praga']."</td>
<td>".$processo['val_eco_pub_energia']."</td>
<td>".$processo['val_eco_pub_telec']."</td>
<td>".$processo['val_eco_pub_transp']."</td>
<td>".$processo['val_eco_pub_comb']."</td>
<td>".$processo['val_eco_pub_segur']."</td>
<td>".$processo['val_eco_pub_ensino']."</td>
<td>".$processo['val_eco_pub']."</td>
<td>".$processo['val_eco_priv_agricul']."</td>
<td>".$processo['val_eco_priv_pecuaria']."</td>
<td>".$processo['val_eco_priv_industria']."</td>
<td>".$processo['val_eco_priv_servico']."</td>
<td>".$processo['val_eco_priv']."</td>
<td>".$processo['ck_stat_reconhecido']."</td>
<td>".$processo['ck_stat_arquivo']."</td>
<td>".$processo['ck_stat_homologa']."</td>
<td>".$processo['ck_stat_analise']."</td>
";
                    
            print "<td>";
            print "<a href='" . FuncaoBase::geraLink("decreto", "processo", "view", array('id' => $processo['id_processo'])) . "'><img src='/core/imagem/view.png' title='Visualizar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("decreto", "processo", "edit", array('id' => $processo['id_processo'])) . "'><img src='/core/imagem/editar.png' title='Editar Registro'></a>|";
            print "<a href='" . FuncaoBase::geraLink("decreto", "processo", "delete", array('id' => $processo['id_processo'])) . "' onclick=\"return confirm('Deseja Deletar esse Registro ?')\"><img src='/core/imagem/delete.png' title='Deletar Registro'></a>";

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
<?php print json_encode($dadosProcesso); ?>, // array com os dados
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
        $("#searchProcessoName").easyAutocomplete(itens);

    });
</script>
        