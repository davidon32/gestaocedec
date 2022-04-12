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
<?php
$_readOnly = "";
	$id_pgto = isset($_GET['id']) ? $_GET['id'] :"";
	if(!empty($id_pgto)){
		$_readOnly = "readonly='readonly'";
	}

?>

<div class="col-md-12">
	<legend>Upload Recibo pagamento </legend>
		
		<div class="col-md-6">
			<label>Nº Recibo Pagamento </label>
			<input class="form-control" type="text" name="txtNumPgto" id="txtNumPgto" value="<?=$id_pgto;?>" <?=$_readOnly;?> />
			<br>
			<input type="file" name="fl_nota" id="fl_nota" accept=".png,.jpeg,.pdf">
			<br>
		</div>
		</div>
		<div class="col-md-12">
			<input class="btn btn-info" type="submit" name="btnUpload" value="btnUpload" id="btnUpload" />
			<a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=idxpagamento">Voltar</a>		
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


	$("#fl_nota").change(function(e){
			var fileName = e.target.files[0].name;
			var fileInfo = e.target.files[0];
                        
                        
                        if( (fileInfo.type = "image/png") ||
                            (fileInfo.type = "image/jpeg") ||
                            (fileInfo.type = "application/pdf") &&
                            (fileinfo.size <= 300000) ){
                        
                        console.log(fileInfo);

                            if (fileName.length == fileName.replace(" ", "").length) {

                                    $("#btnUpload").removeAttr("disabled");
                            }else {
                                    $("#btnUpload").attr("disabled", "true");
                                    alert("O Nome do arquivo não pode conter espacos !");
                            }
                        }else {
                            alert();
                        }
		});

		$("#btnUpload").click(function(){

			if(
				($("#txtNumPgto").val() == "")
			){

					alert("Os campos : \n * Numero do Recibo Pagamento \n é Obrigatório !!");
			}else {
				var form_data = new FormData();

				var file_data = $("#fl_nota").prop("files")[0];

					form_data.append("fl_nota", file_data);
					form_data.append("opcao", "upload_rec_pgto");
					form_data.append("id_pagamento",  $("#txtNumPgto").val())
					
					
				$.ajax({
					type: 'POST',
					url: 'mod_ajuda/backEnd/View/conEstoque/pagamento/valida.php?v=<?=md5(VERSAO)?>',
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,
					success: function(response) {
						if(response == 'sucesso'){
						alert("Upload Realizado com Sucesso !");
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

});

</script>