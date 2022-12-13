
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

<legend>Aprovação Prestação de Contas</legend>

<form action="<?= FuncaoBase::geraLink("ajuda", "h_pedido_prest", "homologa") ?>" method="POST" name="frmHomologar" id="frmHomologar">
    
    <input type='hidden' name='id_pedido' id='id_pedido' value='<?=$_GET['id']?>'>   
    <input type='hidden' name='txtUsuario' id='txtUsuario' value='<?=$_COOKIE['seguranca']['idUser']?>'>
    <label>Aprovar</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="rbParecer" id="rbAprovar" value='Aprovado'><br>
    <label>Recusar</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="rbParecer" id="rbRecusar" value='Recusado'><br>
    <label>Em aberto</label>&nbsp; <input type="checkbox" name="rbParecer" id="rbAberto" value='EmAberto'>
    <br>
    <br>
    <label>Parecer / Justificativa:</label>
    
    
    <textarea class="form form-control" rows='10' name='txtParecer' id='txtParecer' maxlength='255'></textarea>
    <br>
    <input class='btn btn-primary' type="submit" value="Gravar">
    
</form>

<br>
<a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_prest", "index") ?>">Voltar</a>
<br>
<br>

<br>
<?php

    var_dump($_POST);

?>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

    $(document).ready(function () {
        
        $('input[type="checkbox"]').on('change', function() {
            $(this).siblings('input[type="checkbox"]').prop('checked', false);
        });

    });
</script>
