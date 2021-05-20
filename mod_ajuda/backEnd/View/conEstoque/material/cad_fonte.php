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
 

	<legend> Fonte de Entrada de Materiais </legend>
	
	<div class="row">
		<div class="col-md-12 text-center">
			<br>
			<a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=material"/>Voltar</a>
		</div>
	</div>
	
	<form id="frmCad_fonte" action="" method="post">
		<div class="row">
			<div class="col-md-3">
				</div>
				<div class="col-md-6">
					<label>Nome da Fonte / Origem</label>
					<input class="form-control" name="txtNome" id="txtNome" type="text" />
					<input name="txtCadPeloMat" id="txtCadPeloMat" type="hidden" value="<?=(isset($_GET['cad']) ? "true" :"");?>" />
				</div>
				<div class="col-md-3">
					</div>
				</div>
				<br>
				<div class="row">
					
					<div class="col-md-3">
						</div>
						
						<div class="col-md-6">
							<input class="btn btn-primary" type="submit" name="btnCadFonte" id="btnCadFonte" value="Cadastrar"/>
	</form>
							
							<table class="table table-bordered">
								<tr><th class="text-center">Cod</th><th class="text-center">Nome</th></tr>
								<?php

						$fonte = Material::getFonteIdNome();

						foreach ($fonte as $key => $value) {
							print "<tr><td>".$value['id']."</td><td>".$value['nome']."</td></tr>";
						}
					?>
						</table>
			</div>
			<div class="col-md-3">
			</div>	
		</div>
						<br>
	

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>

<script type="text/javascript">

$(document).ready(function(){

	$("#frmCad_fonte").submit(function(e) {
		e.preventDefault();
	}).validate({
		rules: {
				txtNome: { required: true, maxlength: 69 }	
			},
			messages: {
				txtNome: { required: 'Preencha o campo nome', maxlength: 'No máximo 69 letras' }
			},
			
		submitHandler: function(form) { 

			var dados = {
						
						"opcao"    : "cad_fonte",
						'nome'     : $("#txtNome").val(),
						'cad_pelo_mat': $("#txtCadPeloMat").val(),
						
						};
			$.ajax({
				type: 'POST',
				url: 'mod_ajuda/backEnd/View/conEstoque/material/valida.php',
				data: dados,
				//dataType: 'json',
				success: function(response) {
					if(response == 'sucesso'){
						alert("Cadastro realizado com Sucesso !");
						location.reload();
					}else if(response == 'sucesso1') {
						alert("Cadastro realizado com Sucesso !");
						window.location.href = "?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn& &ac=itn&modulo=ajuda&controller=conestoque&action=cadastro"; 
					}
				},
				error: function(e){
					console.log(JSON.stringify(dados));
				}
				
			});

		}
		});

});	
</script>