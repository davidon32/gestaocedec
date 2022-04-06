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
        <div class="col-md-6 text-center">
            <a href='<?= FuncaoBase::geraLink("equipe", "equipe", "reg_dsp") ?>' class='btn btn-primary' title='Novo Cadastro e Registro de DSP'>Registro DSP</a>
        </div>
        <div class="col-md-6 text-center">
            <a href='<?= FuncaoBase::geraLink("equipe", "equipe", "reg_dsp_viatura") ?>' class='btn btn-primary' title='Novo Cadastro e Registro de DSP'>Cadastro Veículo/Viatura</a>
        </div>
    </div>
</div>
<p>
    <div class='row'>
        <div class="col-md-12">

        <table class="table table-bordered table-striped">
            <tr>
                <th colspan="3">Resuno DSP's</th>
            </tr>
            <tr>
                <td>Resuno DSP's</td>
            </tr>

        </table>

        <p><button class='btn btn-success' type="button" onclick="history.back();" >Voltar</button>
    </div>
</div>