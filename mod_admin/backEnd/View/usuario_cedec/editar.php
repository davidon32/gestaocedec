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
            <input type="hidden" name="login" id="login" value="<?= $dados['login']; ?>"></td>
            <input type="hidden" name="situacao" id="situacao" value="<?= $dados['situacao']; ?>"></td>
    </tr>
    <tr>
        <td>Mudar Senha</td>
        <td><input type="checkbox" id="ck_tr_senha" name="ck_tr_senha"></td>
    </tr>

    
        <tr>
            <td>Senha:</td>
            <td><input type="password" name="senha1" class="form-control" id="txtSenha1" style="wi50px" value="">
        </tr>
        <tr>
            <td>Repetir a Senha:</td>
            <td><input type="password" name="senha" class="form-control" id="txtSenha" style="wi50px" value="">
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

    <tr>
        <td>CPF:</td>
        <td><input type="text" name="txtCpf" id="txtCpf" class="form-control" size="40" value="<?php print $dados['cpf']; ?>"></td>
    </tr>
    <tr>
        <td>Posto:</td>
        <td>
        <select name="sel_posto" id="sel_posto" class="form form-control">
            <option><?=$dados['posto']?></option>
            <option>Escolha uma Opção</option>
            <option>GOVERNADOR</option>
            <option>SECRET.GOV</option>
            <option>CEL PM</option>
            <option>CEP BM</option>
            <option>TEN CEL PM</option>
            <option>TEN CEM BM</option>
            <option>MAJ PM</option>
            <option>MAJ BM</option>
            <option>CAP PM</option>
            <option>CAP BM</option>
            <option>TEN BM</option>
            <option>TEN PM</option>
            <option>SUB TEN PM</option>
            <option>SUB TEN BM</option>
            <option>1º SGT PM</option>
            <option>1º SGT BM</option>
            <option>2º SGT PM</option>
            <option>2º SGT BM</option>
            <option>3º SGT PM</option>
            <option>2º SGT BM</option>
            <option>SD PM</option>
            <option>SD BM</option>
            <option>CB PM</option>
            <option>CB BM</option>
            <option>SC</option>
            <option>FC</option>
        </select>
        </td>
    </tr>
    <tr>
    <td>Função</td>
    <td>
        <select name="sel_funcao" id="sel_funcao" class="form form-control">
            <option><?=$dados['funcao']?></option>
            <option>Escolha uma Opção</option>
            <option>GOVERNADOR</option>
            <option>VICE GOVERNADOR</option>
            <option>SECRETARIO</option>
            <option>SUPERINTENDÊNCIA</option>
            <option>CHEFIA</option>
            <option>DIRETORIA</option>
            <option>DIRETOR</option>
            <option>ASSESSORIA</option>
            <option>REDEC</option>
            <option>AUXILIAR I</option>
            <option>AUXILIAR II</option>
            <option>MOTORISTA</option>
        </select>
    </td>
    </tr>
    <tr>
        <td>Seção: </td>
        <td>
        <select name="sel_secao" id="sel_secao" class="form form-control">
            <option><?=$dados['secao']?></option>
            <option>Escolha uma Opção</option>
            <option>CHEFIA</option>
            <option>SGRD</option>
            <option>DRD</option>
            <option>SGRRD</option>
            <option>DRRD</option>
            <option>SADM</option>
            <option>STO</option>
            <option>DEPOS</option>
            <option>DADM</option>
            <option>DEDC</option>
            <option>CCE</option>
            <option>DTEC</option>
<!--            <option>DAR - Inativo</option>-->
            <option>SECRETARIA</option>
            <option>DPLAN</option>
            <option>DLOG</option>
            <option>DLS</option>
            <option>REDEC</option>
            <option>NCO</option>
            <option>GMG</option>
            <option>ADS</option>
            <option>GOV</option>
            <option>CEDEC</option>
            <option>DSB</option>
        </select>
        </td>
    </tr>
    <tr>
        <td>Telefone:</td>
        <td><input type="text" name="txtTelefone" id="txtTelefone" class="form-control"  value="<?php print $dados['telefone']; ?>"></td>
    </tr>
    <tr>
        <td>Whatsapp:</td>
        <td><input type="text" name="txtZap" id="txtZap" class="form-control"  value="<?php print $dados['celular']; ?>"></td>
    </tr>
</table> 
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
        
        $("#dv_senha").hide();
        $("#txtCpf").mask("999.999.999-99");
        
        /* */
        $("#ck_tr_senha").click(function(){
            if($("#ck_tr_senha").is(":checked")){
                $("#dv_senha").show();
                $("#txtSenha1").attr("required", "true");
                $("#txtSenha").attr("required", "true");
            }else{
                $("#dv_senha").hide();
                $("#txtSenha1").removeAttr('required');
                $("#txtSenha").removeAttr('required');
                $("#txtSenha").val("");
                $("#txtSenha1").val("");
            }
            
        });

        $('#enviar').hover(function () {
            if ( $("#txtSenha").val() != $("#txtSenha1").val() && $("#ck_tr_senha").is(":checked") == true ) {
                alert('as Senhas não conferem !');
                $("#enviar").prop('disable', true);
            }
        });


    });
</script>
