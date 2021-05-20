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
 

	<legend> Cadastro Evento / Campanha </legend>
					
	<div class="row">
		<div class="col-md-4">
			<label>Nome</label>
			<input class="form-control" name="txtEvento" id="txtEvento" type="text" />
		</div>

	<div class="row">
		<div class="col-md-12">
			<br>
			<input class="btn btn-primary" type="submit" onclick="return confirm('Confirmar Cadastro Evento?')"  name="btnCadEvento" id="btnCadEvento" value="Cadastrar"/>
			<a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=material"/>Voltar</a>
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

	$("input[type='text']").keyup(function () {
    this.value = this.value.toLocaleUpperCase();
});

	$("#btnCadEvento").click(function(){

		if(
					($("#txtNome").val() == "")
				
				){

				alert("O campo : \n * Nome  é Obrigatório !!");

		}else {

			var dados = {
						
						"opcao"    : "cad_evento",
						'nome'     : $("#txtEvento").val(),
						
						};
			$.ajax({
				type: 'POST',
				url: 'mod_ajuda/backEnd/View/conEstoque/material/valida.php',
				data: dados,
				//dataType: 'json',
				success: function(response) {
					if(response == 'sucesso'){
					alert("Cadastro realizado com Sucesso !");
					window.location.href = "?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=ajuda&controller=conestoque&action=material"; 
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