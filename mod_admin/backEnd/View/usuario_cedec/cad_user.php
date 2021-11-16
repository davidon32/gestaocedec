<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_admin/Model/admModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<?php

    $id_usuario = isset($_GET['id']) ? $_GET['id'] : null;
    
    # pega dos dados do usuario "cedec_usuario"
    $usuario = Usuario::getDadoUsuario($id_usuario);

    # pega permissao dos modulos 
    $permissaoModulo = Usuario::getPermissaoModulo($_COOKIE['seguranca']['login']);
    
    # pega permissa ajuda humanitaria
    $permissaoAjudaH = Usuario::getPermissaoAjudaH($_COOKIE['seguranca']['login']);
    
?>

<div class="col-md-6">
<legend>Dados do Usuario</legend>
    <form action="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=&modulo=admin&controller=adm&action=cad_user_valida" method="POST" name="frmCadUserRapido" id="frmCadUserRapido">
        <label>Numero Policia</label>
        <input class="form-control" type="text" name="txtNumPol" value="<?=!empty($usuario) ? $usuario['num_masp'] : "" ;?>" id="txtNumPol" maxlenght="9" data-mask='9999999-9' >

        <label>Nome Completo</label>
            <input class="form-control" type="text" name="txtNome" value="<?=!empty($usuario) ? $usuario['nome'] : "" ;?>" id="txtNome" maxlength="39" >
        <label>Usuario (alternativo S999999)</label>
            <input class="form-control" type="text" name="txtUsuario" value="<?=!empty($usuario) ? $usuario['login'] : "" ;?>" id="txtUsuario" maxlength="9" >
        
        <label>Lotado</label>
        <select class="form-control" name="selSetor" value="" id="selSetor">
            <option>CEDEC</option>
            <option>GMG</option>
        </select>
        <br>
        <label style='color: red'>Email Recuperação Senha</label>
        <input class="form-control" type="email" name="txtEmail" value="<?=!empty($usuario) ? $usuario['email_rec'] : "" ;?>" id="txtEmail">
        <br>
        <label>Email Informações 1</label>
        <input class="form-control" type="email" name="txtEmailInfo1" value="<?=!empty($usuario) ? $usuario['email_info1'] : "" ;?>" id="txtEmailInfo1">
        <br>
        <label>Email Informações 2</label>
        <input class="form-control" type="email" name="txtEmailInfo2" value="<?=!empty($usuario) ? $usuario['email_info2'] : "" ;?>" id="txtEmailInfo2">
        <br>
        
        <input type="hidden" name="opcao" value="<?=!empty($usuario) ? "atualiza" : "caduser" ;?>" >
        <input type="hidden" name="id_usuario" value="<?=!empty($usuario) ?$usuario['id_usuario'] : "" ;?>" >
        <input type="hidden" name="selSituacao" value="1" >
        <br>
        

        <input class="btn btn-info" type="submit" name="btnEnviar" id="btnEnviar" value="Gravar">
        
    </form>
</div>

<br>
<div class="col-md-12 text-center">
    <br>
    <a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=&modulo=admin&controller=adm&action=usuario">Voltar</a>
</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
