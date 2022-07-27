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

<?php
$aju_tp_pedido = new PedidoConEstoqueModel();

if ($id_pedido) {
    ?>

    <legend>Cancelar Pedido</legend>


    <form action="<?= FuncaoBase::geraLink("ajuda", "pedido", "gravaCancelaPedido"); ?>" method="post" accept-charset="utf-8" name="frmGravarCancela" id="frmGravarCancela">

        <div class='col-md-3'>
            <label>Nº Pedido</label>
            <input type="text" class='form form-control' name='id_pedido' id='id_pedido' value='<?= $id_pedido; ?>' readonly=readonly >
        </div>
        <div class='col-md-12'>
            <label>Observação</label>
            <textarea type="text" class='form form-control' name='justificativa' id='justificativa' maxlength='254' required rows="6"></textarea>
        </div>

        <div class="col-md-12 text-center">
            <br>
            <a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "pedido", "index") ?>">Voltar</a>
            <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Atualizar">
        </div>
    </form>

    <?php
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

//        var form_data = new FormData();
//        form_data.append("id_pedido", $("#id_pedido").val());
//        form_data.append("justificativa", $("#justificativa").val());
//
//        $.ajax({
//            type: 'POST',
//            url: '<?= FuncaoBase::geraLink('ajuda', 'pedido', 'gravaCancelaPedido') ?>',
//            cache: false,
//            contentType: false,
//            processData: false,
//            data: form_data,
//            success: function (response) {
//                var resposta = response;
//                if (resposta.trim() === 'sucesso') {
//
//                    console.log(resposta);
//                    //alert("Cadastro realizado com Sucesso !");
//                    //location.reload();
//                }
//
//            },
//            error: function (e) {
//                console.log(JSON.stringify(form_data));
//                console.log(JSON.stringify(response));
//                alert("Ocorreu um Erro !");
//            }
//
//        });


    });




</script>
