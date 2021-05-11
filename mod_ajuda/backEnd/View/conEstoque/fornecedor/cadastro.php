

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

<?php
?>

<legend>Cadastro de Fornecedor</legend>
<form action="<?= FuncaoBase::geraLink("ajuda", "fornecedor", "gravar"); ?>" method="post" accept-charset="utf-8" name="frmFornecedor" id="frmFornecedor">

    <div class='col-md-6'>
        <label>Razao social</label>
        <input type="text" class='form form-control' name='nome' id='nome' maxlength='69' required >
    </div>
    <div class='col-md-6'>
        <label>Cnpj</label>
        <input type="text" class='form form-control' name='cpfcnpj' id='cpfcnpj' maxlength='19' required >
    </div>
    <div class='col-md-6'>
        <label>Endereço</label>
        <input type="text" class='form form-control' name='endereco' id='endereco' maxlength='169' >
    </div>
    <div class='col-md-6'>
        <label>Municipio</label>
        <input type="text" class='form form-control' name='municipio' id='municipio' maxlength='44'  >
    </div>
    <div class='col-md-6'>
        <label>Estado</label>
        <input type="text" class='form form-control' name='estado' id='estado' maxlength='2' >
        <?php ?>
    </div>
    <div class='col-md-6'>
        <label>Cep</label>
        <input type="text" class='form form-control' name='cep' id='cep' maxlength='10' >
    </div>
    <div class='col-md-6'>
        <label>Telefone</label>
        <input type="text" class='form form-control' name='tel' id='tel' maxlength='19' >
    </div>
    <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Gravar">
    
</form>
<div class="col-md-12 text-center">
        <br>
        <input type="button" class="btn btn-info" name="btnGravarFornecedor" id="btnGravarFornecedor" value="Gravar">
        <a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "fornecedor", "index") ?>">Voltar</a>
        
    </div>




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
    $("#frmFornecedor").trigger("reset");
    $("#cpfcnpj").mask('99.999.999/9999-99');
            $("#btnGravar").hide();
    $("#btnGravarFornecedor").click(function (e) {
        if ($("#tel").val() === "") {
            Swal.fire({
                title: 'O campos Telefone está em branco, deseja salvar o registro mesmo assim ?',
                showCancelButton: true,
                confirmButtonText: `Save`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#tel").val("-")
                    $("#btnGravar").trigger("click");
                }else {
                    result1 = false;
                }
            });

        }else {
            $("#btnGravar").trigger("click");
            event.preventDefault();
        }
        
    });

});
</script>
