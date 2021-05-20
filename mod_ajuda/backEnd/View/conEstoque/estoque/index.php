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
*   Org�o Gestor : Coordenadoria Estadual de Defesa Civil do Estado de Minas Gerais
*	Sistema      : Sistema de Gest�o de Ajuda Humanit�ria
*
*	Autor        :  Demetrio Silva Passos
*	Fun��o       :  Tela de consulta de Saldo Geral dos Dep�sitos
*
*******************************************************************************************/


?>
	
	<div class="col-md-12 text-center imprimir">
		<a class='btn btn-success' href='index.php?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=index'>Voltar</a>
	    </div>
		
		<div class="col-md-12">
			<legend>Busca Depósito</legend>
			<?php Deposito::pegaDeposito();?>
			<br>
			<a class='btn btn-info' href='index.php?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=saldo'>Saldo Geral</a>
	   	
		</div>
		
		<div class="col-md-12">

			<legend>Saldo Impressão</legend>

			<?php

				$unidade = 

				$dados = UnidadeController::getUnidade();

				$coluna = 1;

				print "<div class='col-md-12 table-overflow'>";
			
				print "<label>Todos<input type='checkbox' id='ck_todos'></label></div>";
				print "<table class='table table-bordered table-striped'>
						<tr>";
					
				foreach ($dados as $key => $value) {
					if(($key % 10) == 0){
							$coluna += 1; 
						print "<td style='text-align:left;'>";	
						print "";
					print "<label class='checkbox-inline linhaInteira'><input type='checkbox' name='produto' value='".$value['id_unidade']."'>&nbsp;".
						$value['nome']."</label><br><br>"; 
					}else {

					print "";
					print "<label class='checkbox-inline linhaInteira'><input type='checkbox' name='produto' value='".$value['id_unidade']."'>&nbsp;".
						$value['nome']."</label><br><br>";
					}
				}
				print "</td></tr>";
			
				print "</table></div>";


			?>
		</div>
		
	
		<div class="col-md-12 text-center">
			<button class="btn btn-info" name="btnImpressao" id="btnImpressao">Impressao</button>
		</div>
			
		</div>
					

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
<script type="text/javascript">


$(document).ready(function(){

	$("#btnImpressao").click(function(){

		var ids = 0;
		var favorite = [];
            $.each($("input[name='produto']:checked"), function(){
                favorite.push($(this).val());
			});

			ids = favorite.toString();

			window.location.href = "?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=saldoResumo&id="+ids;
			

	});

	$("#ck_todos").click(function(){

		if($("#ck_todos").is(":checked")){
			$("input[type='checkbox']").attr('checked', true);
		}else {
			$("input[type='checkbox']").attr('checked', false);
		}

	})

});
</script>
