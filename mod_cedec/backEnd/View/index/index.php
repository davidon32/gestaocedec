<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cedec/Model/Model.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<div class='row'>
    <div class="col-md-4 text-center">
    <?php
    
        $permissao = Usuario::getPermissao('cedec_permissao', 'cad_prefeitura');
            if ($permissao == "1") {
    ?>
        <p><a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=cedec&controller=municipio&action=index" title="Informações dos Município"><img width="80" src='/core/imagem/prefeitura.png' /></a></p>
        <p><label>Cadastro Prefeitura</label></p>
    <?php
        } else {
            print "<img class=\"imgCinza\" src=\"core/imagem/prefeitura.png\" width=\"80px\" title=\"Usuario sem Acesso !\">";
            print " <br>Cadastro Prefeitura";
        }
    ?>
    </div>
    <div class="col-md-4 text-center">
    <?php
        $permissao = Usuario::getPermissao('cedec_permissao', 'ger_demanda');
            if ($permissao == "1") {
    ?>    
    <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=cedec&controller=municipio&action=demanda" class="btn btn-primary" title="Dados Gerais do Município">Gerenciar Demanda</a>
    <?php
        } else {
            print "<img class=\"imgCinza\" src=\"core/imagem/sem_imagem.png\" width=\"80px\" title=\"Usuario sem Acesso !\">";
            print " <br>Gerenciador de Demanda";
        }
    ?>
    </div>
    <div class="col-md-4 text-center">
    <?php
        $permissao = Usuario::getPermissao('cedec_permissao', 'agua_doce');
            if ($permissao == "1") {
    ?>    

    <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=cedec&controller=aguadoce&action=index" class="btn btn-primary" title="Manutenção Agua Doce Agora">Água Doce Agora</a>
    <br><br>
    <?php
        } else {
            print "<img class=\"imgCinza\" src=\"core/imagem/sem_imagem\" width=\"80px\" title=\"Usuario sem Acesso !\">";
            print " <br>Água Doce Agora";
        }
    ?>
    </div>
</div>
<div class='row'>
    <br><br>
    <div class="col-md-4 text-center">
    <?php
        $permissao = Usuario::getPermissao('cedec_permissao', 'defesa_agora');
            if ($permissao == "1") {
    ?>    
        <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=cedec&controller=agora&action=index" title="Manutenção Defesa Civil Agora"><img width="80" src='/core/imagem/defesa_civil_agora.png' /></a>
            <p><label>Defesa Civil Agora</label></p>
        <br><br>
    <?php
        } else {
            print "<img class=\"imgCinza\" src=\"core/imagem/defesa_civil_agora.png\" width=\"80px\" title=\"Usuario sem Acesso !\">";
            print " <br>Defesa Civil Agora";
        }
    ?>
    </div>
</div>

<div class="col-md-12 text-center">
    <br>
    <br><br>
    <a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=index&controller=index&action=menu">Voltar</a>
  
</div>



<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>