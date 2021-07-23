<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<style>	
	#frmCad_produto .error {
    	color: red;
	}
</style>
 

	<legend> Cadastro de Materiais </legend>
					
	<div class="row">
		<div class="col-md-12">
			<br>
			<a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=material"/>Voltar</a>
			
		</div>
	</div>

	<div class="row">
			<br>
		<!-- Formeulario de cadastro de materiais -->
		<form id="frmCad_produto" action="" method="post">
				<div class="col-md-3">
				</div>
				<div class="col-md-3">
					<label>Nome</label>
					<input class="form-control" name="txtNome" id="txtNome" type="text" required />
				</div>
				<div class="col-md-3">
					<label>Descrição</label>
					<input class="form-control" name="txtDescricao" id="txtDescricao" type="text" maxlength="20" />
				</div>
				<div class="col-md-3">
					</div>
					<div class="col-md-12 text-center">
						<br>
						<input class="btn btn-primary" type="submit" name="btnCadProduto" id="btnCadProduto" value="Cadastrar"/>
					</div>
		</form>
		<!-- Fim formulario  -->
	</div>
	<br>
			
		<div class="row">
			<div class="col-md-3">
			</div>
				<div class="col-md-6">
					<table class="table table-bordered">
						<tr><th class="text-center">Cod</th><th class="text-center">Nome</th><th class="text-center">Descrição</th></tr>
					<?php
						$unidade = Unidade::getIdNome();
						foreach ($unidade as $key => $value) {
							print "<tr><td>".$value['id_unidade']."</td><td>".$value['nome']."</td><td>".$value['descricao']."</td></tr>";
						}
					?>
					</table>
				</div>
				<div class="col-md-3">
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

	$("#frmCad_produto").submit(function(e) {
		e.preventDefault();
	}).validate({
		rules: {
				txtNome: { required: true, minlength: 2 }	
			},
			messages: {
				txtNome: { required: 'Preencha o campo nome', minlength: 'No mínimo 2 letras' }
			},
			
		submitHandler: function(form) { 

			 var dados = {	
						"opcao"    : "cad_prod",
						'nome'     : $("#txtNome").val(),
						'descricao': $("#txtDescricao").val(),
						};
	
				$.ajax({
					type: 'POST',
					url: 'mod_ajuda/backEnd/View/conEstoque/material/valida.php?v=<?=md5(VERSAO)?>',
					data: dados,
					success: function(response) {
						if(response == 'sucesso'){
						alert("Cadastro realizado com Sucesso !");
						location.reload();
						}
					},
					error: function(e){
						console.log(JSON.stringify(response));
						alert("Ocorreu um Erro !");
					}
				});
				return false;
		}
	});
});	
</script>