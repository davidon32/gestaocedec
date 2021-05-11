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

<p class="text-center">
    <legend>Relat&oacute;rio de Libera&ccedil;&otilde;es</legend>
</p>

<div class="col-md-6">
    <form method="POST"
        action="?token=<?=hash('sha256', md5(VERSAO));?>&ac=itn&modulo=ajuda&controller=relatorio&action=relatorio"
        name="frm_rel_liberacao">

        <div class="col-md-12">
            <label>Dep&oacute;sito Destino:</label>
            <?php $_deposito->pegaDeposito('novalidate="novalidate"');?>
        </div>

        <div class="col-md-12">
            <label>Data Inicial:</label>
            <input class="form-control" type="text" name="txtDtInicial" id="txtDtInicial" data-mask="99/99/9999"
                title="Periodo Inicial de Liberações" required />
        </div>
        <div class="col-md-12">
            <label>Data Final:</label>
            <input class="form-control" type="text" name="txtDtFinal" id="txtDtFinal" data-mask="99/99/9999"
                title="Periodo Final de Liberações" required />
        </div>

        <div class="col-md-12">
            <label>Munic&iacute;pio:</label>
            <?php $_municipio->PegaMunicipio();?>
            <br>
        </div>

        <br />

        <br>
        <input class="btn btn-primary" type="submit" name="pesquisar" value="Pesquisar" />
        &nbsp;&nbsp;<a class="btn btn-success"
            href="?token=<?=hash('sha256', md5(VERSAO));?>&ac=itn&modulo=ajuda&controller=conestoque&action=relIndex">Voltar</a>

	</div>
	<div class='col-md-6'>
		<!-- <label>
				<input type="checkbox" name="ck_evento" id="ck_evento">
				Adicionar Resumo Por Evento
			</label>
			<br>
			<label>
				<input type="checkbox" name="ck_fonte" id="ck_fonte">
				Adicionar Resumo por Fonte de Entrada
			</label>
			<br> -->
		<label>
			<input type="checkbox" name="ck_diario" id="ck_diario" value="1">
			Resumo Diário
		</label>
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
$("#txtDtInicial").datepicker({
    dateFormat: 'dd/mm/yy',
    dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
    dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
    dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
    monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro',
        'Outubro', 'Novembro', 'Dezembro'
    ],
    monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
    nextText: 'Proximo',
    prevText: 'Anterior'
});
$("#txtDtFinal").datepicker({
    dateFormat: 'dd/mm/yy',
    dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
    dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
    dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
    monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro',
        'Outubro', 'Novembro', 'Dezembro'
    ],
    monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
    nextText: 'Proximo',
    prevText: 'Anterior'

});
</script>