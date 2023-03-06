<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_admin/Model/admModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<?php
$id_usuario = isset($_GET['id']) ? $_GET['id'] : null;
$edit = isset($_GET['edit']) ? $_GET['edit'] : null;

# pega dos dados do usuario "cedec_usuario"
$usuario = Usuario::getDadoUsuario($id_usuario);

$readonly = '';
$formaction = "action='#'";
$button = '';
$title = 'Visualizar Dados do Usuario';


if (empty($id_usuario)) {
    print "<script>";
    //print "window.location.href = '".FuncaoBase::geraLink('admin', "adm", "caduser")."';";
    print "</script>";
    $title = 'Novo Usuario';
    $button = "<input class='btn btn-info' type='submit' name='btnEnviar' id='btnEnviar' value='Gravar'>";
    $formaction = "action=\"?token=" . hash('sha256', md5(VERSAO) . date('dmY')) . "&ac=&modulo=admin&controller=adm&action=cad_user_valida\"";

    # editar
} else if (!empty($edit)) {
    $formaction = "action=\"?token=" . hash('sha256', md5(VERSAO) . date('dmY')) . "&ac=&modulo=admin&controller=adm&action=cad_user_valida\"";
    $title = "Editar Dados";
} else {
    $readonly = "readonly='readonly'";
}

# pega permissao dos modulos 
$permissaoModulo = Usuario::getPermissaoModulo($_COOKIE['seguranca']['login']);

# pega permissa ajuda humanitaria
$permissaoAjudaH = Usuario::getPermissaoAjudaH($_COOKIE['seguranca']['login']);
?>

