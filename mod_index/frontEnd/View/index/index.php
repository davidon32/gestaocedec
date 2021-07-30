<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_index/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<!-- painel inicial sitema notificacoes -->
            <div class="col-md-4 text-left"> 
              <a class="btn btn-success" href='index.php?token=<?=hash('sha256', md5(VERSAO)."-".time())?>&ac=etn&modulo=index&controller=index&action=menue'>Acessar Módulos</a>  
               
                <?php 
  
                ?>
            </div> 
            <div class="col-md-4 text-center"> 
            <legend>Notificações</legend>
              <?php
                //$login = new Login();
                //$login->acessoLembrete($_COOKIE['seguranca']['login'], $_COOKIE['seguranca']['id_deposito']);
                //$login->acessoLembreteTransito($_COOKIE['seguranca']['login'], $_COOKIE['seguranca']['id_deposito'])
                
              ?>
            </div> 
            <div class="col-md-4 text-center" style='color:red'> 
            <legend>AVISOS / MENSAGENS</legend>
          
            <?php
                MensagemSistema::mostraMensagem();

            ?>


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
        text: 'Favor atualiar seu email para um email institucional',
        footer: '<a href=\'<?=FuncaoBase::geraLink('compdec', 'compdec', 'index')?>\'>Clique aqui acessar os dados cadatrais</a>'
      });
    }
 

  });
  </script>