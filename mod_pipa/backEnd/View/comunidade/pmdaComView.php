<?php include_once PATH.'/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_pipa/Model/IndexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<?php 
	$pmda = new Pmda();
	$pre_cadastro_comunidade = $pmda->buscaPreCadComun();

?>
		<!-- INICIO DO CORPO-->
						
						<ul>						
								<div class="row">
    								<div class="input-group">
    									
        								<input type="text" id="txtProtocolo">
        								<button class="btn btn-primary" id="btnConfirm">Confirmar</button>
    								</div>
								</div>
    						<br>
    						<!--<a class="btn btn-primary" href="?modulo=pipa&controller=pipa&action=cadcom" title="Cadastrar a Comunidade">Cadastrar / Alterar Comunidade</a><br>-->
    						<br>
    						<a class="btn btn-primary" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=pipa&controller=pipa&action=valcom" title="Validar a Comunidade Cadastrada pelo Compdec">Validar Comunidade</a>
							<br><br>
							<a class="btn btn-primary" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=pipa&controller=pipa&action=index">Voltar</a>
    						<br>
						</ul>

	<div>

	
	<table class="table">
		<tr>
			<th>Municipio com Comunidades Pendentes para Validação</th>
			<th>Qtd</th>
			<th>Ação</th>
		</tr>

	<?php

		foreach ($pre_cadastro_comunidade as $key => $value) {
			print "<tr>";
			print "<td><a href='?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=pipa&controller=pipa&action=valcom&id=".$value['id_municipio']."' title='Visualiza Comunidades para Efetivação de Cadastro'>".$value['nome']."</a></td>";
			print "<td><a href='?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=pipa&controller=pipa&action=valcom&id=".$value['id_municipio']."' title='Visualiza Comunidades para Efetivação de Cadastro'>".$value['total_com']."</a></td>";
			print "<td><a href='?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=pipa&controller=pipa&action=valcom&id=".$value['id_municipio']."' title='Visualiza Comunidades para Efetivação de Cadastro'>Visualizar</a></td>";
			print "</tr>";
		}
	?>
	</table>
	
	</div>

	<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
	
	<script>


		$(document).ready(function(){

			$("#btnConfirm").hide();
			$("#txtProtocolo").hide();


			$("#lk_alteracao").click(function(){
				$("#btnConfirm").show();
				$("#txtProtocolo").show();
			});
			$("#btnConfirm").click(function(){
				alert("ok");
			});


		});


	</script>