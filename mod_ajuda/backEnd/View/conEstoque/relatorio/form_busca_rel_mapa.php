<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";


	$_deposito = new Deposito();

	$_municipio = new Municipio();

?>

	<p class="text-center"><legend>Mapa Resumo</legend></p>

	<br>

	<div class="col-md-6">
		<form method="POST" action="?token=<?=hash('sha256', md5(VERSAO));?>&ac=itn&modulo=ajuda&controller=relatorio&action=mapa" name="frm_rel_liberacao" >
		

			<div class="col-md-12">
				<label>Dep&oacute;sito Destino:</label>
				<?php $_deposito->pegaDeposito('novalidate="novalidate"');?>
			</div>

			<div class="col-md-12">
				<label>Data Inicial:</label>
				<input class="form-control" type="text" name="txtDtInicial" id="txtDtInicial" data-mask="99/99/9999" title="Periodo Inicial de Liberações " required/>
			</div>
			<div class="col-md-12">
				<label>Data Final:</label>
				<input class="form-control" type="text" name="txtDtFinal" id="txtDtFinal" data-mask="99/99/9999" title="Periodo Final de Liberações" required/>
			</div>

			<div class="col-md-12">
			<label>Munic&iacute;pio:</label>
				<?php $_municipio->PegaMunicipio(null, null, 'novalidate="novalidate"');?>
				<br />
			</div>
			
			
			
		</div>
		<div class="col-md-6">
			<!-- <div class="col-md-6">
				<input type="checkbox" name="ck_cesta" id="ck_cesta">
				<label>Entrega de Cestas Básicas</label>
				<br>
				<input type="checkbox" name="ck_cesta" id="ck_cesta">
				<label>Água Pótável</label>
			</div> -->
			<div class="col-md-6">
				<label>Filtrar por Evento</label>
				<select class="form-control" name="sel_evento" id="sel_evento">
					<option>Selecione o Evento</option>
					<?php
						print $evento = Material::EventoList();

						foreach ($evento as $key => $value) {
							print "<option>".$value['nome']."</option>";
						}
						
					?>
				</select>
			</div>
			
		</div>
		<div class="col-md-12 text-center">
			<br>
			<input class="btn btn-primary" type="submit" name="pesquisar" value="Pesquisar" />&nbsp;&nbsp;<a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO));?>&ac=itn&modulo=ajuda&controller=conestoque&action=relIndex">Voltar</a>				 
		</div>
		</form>
	<?php 
	?>
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