<?php
include_once 'core/include.php';
include_once 'core/Model/indexModel.php';
?>
<?php include_once 'mod_index/Model/indexModel.php'; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php"; ?>
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

        //var_dump($acessoModulo);
        $id = $pageSession['session']['seguranca']['id_municipio'];

        # pmda
        print ($acessoModulo['mod_pipa'] == '1') ?
                        '<td align="center">
	  						<a class="" href="?token=' . hash("sha256", md5(VERSAO) . "-" . time()) . '&ac=etn&modulo=pipa&controller=pipa&action=pmdaidx" title="Acesso ao PMDA on-line"><img alt="core/imagem/pipa.png" src="core/imagem/pipa.png"><br><b>PMDA</b></a>
	  					</td>' : '';

        # compdec
        print ($acessoModulo['mod_compdec'] == '1') ?
                        '<td align="center">
	  							<a class="" href="?token=' . hash("sha256", md5(VERSAO) . "-" . time()) . '&ac=etn&modulo=compdec&controller=compdec&action=index" title="Acesso Cadastro de Compdecs"><img alt="core/imagem/comdec.png" src="core/imagem/comdec.png"><br><b>Dados Compdec</b></a>
	  						</td>' : '';

        # ajuda humanitaria
        print ($acessoModulo['mod_ajuda'] == '1') ?
                        '<td align="center">
	  							<a class="" href="?token=' . hash("sha256", md5(VERSAO) . "-" . time()) . '&ac=etn&modulo=ajuda&controller=h_pedido_index&action=index" title="Ajuda Humanitária"><img width="128" alt="core/imagem/ajuda.png" src="core/imagem/pedido_cesta.png"><br><b>Ajuda Humanitária</b></a>
								</td>' : '';

        # Registro desastre
        print ($acessoModulo['mod_registro'] == '1') ?
                        '<td align="center">
	  							<a class="" href="?token=' . hash("sha256", md5(VERSAO) . "-" . time()) . '&ac=etn&modulo=registro&controller=index&action=index" title="Registro de Danos Humanos"><img width="128" alt="core/imagem/ajuda.png" src="core/imagem/evento.png"><br><b>Registro Danos Humanos</b></a>
								</td>' : '';
        # plano de contingencia	
        if ($acessoModulo['mod_plano'] == '1') {
            print '<td align="center">
                    <a class="" href="?token=' . hash("sha256", md5(VERSAO) . "-" . time()) . '&ac=etn&modulo=compdec&controller=plano&action=index" title="Confecção do Plano de Contingencia"><img alt="core/imagem/plano.png" src="core/imagem/plano.png"><br><b>Plano de Contingência</b></a>
                </td>';
        } else {
            print '<td align="center">
                    <a class="" href="" title="Prazo Terminou as 16:00 do dia 10/08/2021 para Envio de plano de Contingencia"><img class="imgCinza" alt="core/imagem/plano.png" src="core/imagem/plano.png"><br></a>
                </td>';
        }
        ?>
    </tr>
</table>
<br>
<div>
    <br>
    <div class="col-md-3 text-center"></div>
    <div class="col-md-6 text-center">
        <div class="alert alert-danger">
            <h3><p style="text-align:center;" >Importante !</p></h3>
            <h4>Você COMPDEC, já acessou os tutoriais e manuais que se encontram no link ao lado "Ajuda de Sistema" ?</h4>
        </div>
    </div>
    <div class="col-md-3 text-center"></div>
</div>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>

<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>