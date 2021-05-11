<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_index/Model/indexModel.php";?>  
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<div class="col-md-12">

<!-- painel inicial sitema notificacoes -->
  <div class="col-md-12 text-center">

    <legend>Tela Inicial do Sistema</legend>
  </div>
              <div class="col-md-6 text-center"> 
            <legend>Notificações do Sistema</legend>
              <?php
                $login = new Login();
                $login->acessoLembrete($_COOKIE['seguranca']['login'], $_COOKIE['seguranca']['id_deposito']);
                $login->acessoLembreteTransito($_COOKIE['seguranca']['login'], $_COOKIE['seguranca']['id_deposito'])
                
              ?>
            </div> 
            <div class="col-md-6" style='color:red;'> 
            <legend>Aviso / Mensagem</legend>
              <p>Troque sua senha regularmente !</p></br>
              <p>Nunca salve sua senha no navegador !</p></br>
              
            </div> 
    <div class="col-md-12 text-center">
        <br><br><br>
        <div class="col-md-3"></div>
        <div class="col-md-6">
        <a class="btn btn-block btn-success" href='index.php?token=<?=hash('sha256', md5(VERSAO)."-".time())?>&modulo=index&controller=index&action=menu'> Clique aqui !<br> e Acesse os <br>Módulos do Sistema</a>  
        </div>
        <div class="col-md-3"></div>
    </div> 
</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
<script>

  $(document).ready(function(){
    var email = '<?=$_COOKIE['seguranca']['email_rec']?>';
    if((email.length > 0) && (email.match(/.com/))){
      Swal.fire({
        icon: 'error',
        title: 'Atualização de Email necessária...',
        width: 500,
        height: 400,
        text: 'Favor atualiar seu email para um email institucional',
        footer: '<a href=\'<?=FuncaoBase::geraLink("admin", "adm", "caduser", array("id"=>$_COOKIE['seguranca']['idUser']))?>\'>Clique aqui acessar os dados cadatrais</a>'
      });
    }
 

  });

</script>