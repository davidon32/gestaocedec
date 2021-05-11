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

/* ****************************************************************************************
*  	Org�o 		 : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*	Autor        :  Demetrio Silva Passos
*	Função       : Tela para Transfer�ncia de Materiais entre Dep�sitos Avan�ados
*
*******************************************************************************************/

?>
    <div class="col-md-6 text-center">
	<br>
	
			<a class="btn btn-info" href="?token=<?=hash('sha256', md5(VERSAO));?>&ac=itn&modulo=ajuda&controller=conestoque&action=add_mat_transf" class="btn window" title="">Adicionar Material</a>
			
		<p class="text-center"><legend> Materiais da Transferencia</legend></p>

		<?php
				if(isset($_SESSION['cesta']) && (!empty($_SESSION['cesta']))){
					print Pedido::MostraPedido($_SESSION['cesta']);
				}else {
					print "<span class=\"alert alert-danger\">Não foi Adicionado Material para Liberar</span>";
				}
			?>
	</div>
	<div class="col-md-6">
		<legend>Transfer&ecirc;ncia de Materiais</legend>
		<form action="?token=<?=hash('sha256', md5(VERSAO));?>&ac=itn&modulo=ajuda&controller=conestoque&action=transfgravar" method="POST" name="frm_cesta">

		<div class="col-md-6">
			<label>Data</label>
			<input class="form-control" name="txt_dt_transferencia" type="text" id="txt_dt_transferencia" data-mask="99/99/9999" value="<?php print date('d/m/Y');?>" />
			<input type="hidden" name="opcao" value="transferir">
		</div>
		<div class="col-md-6">	
			<label>Motorista</label>
			<input class="form-control" type="text" name="txt_motorista" />
		</div>
		<div class="col-md-6">	
			<label>Ve&iacute;culo</label>
			<input class="form-control" type="text" name="txt_veiculo" />
		</div>
		<div class="col-md-6">
			<label>Placa</label>
			<input class="form-control" type="text" name="txt_placa" data-mask="AAA-9999" />
		</div>
		<div class="col-md-6">
			<label>Data Saida</label>
			<input class="form-control" type="text" name="txt_saida" id="txt_saida" data-mask="99/99/9999" value="<?php print date('d/m/Y');?>"/>
		</div>
		<div class="col-md-6">
			<label>Hora Saída</label>
			<input class="form-control" type="text" name="txt_hora_saida" data-mask="99:99" />
		</div>
		<div class="col-md-6">
			<label>Previs&atilde;o Chegada Data</label>
			<input class="form-control" type="text" name="txt_chegada" id="txt_chegada" data-mask="99/99/9999" />
		</div>
		<div class="col-md-6">
			<label>Previs&atilde;o Chegada Hora</label>
			<input class="form-control" type="text" name="txt_hora_chegada" data-mask="99:99" />
		</div>
		<div class="col-md-12">
			<label>Transferir para Deposito :</label>
			<?php Deposito::PegaDeposito();?>
		</div>
		<div class="col-md-12 text-center">
			<br>
			<input class="btn btn-info" type="submit" onclick="return confirm('Deseja Realmente fazer a Transferencia de Materiais ?');" name="btn_enviar" value="Gravar Transferencia" /> 
			<br>
		</div>
	</div>

	<div class="col-md-12 text-center"><br>
		<a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO))?>&ac=itn&modulo=ajuda&controller=conestoque&action=idxtransf">Voltar</a>
	</div>		
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
<script type="text/javascript">

	$("#txt_dt_transferencia").datepicker({ dateFormat: 'dd/mm/yy' });
	$("#txt_saida").datepicker({ dateFormat: 'dd/mm/yy' });
	$("#txt_chegada").datepicker({ dateFormat: 'dd/mm/yy' });
	
</script>
