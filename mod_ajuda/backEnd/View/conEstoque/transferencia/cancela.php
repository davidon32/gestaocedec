<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<?php
$_deposito = new Deposito();

$_controleSaldo = new ControleSaldo();

$id_transf = isset($_GET['n']) ? $_GET['n'] :"";

$bl_input = (is_numeric($id_transf)) ? "readonly='readonly'" : "";

/*****************************************************************************************
 *   Org�o 		: Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*	Autor        : Demetrio Silva Passos
*	Fun��o       : Adiciona material na cesta para transferencia
*
*******************************************************************************************/


$saldo = new Relatorio();

if(!isset($_SESSION['cesta'])){

	$_SESSION['cesta'] = array();
}
$nProd = new Produto();	

?>

<div class="col-md-12">
	<legend>Cancelar Transferencia de Materiais</legend>
	<form method="POST" action="?token=<?=hash('sha256', md5(VERSAO));?>&ac=itn&modulo=ajuda&controller=conestoque&action=vtransfcancela" name="frm_cancela">
	<div class="col-md-4">	
		<label>Nº Transferência</label>
			<input class="form-control" <?=$bl_input;?> value="<?=$id_transf;?>" type="text" name="txt_id_transferencia" id="txt_id_transferencia" title="Número da Transferencia" placeholder="Código Transferência">
			<input type="hidden" name="opcao" value="cancela">
	</div>
	<div class="col-md-12">	
		<label>Observação</label>
		<textarea class="form-control" name="txt_observacao" id="txt_observacao" placeholder="Observação"></textarea>
		<br />
	</div>
	<div class="col-md-12 text-center">		
		<input class="btn btn-success" type="submit" name="btn_enviar" value="Gravar" onclick="return confirm('Deseja realmente Cancelar esta Transferencia de Materiais ?')">
		<a class="btn btn-primary" onclick="history.back()">Voltar</a>
	</div>
	</form>
</div>	
	<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>