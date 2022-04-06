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
    <div class="col-md-12">


        <table class="table table-bordered table-striped">
            <legend>Cadastro Viatura</legend>
            </tr>

            <tr>
                <td>PLACA</td><td></td>
            </tr>
            <tr>
                <td>PLACA SEGURANCA</td><td></td>
            </tr>
            <tr>
                <td>MODELO</td><td></td>
            </tr>
            <tr>
                <td>MARCA</td><td></td>
            </tr>
            <tr>
                <td>ANO</td><td></td>
            </tr>
            <tr>
                <td>NOME</td><td></td>
            </tr>
            <tr>
                <td>OBS</td><td></td>
            </tr>

        </table>

        <p><button class='btn btn-success' type="button" onclick="history.back();" >Voltar</button>
    </div>
</div>