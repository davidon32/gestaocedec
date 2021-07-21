<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";

	$_deposito = new Deposito();

	$_municipio = new Municipio();
	
?>

<div class="col-md-6">

	<form method="POST" action="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=relatorio&action=rel_material_pago" name="frm_rel_pagamento" >
		<legend>Relat&oacute;rio de Material Pago</legend>
		<label>Dep&oacute;sito Destino:</label>
		<?php $_deposito->pegaDeposito();?>
						
		<label>Data Inicial:</label>
		<input class="form-control" type="text" name="txt_dt_inicial" id="txt_dt_inicial" data-mask="99/99/9999" title="Periodo Inicial de Pagamento "/>

		<label>Data Final:</label>
		<input class="form-control"  type="text" name="txt_dt_final" id="txt_dt_final" data-mask="99/99/9999" title="Periodo Final de Pagamento"/>
					
		<label>Munic&iacute;pio:</label>
		<?php $_municipio->PegaMunicipio();?>
		<br />
		<input class="btn btn-primary" type="submit" name="btn_enviar" value="Relatório" />
		<br>			 
	</form>

</div>

<div class="col-md-12 text-center">
<br>
<a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=relIndex" class="btn btn-success">Voltar</a><br>
</div>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
<script type="text/javascript">

	$("#txt_dt_inicial").datepicker({ dateFormat: 'dd/mm/yy' });
	$("#txt_dt_final").datepicker({ dateFormat: 'dd/mm/yy' });
	
</script>