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

	//$unidade = RelatorioAju::itensUnidade();
        
        $unidade = Unidade::ListUnidade();
        
        $eventoModel = new EventoConEstoqueModel;
        $eventos = $eventoModel->listaEvento();
        
?>

	<p class="text-center"><legend>Relat&oacute;rio de Inventário de materiais</legend></p>

	<form method="POST" action="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=relatorio&action=inventario" name="frm_rel_inventario" >
		<div class="col-md-12">
                    <label>Dep&oacute;sito Destino:</label>
                    <?php $_deposito->pegaDeposito();?>
                </div>
                <!--<div class="col-md-12">
                    <br>
                    <label>Data Inicial:</label>
                    <input class="form-control" type="text" name="txtDtInicial" id="txtDtInicial" data-mask="99/99/9999" title="Periodo Inicial de Liberações " required/>
		</div>
		<div class="col-md-12">
                    <br>
                    <label>Data Final:</label>
                    <input class="form-control" type="text" name="txtDtFinal" id="txtDtFinal" data-mask="99/99/9999" title="Periodo Final de Liberações" required/>
		</div>-->
                
                <!--<div class="col-md-12">
                    <br>
                    <label>Munic&iacute;pio:</label>
                    <?php $_municipio->PegaMunicipio();?>
		</div>-->
		
           
            <div class="col-md-12">
                <br>
                <div class="form-group">
				<label for="ckSaldoZerado">Saldo Zerado</label>
				<input type="checkbox" name="ckSaldoZerado" id="ckSaldoZerado">
		</div>
                
            </div>
            <div class="col-md-12">
            <input class="btn btn-primary" type="submit" name="pesquisar" value="Pesquisar" />
					&nbsp;&nbsp;<a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=relIndex">Voltar</a>				 
            </div>

	</form>
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

	
	$("#ckListMat").attr("checked",false);
	$("#lista").hide();

	$("#ckListMat").click(function(){
		
		if($("#ckListMat").is(":checked")){

			if($("#lista").is(":visible")){

   			}else {
				$("#lista").show(700);
			}
			$("#ckListMat").attr("checked",true);
		}else{
			$("#lista").hide(700);
			$("#ckListMat").attr("checked",false);
		}
	})
	
</script>