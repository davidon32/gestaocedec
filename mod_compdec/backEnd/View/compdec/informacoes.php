<?php include_once PATH . '/core/include.php'; ?>
<?php include_once 'core/Model/indexModel.php'; ?>
<?php include_once "mod_compdec/Model/Model.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<?php

    $id_municipio = isset($_GET['id']) ? $_GET['id'] : "";
    $dados_municipio = $id_municipio;
            


?>
<br>
<legend>Informações Gerais do Municipio</legend>
<table>
    <tr>
        <td></td>
    <tr>
</table>

<div class='col-md-12 text-center'>
    <a class="btn btn-success" href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=compdec&controller=compdec&action=index">Voltar</a><br> <br> 
</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>