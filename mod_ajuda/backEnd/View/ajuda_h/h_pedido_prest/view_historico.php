<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";
?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<?php

$dados_pedido = H_pedido_pedidajuda_hModel::buscaPedidoId($pedido_id) ;

?>

<legend>Prestação Contas Comentários</legend>

<div class="col-md-12 text-center print">
    <a class="btn btn-success print" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_index", "index", array('status'=> 6)) ?>">Voltar</a>
</div>
<form action="<?= FuncaoBase::geraLink("ajuda", "h_pedido_prest", "storeHistorico"); ?>" method="post" accept-charset="utf-8" name="frmH_pedido_prest_hist" id="frmH_pedido_prest_hist">


    <div class='row print'>
        <div class='col-md-2'>
            <label>Data Ocorrência :</label>
            <input type="hidden" name='pedido_id' id='pedido_id' value="<?= $pedido_id ?>" required>
            <input type="hidden" name='user_id' id='user_id' value="<?= $user_id ?>" required>
            <input type="datetime-local" class='form form-control' name='historico_data' id='historico_data' maxlength='' required>
        </div>
    </div>

    <div class='row print'>
        <br>
        <div class='col-md-12'>
            <label>Histórico :</label>
            <textarea class="form form-control" rows="5" name="historico" id="historico" maxlength="255" required></textarea>
            <span><span id="num_caracteres">0</span> de / 255 Caracteres</span>
        </div>
    </div>

    <div class="col-md-12 text-center print">
        <div class="row">
            <br>
            
            <input type="submit" class="btn btn-info print" name="btnGravar" id="btnGravar" value="Gravar">
        </div>
        <br>
        <br>
        <br>
    </div>
</form>

<p style='font-size:16pt;'>Pedido Nº : <?=$pedido_id?></p>
<p style='font-size:16pt;'>Município : <?=Municipio::PegaNomeMunicipio($dados_pedido[0]['id_municipio'])?></p>
<p style='font-size:16pt;'>Cobrade   : <?=Decreto::getNomeCobrade($dados_pedido[0]['id_cobrade'])?></p>
<br>
<table class="table table-condensed">

    <tr>
        <th>#</th>
        <th>Usuário</th>
        <th>Data</th>
        <th>Histórico</th>
    </tr>

    <?php

    foreach ($historicos as $key => $historico) {
        print "<tr>";
        print "<td>" . ($key + 1) . "</td>";
        print "<td>" . Usuario::getNomeId($historico['user_id']) . "</td>";
        print "<td>" . $historico['historico_data'] . "</td>";
        print "<td>" . $historico['historico'] . "</td>";
        print "</tr>";
    }
    ?>
</table>




<br>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>
    $(document).ready(function() {

        /* close focus pesquisa */

        $("#historico").keyup(function(){
            $('#num_caracteres').text(($(this).val().length));
        });

        $('#historico').val() = "" ;


        $("#frmH_pedido_prest").trigger("reset");







    });
</script>