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
<?php include_once "template/page/corpoHeader.php";
	$_deposito = new Deposito();

	$_municipio = new Municipio();
	
?>
<div class="col-md-12 text-center">
<a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=relIndex">Voltar</a>	
</div>
<div class="col-md-6">
	<form method="POST" action="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=relatorio&action=rmattransf" name="frm_rel_liberacao" >
					
		<legend>Relat&oacute;rio de Materiais Transferidos entre Depósitos</legend>
						
			<label>Dep&oacute;sito Destino:</label>
			<?php $_deposito->pegaDeposito();?>
							
			<label>Data Inicial:</label>
			<input class="form-control" type="text" name="txtDtInicial" id="txtDtInicial" data-mask="99/99/9999" title="Periodo Inicial de Liberações "/>

			<label>Data Final:</label>
			<input class="form-control" type="text" name="txtDtFinal" id="txtDtFinal" data-mask="99/99/9999" title="Periodo Final de Liberações"/>
						
			<label>Munic&iacute;pio:</label>
			<?php $_municipio->PegaMunicipio();?>
			<br />
			<input class="btn btn-primary" type="submit" name="pesquisar" value="Pesquisar" />					 
	</form>
</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>

<script type="text/javascript">

	$("#txtDtInicial").datepicker({ dateFormat: 'dd/mm/yy' });
	$("#txtDtFinal").datepicker({ dateFormat: 'dd/mm/yy' });
	
</script>