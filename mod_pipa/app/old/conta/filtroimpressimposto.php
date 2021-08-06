<?php $id_session = session_id();
    if(empty($id_session)) session_start();
print "<!DOCTYPE html>";
include_once PATH.'/include.php';
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php print TITULO;?></title>
<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</head>
<body onload="esconde();">
    <!-- TOPO /system/topo.php-->
    <?php include_once(PATH.'/system/topo.php'); ?>
	<div class="container">
		<div class="row-fluid">
			<div class="span3">
				<?php include_once PATH."/mod_".$modulo.'/app/elemento/'.$modulo.'.menu.php';?>
			</div>
			<div class="span9">
				<legend>Relatório de Lancamento de Contas</label>
			</div>
			<div class="span3">
				<legend>Filtro</legend>
				<!--FORMULARIO -->
				<form action="index.php?modulo=pipa&secao=relatorio&acao=rel_imposto" method="POST" name="frm_envia">
				<label>Mês</label>
				<?php FuncaoBase::mes(); ?>

				<label>Ano</label>
				<input type="text" name="ano" id="ano" size="15" value="<?php print date('Y');?>" maxlength="4" />
				
				<label id="lbl_acerto">Data Acerto</label>
				<input type="text" name="dt_acerto" id="dt_acerto" data-mask="99/99/999" maxlength="10">
							
				<label>Lote</label>
				<input type="text" name="lote" id="lote" maxlength="4">
			</div>
			<div class="span3">
				<legend>Modelo</legend>

				<input type="radio" name="tipo_rel" id="radio" value="0" onclick="msg();" checked="checked"/> Normal
				<br /><br />
				
				<input type="radio" name="tipo_rel" id="radio" value="1" onclick="mostra();"/> Contabilidade
				<br /><br />
				
				<input type="radio" name="tipo_rel" id="radio" value="2" onclick="dpca();"/> DPCA (Relatorio Dirf)
				<br /><br />
				
				<input type="radio" name="tipo_rel" id="radio" value="3" /> DPCA 2
				<br />
				<br>
				<input type="radio" name="tipo_rel" id="radio" value="6" /> DPCA 3 (Individual para a Pasta de Doc.)
                <br />
				
				<input type="radio" name="tipo_rel" id="radio" value="4" /> DADM<!-- Modelo Sub Nilton-->
				<br /><br>

				<input type="radio" name="tipo_rel" id="radio" value="5" /> DADM PRESTACAO DE CONTA<!-- Modelo Ribeiro-->
				<br /><br>
				
				<legend>Pessoa Jurídica</legend>
				<input type="radio" name="tipo_rel" id="radio" value="7" /> PESSOA JURÍDICA <!-- Modelo Pessoa jurídica-->
                <br />
                <br>
                <input type="checkbox" value="1" name="ckIndividual"/> Individual
                
				
				<br />
				<legend>Conta</legend>
				
				
				<input type="radio" name="tp" id="tp" value="1" >Pag. Efetuados
				<br /><br />
				
				<input type="radio" name="tp" id="tp" value="0">Em Aberto

			</div>			
			<div class="span3">
				<legend>Resumo Geral</legend>
			
				
				<input type="checkbox" name="resumo" id="resumo" />Resumo
				<br /><br />

				<label>Data Inicial:</label>
				<input type="text" name="dt_inicial" id="dt_inicial" data-mask="99/99/9999" maxlength="10" value="" />
				
				<label>Data Final:</label>
					
				<input type="text" name="dt_final" id="dt_final" data-mask="99/99/9999" maxlength="10" value="" />
		
			</div>	

		</div>	
		<div class="row-fluid">
			<div class="span3"></div>
			<div class="span9 text-center">
				<hr>
				<br />
				<div id="alert" class="alert alert-error">
					Atenção ! <br> Ajustar a impressora para modo PAISAGEM ! para impressao Correta
				</div>
				<input class="btn btn-primary" type="submit" name="enviar" value="Gerar">
			</div>
		</div>
		<div class="row-fluid fdo_corpo">

		</div>
			
		

	</form>
	
	<script src="<?php print SISTEMA;?>/js/jquery.js"></script>
	<script src="<?php print SISTEMA;?>/js/bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/jasny-bootstrap.js"></script>
	<script src="<?php print SISTEMA;?>/js/funcaobase.js"></script>
	<script type="text/javascript">
		function esconde() {

			$("#alert").hide();
		}

        /* ativa as opções do relatorio normal*/
		function msg() {

			$("#alert").hide();
			$("#lote").prop('disabled', false);
	
		}

        /* mostra o alerta para a mudança layout do papel */
		function mostra() {

    		$("#alert").show();
    		$("#lote").prop('disabled', true);

		}

		function dpca() {

			if ($('#dt_acerto').is(':disabled') == true) { 

				$("#dt_acerto").prop('disabled', false);
				$("#lote").prop('disabled', false);
				$("#resumo").prop('disabled', false);
			}else {

				$('#dt_acerto').prop('disabled', true);
				$('#lote').prop('disabled', true);
				$('#resumo').prop('disabled', true);

			
			}

		}


	</script>
</body>
</html>



