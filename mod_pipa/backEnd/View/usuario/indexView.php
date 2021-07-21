<?php include_once "core/Model/indexModel.php"?>
<?php include_once "mod_pipa/Model/IndexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<br>
<div class="col-md-12 text-right">
    <?php 
        if(isset($_GET['volta']) == 'compdec'){
            print "<a class=\"btn btn-success\" href=\"".FuncaoBase::geraLink("compdec", "compdec", "index")."\">Voltar</a></div>";
        }else {
            print "<a class=\"btn btn-success\" href=\"".FuncaoBase::geraLink("pipa", "pipa", "index")."\">Voltar</a></div>";      
        }
        ?>

<div class="col-md-12">
  <br><br>
	<a class='btn btn-primary btn-lg' href='?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=pipa&controller=pipa&action=caduser' title='Cadastro de Usuários COMPDEC'>Cadastro de Usuários (COMPDEC)</a><br>	<br>					
        <a class='btn btn-primary' href='<?= FuncaoBase::geraLink("pipa", "pipa", "pesquisaUsuario", array('volta'=>'compdec'))?>' title='Alterar dados do Usuário COMPDEC'>Alteração de Usuários (COMPDEC)</a>						     
        <a class='btn btn-primary' href='<?= FuncaoBase::geraLink("pipa", "pipa", "pesquisaUsuario", array('volta'=>'compdec'))?>' title='Alterar dados do Usuário COMPDEC'>Alteração de Usuários (COMPDEC)</a>						     
      
</div> 
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>