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

<?php

//Login::logado();

$usuario = new Usuario();

$dados =$usuario->getDadoUsuario($pageSession['session']['seguranca']['idUser']);
?>

<table class="table table-bordered table-hover">
    <tr>
        <td><b>Código</b></td>
        <td><?=$dados['id_usuario'];?></td>
    </tr>
    <tr>
        <td><b>Login</b></td>
        <td><?=$dados['login'];?></td>
    </tr>
    
    <tr>
        <td><b>Nome</b></td>
        <td><?=$dados['nome'];?></td>
    </tr>
    <tr>
        <td style='color:red'>Email recuperação de Senha</td>
        <td><?=$dados['email_rec'];?></td>
    </tr>
    <tr>
        <td><b>Email Informação 1</b></td>
        <td><?=$dados['email_info1'];?></td>
    </tr>
    <tr>
        <td><b>Email Informação 2</b></td>
        <td><?=$dados['email_info2'];?></td>
    </tr>
</table>

<div class="col-md-6 p-sm-3">
    <br>
<a class="btn btn-primary" href="<?=FuncaoBase::geraLink("admin", "adm", "editar", array("id"=>$dados['id_usuario']))?>">Editar</a>
<?php
   print "<a class=\"btn btn-success\" href=\"".FuncaoBase::geraLink('index', 'index', 'index1', array('id'=>$dados['id_usuario']))."\">Voltar</a>";
?>
</div>


      
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>