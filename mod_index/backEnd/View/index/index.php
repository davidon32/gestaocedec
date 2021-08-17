<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_index/Model/indexModel.php"; ?>  
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<div class="col-md-12">
    <a class="btn btn-success btn-lg" href='index.php?token=<?= hash('sha256', md5(VERSAO) . "-" . time()) ?>&modulo=index&controller=index&action=menu'> Continuar a usar o Sistema !</a>  
</div> 
<div class="col-md-12">
    <br>
    <p class="text-center"><legend>Notificações do Sistema</legend></p>
    <div class="col-md-6 text-center"> 
        <?php
        $login = new Login();
        $login->acessoLembrete($_COOKIE['seguranca']['login'], $_COOKIE['seguranca']['id_deposito']);
        $login->acessoLembreteTransito($_COOKIE['seguranca']['login'], $_COOKIE['seguranca']['id_deposito'])
        ?>
    </div>
    <div class="col-md-6 text-center"> 
    <?php
            var_dump($dash = dashboardModel::CompdecAtualizados());
    ?>        
    </div>
    
</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

    $(document).ready(function () {
        var email = '<?= $_COOKIE['seguranca']['email_rec'] ?>';
        if ((email.length > 0) && (email.match(/.com/))) {
            Swal.fire({
                icon: 'error',
                title: 'Atualização de Email necessária...',
                width: 500,
                height: 400,
                text: 'Favor atualiar seu email para um email institucional',
                footer: '<a href=\'<?= FuncaoBase::geraLink("admin", "adm", "caduser", array("id" => $_COOKIE['seguranca']['idUser'])) ?>\'>Clique aqui acessar os dados cadatrais</a>'
            });
        }
    });





</script>