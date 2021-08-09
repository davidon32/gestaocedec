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
	#frm_Entrada_mat .error {
    	color: red;
	}
</style>

	<legend> Entrada de Materiais</legend>
	<div class="row">
		<div class="col-md-12 text-center">
			<br>
			<a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=material"/>Voltar</a>
		</div>
	</div>
			<br>		
			
		<form id="frm_Entrada_mat" action="" method="">
			<div class="row">
				<div class="col-md-4">
						<label>Origem</label>
							<select class="form-control" name="txtOrigem" id="txtOrigem">
								<option></option>
								<?php
									print Material::Fonte();
								?>
								<option>Adicionar Fonte<option>
							</select>
					</div>
				<div class="col-md-4">
					<label>Nome</label>
					<?php Produto::PegaProduto();?>
				</div>
				<div class="col-md-4">
					<label>Data Entrada</label>
                                        <input class="form-control" name="txtDtEntrada" id="txtDtEntrada" type="text" data-mask="99/99/9999" value="<?php echo date('d/m/Y'); ?>" maxlength="10" />
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<label>Validade</label>
                                        <input class="form-control" name="txtValidade" type="text" id="txtValidade" data-mask="99/99/9999" maxlength="10"/>
				</div>
				<div class="col-md-4">
					<label>Quantidade</label>
                                        <input type="text" name="txtQtd" id="txtQtd" class="form-control" required maxlength="4"/>
				</div>
				<div class="col-md-4">		
					<label>Dep&oacute;sito Avan&ccedil;ado:</label>
					<?php Deposito::pegaDeposito();?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label>Observa&ccedil;&otilde;es:</label>
                                        <textarea class="form-control" name="txObs" id="txObs" cols="30" rows="4" maxlength="255"></textarea>
				</div>
				<div class="col-md-6">
				
					<label>Upload Nota Fiscal</label>
					<input type="file" name="fl_nota" id="fl_nota">
				</div>
				<div class="col-md-12 text-center">
					<br>
					<input type="submit" class="btn btn-primary"  name="btnCadMaterial" id="btnCadMaterial" value="Cadastrar"/>
				</div>
			</div>
		</form>
	</div>
	<br>
	<div class="row">

		<div class="col-md-1">
		</div>

		<div class="col-md-10">

			<table class="table table-bordered">
				<tr><th class="text-center">Cod</th>
				<th class="text-center">Data Entrada</th>
				<th class="text-center">Nome</th>
				<th class="text-center">Origem de Entrada</th>
				<th class="text-center">Deposito Destino</th>
				<th class="text-center">Qtd</th>
				<th class="text-center">Validade</th>
				<th class="text-center">Nota F</th>
			
			</tr>
				<?php

					$material = Material::listaEntradaMaterial(50);

					foreach ($material as $key => $value) {
						print "<tr><td>".$value['id_produto']."</td>
								<td>".$value['dtEntradaSaida']."</td>
								<td>".$value['nome']."</td>
								<td>".$value['origem']."</td>
								<td>".$value['depDestino']."</td>
								<td>".$value['quantidade']."</td>
								<td>".(empty($value['validade']) ? "n/a" : $value['validade'] )."</td>
                                                                <td>-</td>
								</tr>";
					}
				?>
					</table>
		</div>
		<div class="col-md-1">
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

    $("#txtDtEntrada").datepicker({ dateFormat: 'dd/mm/yy' });
    $("#txtValidade").datepicker({ dateFormat: 'dd/mm/yy' });

	$("#frm_Entrada_mat").submit(function(e) {
		e.preventDefault();
	}).validate({
		rules: {
				txtOrigem:{ required: true}, 		
				txtQtd:{ required: true, number: true, minlength: 1 }, 	
				id_produto:{ required: true}, 	
				id_deposito:{ required: true}, 	

			},
			messages: {
				txtQtd: { required: 'O campo Quantidade não pode ficar em Branco !', number: 'O valor precisa ser numerico', minlength: 'tamanho errado'},
				txtOrigem: { required: 'O campo Origem não pode ficar em Branco !'},
				id_produto: { required: 'O campo Material não pode ficar em Branco !'},
				id_deposito: { required: 'O campo Deposito não pode ficar em Branco !'}	,
			},
			
		submitHandler: function(form) { 

			var form_data = new FormData();

			var file_data = $("#fl_nota").prop("files")[0];

				form_data.append("fl_nota",        file_data);
				form_data.append("opcao",       "cad_material");
				form_data.append("id_produto",  $("#id_produto").val())
				form_data.append("txtDtEntrada",$("#txtDtEntrada").val())
				form_data.append("txtOrigem",   $("#txtOrigem").val())
				form_data.append("txtValidade", $("#txtValidade").val())
				form_data.append("txtQtd",      $("#txtQtd").val())
				form_data.append("id_deposito", $("#id_deposito").val())
				form_data.append("txObs",       $("#txObs").val())
				
			$.ajax({
				type: 'POST',
				url: 'mod_ajuda/backEnd/View/conEstoque/material/valida.php?v=<?=md5(VERSAO)?>',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				success: function(response) {
					if(response == 'sucesso'){
					alert("Cadastro realizado com Sucesso !");
					//console.log(response);
					location.reload();
					}
				},
				error: function(e){
					console.log(JSON.stringify(form_data));
					console.log(JSON.stringify(response));
					alert("Ocorreu um Erro !");
				}
				
			});

		}
	});


	$("#txtOrigem").change(function(){

		if($("#txtOrigem").val() == "Adicionar Fonte"){

			var result = confirm("Deseja Cadastrar uma Fonte de Entrada de Materiais");

			if(result){
				window.location.href = "?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=origem&cad=true";
			}
		}

	})

	$("#fl_nota").change(function(e){
		var fileName = e.target.files[0].name;

		if (fileName.length == fileName.replace(" ", "").length) {
			$("#btnCadMaterial").removeAttr("disabled");
		}else {
			$("#btnCadMaterial").attr("disabled", "true");
			alert("O Nome do arquivo não pode conter espacos !");
		}
	});

		/*$("#txtQtd").blur(function(){
			var num = $("#txtQtd").val();

			numInt = parseInt(num);
			$("#txtQtd").val(numInt);
		});*/

});	
</script>