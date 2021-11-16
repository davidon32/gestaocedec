<?php include_once PATH . '/core/include.php'; ?>
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
<?php
$_login = new Login();

$id_usuario = isset($_GET['id']) ? $_GET['id'] : 0;

$usuario = new Usuario();
$dados = $usuario->getDadoUsuario($id_usuario);
?>

<form action="<?= FuncaoBase::geraLink("admin", "adm", "salvar") ?>" method="post" name="" id="">

    <p style="text-algn:center"><h4>Alteração de Cadastro Usuário</h4></p><br>
<table class="table" align="center">

    <tr>
        <td>Nome:</td>
        <td><input type="text" name="nome" class="form-control" size="40" value="<?php print $dados['nome'] ?>">
            <input type="hidden" name="id_usuario" id="id_usuario" value="<?= $dados['id_usuario']; ?>"></td>
    </tr>
    <tr>
        <td>Senha:</td>
        <td><input type="password" name="senha1" class="form-control" id="txtSenha1" style="wi50px" value="<?php print $dados['senha'] ?>">
    </tr>
    <tr>
        <td>Repetir a Senha:</td>
        <td><input type="password" name="senha" class="form-control" id="txtSenha" style="wi50px" value="<?php print $dados['senha'] ?>">
    </tr>
    <tr>
        <td style="color:red">Email Recuperação Senha:</td>
        <td><input type="email" name="email_rec" class="form-control" size="40" value="<?php print $dados['email_rec']; ?>"></td>
    </tr>
    <tr>
        <td>Email Informações 1:</td>
        <td><input type="email" name="txtEmailInfo1" class="form-control" size="40" value="<?php print $dados['email_info1']; ?>"></td>
    </tr>
    <tr>
        <td>Email Informações 2:</td>
        <td><input type="email" name="txtEmailInfo2" class="form-control" size="40" value="<?php print $dados['email_info2']; ?>"></td>
    </tr>
    
    <?php
    if(false){

    /*print "<tr>
        <td>Depósito:</td>
        //<td> print Deposito::pegaDepositoSelected($dados['id_deposito']);  </td>
    </tr>";*/
    print "<tr>
        <td>Nível:</td>
        <td><select name='nivel' class='form-control'>
                <option value='1'>Usuário</option>
                <option value='3'>Administrador</option>
                <option value='2'>Gerente</option>
                <option value='1'>Usuário</option>
                <option value='0'>Dep.Avançado</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Situação:</td>
        <td><select name='situacao' class='form-control'>
                <option value='1'>Ativo</option>
                <option value='1'>Ativo</option>
                <option value='0'>Inativo</option>
            </select></td>
    </tr>";
    

/*</table>
<br />
<fieldset>
    <legend>Módulos</legend>
    <table align="center" border="0">
        <tr>
            <td align="left">Ajuda Humanitária</td>
            <td><input type="checkbox" name="ajuda" id="ajuda" value="1" {$dados['it_m_deposito'] == 1) ? "checked" : ""}; ></td>
            <td align="left">Pipa</td>
            <td><input type="checkbox" name="pipa" id="pipa" value="1" <?= ($dados['it_m_pipa'] == 1) ? "checked" : ""; ?>></td>
        </tr>
        <tr>
            <td>Decretos</td>
            <td><input type="checkbox" name="decretacao" id="decretacao" value="1" <?= ($dados['it_m_decretacao'] == 1) ? "checked" : ""; ?>></td>
            <td>Poço Artesiano</td>
            <td><input type="checkbox" name="poco" id="poco" value="1" <?= ($dados['it_m_poco'] == 1) ? "checked" : ""; ?>></td>
        </tr>
        <tr>
            <td>Equipe de Apoio</td>
            <td><input type="checkbox" name="apoio" id="apoio" value="1" <?= ($dados['it_m_apoio'] == 1) ? "checked" : ""; ?>></td>
            <td>Escola de Defesa Civil</td>
            <td><input type="checkbox" name="escola" id="escola" value="1" <?= ($dados['it_m_escola'] == 1) ? "checked" : ""; ?>></td>
        </tr>
        <tr>
            <td>Compdec</td>
            <td><input type="checkbox" name="comdec" id="comdec" value="1" <?= ($dados['it_m_comdec'] == 1) ? "checked" : ""; ?>></td>
            <td>CCE</td>
            <td><input type="checkbox" name="cce" id="cce" value="1" <?= ($dados['it_m_cce'] == 1) ? "checked" : ""; ?>></td>
        </tr>

    </table>*/

}
?>

</fieldset>
<br />
<div class="center">
    <input class="btn btn-primary" type="submit" name="enviar" id="enviar" value="Salvar"/>
    <a class="btn btn-primary" href="<?= FuncaoBase::geraLink("admin", "adm", "perfil", array('id'=>$_GET['id']))?>">Voltar</a>
    <!--?modulo=admin&controller=adm&action=perfil-->
</div>



</form>


<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>
    $(document).ready(function () {

        $('#enviar').hover(function () {
            if ( $("#txtSenha").val() != $("#txtSenha1").val() ) {
                alert('as Senhas não conferem !');
                $("#enviar").prop('disable', true);
            }
        });


    });
</script>