<div class="col-md-6">
    <legend><?= $title; ?></legend>
    <form <?= $formaction; ?> method="POST" name="frmCadUserRapido" id="frmCadUserRapido">
        <label>Numero Policia</label>
        <input class="form-control" type="text" name="txtNumPol" value="<?= !empty($usuario) ? $usuario['num_masp'] : ""; ?>" id="txtNumPol" maxlenght="9" data-mask='9999999-9' <?= $readonly; ?>

               <label>Nome Completo</label>
        <input class="form-control" type="text" name="txtNome" value="<?= !empty($usuario) ? $usuario['nome'] : ""; ?>" id="txtNome" maxlength="39" <?= $readonly; ?> />
        <label>Usuario (alternativo S999999)</label>
        <input class="form-control" type="text" name="txtUsuario" value="<?= !empty($usuario) ? $usuario['login'] : ""; ?>" id="txtUsuario" maxlength="9" <?= $readonly; ?> >

        <label>POSTO</label>
        <select name="sel_posto" id="sel_posto" class="form form-control">
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

        <label>RPM</label>
        <select name="sel_rpm" id="sel_rpm" class="form form-control">
            <option>Escolha uma Opção</option>
            <option value="1">1 RPM</option>
            <option value="2">2 RPM</option>
            <option value="3">3 RPM</option>
            <option value="4">4 RPM</option>
            <option value="5">5 RPM</option>
            <option value="6">6 RPM</option>
            <option value="7">7 RPM</option>
            <option value="8">8 RPM</option>
            <option value="9">9 RPM</option>
            <option value="10">10 RPM</option>
            <option value="11">11 RPM</option>
            <option value="12">12 RPM</option>
            <option value="13">13 RPM</option>
            <option value="14">14 RPM</option>
            <option value="15">15 RPM</option>
            <option value="16">16 RPM</option>
            <option value="17">17 RPM</option>
            <option value="18">18 RPM</option>
            <option value="19">19 RPM</option>
        </select>

        <label>SECAO</label>
        <select name="sel_secao" id="sel_secao" class="form form-control">
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
            <option>DAR</option>
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
        </select>

        <label>Função</label>
        <select name="sel_funcao" id="sel_funcao" class="form form-control">
            <option>Escolha uma Opção</option>
            <option>CHEFIA</option>
            <option>SUPERINTENDÊNCIA</option>
            <option>DIRETORIA</option>
            <option>MOTORISTA</option>
            <option>AUXILIAR I</option>
            <option>DIRETOR</option>
            <option>ASSESSORIA</option>
            <option>AUXILIAR II</option>
            <option>REDEC</option>
            <option>SUPERINTENDÊNCIA</option>
            <option>SECRETARIO</option>
            <option>VICE GOVERNADOR</option>
            <option>GOVERNADOR</option>
        </select>

        <label>Função Descricao</label>
        <select name="sel_func_desc" id="sel_func_desc" class="form form-control">
            <option>Escolha uma Opção</option>
            <option>GOVERNADOR</option>
            <option>VICE GOVERNADOR</option>
            <option>SECRETARIO GOVERNO</option>
            <option>Chefe do Gabinete Militar do Governador e Coordenador Estadual de Defesa Civil</option>
            <option>SUBCHEFE DO GABINETE MILITAR DO GOVERNADOR</option>
            <option>SECRETARIO EXECUTIVO DE DEFESA CIVIL</option>
            <option>SUPERINTENDENTE ADMINISTRATIVO</option>
            <option>SUPERINTENDENTE DE GESTÃO DO DESASTRE</option>
            <option>SUPERINTENDENTE DE GESTÃO DO RISCO DO DESASTRE</option>
            <option>SUPERINTENDENTE DE PLANEJAMENTO, GESTAO E FINANCAS</option>
            <option>CHEFE DO DEPOSITO DA CEDEC/MG</option>
            <option>DIRETOR ADMINISTRATIVO DA CEDEC/MG</option>
            <option>DIRETOR DE ENSINO EM DEFESA CIVIL</option>
            <option>CHEFE DO CENTRO DE CONTROLE DE EMERGENCIAS DA CEDEC/MG</option>
            <option>DIRETOR TECNICO DA CEDEC/MG</option>
            <option>DIRETOR DE PLANEJAMENTO DA CEDEC/MG</option>
            <option>SUBCHEFE DO CENTRO DE CONTROLE DE EMERGÊNCIAS DA CEDEC/MG</option>
            <option>CHEFE DEPOSITO CENTRAL</option>
            <option>AUXILIAR ADMINISTRATIVO</option>
            <option>MOTORISTA</option>
            <option>Auxiliar de Informática</option>
            <option>SECRETARIA DA CEDEC/MG</option>
            <option>SUPERINTENDENTE TECNICO OPERACIONAL</option>
            <option>DIRETOR LOGISTICA E SUPRIMENTOS</option>
            <option>Agente Regional de DC</option>
            <option>DIRETOR DE APOIO AS REGIONAIS</option>
        </select>

        <label>Lotado</label>
        <select class="form-control" name="selSetor" value="" id="selSetor">
            <option>CEDEC</option>
            <option>GMG</option>
        </select>
        <label>GMG/CEDEC</label>
        <select class="form-control" name="selSetor" value="" id="selSetor">
            <option>CEDEC</option>
            <option>GMG</option>
        </select>
        <br>
        <label style='color: red'>Email Recuperação Senha</label>
        <input class="form-control" type="email" name="txtEmail" value="<?= !empty($usuario) ? $usuario['email_rec'] : ""; ?>" id="txtEmail" <?= $readonly; ?> >
        <br>
        <label>Email Informações 1</label>
        <input class="form-control" type="email" name="txtEmailInfo1" value="<?= !empty($usuario) ? $usuario['email_info1'] : ""; ?>" id="txtEmailInfo1" <?= $readonly; ?> >
        <br>
        <label>Email Informações 2</label>
        <input class="form-control" type="email" name="txtEmailInfo2" value="<?= !empty($usuario) ? $usuario['email_info2'] : ""; ?>" id="txtEmailInfo2" <?= $readonly; ?> >
        <br>

        <input type="hidden" name="opcao" value="<?= !empty($usuario) ? "atualiza" : "caduser"; ?>" >
        <input type="hidden" name="id_usuario" value="<?= !empty($usuario) ? $usuario['id_usuario'] : ""; ?>" >
        <input type="hidden" name="selSituacao" value="1" >
        <br>


        <?= $button ?>

    </form>
</div>

<br>
<div class="col-md-12 text-center">
    <br>
    <a class="btn btn-success" href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=&modulo=admin&controller=adm&action=usuario">Voltar</a>
</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
