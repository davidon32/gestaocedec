<?php include_once 'core/include.php';
include_once 'core/Model/indexModel.php';
?>
<?php include_once 'mod_index/Model/indexModel.php'; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php"; ?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<?php
if (isset($_GET['debug'])) {
    
}

$_loginEx = new LoginExterno();
?>
<table class="table">
    <tr>
        <?php
        $acessoModulo = $_loginEx->acessoModulo($pageSession['session']['seguranca']['idUser']);
        
        var_dump($acessoModulo);
        $id = $pageSession['session']['seguranca']['id_municipio'];

        # pmda
        print ($acessoModulo['mod_pipa'] == '1') ?
                        '<td align="center">
	  						<a class="" href="?token=' . hash("sha256", md5(VERSAO)."-".time()) . '&ac=etn&modulo=pipa&controller=pipa&action=pmdaidx" title="Acesso ao PMDA on-line"><img alt="core/imagem/pipa.png" src="core/imagem/pipa.png"><br><b>PMDA on-line</b></a>
	  					</td>' : '';

        # compdec
        print ($acessoModulo['mod_compdec'] == '1') ?
                        '<td align="center">
	  							<a class="" href="?token=' . hash("sha256", md5(VERSAO)."-".time()) . '&ac=etn&modulo=compdec&controller=compdec&action=index" title="Acesso Cadastro de Compdecs"><img alt="core/imagem/comdec.png" src="core/imagem/comdec.png"><br><b>Dados Compdec</b></a>
	  						</td>' : '';

        # ajuda humanitaria
        print ($acessoModulo['mod_ajuda'] == '1') ?
                        '<td align="center">
	  							<a class="" href="?token=' . hash("sha256", md5(VERSAO)."-".time()) . '&ac=etn&modulo=ajuda&controller=ajudahuman&action=index" title="Ajuda Humanitária"><img alt="core/imagem/ajuda.png" src="core/imagem/ajuda.png"><br><b>Ajuda Humanitária</b></a>
								</td>' : '';
        # plano de contingencia			
        print ($acessoModulo['mod_plano'] == '1') ?
                        '<td align="center">
	  							<a class="" href="?token=' . hash("sha256", md5(VERSAO)."-".time()) . '&ac=etn&modulo=compdec&controller=plano&action=index" title="Confecção do Plano de Contingencia"><img alt="core/imagem/plano.png" src="core/imagem/plano.png"><br><b>Plano de Contingencia</b></a>
	  						</td>' : '';
        ?>
    </tr>
</table>
<br>
<div>

    <h3><p style="text-align:center;">Importante !</p></h3><br>
    <h4>Você COMPDEC, já acessou os tutoriais e manuais que se encontram no link ao lado "Ajuda de Sistema" ?</h4>


</div>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>

<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>