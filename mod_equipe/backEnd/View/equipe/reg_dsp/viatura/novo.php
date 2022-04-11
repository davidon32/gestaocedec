<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_admin/Model/admModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<style>
    p {text-align: center};

</style>
<div class='row'>
    <form method="POST" action="<?= FuncaoBase::geraLink("equipe", "viatura", "gravar")?>" name="frmCadViatura" >
    <div class="col-md-12">
        <table class="table table-bordered table-striped">
            <legend>Cadastro Viatura</legend>
            </tr>

            <tr>
                <td>PLACA</td>
                <td><input class="form form-control" type="text" name="txtPlaca" id="txtPlaca" maxlength="6" required/> </td>
            </tr>
            <tr>
                <td>PLACA SEGURANCA</td>
                <td><input class="form form-control" type="text" name="txtPlacaSeg" id="txtPlacaSeg" maxlength="6" required/></td>
            </tr>
            <tr>
                <td>MODELO</td>
                <td><input class="form form-control" type="text" name="txtModelo" id="txtModelo" maxlength="45" required/></td>
            </tr>
            <tr>
                <td>MARCA</td>
                <td><input class="form form-control" type="text" name="txtMarca" id="txtMarca" maxlength="45" required/></td>
            </tr>
            <tr>
                <td>ANO</td>
                <td><input class="form form-control" type="text" name="txtAno" id="txtAno" maxlength="4" required/></td>
            </tr>
            <tr>
                <td>NOME</td>
                <td><input class="form form-control" type="text" name="txtNome" id="txtNome" maxlength="45" required/></td>
            </tr>
            <tr>
                <td>OBS</td>
                <td><input class="form form-control" type="text" name="txtObs" id="txtObs" maxlength="255"/></td>
            </tr>

        </table>

        <input class='btn btn-primary' type="submit" name="btnGravar" id="btnGravar" value="Salvar">
    </div>
</form>
        <p><button class='btn btn-success' type="button" onclick="window.location.href= '<?= FuncaoBase::geraLink("equipe", "viatura", "index")?>';" >Voltar</button>
</div>