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
<?php 
    $id_viatura = isset($_GET['id']) ? $_GET['id'] : "";
    
    
    
    if(is_numeric($id_viatura)) {
        $dados = RegDspViatura::searchId($id_viatura);
?>
<style>
    p {text-align: center};

</style>
<div class='row'>
    <form method="POST" action="<?= FuncaoBase::geraLink("equipe", "viatura", "gravar")?>" name="frmCadViatura" >
    <div class="col-md-12">
        <table class="table table-bordered table-striped">
            <legend>Editar Cadastro Viatura</legend>
            </tr>

            <tr>
                <td>PLACA</td>
                <td><input class="form form-control" type="text" name="pl_placa" id="pl_placa" maxlength="10" required value="<?=$dados['placa']?>"/>
                <input type="hidden" name="id_viatura" id="id_viatura" value="<?=$dados['id_viatura']?>"/></td>
            </tr>
            <tr>
                <td>PLACA SEGURANCA</td>
                <td><input class="form form-control" type="text" name="pl_placaSeg" id="pl_placaSeg" maxlength="10" required value="<?=$dados['placa_seguranca']?>"/></td>
            </tr>
            <tr>
                <td>MODELO</td>
                <td><input class="form form-control" type="text" name="txtModelo" id="txtModelo" maxlength="45" required value="<?=$dados['modelo']?>"/></td>
            </tr>
            <tr>
                <td>MARCA</td>
                <td><input class="form form-control" type="text" name="txtMarca" id="txtMarca" maxlength="45" required value="<?=$dados['marca']?>"/></td>
            </tr>
            <tr>
                <td>ANO</td>
                <td><input class="form form-control" type="text" name="txtAno" id="txtAno" maxlength="4" required value="<?=$dados['ano']?>"/></td>
            </tr>
            <tr>
                <td>NOME</td>
                <td><input class="form form-control" type="text" name="txtNome" id="txtNome" maxlength="45" required value="<?=$dados['nome']?>"/></td>
            </tr>
            <tr>
                <td>OBS</td>
                <td><textarea class="form form-control" name="txtObs" id="txtObs" maxlength="255"><?=$dados['obs']?></textarea></td>
            </tr>

        </table>

        <input class='btn btn-primary' type="submit" name="btnGravar" id="btnGravar" value="Gravar">
    </div>
</form>
        <p><button class='btn btn-success' type="button" onclick="window.location.href= '<?= FuncaoBase::geraLink("equipe", "viatura", "index")?>';" >Voltar</button>
</div>
<?php

    }
    
    ?>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>    